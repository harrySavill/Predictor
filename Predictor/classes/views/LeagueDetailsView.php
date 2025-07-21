<?php

class LeagueDetailsView extends DefaultView
{
private $league_details;
private $users;

    public function setLeagueDetails($league_details){
        $this->league_details = $league_details;
    }
    public function setUsers($users){
        $this->users = $users;
    }
    public function createPage()
    {
        $this->createDefaultPage();
        $this->createLeagueDetailsView();
        $this->addUsers();
        $this->createWebPageFooter();
    }


    private function createLeagueDetailsView(){
        $address = APP_ROOT_PATH;
        $html_output = <<<HTML
<main class="league-details-main">
<div class="league-details-heading">
<h2>{$this->league_details['name']}</h2>
<p>Join Code: {$this->league_details['join_code']}</p>
<p>League Admin: {$this->league_details['created_by']}</p>
<form class="leave-league-form" action="$address" method="post">
<input type="hidden" name="join_code" value="{$this->league_details['join_code']}">
<button class="submit-btn red-btn" type="submit" name="route" value="leave-league">Leave League</button>
</form>
</div>
HTML;
        $this->html_page_output .= $html_output;
    }
    private function addUsers() {
        $html_output = <<<HTML
<table class="league-details-table">
    <tr>
        <th>Username</th>
        <th>Gameweek Score</th>
        <th>Overall Score</th>
    </tr>
HTML;

        foreach($this->users as $user) {
            $html_output .= <<<HTML
    <tr class="league-details-user">
        <td class="league-details-username">{$user['username']}</td>
        <td class="league-details-gameweek">{$user['gameweek_points']}</td>
        <td class="league-details-overall">{$user['total_points']}</td>
    </tr>
HTML;
        }

        $html_output .= "</table>";
        $this->html_page_output .= $html_output;
    }

    private function createWebPageFooter()
    {
        $html_output = <<< HTML
</main>
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}