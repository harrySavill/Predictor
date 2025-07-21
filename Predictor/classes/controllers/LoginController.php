<?php
/**
 * LoginController.php
 *
 */

class LoginController extends ControllerAbstract
{
    private $validator;
    public function createHtmlOutput()
    {
        $route = $this->getRoute();
        if ($route == "login") {
            $this->buildLoginView();
        }
        if ($route == 'logout'){
            session_unset();
            session_destroy();
            session_start();
            $this->buildLoginView();

        }
        elseif ($route == "login-submit"){
            $this->handleLogin();
        }
    }

    private function getRoute()
    {
        return $_POST['route'] ?? 'login';
    }
    private function buildLoginView($errorMessage = null){
        $view = Factory::buildObject('LoginView');
        $view->setErrorMessage($errorMessage);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }

    private function authenticateLogin($email, $password)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('LoginModel');

        $model->setDatabaseHandle($database);
        $model->setEmail($email);
        $model->setPassword($password);
        return $model->login(); // returns true if login successful
    }

    private function validateEmail(){
        if (!$this->validator->validateEmail($_POST['email'])) {
            return false;
        }else  return true;
    }
    private function handleLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $this->validator = Factory::buildObject('Validate');
        if (!$this->validateEmail()) {
            $this->buildLoginView('invalid email');
        }

        else if($this->authenticateLogin($email, $password)){
            $_SESSION['email'] = $email;
            $_SESSION['loggedIn'] = true;

            $_SESSION['admin_status'] = ($this->getAdminStatus($email));


            $controller = Factory::buildObject('PredictionsController');
            $controller->createHtmlOutput();
            $this->html_output= $controller->getHtmlOutput();
        }else{
            $this->buildLoginView('Login failed, please try again.');
        }
    }
    private function getAdminStatus($email){
        $model = Factory::buildObject('LoginModel');
        $database = Factory::createDatabaseWrapper();

        $model->setDatabaseHandle($database);

        return $model->getAdminStatus($email);
    }
}
