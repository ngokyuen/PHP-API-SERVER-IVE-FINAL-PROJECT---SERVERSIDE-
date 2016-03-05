<?php

  function create_connection()
  {
    $conn = mysql_connect("localhost", "root", "root")
      or die("無法建立資料連接<br><br>" . mysql_error());
	  
    mysql_query("SET NAMES utf8");
			   	
    return $conn;
  }
	
  function execute_sql($database, $sql, $conn)
  {
    $db_selected = mysql_select_db('project3b', $conn)
      or die("開啟資料庫失敗<br><br>" . mysql_error($conn));
						 
    $result = mysql_query($sql, $conn);
		
    return $result;
  }
?>