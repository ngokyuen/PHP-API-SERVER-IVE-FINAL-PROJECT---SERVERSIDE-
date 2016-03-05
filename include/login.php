<?php


if (isset($_POST) && isset($_POST["action"]) && $_POST["action"] == "login"){
    
    $username = isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : "";
	$password = isset($_POST['password']) ? mysql_real_escape_string($_POST['password']) : "";
    
    //搜尋資料庫資料
    $sql = "SELECT * FROM users where username='$username' and password='$password'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_row($result);
    $response = array();
    
    
    header('Content-type: application/json');
    
    if (count($rows) == 0){
         $response = array("result"=>false, "error_code"=>0);
    } else {
         $response = array("result"=>true, "content"=>array("token"=>$rows[0]["token"]));
    }
    
    echo 
         json_encode($response);
}


?>