<?php
  
  //Token generate
	function set_token() {
	return md5(microtime(true));
	}
  
  //取得表單資料
	$username = isset($_POST['username']) ? mysqli_real_escape_string($SQL, $_POST['username']) : "";
	$password = isset($_POST['password']) ? mysqli_real_escape_string($SQL, $_POST['password']) : "";
	$token = set_token();

			
  //檢查帳號是否有人申請
  $query = "SELECT * FROM users Where username = '" . $username . "'";
  $result = mysqli_query($SQL, $query);

  //如果帳號已經有人使用 ==0 noone use, !=0 someone use
  if (mysqli_num_rows($result) != 0)
  {	
  //顯示訊息要求使用者更換帳號名稱
	$json = array ("result" => false, "error_code" => "username duplicate!");
  }
	
  //如果帳號沒人使用
  else
  {
    $query = "INSERT INTO `project3b`.`users` (`username`, `password`,`token` ) VALUES ('" . 
    "$username', '$password', '$token');";
    
	$json = array ("result"=>true, "content" => array());
	$result = mysqli_query($SQL, $query);
  }
	
	echo json_encode($json);
?>