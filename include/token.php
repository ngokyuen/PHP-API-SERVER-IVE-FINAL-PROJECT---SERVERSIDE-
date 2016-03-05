<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<body background="../image/bg.jpg"> 
<?php
/*
$username = "";
$password = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = test_input($_POST["username"]);
   $password = test_input($_POST["password"]);
   //$status = test_input($_POST["status"]);

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


*/
session_start();
$status = 0;

function set_token() {
	return md5(microtime(true));
}

function valid_token() {
	$return = $_REQUEST['token'] === $_SESSION['token'] ? 1 : 0;
	set_token();
	return $return;
}

//如果空token, 則產生一個
if(!isset($_SESSION['token']) || $_SESSION['token']=='') {
	set_token();
}

if(isset($_POST['username'])){
	if(!valid_token()){
		echo "token null";
		$status = 0;
	}else{
		echo "token created";
		$status = 1;
	}
}

//Check Specail char
function filter($var) {
	return preg_replace('/[a-zA-Z0-9\s]/','',$var);
}

//unfinish function (status = 0 login fail, status = 1 login successful)
function status() {
	$status = "";
	switch ($status) {
		case $status = 1:
		echo "login successful";
		break;
		default:
		echo "login fail";	
	}
			
}

if (isset($_POST['submit'])) {
	if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']){
		

		$username = filter($_POST['username']);
		$password = filter($_POST['password']);
		
		//process data
		echo "Username: $username <br>Token: $token";
	}
}

//login function
function login(){
		$username = $_POST['username'];
        $password = $_POST['password'];
        $this->db->query("SELECT * FROM `project3b`.`users` WHERE username='$username' AND password='$password' AND (deleted IS NULL or deleted IS FALSE);");
        $users = $this->db->getArray();
        if (count($users) == 1) {
        $_SESSION['id'] = $users[0]['id'];
        }
    }
?>

<div class="form-group" style="text-align:center">
<img class="login-text" style="padding:20px;" src="../image/logo.png">
<form method="post" action="">
<table border ="0" align="center">
<tr><td>
<input type="text" autocomplete="off" class="form-control" style="margin-bottom: 16px;" id="username" name="username" placeholder="帳號" value=""></td></tr>
<tr><td>
<input type="password" autocomplete="off" class="form-control" style="margin-bottom: 16px;" id="password" name="password" placeholder="密碼" value=""></td></tr>
<input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
</table>
   <button type="reset" class="button positive" name="reset" value="reset">重設
   </button>
   <button type="submit" class="button positive" name="submit" value="submit" method="post" a href="register.php" />登錄<img alt="ok" src="../image/tick.png" />
   </button>                 
   </div>   
</form>


<!--Testing!-->
<?php
echo "<h3>Testing:</h3>";
//echo 'Username: '.$_POST['username'];
//echo "<br>";
//echo 'Password: '.$_POST['password'];
//echo "<br>";
//echo 'Status: '.$_SESSION['status'];
//echo "<br>";
//echo 'Token: '.$_REQUEST['token'];
//echo "<br>";
echo 'Session: '.$_SESSION['token'];
echo "<br>";
//echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>