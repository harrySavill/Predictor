<?php

class LeaguesView extends DefaultView
{
    private $username;
    private $leagues;

    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setLeagues($leagues){
        $this->leagues = $leagues;
    }

    public function createPage()
    {
        $this->createDefaultPage();
        $this->insertPageContent();
        $this->displayLeagues();
        $this->createWebPageFooter();
    }

        private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<<HTML
    <main class="leagues-main">
    <div class="leagues-left-menu">
        <h3 class="leagues-left-header">Leagues</h3>
        <form action="$address" class="leagues-menu-form" method="post">
            <button class="league-menu-button" name="route" value="create-league">Create a League</button>
            <button class="league-menu-button" name="route" value="join-league">Join a League</button>
        </form>
    </div>
    <div class="leagues-center">
        <h2 class="leagues-center-header">Joined Leagues - $this->username</h2>
<div class="leagues-container-div">
            
HTML;
        $this->html_page_output .= $html_output;
    }
    private function displayLeagues()
    {
        if ($this->leagues) {
            $address = APP_ROOT_PATH;
            foreach ($this->leagues as $league) {
                $html_output = <<<HTML
<form action="$address" method="post">
    <input type="hidden" name="league_id" value="{$league['league_id']}">
    <button class="league" type="submit" name="route" value="league-detail">
        <p class="league-name">{$league['name']}</p>
        <p class="league-type classic-league">Classic</p>
        <div class="league-position-div">
            <i class="fa-solid fa-user-group"></i>
            <p class="league-position">{$league['rank']}/{$league['count']}</p>
        </div>
        <i class="fa-solid fa-arrow-right"></i>
    </button>
</form>
HTML;
            $this->html_page_output .= $html_output;
        }
        } else {
            $this->html_page_output .= "<p>You have not joined any leagues yet.</p>";
        }
    }
    private function createWebPageFooter()
    {
        $html_output = <<< HTML
</div>
</main>
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}