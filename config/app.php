<?php
/**
 * Created by PhpStorm.
 * User: ENE
 * Date: 7/03/16
 * Time: 16:51
 */
define('URLWEB', 'http://' . $_SERVER['SERVER_NAME'] . '/');
define('VIEWS', dirname(__FILE__) . '/../resources/views/');
define('ASSETS', URLWEB . 'assets/');
define('DOWNLOADS', dirname(__FILE__) . '/../resources/downloads/');
define('ERRORS', dirname(__FILE__) . '/../errors/');
define('KERNEL', dirname(__FILE__) . '/../ene/');
define('CONTROLLERS', dirname(__FILE__) . '/../app/controllers/');
define('LIBRARIES', dirname(__FILE__) . '/../app/libraries/');
define('TABLES', dirname(__FILE__) . '/../app/tables/');

//DATABASE

define('DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'egrencuesta');
