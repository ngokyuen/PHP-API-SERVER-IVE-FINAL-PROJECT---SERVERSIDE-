<?php

//build class
class order {
    const MAX_DISTANCE = 0.05;
    private $SQL;
    private $type, $origin,$origin_remark;
    private $destination,$destination_remark;
	private $passenger, $contact_person, $contact_no;
    private $token,$user_id,$id;
    private $book_date, $created_date,$modified_date;
    private $status;
    private $origin_lat,$origin_lng;
    private $destination_lat,$destination_lng;
    private $current_lng,$current_lat = 0;
    private $is_five = false;
    
    function order($SQL){
        $this->SQL = $SQL;
    }
    
    function joinShareOrder(){
        $this->getPost();
        $query = "INSERT INTO users_join_orders (user_id, order_id) VALUES (" .
        "'$this->user_id', '$this->id')";
        
        $result = mysqli_query($this->SQL, $query);
        if ($order_id = mysqli_insert_id($this->SQL))
            return array("result"=>true);
        else
            return array("result"=>false);
    }
    
    function outShareOrder(){
        $this->getPost();
        $query = "UPDATE users_join_orders SET status='cancel' WHERE order_id=" .
        "'$this->id' AND user_id='$this->user_id'";
        
        $result = mysqli_query($this->SQL, $query);
        if (mysqli_affected_rows() != 0)
            return array("result"=>true);
        else
            return array("result"=>false);
    }
    
    function getJoinShareOrder(){
        $this->getPost();
        $query = "SELECT * FROM orders o WHERE " .
        " o.type='share' AND o.status='pending' " .
        " AND (o.user_id=$this->user_id " .
        " OR (SELECT 1 FROM users_join_orders uo WHERE " .
        " uo.user_id=$this->user_id and uo.status='join'" .
        " AND uo.order_id =o.id))";
        //echo $query;
        $items = $this->returnOrders($query);
        //print_r($items);
        if (count($items) > 0)
            return array("result"=>true, "content"=>$items);
        else
            return array("result"=>false);
    }
    
    function getNearShareOrder(){
        $this->getPost();
        $query = "SELECT * FROM orders o WHERE " .
        " o.type='share' AND o.status='pending' ".
        " AND ABS(o.origin_lng - $this->current_lng) <= " . self::MAX_DISTANCE .
        " AND ABS(o.origin_lat - $this->current_lat) <= " . self::MAX_DISTANCE .
        " AND o.id NOT IN (" .
        " SELECT o2.id FROM orders o2 WHERE " .
        " o2.type='share' AND o2.status='pending' " .
        " AND (o2.user_id=$this->user_id " .
        " OR (SELECT 1 FROM users_join_orders uo WHERE " .
        " uo.user_id=$this->user_id and status='join'" .
        " AND uo.order_id =o2.id)));";

        //echo $query;
        $items = $this->returnOrders($query);
        if (count($items) > 0)
            return array("result"=>true, "content"=>$items);
        else
            return array("result"=>false);
    }
    
    function getOtherShareOrder(){
        $this->getPost();
        $query = "SELECT * FROM orders o WHERE " .
        " o.type='share' AND o.status='pending' ".
        " AND ABS(o.origin_lng - $this->current_lng) > " . self::MAX_DISTANCE .
        " AND ABS(o.origin_lat - $this->current_lat) > " . self::MAX_DISTANCE .
        " AND o.id NOT IN (" .
        " SELECT o2.id FROM orders o2 WHERE " .
        " o2.type = 'share' AND o2.status = 'pending' " .
        " AND (o2.user_id = $this->user_id " .
        " OR (SELECT 1 FROM users_join_orders uo WHERE " .
        " uo.user_id = $this->user_id and status='join'" .
        " AND uo.order_id = o2.id)));";
        //echo $query;
        $items = $this->returnOrders($query);
        //print_r($items);
        if (count($items) > 0)
            return array("result"=>true, "content"=>$items);
        else
            return array("result"=>false);
    }
    
