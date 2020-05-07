<?php

/**
 * File Doc Comment
 *
 * PHP version 7
 *
 * @category Home_Work
 * @package  Does_Not_Exist
 * @author   Ildar Davletyarov <ildardaf@gmail.com>
 * @license  does not exist
 * @link     http://localhost/
 */

/**
 * Instruction Doc Comment
 *
 * @category Home_Work
 * @package  Does_Not_Exist
 * @author   Ildar Davletyarov <ildardaf@gmail.com>
 * @license  does not exist
 * @link     http://localhost/
 */

require "vendor/autoload.php";
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
spl_autoload_register(
    function ($className) {
        $path = str_replace(
            "\\",
            DIRECTORY_SEPARATOR,
            $_SERVER['DOCUMENT_ROOT']."\\".$className.'.php'
        );
        include $path;
    }
);
$logger =new Classes\Logger("log.json");
for ($i=0;$i<10;$i++) {
    $logger->alert("something");
    $logger->warning("something");
    $logger->emergency("something");
}
$logger->saveJson();