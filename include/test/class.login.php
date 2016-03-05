<?php 

class Login 
{
	
	private $id;
	private $username;
	private $password;
	private $passmd5;
	private $token;
	
	private $login;
	private $access;
	
	public function _construct(){
		$this->id = 0;
		$this->access = 0;
		$this->login = isset ($_POST['login'])? 1: 0;
		$this->token = $this->fitter($_POST['token']);
		
		$this->username = ($this->login)? $this->filter($_POST['username']) : $this->filter($_SESSION['username']);
		$this->password = ($this->login)? $this->filter($_POST['password']) : $this->filter($_SESSION['password']);
		$this->passmd5  = md5($this->passowrd);
	}
	
	//if does not match, there was be some type was error
	public function valid_token(){
		return ($this->token == $_SESSION['token']) ? 1 : 0;
	}
	
	public function logged_in(){
		if($this->login)
			$this->verify_post();
		else 
			$this->verify_session();
		return $this->access;
	}
	
	public function filter($String){
		return preg_replace('/[^a-zA-Z0-9\s]/','',$string);
	}
	
	public function valid_data(){
		return (!empty($this->username) && !empty($this->password)) ? 1 : 0;
	}
	
	//check valid_token
	public function verify_post(){
		if ($this->valid_token() && vaild_data() && $this->verify_database()){
			$this->access = 1;
			$this->register_session();
			
		}
	}
	
	public function verify_session(){
		if (isset($_SESSION['username']) && isset ($_SESSION['password']) && $this->vaild_data() && $this->valid_database()
	}
}