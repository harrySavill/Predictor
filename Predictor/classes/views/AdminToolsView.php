<?php

class AdminToolsView extends DefaultView
{
    public function createPage()
    {
        $this->createDefaultPage();
        $this->createWebPageFooter();
    }
    private function createWebPageFooter()
    {
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<body class="admin-tools-body">
    <div class="admin-grid-container">
        <form class="admin-form" action="$address" method="POST">
            <h3 class="admin-form-header">Create Gameweek</h3>
            <button class="submit-btn" type="submit" name="route" value="create-gameweek">Create Gameweek</button>
        </form>
        
        <form class="admin-form" action="$address" method="POST">
            <h3 class="admin-form-header">Update Gameweek</h3>
            <label for="gameweek">Gameweek:</label>
            <input id="gameweek" name="gameweek" type="number" min="0" required>
            <button class="submit-btn" type="submit" name="route" value="update-gameweek">Update Gameweek</button>
        </form>
        <form class="admin-form" action="$address" method="POST">
            <h3 class="admin-form-header">Create Gameweek with Api</h3>
            <label for="gameweek">Gameweek: </label>
            <input id="gameweek" name="gameweek" type="number" min="0" required>
            <label for="league">League: </label>
            <select id="league" name="league" required>
                <option value="PL"  selected>English Premier League</option>
                <option value="BL1"  >German Bundesliga</option>                
                <option value="DED"  >Dutch Eredivisie</option>                
                <option value="PD"  >Spanish La Liga</option>                
                <option value="FL1"  >French Ligue 1</option>                
                <option value="ELC"  >English Championship</option>                
                <option value="SA"  >Italian Serie A</option>                
                <option value="PPL"  >Portuguese Primeira Liga</option>                
            </select>
            <button class="submit-btn" type="submit" name="route" value="create-gameweek-api">Create Gameweek using API</button>
        </form>
        <form class="admin-form" action="$address" method="POST">
            <h3 class="admin-form-header">Update Gameweek with Api</h3>
            <label for="gameweek">Gameweek: </label>
            <input id="gameweek" name="gameweek" type="number" min="0" required>
            <label for="league">League: </label>
            <input id="league" name="league" type="text" required>
            <button class="submit-btn" type="submit" name="route" value="update-gameweek-api">Update Gameweek using API</button>
        </form>
    </div>
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}