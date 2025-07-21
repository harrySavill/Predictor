<?php

class CreateLeagueView extends DefaultView
{
    private $error_message;

    public function setErrorMessage($error_message){
        $this->error_message = $error_message;
    }
    public function createPage(){
        $this->createDefaultPage();
        $this->addCreateLeagueForm();
    }
    private function addCreateLeagueForm()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<form method="POST" action="$address">
<label for="league_name">League name: </label>
<input type="text" name="league_name" id="league_name">
<button type="submit" class="submit-btn" name="route" value="create-league-submit">Create League</button>
</form>
<p class="error-message"> {$this->error_message}</p>
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}