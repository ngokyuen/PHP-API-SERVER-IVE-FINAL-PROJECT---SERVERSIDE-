<?php


//Complete 2016/02/23



// Include config.php
include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "PUT"){
	$uid = isset($_SERVER['HTTP_UID']) ? mysql_real_escape_string($_SERVER['HTTP_UID']) : "";
	$status = isset($_SERVER['HTTP_STATUS']) ? mysql_real_escape_string($_SERVER['HTTP_STATUS']) : "";

	// Add your validations
	if(!empty($uid)){
		$qur = mysql_query("UPDATE  `project3b`.`users` SET  `status` =  '$status' WHERE  `users`.`ID` ='$uid';");
		if($qur){
			$json = array("status" => 1, "msg" => "Status updated!!.");
		}else{
			$json = array("status" => 0, "msg" => "Error updating status");
		}
	}else{
		$json = array("status" => 0, "msg" => "User ID not define");
	}
}else{
		$json = array("status" => 0, "msg" => "User ID not define");
	}
	@mysql_close($conn);

	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);