<!DOCTYPE HTML> 
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>打的的</title>
    <meta name="keywords" content="的士APP">
    <script>
		function getResourceUrlPrefix(){
			return "/kmgViewResource.fcFront"
		}
	</script>
	<link rel="stylesheet" href="../kmgViewResource.fcFront/8fe096c196029ce0a28958e89d8d7876.css">
	<script src="../kmgViewResource.fcFront/3a80974c778459cae9a240fc79fe97ad.js"></script></head>
<body background="../image/bg.jpg">

<?php
// define variables and set to empty values
$name = $password = $status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = test_input($_POST["name"]);
   $password = test_input($_POST["password"]);
   $status = test_input($_POST["status"]);

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<div id="login" class="main-container">
    <div class="wrap clearfix">
        <div class="login-container clearfix" id="loginContainer">
            <img class="login-text" style="padding:20px;" src="../image/logo.png">
            <form class="form-horizontal form" role="form">
                <input type="text" autocomplete="off" class="form-control" style="margin-bottom: 16px;" id="inputEmail3" name="Username" placeholder="帳號" value="">
                <input type="password" autocomplete="off" class="form-control" style="margin-bottom: 16px;" id="inputPassword3" name="Password" placeholder="密碼" value="">
                <div class="form-group" style="text-align:center">
                <button type="home" class="button positive" name="home" value="home" onclick="../index.html">
                回首頁
                </button>
                <button type="reset" class="button positive" name="reset" value="reset">
                重設
                </button>
                <button type="submit" class="button positive" name="submit" value="Submit" method="post">
                登錄 <img alt="ok" src="../image/tick.png" />
                </button>
                    
                </div>
				<?php 
				echo $name;
				echo "<br>";
				echo $password;
				echo "<br>";
				?>
				</form>
        </div>
    </div>
</div></body>
</html>
