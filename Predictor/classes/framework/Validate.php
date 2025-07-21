<?php

class Validate
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }


    public function validateRoute($route)
    {
        $route_exists = false;
        $routes = [
            'login',
            'logout',
            'register',
            'registered',
            'login-submit',
            'admin-tools',
            'predictions',
            'predictions-made',
            'create-gameweek-api',
            'update-gameweek-api',
            'leagues',
            'account-management',
            'create-gameweek',
            'gameweek-created',
            'update-gameweek',
            'gameweek-updated',
            'results',
            'create-league',
            'create-league-submit',
            'join-league',
            'join-league-submit',
            'league-detail',
            'leave-league',
        ];

        if (in_array($route, $routes)) {
            $route_exists =  true;
        } else {
            die();
        }
        return $route_exists;
    }

    public function validateString(string $input, int $min_length, int $max_length)
    {
        $sanitised_string = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        $length = strlen($sanitised_string);

        if ($length >= $min_length && $length <= $max_length) {
            return $sanitised_string;
        }

        return false;
    }


    public function validateEmail(string $email)
{
    $sanitised_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    return filter_var($sanitised_email, FILTER_VALIDATE_EMAIL) ?: false;
}
    public function validateInt($input)
    {
        $sanitized_input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        if (filter_var($sanitized_input, FILTER_VALIDATE_INT) === false) {
            return false;
        }
        if ($sanitized_input < 0) {
            return false;
        }
        return (int)$sanitized_input;
    }
}