    function modifyOrder(){
        $this->getPost();
        //$this->updateLatLng();
        $query = "UPDATE orders SET " .
        " origin='" .  $this->origin . "'," .
	    " origin_remark='" .  $this->origin_remark . "'," .
        " destination='" .  $this->destination . "'," .
        " destination_remark='" .  $this->destination_remark . "'," .
        " book_date='" .  $this->book_date . "'," .
        " passenger='" .  $this->passenger . "'," .
        " contact_person='" .  $this->contact_person . "'," .
        " contact_no='" .  $this->contact_no . "'," .
        " origin_lat='" .  $this->origin_lat . "'," .
        " origin_lng='" .  $this->origin_lng . "'," .
        " destination_lat='" .  $this->destination_lat . "', " .
        " destination_lng='" .  $this->destination_lng . "', " .
        " is_five=" .  $this->is_five .
        " WHERE id=" . $this->id;
        //echo $query;
        if (mysqli_query($this->SQL, $query))
            return array("result"=>true);
        else
            return array("result"=>false);
    }
    
    function addOrder(){
        $this->getPost();
        //$this->updateLatLng();
        if ($this->type == "")
            $this->type = 'normal';
        
        $query = "INSERT INTO orders (type, user_id, origin, destination, origin_remark" .
        ", destination_remark, book_date, passenger, contact_person, contact_no, origin_lat, origin_lng, destination_lat, destination_lng, is_five) VALUES ('$this->type', " .
        (($this->user_id) ? $this->user_id :'NULL') .
        ",'$this->origin', '$this->destination', '$this->origin_remark'" .
        ", '$this->destination_remark', '$this->book_date', $this->passenger, '$this->contact_person', $this->contact_no" . 
        ", '$this->origin_lat', '$this->origin_lng', '$this->destination_lat', '$this->destination_lng', " . 
        (($this->is_five) ? $this->is_five :'NULL') .
        ");";
        
        //echo $query;
        $result = mysqli_query($this->SQL, $query);
        
        if ($order_id = mysqli_insert_id($this->SQL))
            return array("result"=>true);
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
		//$result = mysqli_query($this->SQL, $query);
        
        if (mysqli_query($this->SQL, $query))
            return array("result"=>true);
        else
            return array("result"=>false);
    }
    
    //13 March 2016 Ted
    function getOrder($condition = ""){
        $this->getPost();
        //echo $_POST["id"];
        $query = "SELECT * FROM orders ";
        $query2 .= cmdAddCond($query2, "and", "equal", array("id",$this->id));
        $query2 .= cmdAddCond($query2, "and", "equal", array("type",$this->type));
        $query2 .= cmdAddCond($query2, "and","equal",array("origin",$this->origin));
        $query2 .= cmdAddCond($query2, "and", "like", array("origin_remark",$this->origin_remark));
        $query2 .= cmdAddCond($query2, "and","equal",array("destination",$this->destination));
        $query2 .= cmdAddCond($query2, "and", "like", array("destination_remark", $this->destination_remark));
        $query2 .= cmdAddCond($query2, "and", "equal", array("book_date",$this->book_date));
        $query2 .= cmdAddCond($query2, "and","equal", array("passenger", $this->passenger));
        $query2 .= cmdAddCond($query2, "and","like", array("contact_person",$this->contact_person));
        $query2 .= cmdAddCond($query2, "and","like", array("contact_no",$this->contact_no));
        $query2 .= cmdAddCond($query2, "and","equal", array("status",$this->status));
        $query2 .= cmdAddCond($query2, "and","equal", array("user_id",$this->user_id));
        
        if ($query2)
            $query .= " WHERE " . $query2 . " " . $condition;
        else if ($condition)
            $query .= $condition;
            
        //echo $query;
        $items = $this->returnOrders($query);
        //print_r($items);
        if (count($items) > 0)
            return array("result"=>true, "content"=>$items);
        else
            return array("result"=>false);
    }
    
