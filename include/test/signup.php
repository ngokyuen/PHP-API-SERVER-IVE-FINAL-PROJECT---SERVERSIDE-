<?php

//remove 2016/02/27 21:58


include_once('config.php');
//include_once('token.php');
	
	//token generate
	function set_token() {
	return md5(microtime(true));
	}

	function valid_token() {
	//$return = $_REQUEST['token'] === $_SESSION['token'] ? 1 : 0;
	set_token();
	return $return;
	}

	//Check username & password
	function valid_username($username) {
	return preg_match('/[0-9]{8}/',$username);
	}
	function valid_password($password) {
	//return preg_match('/[a-zA-Z0-9]{4,20}/',$var);
	return preg_match('/^[0-9]{8}$/',$password);
	}

	//check data correct
	//216/02/27 20:29 
	function check_data() {
		if (document.myForm.username.value.length == 0)
        {
          alert("「使用者帳號」一定要填寫哦...");
          return false;
        }
        if (document.myForm.username.value.length > 8)
        {
          alert("「使用者帳號」不可以超過 8 個字元哦...");
          return false;
        }
        if (document.myForm.password.value.length == 0)
        {
          alert("「使用者密碼」一定要填寫哦...");
          return false;
        }
        if (document.myForm.password.value.length > 10)
        {
          alert("「使用者密碼」不可以超過 10 個字元哦...");
          return false;
        }
        if (document.myForm.re_password.value.length == 0)
        {
          alert("「密碼確認」欄位忘了填哦...");
          return false;
        }
        if (document.myForm.password.value != document.myForm.re_password.value)
        {
          alert("「密碼確認」欄位與「使用者密碼」欄位一定要相同...");
          return false;
        }
	}
	
	if($_SERVER['REQUEST_METHOD'] == "POST") 
	{
	//get data
	$username = isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : "";
	$password = isset($_POST['password']) ? mysql_real_escape_string($_POST['password']) : "";
	$token = set_token();
	$getUser = mysql_query("select username from `users` where username='$username'");
	
	
	//check username is it exsit
	if (valid_username($username) && valid_password($password)) {
	$qur = mysql_query("select username from `users` where username='$username'");
	$result = mysql_fetch_assoc($qur);
	if (count($result)== 0) {
	//create new user
	//$sql = "INSERT INTO `project3b`.`users` (`username`, `password`,`token` ) VALUES ('$username', '$password', '$token');";
	//$qur = mysql_query($sql);

	}else{
	//error code
	}
	}

}
	//Data is work but not include validation
	// Insert data into data base
	
	if($qur){
		$json = array("msg" => "Done User added!");
	
	//執行 SQL 命令, 新增此帳號
		$sql = "INSERT INTO `project3b`.`users` (`username`, `password`,`token` ) VALUES ('$username', '$password', '$token');";
		$qur = mysql_query($sql);
	}else{
		$json = array("msg" => "Error adding user!");
		$json = array("msg" => "Request method not accepted");
	}
	//關閉資料連接
@mysql_close($conn);

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);