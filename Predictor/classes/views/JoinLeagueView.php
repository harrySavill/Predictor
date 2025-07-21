<?php

class JoinLeagueView extends DefaultView
{
    private $error_message;

    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
    }

    public function createPage(){
        $this->createDefaultPage();
        $this->createJoinLeagueForm();
    }
    private function createJoinLeagueForm()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<form method="POST" action="$address">
<label for="join_code">League Code: </label>
<input type="text" name="join_code" id="join_code">
<button type="submit" class="submit-btn" name="route" value="join-league-submit">Join League</button>
</form>
<p class="error-message">$this->error_message</p>
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}