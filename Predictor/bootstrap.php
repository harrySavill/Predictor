<?php
/**
 * bootstrap.php
 *
 * Each route is hosted in its own directory. The __autoload function
 * iterates through an array of the directory names, looking for the required class.
 * If the class definition file is find, the class is then checked for correct instantiation.
 *
 * If there are any problems, the error class is instantiated for error processing
 * NB this could also be achieved by throwing an exception in a try-catch structure
 *
 * @package Task Management Project
 */

include_once 'autoload.php';

include_once 'settings.php';

session_start();

$router = Factory::buildObject('Router');
$router->routing();
$html_output = $router->getHtmlOutput();

echo $html_output;