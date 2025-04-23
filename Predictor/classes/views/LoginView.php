<?php
/**
 * LoginView.php
 *
 */

class LoginView
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
        $this->page_title = 'Login';
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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
    <main class="login-main">
            <form class="login-form" action="$address" method="POST">
                <div class="text-div">
                    <h3 class="form-header">Welcome Back</h3>
                    <p class="form-desc">Enter your credentials to gain access to your account</p>
                </div>

                <div class="input-container">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input required type="email" name="email" id="email" placeholder="Enter your email address">
                </div>

                <div class="input-container">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input required type="password" name="password" id="password" placeholder="Enter your password">
                </div>

                <button class="submit-btn" type="submit" name="route" value="login-submit">Sign in</button>
                {$errorMessage}
                <p class="register-link">Don't have an account? <a href="index.php?route=register">Sign up</a></p>
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

