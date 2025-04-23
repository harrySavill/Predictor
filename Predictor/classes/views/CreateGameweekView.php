<?php

class CreateGameweekView extends DefaultView
{
    public function createPage()
    {
        $this->createDefaultPage();
        $this->insertGameweekCreationForm();
        $this->createWebPageFooter();
    }

    private function insertGameweekCreationForm(){
        $address = APP_ROOT_PATH;
        $js = JS_PATH . 'createMatch.js';
        $html_output = <<< HTML
<main class="create-match-main">
        <h3 class="pre-form-title">Create Gameweek</h3>
        <form action="$address" method="POST" class="create-gameweek-form">
            <div>
                <label for="gameweek">Gameweek:</label>
                <input type="number" name="gameweek" id="gameweek" class="gameweek-input" required>
            </div>
            <div class="fixtures-container" id="fixtures-container"></div>
            
            <button type="submit" class="submit-btn" name="route" value="gameweek-created">Create Gameweek</button>
        </form>
</main>  
<script type="module" src="$js"></script>
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