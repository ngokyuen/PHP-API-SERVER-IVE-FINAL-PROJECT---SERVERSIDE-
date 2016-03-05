<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
	
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向 ../include/login.php	*/

  if ($passed != "true")
  {
    header("location:../include/login.php");
    exit();
  }
  else
  {  
    require_once("config.inc.php");

  $username = $_POST['username'];
  $password = $_POST['password'];
  $token    = $_POST['token'];
  $date     = $_POST['date'];
  
  //連接資料庫
  $conn = create_connection();
  
  //執行sql
  $sql = "SELECT `id`, `username`, `password`,`date`, `token` from `users`;";
  $result = execute_sql($sql, $conn);
  } 
  
?>
<html>
  <head>
    <title>Testing data</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <p align="center"><img src=".jpg"></p>
    <p align="center">
	<table style="width:100%">
<tr>
    <td>Id</td>
    <td>Username</td>		
    <td>Create date</td>
	<td>Token</td>
</tr>
<tr>
	<td>$id</td>
	<td>$username</td>
	<td>$date</td>
	<td>$token</td>
</tr>
      <a href="modify.php">修改會員資料</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="delete.php">刪除會員資料</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="logout.php">登出網站</a>
    </p>
	</table>
  </body>
</html>