<?php

class PredictionsView extends DefaultView
{
    private $predictions;

    public function createPage()
    {
        $this->createDefaultPage();
        $this->createPredictionsForm();
        $this->createWebPageFooter();
    }

    public function setPredictions($predictions)
    {
        $this->predictions = $predictions;
    }

    private function createPredictionsForm()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<<HTML
<main class="update-scores-main">
    <h3 class="pre-form-title">Make Your Predictions</h3>
    <form action="$address" method="POST" class="update-predictions-form">
        <input type="hidden" name="gameweek" value="1">
        <div id="matches-container">
HTML;

        foreach ($this->predictions as $prediction) {
            $prediction_id = $prediction['prediction_id']; // Use prediction_id since match_id isn't in the data
            $home_team = htmlspecialchars($prediction['home_team'], ENT_QUOTES, 'UTF-8');
            $away_team = htmlspecialchars($prediction['away_team'], ENT_QUOTES, 'UTF-8');

            // If scores are NULL, use 0 as placeholder
            $home_score = $prediction['predicted_home_score'] ?? 0;
            $away_score = $prediction['predicted_away_score'] ?? 0;

            $html_output .= <<<HTML
            <div class="match">
                <span class="team-name">$home_team</span>
                <input type="number" name="home_score_{$prediction_id}" min="0" placeholder="$home_score" class="score-input">
                <span class="vs">vs</span>
                <input type="number" name="away_score_{$prediction_id}" min="0" placeholder="$away_score" class="score-input">
                <span class="team-name">$away_team</span>
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
