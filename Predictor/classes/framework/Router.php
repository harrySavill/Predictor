<?php
/**
 * Router.php
 *
 * Used for redirecting submissions to the correct place.
 * Routes need to be allowed in framework\Validate.php
 *
 */

class Router
{
    private $html_output;

    public function __construct()
    {
        $this->html_output = '';
    }

    public function __destruct(){}

    public function routing()
    {
        $html_output = '';

        // Set the selected route based on form submission or default
        $selected_route = $this->setRouteName();
        $route_exists = $this->validateRouteName($selected_route);

        // Check if the route exists and dispatch to the appropriate controller
        if ($route_exists == true)
        {
            $html_output = $this->selectController($selected_route);
        }

        // Process the HTML output
        $this->html_output = $this->processOutput($html_output);
    }
    /**
     * Determines the route name based on URL parameters or form submission.
     * If no route is provided, defaults to 'login'.
     *
     * @return string The selected route name.
     */
    private function setRouteName()
    {
        $selected_route = 'login'; // Default route

        // Check GET first, then POST
        if (isset($_GET['route'])) {
            $selected_route = $_GET['route'];
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['route'])) {
            $selected_route = $_POST['route'];
        }

        return $selected_route;
    }

    /**
     * Check to see that the route name passed from the client is valid.
     * If not valid, chances are that a user is attempting something malicious.
     * In which case, kill the app's execution.
     */
    private function validateRouteName($selected_route)
    {
        $route_exists = false;
        $validate = Factory::buildObject('Validate');
        $route_exists = $validate->validateRoute($selected_route);
        return $route_exists;
    }

    /**
     * Select the appropriate controller based on the selected route
     */
    public function selectController($selected_route)
    {
        switch ($selected_route)
        {
            case 'update-gameweek':
            case 'update-gameweek-api':
            case 'gameweek-updated':
                $controller = Factory::buildObject('UpdateGameweekController');
                break;
            case 'create-gameweek':
            case 'gameweek-created':
            case 'create-gameweek-api':
                $controller = Factory::buildObject('CreateGameweekController');
                break;

            case 'predictions':
            case 'predictions-made':
                $controller = Factory::buildObject('PredictionsController');
                break;
            case 'leagues':
                $controller = Factory::buildObject('LeaguesController');
                break;
            case 'account-management':
                $controller = Factory::buildObject('AccountManagementController');
                break;
            case 'admin-tools':
                $controller = Factory::buildObject('AdminToolsController');
                    break;
            case 'register':
            case 'registered':
                $controller = Factory::buildObject('RegisterController');
                break;
            case 'logout':
            case 'login':
            case 'login-submit';
            default:
                $controller = Factory::buildObject('LoginController');
                break;
        }

        $controller->createHtmlOutput();

        $html_output = $controller->getHtmlOutput();
        return $html_output;
    }

    /**
     * Process the HTML output
     */
    private function processOutput(string $html_output)
    {
        $processed_html_output = '';
        $process_output = Factory::buildObject('ProcessOutput');
        $processed_html_output = $process_output->assembleOutput($html_output);
        return $processed_html_output;
    }

    public function getHtmlOutput()
    {
        return $this->html_output;
    }


}
