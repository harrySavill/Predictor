<?php

class ResultsView extends DefaultView
{
    private $results;

    public function createPage()
    {
        $this->createDefaultPage();
        $this->buildOutput();
        $this->createWebPageFooter();
    }

    public function setResults($results)
    {
        $this->results = $results;
    }

    private function buildOutput()
    {
        $this->html_page_output .= '<main class="results-main">';
        $this->html_page_output .= '<h2 class="results-h2">Your Prediction Results</h2>';

        if (empty($this->results)) {
            $this->html_page_output .= '<p>No results available.</p>';
        } else {
            foreach ($this->results as $result) {
                 $html_output = <<<HTML
                    <div class="results-match-card">
                        <div class="results-match-info">
                            <p class="results-team">{$result['home_team']} vs {$result['away_team']}</p>
                        </div>
                        <div class="results-prediction-row">
                            <p class="results-label">Your Prediction:</p>
                            <p class="results-score {$result['color_class']}">{$result['predicted_home_score']} - {$result['predicted_away_score']}</p>
                        </div>
                        <div class="results-prediction-row">
                            <p class="results-label">Actual Result:</p>
                            <p class="results-score {$result['color_class']}">{$result['home_score']} - {$result['away_score']}</p>
                        </div>
                        <div class="results-prediction-row">
                            <p class="results-label">Points Earned:</p>
                            <p class="results-points">{$result['points_earned']}</p>
                        </div>
                    </div>
HTML;
                $this->html_page_output .= $html_output;
            }
        }

        $this->html_page_output .= '</main>';
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