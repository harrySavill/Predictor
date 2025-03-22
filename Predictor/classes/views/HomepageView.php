<?php

class HomepageView
{
    protected $page_title;
    protected $html_page_output;

    public function __construct()
    {
        $this->page_title = '';
        $this->html_page_output = '';
    }

    public function createPage()
    {
        $this->setPageTitle();
        $this->createWebPageMetaHeadings();
        $this->insertPageContent();
        $this->createWebPageFooter();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function setPageTitle()
    {
        $this->page_title = 'Predictor - Home';
    }

    private function createWebPageMetaHeadings()
    {
        $css_filename = CSS_PATH . CSS_FILE_NAME;
        $html_output = <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="$css_filename" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$this->page_title</title>
</head>
<body>
HTML;
        $this->html_page_output .= $html_output;
    }
    private function insertPageContent()
    {
        $address = APP_ROOT_PATH;
        $logo = MEDIA_PATH . LOGO;

        $html_output = <<<HTML
        <header>
            <img src="$logo" alt="Predictor logo" class="logo">
        </header>
        <p>You are logged in with the account for: {$_SESSION['email']}, this is an {$_SESSION['admin_status']} account.</p>
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