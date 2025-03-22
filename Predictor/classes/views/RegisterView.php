<?php
/**
 * RegisterView.php
 *
 */

class RegisterView
{
    protected $page_title;
    protected $html_page_output;
    protected $error_message;

    public function __construct()
    {
        $this->page_title = '';
        $this->html_page_output = '';
        $this->error_message = '';
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
        $this->page_title = 'Register';
    }
    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
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
        $errorMessage = $this->error_message ? "<p class='error-message'>$this->error_message</p>" : "";

        $html_output = <<< HTML
    <header>
        <img src="$logo" alt="Predictor logo" class="logo">
    </header>
     <main class="register-main">
            <form class="login-form" action="$address" method="POST">
                <div class="text-div">
                    <h3 class="form-header">Create an Account</h3>
                    <p class="form-desc">Sign up to start making predictions and competing in leagues.</p>
                </div>

                <div class="input-container">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input required type="email" name="email" id="email" placeholder="Enter your email address">
                </div>

                <div class="input-container">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input required type="text" name="username" id="username" placeholder="Choose a username">
                </div>

                <div class="input-container">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input required type="password" name="password" id="password" placeholder="Enter your password">
                </div>

                <div class="input-container">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input required type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password">
                </div>

                <button name="route" value="registered" type="submit">Sign Up</button>
                
                {$errorMessage}

                <p class="register-link">Already have an account? <a href="index.php?route=login">Sign in</a></p>
            </form>
    </main>
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

