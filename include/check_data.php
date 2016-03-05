	<?

	//username can not 0 number
	//username can not be same
	//username can not equal to password
	//username at least 8 numbers
	
	function valid_username($username) {
	if (valid_username($username.length) == 0) { //wrong
		alert("Please enter your phone number");
		return false;	
			}else{ //correct
			if (valid_username(count($username))!= 0 ) { //wrong
				alert("username does not exist");
				return false;
					}else{ //correct
					if (valid_username($username) == (valid_password($password))) { //wrong
						alert("username can not be password");
						return false;
							}else{ //correct
							if (valid_username($username.length) != 8) { //wrong 
							alert("username must 8 numbers");
							return false;
									}else{ //correct
									alert("create success");
									return preg_match('/[0-9]{8}/',$username);
										}
								}
						}	
				}
	}
	
	function valid_password($password) {
	//return preg_match('/[a-zA-Z0-9]{4,20}/',$var);
	return preg_match('/^[0-9]{8}$/',$password);
	}
	
	?>