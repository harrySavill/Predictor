<?php

class FootballApiClient {
    private $baseUrl = 'http://api.football-data.org/v4';
    private $apiKey = '.env.apiKey';
    private $leagueCode;
    private $season = 2024;
    private $standingsCache = null;

    public function __construct() {
    }
    public function setLeagueCode($leagueCode) {
        $this->leagueCode = $leagueCode;
    }

    /**
     * Fetches fixtures for a given gameweek with team details
     */
    public function getFixturesWithDetails($gameweek) {
        $fixtures = $this->fetchFixtures($gameweek);
        if (!$fixtures) {
            return [];
        }

        if ($this->standingsCache === null) {
            $this->standingsCache = $this->fetchStandings();
        }

        $results = [];
        foreach ($fixtures as $fixture) {
            $homeTeamId = $fixture['homeTeam']['id'];
            $awayTeamId = $fixture['awayTeam']['id'];
            $matchDate = date('Y-m-d H:i:s', strtotime($fixture['utcDate']) - 3600);
            $homeTeamName = $fixture['homeTeam']['name'];
            $awayTeamName = $fixture['awayTeam']['name'];

            $homePosition = $this->getTeamPosition($homeTeamId);
            $awayPosition = $this->getTeamPosition($awayTeamId);

            $results[] = [
                'fixture_id' => $fixture['id'],
                'date' => $matchDate,
                'home_team' => [
                    'name' => $homeTeamName,
                    'id' => $homeTeamId,
                    'position' => $homePosition
                ],
                'away_team' => [
                    'name' => $awayTeamName,
                    'id' => $awayTeamId,
                    'position' => $awayPosition
                ]
            ];
        }

        return $results;
    }

    /**
     * Fetches fixtures for a specific gameweek from the API given the user inputted league code and gameweek.
     */
    private function fetchFixtures($gameweek) {
        $url = "{$this->baseUrl}/competitions/{$this->leagueCode}/matches?season={$this->season}&matchday={$gameweek}";
        $response = $this->makeApiRequest($url);

        if ($response && isset($response['matches'])) {
            return $response['matches'];
        }
        return [];
    }

    /**
     * Fetches standings for the league from the API for the given league code and season
     */
    private function fetchStandings() {
        $url = "{$this->baseUrl}/competitions/{$this->leagueCode}/standings?season={$this->season}";
        $response = $this->makeApiRequest($url);

        if ($response && isset($response['standings'][0]['table'])) {
            return $response['standings'][0]['table'];
        }
        return [];
    }

    /**
     * Get team position from standings cache.
     */
    private function getTeamPosition($teamId) {
        if (empty($this->standingsCache)) {
            return null;
        }

        foreach ($this->standingsCache as $standing) {
            if ($standing['team']['id'] === $teamId) {
                return $standing['position'];
            }
        }
        return null;
    }



    /**
     * Makes API request with cURL, handles errors and processes JSON response into PHP Array.
     */
    private function makeApiRequest($url) {
        $curl = curl_init();
        $curlOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_HTTPHEADER => [
                "X-Auth-Token: {$this->apiKey}"
            ]
        ];

        curl_setopt_array($curl, $curlOptions);
        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($result === false || $httpCode >= 400) {
            die("API request failed: URL=$url, HTTP_CODE=$httpCode");
        }

        $decoded = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("JSON decode error: " . json_last_error_msg());
        }

        return $decoded;
    }

    /**
     * Collects completed match results for a given gameweek,
     * including fixture IDs and the full-time scores of both teams.
     */
    public function getFinalScores($gameweek)
    {
        $fixtures = $this->fetchFixtures($gameweek);
        if (!$fixtures) {
            return [];
        }

        $results = [];
        foreach ($fixtures as $fixture) {
            if ($fixture['status'] !== 'FINISHED') {
                continue;
            }

            $homeGoals = $fixture['score']['fullTime']['home'];
            $awayGoals = $fixture['score']['fullTime']['away'];

            if ($homeGoals === null || $awayGoals === null) {
                continue;
            }

            $results[] = [
                'fixture_id' => $fixture['id'],
                'home_team' => [
                    'name' => $fixture['homeTeam']['name'],
                    'score' => $homeGoals
                ],
                'away_team' => [
                    'name' => $fixture['awayTeam']['name'],
                    'score' => $awayGoals
                ]
            ];
        }

        return $results;
    }
}

