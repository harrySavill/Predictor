<?php
/**
 * Validate.php
 */

class Validate
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    /**
     * Check that the route name from the browser is a valid route
     * If it is not, abandon the processing.
     * NB this is not a good way to achieve this error handling.
     *
     * @param $route
     * @return boolean
     */
    public function validateRoute($route)
    {
        $route_exists = false;
        $routes = [
            'login',
            'register',
            'registered',
            'login-submit',
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


}
