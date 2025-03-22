<?php

class RegisterController extends ControllerAbstract
{
    private $validator;

    public function createHtmlOutput()
    {

        $route = $this->getRoute();

        if ($route == 'register') {
            $this->buildView();
        } elseif ($route == 'registered') {
            $this->validator = new Validate();
            $errorMessage = $this->validateInputs();

            if ($errorMessage) {
                $this->buildView($errorMessage);
            } else {

                $this->registerUser();
            }
        }
    }

    private function getRoute()
    {
        return $_POST['route'] ?? $_GET['route'];
    }

    private function buildView($errorMessage = null)
    {
        $view = Factory::buildObject('RegisterView');
        $view->setErrorMessage($errorMessage);
        $view->createPage();
        $this->html_output = $view->getHtmlOutput();
    }

    private function validateInputs()
    {
        // Validate Email
        if (!$this->validator->validateEmail($_POST['email'])) {
            return 'Invalid email address.';
        }

        // Validate Username (Min: 3, Max: 20)
        if (!$this->validator->validateString($_POST['username'], 3, 20)) {
            return 'Username must be between 3 and 20 characters.';
        }

        // Validate Passwords Match
        if (!$this->checkPasswordsMatch()) {
            return 'Passwords do not match!';
        }

        // Validate Password Strength
        if (!$this->checkPasswordStrength()) {
            return 'Password strength not met';
        }

        // Validate Username Uniqueness
        if (!$this->checkUsernameUnique()) {
            return 'Username already exists! Please login';
        }

        // Validate Email Uniqueness
        if (!$this->checkEmailUnique()) {
            return 'Email already in use! Please login.';
        }

        return null;
    }


    private function checkPasswordsMatch()
    {
        if ($_POST['password'] !== $_POST['confirm-password']) {
            return false;
        }
        return true;
    }
    private function checkPasswordStrength(){
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $_POST['password'])) {
            return false;
        }

        return true;
    }
    private function checkEmailUnique(){
        $model = Factory::buildObject('RegisterModel');
        $database = Factory::createDatabaseWrapper();
        $model->setEmail($_POST['email']);
        $model->setDatabaseHandle($database);

        return $model->checkEmailUnique();
    }
    private function checkUsernameUnique(){
        $model = Factory::buildObject('RegisterModel');
        $database = Factory::createDatabaseWrapper();
        $model->setUsername($_POST['username']);
        $model->setDatabaseHandle($database);

        return $model->checkUsernameUnique();

    }
    private function registerUser(){
        $model = Factory::buildObject('RegisterModel');
        $passwordManager = Factory::buildObject('PasswordManager');
        $database = Factory::createDatabaseWrapper();
        $model->setEmail($_POST['email']);
        $model->setUsername($_POST['username']);
        $model->setHashedPassword($passwordManager->hashPassword($_POST['password']));
        $model->setDatabaseHandle($database);


        $model->registerUser();
        $_POST['route'] = 'login';
        $controller = Factory::buildObject('LoginController');
        $controller->createHtmlOutput();
        $this->html_output= $controller->getHtmlOutput();
        

    }
}