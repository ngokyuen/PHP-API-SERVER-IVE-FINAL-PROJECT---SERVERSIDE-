<?php

error_reporting(E_ALL ^E_NOTICE);
ini_set('display_errors', 1);

$URL_ROOT = "";

$PAGE_PATH = 'view/page/';
$CLASS_PATH = 'include/';
$IMG_PATH = 'view/img/';
$JS_PATH = 'include/js/';
$CSS_PATH = 'view/css/';

$DATABASE_HOST = 'localhost';
$DATABASE_PORT = '3306';
$DATABASE_USERNAME = 'root';
$DATABASE_PASSWORD = 'root';
$DATABASE_TABLE = 'project3b';

/require_once $CLASS_PATH . 'database.php';
$SQL = new database($DATABASE_HOST, $DATABASE_PORT, $DATABASE_USERNAME, $DATABASE_PASSWORD, $DATABASE_TABLE);

require_once $CLASS_PATH . 'general.php';
require_once $CLASS_PATH . 'login.php';
$LOGIN = new login($SQL);
$LOGIN->verify_login();     //checking the login
$USER = $LOGIN->getUser();      //get user information after checking

?>
