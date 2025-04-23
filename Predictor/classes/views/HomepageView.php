<?php

class HomepageView extends DefaultView
{
    public function createPage()
    {
        $this->createDefaultPage();
        $this->createWebPageFooter();
    }
    private function createWebPageFooter()
    {
        $html_output = <<< HTML
this is the unimplemented homepage
</body>
</html>
HTML;
        $this->html_page_output .= $html_output;
    }
}