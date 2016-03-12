<?php

//build class
class Job {
    private $SQL;
    private $type;
    private $origin;
	private $origin_remark;
    private $destination;
	private $destination_remark;
    private $book_date;
	private $passenger;
    private $contact_person;
	private $contact_no;
    private $token;
    
    function Job($SQL){
        $this->SQL = $SQL;
    }
    
    function addOrder(){
        $this->getPost();
        $user_id = "";
        
        if ($token != ""){
            $query = "SELECT * FROM users WHERE token ='$token';";
            $result = mysqli_query($this->SQL, $query);
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["id"];   
        }
        
        $query = "INSERT INTO orders (type, user_id, origin, destination, origin_remark" .
        ", destination_remark, book_date, passenger, contact_person, contact_no) VALUES ('$this->type', " .
        (($user_id) ? $user_id :'NULL') .
        ",'$this->origin', '$this->destination', '$this->origin_remark'" .
        ", '$this->destination_remark', '$this->book_date', $this->passenger, '$this->contact_person', $this->contact_no);";
        
        //echo $query;
        $result = mysqli_query($this->SQL, $query);
        
        if ($order_id = mysqli_insert_id($this->SQL))
            return array("result"=>true, "order_id"=>$this->order_id);
        else
            return array("result"=>false);
    }
	
	//2016-03-09
	//remove function
	function removeOrder(){
		$id = isset($_POST['id']) ? mysqli_real_escape_string($this->SQL, $_POST['id']) : "";
		
		//non-finish validation
		//switch case
		$query = "UPDATE orders SET status ='cancel' where id = '$id';";
		$result = mysqli_query($this->SQL, $query);
        
        if ($order_id = mysqli_insert_id($this->SQL))
            return array("result"=>true);
        else
            return array("result"=>false);
    }
    
    //13 March 2016 Ted
    function getOrder(){
        
    }
	
	//2016-03-10
	//get General Order
	function getGeneralOrder(){
		$token = isset($_POST['token']) ? mysqli_real_escape_string($this->SQL, $_POST['token']) : ""; //client send
		$type = isset($_POST['type']) ? mysqli_real_escape_string($this->SQL, $_POST['type']) : ""; //client send
		
		//get token
		if ($token != ""){
            $query = "SELECT * FROM users WHERE token ='$token';";
            $result = mysqli_query($this->SQL, $query);
            $row = mysqli_fetch_assoc($result);
            //$user_id = $row["id"];   
        }
		
		//loop get data limit 5 orders
		$query = "SELECT id, type, book_date, origin, destination, passenger, status FROM orders Order BY book_date LIMIT 5;";
		if ($result = mysqli_query($this->SQL, $query)) {
			//loop begin
            $orders = array();
			while ($order_id = mysqli_fetch_array($result)) { //change to _array, non-finish
				$order =  array("id"=>$id,"type"=>$type,"book_date"=>$book_date,
                "origin"=>$origin, "origin"=>$origin,"destination"=>$destination, "passenger"=>$passenger,
                "status"=>$status);
                array_push($orders, $order);
		      }
			mysqli_free_result($result);
			return array ("result"=>true, "content"=>$orders);
        } else
            return array("result"=>false);
	}


	//2016-03-11
	//modifyGeneralOrderDistrict - non-finish
	function modifyGeneralOrderDistrict() {
		$token = isset($_POST['token']) ? mysqli_real_escape_string($this->SQL, $_POST['token']) : ""; //client send
		$id = isset($_POST['id']) ? mysqli_real_escape_string($this->SQL, $_POST['id']) : ""; //client send
		
		//get token
		if ($token != ""){
            $query = "SELECT * FROM users WHERE token ='$token';";
            $result = mysqli_query($this->SQL, $query);
            $row = mysqli_fetch_assoc($result);
            //$user_id = $row["id"];   
        }
		
		//loop get data check status != 'completed' OR 'cancel' (limit 5), if pending return true
		if ($status != 'completed' || $status != 'cancel'){ //pending return true, exec data (limit 5)
			$query = "SELECT  status, book_date, origin, destination FROM orders Order BY book_date LIMIT 5;";
			$result = mysqli_query($this->SQL, $query);
		} 
		else 
		{
			return array("result"=>false);
		}
		//non-finish
	$query = "UPDATE orders SET origin='".$_POST['origin']."', destination='".$_POST['destination']."' where id = '$id';";
	return array("result"=>true);

	
	}
    
    //13 March 2016 Ted
    //general post method variable
    function getPost(){
        $this->type = isset($_POST['type']) ? mysqli_real_escape_string($this->SQL, $_POST['type']) : "normal";
        $this->origin = isset($_POST['origin']) ? mysqli_real_escape_string($this->SQL, $_POST['origin']) : "";
	    $this->origin_remark = isset($_POST['origin_remark']) ? mysqli_real_escape_string($this->SQL, $_POST['origin_remark']) : "";
        $this->destination = isset($_POST['destination']) ? mysqli_real_escape_string($this->SQL, $_POST['destination']) : "";
	    $this->destination_remark = isset($_POST['destination_remark']) ? mysqli_real_escape_string($this->SQL, $_POST['destination_remark']) : "";
        $this->book_date = isset($_POST['book_date']) ? mysqli_real_escape_string($this->SQL, $_POST['book_date']) : "";
	    $this->passenger = isset($_POST['passenger']) ? mysqli_real_escape_string($this->SQL, $_POST['passenger']) : "";
        $this->contact_person = isset($_POST['contact_person']) ? mysqli_real_escape_string($this->SQL, $_POST['contact_person']) : "";
	    $this->contact_no = isset($_POST['contact_no']) ? mysqli_real_escape_string($this->SQL, $_POST['contact_no']) : "";
        $this->token = isset($_POST['token']) ? mysqli_real_escape_string($this->SQL, $_POST['token']) : "";
    }
}


if (isset($_POST["action2"])){
    $job = new Job($SQL);
    
    switch($_POST["action2"]){
        case "addOrder":
            $response = $job->addOrder();
        break;
		case "removeOrder": //2016-03-09
			$response = $job->removeOrder();
		break;
		case "getGeneralOrder": //2016-03-10
			$response = $job->getGeneralOrder();
		break;
		case "modifyGeneralOrderDistrict": //2016-03-11
			$respone = $job->modifyGeneralOrder();
		break;
    }
}

echo json_encode($response);

?>
