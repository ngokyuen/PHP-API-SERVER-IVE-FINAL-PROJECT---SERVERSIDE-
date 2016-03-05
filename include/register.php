<?php
  //require_once("mysql_config.inc.php");
  require_once("config.inc.php");
  //require_once("check_data.php");
  
  //Token generate
	function set_token() {
	return md5(microtime(true));
	}

	function valid_token() {
	set_token();
	return $return;
	}
  
  //取得表單資料
	$username = isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : "";
	$password = isset($_POST['password']) ? mysql_real_escape_string($_POST['password']) : "";
	$token = set_token();

  //建立資料連接
  $conn = create_connection();
			
  //檢查帳號是否有人申請
  $sql = "SELECT * FROM users Where username = '$username'";
  $result = mysql_query($sql);

  //如果帳號已經有人使用 ==0 noone use, !=0 someone use
  if (count($result)==0)
  {	
  //顯示訊息要求使用者更換帳號名稱
	$json = array ("msg" => "username duplicate!");
  }
	
  //如果帳號沒人使用
  else
  {
  //執行 SQL 命令，新增此帳號
  //Function of Username Validation 
	function valid_username($username) {
	if (valid_username($username.length) == 0) { //wrong
		alert("Please enter your phone number");
		return false;	
			}else{ //correct
			if (valid_username(count($username))!= 0 ) { //wrong
				alert("username does not exist");
				return false;
					}else{ //correct
					if (valid_username($username) == (valid_password($password))) { //wrong
						alert("username can not be password");
						return false;
							}else{ //correct
							if (valid_username($username.length) != 8) { //wrong 
							alert("username must 8 numbers");
							return false;
									}else{ //correct
									return true;
									alert("create success");
									return preg_match('/[0-9]{8}/',$username);
										}
								}
						}	
				}
	}
	
  //Function of Password Validation
	function valid_password($password) {
	if (valid_password($password) == 0) { //wrong 
		alert ("Please enter your password, password can not be null!");
		return false;
		}else{ //correct 
			if (valid_password($password) <= 7) { //wrong
			alert("Password must be more than 7 char!");
			return false;
			}else{ //correct
				if (valid_passowrd($password) != password($password)) { //wrong
				alert ("Password deos not same!");
				return false;
				}else{
					return true;
					alert("create success");
					return preg_match('/^[a-zA-Z0-9{8,20}]$/',$password);
					}
				}
			}		
	}
	
    $sql = "INSERT INTO `project3b`.`users` (`username`, `password`,`token` ) VALUES ('$username', '$password', '$token');";
	$json = array ("msg" => "username create!","username"=>$username, "token"=>$token);
	$result = mysql_query($sql);
  }
	
  //關閉資料連接	
  mysql_close($conn);
  
  /* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>