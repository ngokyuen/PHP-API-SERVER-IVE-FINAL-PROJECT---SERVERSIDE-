<?php
  //�ˬd cookie ���� passed �ܼƬO�_���� TRUE
  $passed = $_COOKIE["passed"];
	
  /*  �p�G cookie ���� passed �ܼƤ����� TRUE
      ��ܩ|���n�J�����A�N�ϥΪ̾ɦV ../include/login.php	*/

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
  
  //�s����Ʈw
  $conn = create_connection();
  
  //����sql
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
      <a href="modify.php">�ק�|�����</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="delete.php">�R���|�����</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="logout.php">�n�X����</a>
    </p>
	</table>
  </body>
</html>