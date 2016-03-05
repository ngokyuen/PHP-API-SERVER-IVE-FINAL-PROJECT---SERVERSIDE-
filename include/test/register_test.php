<?php
$sent = false;
	if ( isset($_POST['register']) ) 
    {
        $error = array();

        //Username validation
        if(!preg_match('/^[0-9]{8}$/', $_POST['username']))
        {
            $error[]='The username does not match the requirements';        
        }
        //Password validation
        if(!preg_match('/^[0-9]{8}$/', $_POST['password']))
        {
            $error[]='The password does not match the requirements';
        }

        if ( count($error) > 0) 
        {
            foreach ($error as $output) {
               echo "{$output} <br>";
			   $json = array("msg" => "Error adding user!");
            }
        } else {
            $sent = true;
			$json = array("msg" => "Done User added!");
        }
    }
	?>
	<?php if ($sent==false) { ?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="register">
        <input type="text" placeholder="Username" maxlength="15" name="username" value="<?php if (isset($_POST['username'])) {echo $_POST['username'];} ?>" /><br>
        <input type="password" maxlength="15" name="password" /><br>
        <input type="submit" value="Register" name="register"/>
    </form>

<?php } else { echo "Success!"; } ?>