<?php
//資料庫設定
//資料庫位置
$db_server = "localhost";
//資料庫名稱
$db_name = "project3b";
//資料庫管理者帳號
$db_user = "root";
//資料庫管理者密碼
$db_passwd = "root";

//對資料庫連線
if(! $SQL = mysqli_connect($db_server, $db_user, $db_passwd, $db_name))
        die("無法對資料庫連線");

//資料庫連線採UTF8
mysqli_query($SQL, "SET NAMES utf8");

?> 