<?php

class UpdateGameweekView extends DefaultView
{
    private $matches;
    public function createPage()
    {
        $this->createDefaultPage();
        $this->createUpdateMatchForm();
        $this->createWebPageFooter();
    }
    public function setMatches($matches){
        $this->matches = $matches;
    }

    private function createUpdateMatchForm()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<<HTML
<main class="update-scores-main">
    <h3 class="pre-form-title">Update Match Scores</h3>
    <form action="$address" method="POST" class="update-scores-form">
        <input type="hidden" name="gameweek" value="1">
        <div id="matches-container">
HTML;

        foreach ($this->matches as $match) {
            $match_id = $match['match_id'];
            $home_team = htmlspecialchars($match['home_team'], ENT_QUOTES, 'UTF-8');
            $away_team = htmlspecialchars($match['away_team'], ENT_QUOTES, 'UTF-8');

            $html_output .= <<<HTML
            <div class="match">
                <span class="team-name">$home_team</span>
                <input type="number" name="home_score_{$match_id}" min="0" placeholder="0" class="score-input">
                <span class="vs">vs</span>
                <input type="number" name="away_score_{$match_id}" min="0" placeholder="0" class="score-input">
                <span class="team-name">$away_team</span>
                <input type="hidden" name="match_id[]" value="$match_id">
            </div>
HTML;
        }

        $html_output .= <<<HTML
        </div>
        <button name="route" value="gameweek-updated" type="submit" class="submit-btn">Update Scores</button>
    </form>
</main>
HTML;

        $this->html_page_output .= $html_output;
    }

    private function createWebPageFooter()
    {
        $html_output = <<< HTML
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}