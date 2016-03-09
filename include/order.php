<?php

//build class
class Job {
    private $SQL;
    
    function Job($SQL){
        $this->SQL = $SQL;
    }
    
    function addOrder(){
        $type = isset($_POST['type']) ? mysqli_real_escape_string($this->SQL, $_POST['type']) : "";
        $origin = isset($_POST['origin']) ? mysqli_real_escape_string($this->SQL, $_POST['origin']) : "";
	    $origin_remark = isset($_POST['origin_remark']) ? mysqli_real_escape_string($this->SQL, $_POST['origin_remark']) : "";
        $destination = isset($_POST['destination']) ? mysqli_real_escape_string($this->SQL, $_POST['destination']) : "";
	    $destination_remark = isset($_POST['destination_remark']) ? mysqli_real_escape_string($this->SQL, $_POST['destination_remark']) : "";
        $book_date = isset($_POST['book_date']) ? mysqli_real_escape_string($this->SQL, $_POST['book_date']) : "";
	    $passenger = isset($_POST['passenger']) ? mysqli_real_escape_string($this->SQL, $_POST['passenger']) : "";
        $contact_person = isset($_POST['contact_person']) ? mysqli_real_escape_string($this->SQL, $_POST['contact_person']) : "";
	    $contact_no = isset($_POST['contact_no']) ? mysqli_real_escape_string($this->SQL, $_POST['contact_no']) : "";
        $token = isset($_POST['token']) ? mysqli_real_escape_string($this->SQL, $_POST['token']) : "";
        $user_id = "";
        
        if ($token != ""){
            $query = "SELECT * FROM users WHERE token ='$token';";
            $result = mysqli_query($this->SQL, $query);
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["id"];   
        }
        
        if ($type == ""){
            $type = "normal";
        }
        
        $query = "INSERT INTO orders (type, user_id, origin, destination, origin_remark" .
        ", destination_remark, book_date, passenger, contact_person, contact_no) VALUES ('$type', " .
        (($user_id) ? $user_id :'NULL') .
        ",'$origin', '$destination', '$origin_remark'" .
        ", '$destination_remark', '$book_date', $passenger, '$contact_person', $contact_no);";
        
        //echo $query;
        $result = mysqli_query($this->SQL, $query);
        
        if (mysqli_insert_id($this->SQL))
            return array("result"=>true);
        else
            return array("result"=>false);
    }
}

//response variable
$response = array();

if (isset($_POST["action2"])){
    $job = new Job($SQL);
    
    switch($_POST["action2"]){
        case "addOrder":
            $response = $job->addOrder();
        break;
    }
}

echo json_encode($response);

?>