<?php 

require_once("mysql_connect.inc.php");

if (isset($_POST) && isset($_POST["action"])){
    switch ($_POST["action"]) {
        case 'login':
            require_once("./include/mysql_connect.inc.php");
            break;
    }
} else {
    exit("No access to site");
}


?>