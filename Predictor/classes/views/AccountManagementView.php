<?php

class AccountManagementView extends DefaultView
{
    public function createPage()
    {
        $this->createDefaultPage();
        $this->insertLogoutButton();
        $this->createWebPageFooter();
    }

    private function insertLogoutButton(){
        $address = APP_ROOT_PATH;
        $html_output = <<< HTML
<form action="$address" method="POST">
    <button class="submit-btn" type="submit" name="route" value="logout">Logout</button>
</form>
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