<?php

    $username = isset($_POST['username']) ? mysqli_real_escape_string($SQL, $_POST['username']) : "";
	$password = isset($_POST['password']) ? mysqli_real_escape_string($SQL, $_POST['password']) : "";

    //搜尋資料庫資料
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    //echo $query;
    $result = mysqli_query($SQL, $query);
    $row = mysqli_fetch_assoc($result);
    
    
    if (mysqli_num_rows($result) == 0){
         $response = array("result"=>false, "error_code"=>0);
    } else {
         $response = array("result"=>true, "content"=>array("token"=>$row["token"]));
    }
    
    echo 
         json_encode($response);


?>