<?php
/**
 * autoload.php
 *
 * for more details, see http://uk1.php.net/manual/en/language.oop5.autoload.php
 *
 * If an attempt is made to instantiate an object is made with the keyword 'new', PHP looks
 * for the class definition.  If the relevant file has not been pre-included this function
 * is called, and the name of the class is passed in as a parameter.  This requires the
 * file name of the class definition file to be identical to the class.
 *
 * The function reads the names of the component directories, and looks in each in turn for the
 * class definition file.  If the relevant file exists, it is included, and the class instantiated.
 *
 * @param $class_name
 *
 * @package Task Management Project
 *
 */

spl_autoload_register(function ($class_name)
{
    $file_path_and_name = '';
    $directories = [];

    $file_name = $class_name . '.php';

    $directories = array_diff(scandir(CLASS_PATH), array('..', '.'));

    foreach ($directories as $directory)
    {
        $file_path_and_name = CLASS_PATH . $directory . DIRSEP . $file_name;

        if (file_exists($file_path_and_name))
        {
            require_once $file_path_and_name;
            break;
        }
    }
});
