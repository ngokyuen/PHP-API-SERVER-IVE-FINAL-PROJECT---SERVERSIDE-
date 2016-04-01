<?php
	// Include config.php
	include_once('config.php');

	$uid = isset($_GET['uid']) ? mysql_real_escape_string($_GET['uid']) :  "";
	if(!empty($uid)){
		$qur = mysql_query("select username, status, token from `users` where ID='$uid'");
		$result = array();
		while($r = mysql_fetch_array($qur)){
			extract($r);
			$result[] = array("username" => $username, "status" => $status, 'token' => $token); 
		}
		$json = array("status" => 1, "info" => $result);
	}else{
		$json = array("status" => 0, "msg" => "User ID not define");
	}
	@mysql_close($conn);

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);