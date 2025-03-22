<?php


define ('DIRSEP', DIRECTORY_SEPARATOR);
define ('URLSEP', '/');

$app_file_path = realpath(dirname(__FILE__));
$class_file_path = $app_file_path . DIRSEP . 'classes' . DIRSEP;

$app_root_path = dirname($_SERVER['PHP_SELF'], 1) . URLSEP;
$document_root = $_SERVER['HTTP_HOST'];
$app_root_path = 'http://' . $document_root . $app_root_path;

$application_name = 'Predictor';
$media_path = $app_root_path . 'media' . URLSEP;
$css_path = $app_root_path . URLSEP . 'css' . URLSEP;
$css_file_name = 'styles.css';
$logo = 'logo.png';

define ('CLASS_PATH', $class_file_path);
define ('APP_ROOT_PATH', $app_root_path);
define ('APP_NAME', $application_name);
define ('MEDIA_PATH', $media_path);
define ('LOGO', $logo);
define ('CSS_PATH' , $css_path);
define ('CSS_FILE_NAME', $css_file_name);


function getPdoDatabaseConnectionDetails()
{
    $rdbms = 'mysql';
    $host = 'localhost';
    $port = '3306';
    $charset = 'utf8mb4';
    $db_name = 'predictor_db';
    $pdo_dsn = $rdbms . ':host=' . $host. ';port=' . $port . ';dbname=' . $db_name . ';charset=' . $charset;
    $pdo_user_name = 'predictorUser';
    $pdo_user_password = 'predictorPassword';
    $db_connect_details['pdo_dsn'] = $pdo_dsn;
    $db_connect_details['pdo_user_name'] = $pdo_user_name;
    $db_connect_details['pdo_user_password'] = $pdo_user_password;
    return $db_connect_details;
}

