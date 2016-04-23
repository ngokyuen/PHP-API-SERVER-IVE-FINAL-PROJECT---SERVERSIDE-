<?php

class Profile {
    private $SQL;
    private $last_name,$first_name;
    private $home_no;
    private $email;
    private $address,$address2;
    private $sex;
    private $id;
    private $token;
    //for upload/download image
    private $img;
    
    private $result;
    
    function Profile($sql){
        $this->SQL = $sql;
    }
    
    function uploadProfileImage(){
        $this->getPost();
        //$binary=base64_decode($this->img);
        //header('Content-Type: bitmap; charset=utf-8');
        $file = fopen('img/' . $this->id, 'wb');
        //fwrite($file, $binary);
        fwrite($file, $this->img);
        fclose($file);
        return array("result"=>true);
    }
    
    function downloadProfileImage(){
        $this->getPost();
        $file = file_get_contents('img/' . $this->id);
        if ($file)
            return array("result"=>true, "content"=>array("img"=>$file));
        else
            return array("result"=>false);
    }
    
    function modifyProfile(){
        $this->getPost();
        $query = "UPDATE users SET" .
        " last_name='" . $this->last_name . "'" .
        " , first_name='" . $this->first_name . "'" . 
        " , home_no='" . $this->home_no . "'" . 
        " , email='" . $this->email . "'" . 
        " , address='" . $this->address . "'" . 
        " , address2='" . $this->address2 . "'" . 
        " , sex='" . $this->sex . "'" . 
        " WHERE token='" . $this->token . "';";
        //echo $query;
        //$result = mysqli_query($this->SQL, $query);
        //echo $query;
        if (mysqli_query($this->SQL, $query))
            return array("result"=>true);
        else
            return array("result"=>false);
    }
    
    function getProfile(){
        $this->getPost();
        //   $query = "SELECT * FROM users WHERE token='" . $this->token . "';";
		//   if ($result = mysqli_query($this->SQL, $query)) {
		//   	$user = mysqli_fetch_array($result);
		//   	mysqli_free_result($result);
        if ($this->token != ""){
			return array ("result"=>true, "content"=>$this->result);
        } else
            return array("result"=>false);
    }
    
    function getPost(){
        $this->id = isset($_POST['id']) ? mysqli_real_escape_string($this->SQL, $_POST['id']) : "";
        $this->last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($this->SQL, $_POST['last_name']) : "";
        $this->first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($this->SQL, $_POST['first_name']) : "";
	    $this->home_no = isset($_POST['home_no']) ? mysqli_real_escape_string($this->SQL, $_POST['home_no']) : "";
        $this->email = isset($_POST['email']) ? mysqli_real_escape_string($this->SQL, $_POST['email']) : "";
	    $this->address = isset($_POST['address']) ? mysqli_real_escape_string($this->SQL, $_POST['address']) : "";
        $this->address2 = isset($_POST['address2']) ? mysqli_real_escape_string($this->SQL, $_POST['address2']) : "";
	    $this->sex = isset($_POST['sex']) ? mysqli_real_escape_string($this->SQL, $_POST['sex']) : "";
        $this->token = isset($_POST['token']) ? mysqli_real_escape_string($this->SQL, $_POST['token']) : "";
        $this->result = array();
        if ($this->token != ""){
            $query = "SELECT * FROM users WHERE token ='".$this->token."';";
            $result = mysqli_query($this->SQL, $query);
            $this->result = mysqli_fetch_assoc($result);
            $this->id = $this->result["id"];
        }
        //for download/upload image
        $this->img = isset($_POST['img']) ? mysqli_real_escape_string($this->SQL, $_POST['img']) : "";
    }
}


if (isset($_POST["action2"])){
    $profile = new Profile($SQL);
    //$job->getOrder();
    
    switch($_POST["action2"]){
        case "modifyProfile":
            $response = $profile->modifyProfile();
        break;
        case "getProfile":
            $response = $profile->getProfile();
        break;
        case "uploadProfileImage":
            $response = $profile->uploadProfileImage();
        break;
        case "downloadProfileImage":
            $response = $profile->downloadProfileImage();
        break;
    }
    
    
    echo json_encode($response);    
}

?>