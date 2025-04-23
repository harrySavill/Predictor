<?php

class DefaultView
{
    protected $html_page_output;
    protected $isAdmin;

    public function __construct()
    {
        $this->page_title = '';
        $this->html_page_output = '';
        $this->isAdmin = false;
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    public function setAdminStatus($isAdmin){
        $this->isAdmin = $isAdmin;
    }
    private function setPageTitle()
    {
        $this->page_title = 'Predictor';
    }
    public function createDefaultPage()
    {
        $this->setPageTitle();
        $this->createWebPageMetaHeadings();
        $this->isAdmin ? $this->insertAdminPageContent(): $this->insertPageContent();
    }
    private function createWebPageMetaHeadings()
    {
        $css_filename = CSS_PATH . CSS_FILE_NAME;
        $html_output = <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="$css_filename" type="text/css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$this->page_title</title>
</head>
<body>
HTML;
        $this->html_page_output .= $html_output;
    }
    private function insertPageContent(){
        $address = APP_ROOT_PATH;
        $logo = MEDIA_PATH . LOGO;

        $html_output = <<<HTML
        <header>
            <img src="$logo" alt="Predictor logo" class="logo">
            <form class="header-links-form" action="$address" method="POST">
                <ul class="header-links">
                    <li>
                        <button class="header-link" type="submit" name="route" value="predictions">Predictions</button>
                    </li>                  
                    <li>
                        <button class="header-link" type="submit" name="route" value="leagues">Leagues</button>
                    </li>
                    
                    <li>
                        <button class="header-link" type="submit" name="route" value="account-management">
                            <span class="icon"><i class="fa-solid fa-user"></i></span>
                        </button>
                    </li>
                </ul>                
            </form>
        </header>
HTML;



        $this->html_page_output .= $html_output;
    }
    private function insertAdminPageContent()
    {
        $address = APP_ROOT_PATH;
        $logo = MEDIA_PATH . LOGO;

        $html_output = <<<HTML
        <header>
            <img src="$logo" alt="Predictor logo" class="logo">
            <form class="header-links-form" action="$address" method="POST">
                <ul class="header-links">
                    <li>
                        <button class="header-link" type="submit" name="route" value="predictions">Predictions</button>
                    </li>                  
                    <li>
                        <button class="header-link" type="submit" name="route" value="leagues">Leagues</button>
                    </li>
                    <li>
                        <button class="header-link" type="submit" name="route" value="admin-tools">Admin Tools</button>
                    </li>
                    <li>
                        <button class="header-link" type="submit" name="route" value="account-management">
                            <span class="icon"><i class="fa-solid fa-user"></i></span>
                        </button>
                    </li>
                </ul>                
            </form>
        </header>
HTML;



        $this->html_page_output .= $html_output;
    }

}