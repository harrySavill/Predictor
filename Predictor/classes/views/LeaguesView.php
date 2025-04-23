<?php

class LeaguesView extends DefaultView
{
    private $username;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function createPage()
    {
        $this->createDefaultPage();
        $this->createWebPageFooter();
    }
    private function createWebPageFooter()
    {
        echo $this->username . '<br>';
        $html_output = <<< HTML
this is the unimplemented leagues page.
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}