    //13 March 2016 Ted
    //general post method variable
    function getPost(){
        //$this->user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($this->SQL, $_POST['user_id']) : "";
        $this->id = isset($_POST['id']) ? mysqli_real_escape_string($this->SQL, $_POST['id']) : "";
        $this->type = isset($_POST['type']) ? mysqli_real_escape_string($this->SQL, $_POST['type']) : "";
        $this->origin = isset($_POST['origin']) ? mysqli_real_escape_string($this->SQL, $_POST['origin']) : "";
	    $this->origin_remark = isset($_POST['origin_remark']) ? mysqli_real_escape_string($this->SQL, $_POST['origin_remark']) : "";
        $this->destination = isset($_POST['destination']) ? mysqli_real_escape_string($this->SQL, $_POST['destination']) : "";
	    $this->destination_remark = isset($_POST['destination_remark']) ? mysqli_real_escape_string($this->SQL, $_POST['destination_remark']) : "";
        $this->book_date = isset($_POST['book_date']) ? mysqli_real_escape_string($this->SQL, $_POST['book_date']) : "";
	    $this->passenger = isset($_POST['passenger']) ? mysqli_real_escape_string($this->SQL, $_POST['passenger']) : "";
        $this->contact_person = isset($_POST['contact_person']) ? mysqli_real_escape_string($this->SQL, $_POST['contact_person']) : "";
	    $this->contact_no = isset($_POST['contact_no']) ? mysqli_real_escape_string($this->SQL, $_POST['contact_no']) : "";
        $this->created_date = isset($_POST['created_date']) ? mysqli_real_escape_string($this->SQL, $_POST['created_date']) : "";
        $this->status = isset($_POST['status']) ? mysqli_real_escape_string($this->SQL, $_POST['status']) : "";
        $this->token = isset($_POST['token']) ? mysqli_real_escape_string($this->SQL, $_POST['token']) : "";
        $this->origin_lat = isset($_POST['origin_lat']) ? mysqli_real_escape_string($this->SQL, $_POST['origin_lat']) : "";
        $this->origin_lng = isset($_POST['origin_lng']) ? mysqli_real_escape_string($this->SQL, $_POST['origin_lng']) : "";
        $this->destination_lat = isset($_POST['destination_lat']) ? mysqli_real_escape_string($this->SQL, $_POST['destination_lat']) : "";
        $this->destination_lng = isset($_POST['destination_lng']) ? mysqli_real_escape_string($this->SQL, $_POST['destination_lng']) : "";
        $this->current_lng = isset($_POST['current_lng']) ? mysqli_real_escape_string($this->SQL, $_POST['current_lng']) : "";
        $this->current_lat = isset($_POST['current_lat']) ? mysqli_real_escape_string($this->SQL, $_POST['current_lat']) : "";
        $this->is_five = isset($_POST['is_five']) ? mysqli_real_escape_string($this->SQL, $_POST['is_five']) : "";
        if ($this->token != ""){
            $query = "SELECT id FROM users WHERE token ='$this->token';";
            $result = mysqli_query($this->SQL, $query);
            $row = mysqli_fetch_assoc($result);
            $this->user_id = $row["id"];   
        }
    }
    
    function returnOrders($query){
        $items = array();
	    $result = mysqli_query($this->SQL, $query);
        while ($item = mysqli_fetch_assoc($result)){
            array_push($items, $item);
        }
        return $items;
    }
    
}

function cmdAddCond($cond_query, $cmd, $cmd2, $conds){
    $result="";
    if ($conds && $conds[0] && $conds[1]) {
        switch ($cmd){
            case "and":
                $result .= ($cond_query) ? " AND " : "";
            break;
            case "or":
                $result .= ($cond_query) ? " OR " : "";
            break;
        }
        switch ($cmd2){
            case "like":
                $result .= " " . $conds[0] . " LIKE '%" . $conds[1] . "%'";
            break;
            case "equal":
                $result .= " " . $conds[0] . "='" . $conds[1] . "'";
            break;
        }
    }
     return $result;     
}

if (isset($_POST["action2"])){
    $order = new order($SQL);
    //$order->getOrder();
    
    switch($_POST["action2"]){
        case "joinShareOrder":
            $response = $order->joinShareOrder();
        break;
        case "outShareOrder":
            $response = $order->outShareOrder();
        break;
        case "getOtherShareOrder":
            $response = $order->getOtherShareOrder();
        break;
        case "getJoinShareOrder":
            $response = $order->getJoinShareOrder();
        break;
        case "getNearShareOrder":
            $response = $order->getNearShareOrder();
        break;
        case "modifyOrder":
            $response = $order->modifyOrder();
        break;
        case "addOrder":
            $response = $order->addOrder();
        break;
		case "removeOrder": //2016-03-09
			$response = $order->removeOrder();
		break;
        case "getOrder":
            $response = $order->getOrder();
        break;
    }
}

echo json_encode($response);

?>
