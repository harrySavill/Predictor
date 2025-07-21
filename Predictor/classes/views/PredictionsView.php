<?php

class PredictionsView extends DefaultView
{
    private $predictions;
    private $error_message;


    public function createPage()
    {
        $this->createDefaultPage();
        $this->createPredictionsForm();
        $this->createWebPageFooter();
    }
    private function formatLeaguePosition($number) {
        // Handle special cases for 11, 12, 13
        if ($number % 100 == 11 || $number % 100 == 12 || $number % 100 == 13) {
            return $number . 'th';
        }
        // Apply correct suffix based on last digit
        switch ($number % 10) {
            case 1:
                return $number . 'st';
            case 2:
                return $number . 'nd';
            case 3:
                return $number . 'rd';
            default:
                return $number . 'th';
        }
    }

    public function setPredictions($predictions)
    {
        $this->predictions = $predictions;
    }
    public function setErrorMessage($error_message){
        $this->error_message = $error_message;
    }
    private function createPredictionsForm()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<<HTML
<main class="update-scores-main">
    <h3 class="pre-form-title">Make Your Predictions</h3>
    <p class="error-message">{$this->error_message}</p>
    <form action="$address" method="POST" class="update-predictions-form">
        <input type="hidden" name="gameweek" value="1">
        <div id="matches-container">
HTML;

        foreach ($this->predictions as $prediction) {
            $prediction_id = $prediction['prediction_id']; // Use prediction_id since match_id isn't in the data
            $home_team = $prediction['home_team'];
            $away_team = $prediction['away_team'];

            // If scores are NULL, use 0 as placeholder
            $home_score = $prediction['predicted_home_score'] ?? 0;
            $away_score = $prediction['predicted_away_score'] ?? 0;

            $home_league_position = $this->formatLeaguePosition($prediction['home_league_position']);
            $away_league_position = $this->formatLeaguePosition($prediction['away_league_position']);

            $html_output .= <<<HTML
            <div class="match">
                <div class = "team-detail">
                    <span class="team-name">$home_team</span>
                    <span class="team-position">$home_league_position</span>
                </div>
                <input type="number" name="home_score_{$prediction_id}" min="0" placeholder="$home_score" class="score-input">
                <span class="vs">vs</span>
                <input type="number" name="away_score_{$prediction_id}" min="0" placeholder="$away_score" class="score-input">
                <div class="team-detail">                    
                    <span class="team-name">$away_team</span>
                    <span class="team-position">$away_league_position</span>
                </div>
                <input type="hidden" name="prediction_id[]" value="$prediction_id">
            </div>
HTML;
        }

        $html_output .= <<<HTML
        </div>
        <button name="route" value="predictions-made" type="submit" class="submit-btn">Update Scores</button>
    </form>
</main>
HTML;

        $this->html_page_output .= $html_output;
    }

    private function createWebPageFooter()
    {
        $html_output = <<<HTML
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}
