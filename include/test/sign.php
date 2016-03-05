<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<body background="../image/bg.jpg"> 

<?php
/*
* 定義POST to db

$username = $password = $status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = test_input($_POST["username"]);
   $password = test_input($_POST["password"]);
   $status = test_input($_POST["status"]);

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
*/
   
/*
* 測試用20160223 18:33
* 產生Token 位置
* 未連db
*/
session_start();
if (isset($_POST['submit'])) {
	if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']){
		

		$username = filter($_POST['username']);
		$password = filter($_POST['password']);
		
		//process data
		echo "Username: $username <br>Token: $token";
	}
}
/*
function set_token() {
	$_SESSION['token'] = md5(microtime(true));
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
*/

function filter($var) {
	return preg_replace('/[a-zA-Z0-9\s]/','',$var);
}

$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));

/*
if(isset($_POST['test'])){
	if(!valid_token()){
		echo "token error";
	}else{
		echo '成功提交，Value: '.$_POST['test'];
		echo "<br>";
		echo 'Token: '.$_REQUEST['token'];
		echo "<br>";
		echo 'Session: '.$_SESSION['session'];
	}
}
*/

?>
<div class="form-group" style="text-align:center">
<img class="login-text" style="padding:20px;" src="../image/logo.png">
<!--<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">!-->
<form method="post" action="">
<input type="text" autocomplete="off" class="form-control" style="margin-bottom: 16px;" name="username" placeholder="帳號" value="">
<input type="password" autocomplete="off" class="form-control" style="margin-bottom: 16px;" name="password" placeholder="密碼" value="">			

<input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">

   <button type="home" class="button positive" name="home" value="home" onclick="../index.html">回首頁
   </button>
   <button type="reset" class="button positive" name="reset" value="reset">重設
   </button>
   <button type="submit" class="button positive" name="submit" value="Submit" method="post">登錄 <img alt="ok" src="../image/tick.png" />
   </button>                 
   </div>   
</form>

<?php
echo "<h2>Result:</h2>";
echo $username;
echo "<br>";
echo $password;
?>

</body>