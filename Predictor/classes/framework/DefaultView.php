<?php

class DefaultView
{
    protected $page_title;
    protected $html_page_output;

    public function __construct()
    {
        $this->page_title = '';
        $this->html_page_output = '';
    }
    public function createDefaultPage(){
        $this->createWebPageMetaHeadings();
        $this->createHeader();
    }
    private function createWebPageMetaHeadings()
    {
        $css_filename = CSS_PATH . CSS_FILE_NAME;
        $html_output = <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="$css_filename" type="text/css" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$this->page_title</title>
</head>
<body class="default-body">
HTML;
        $this->html_page_output .= $html_output;
    }
    private function createHeader()
    {
        $address = APP_ROOT_PATH;
        $media_path = MEDIA_PATH;
        $html_output = <<< HTML
    <header>
        <img src="$media_path" alt="Predictor logo" class="logo">
    </header>
HTML;
        $this->html_page_output .= $html_output;


    }

}