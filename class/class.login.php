<?php
//start session
session_start();
class logmein{
	//database setup 
       //MAKE SURE TO FILL IN DATABASE INFO
	var $hostname_logon = 'localhost';		//Database server LOCATION
	var $database_logon = 'modpixco_website';		//Database NAME
	var $username_logon = 'modpixco_sam';		//Database USERNAME
	var $password_logon = 'AnH9iS#r=!F8';		//Database PASSWORD
	
	var $baseurl = 'http://www.modpix.com.au/';
	var $rootDirectory = '/home/modpixco/public_html/';
	//table fields
	var $user_table = 'logon';			//Users table name
	
	var $userid_column = 'id';
	var $user_column = 'useremail';		//USERNAME column (value MUST be valid email)
	var $fname_column = 'fname';		
	var $lname_column = 'lname';
	var $address_column = 'address';
	var $addresstwo_column = 'addresstwo';
	
	var $phone_column = 'phone';
	var $zip_column = 'zip';
	var $city_column = 'city';
	var $country_column = 'country';
	
	
	var $pass_column = 'password';		//PASSWORD column
	var $registration_date = 'registration_date';
	
	var $user_level = 'userlevel';		//(optional) userlevel column
	
	//encryption
	var $encrypt = true;		//set to true to use md5 encryption for the password
	
	var $sessionLimit = 28800;    //time set for session
		
	
	//connect to database
	function dbconnect(){
		$connections = mysql_connect($this->hostname_logon, $this->username_logon, $this->password_logon) or die ('Unabale to connect to the database');
		mysql_select_db($this->database_logon) or die ('Unable to select database!');	
		return $connections;
	}
	
	
	
	function timetodb($string = ''){
		if($string == ''){
			return date("Y-m-d H:i:s");
		}else{
			return date('Y-m-d H:i:s',strtotime($string));
		}
	}
	
	function timewebformat($string){
		return date('F j, Y',strtotime($string));
		
		// return date('F j, Y, g:i a',strtotime($string));   					// March 10, 2001, 5:16 pm
		// return date('m.d.y',strtotime($string));								// 03.10.01
		// return date('j, n, Y',strtotime($string));							// 10, 3, 2001
		// return date('Ymd',strtotime($string));								// 20010310
		// return date('h-i-s, j-m-y, it is w Day',strtotime($string)); 		// 05-16-18, 10-03-01, 1631 1618 6 Satpm01
		// return date('\i\t \i\s \t\h\e jS \d\a\y.',strtotime($string)); 		// it is the 10th day.
		// return date('D M j G:i:s T Y',strtotime($string)); 					// Sat Mar 10 17:16:18 MST 2001
		// return date('H:m:s \m \i\s\ \m\o\n\t\h',strtotime($string));  		// 17:03:18 m is month
		// return date('H:i:s',strtotime($string));  							// 17:16:18                    
	}
	
	
	
	
	function login($username, $password){
		//conect to DB
		$this->dbconnect();
		//make sure table name is set
//		if($this->user_table == ""){
//			$this->user_table = $table;
//		}
		//check if encryption is used
		if($this->encrypt == true){
			$password = md5($password);	
		}
		
		//execute login via qry function that prevents MySQL injections
		
		$result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->user_column."='?' AND ".$this->pass_column." = '?' AND status = 1;" , $username, $password);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			if($row[$this->user_column] !="" && $row[$this->pass_column] !=""){
				//register sessions
				//you can add additional sessions here if needed
				$_SESSION['loggedin'] = $row[$this->pass_column];
				$_SESSION['email'] = $row[$this->pass_column];
				$_SESSION['email'] = $row[$this->user_column];
				$_SESSION['userid'] = $row[$this->userid_column];
				$_SESSION['timeout'] = time();
				$_SESSION['name'] = $row[$this->fname_column].' '.$row[$this->lname_column];
				//userlevel session is optional. Use it if you have different user levels
				$_SESSION['userlevel'] = $row[$this->user_level];
				return true;	
			}else{
				session_destroy();
				return false;
			}
		}else{
			return false;
		}
		
	}
	
	//prevent injection
	function qry($query) {
	  $this->dbconnect();
      $args  = func_get_args();
      $query = array_shift($args);
      $query = str_replace("?", "%s", $query);
      $args  = array_map('mysql_real_escape_string', $args);
      array_unshift($args,$query);
      $query = call_user_func_array('sprintf',$args);
      $result = mysql_query($query) or die(mysql_error());
		  if($result){
		  	return $result;
		  }else{
		 	 $error = "Error";
		 	 return $result;
		  }
    }
	
	//logout function 
	function logout(){
		session_destroy();
		return;
	}
	
	//check if loggedin
	//function logincheck($logincode, $user_table, $pass_column, $user_column){
	
	function logincheck($logincode){
		//conect to DB
		$this->dbconnect();
		
		
		if(isset($_SESSION['timeout']) ) {
		$session_life = time() - $_SESSION['timeout'];
		
		if($session_life > $this->sessionLimit)
		{ 
			session_destroy(); 
			header("Location: ".$this->baseurl."user/logout.php"); }
		}
		
		//make sure password column and table are set
		if($this->pass_column == ""){
			$this->pass_column = $pass_column;	
		}
		if($this->user_column == ""){
			$this->user_column = $user_column;	
		}
		if($this->user_table == ""){
			$this->user_table = $user_table;	
		}
		//exectue query
		$result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->pass_column." = '?';" , $logincode);
		$rownum = mysql_num_rows($result);
		//return true if logged in and false if not
		if($row != "Error"){
			if($rownum > 0){
				return true;	
			}else{
				return false;	
			}
		}
	}
	
function existEmail($email){
		//conect to DB
		$this->dbconnect();
		//make sure password column and table are set
		if($this->pass_column == ""){
			$this->pass_column = $pass_column;	
		}
		if($this->user_column == ""){
			$this->user_column = $user_column;	
		}
		if($this->user_table == ""){
			$this->user_table = $user_table;	
		}
		//exectue query
		$result = $this->qry("SELECT * FROM ".$this->user_table." WHERE ".$this->user_column." = '?';" , $email);
		$rownum = mysql_num_rows($result);
		//return true if logged in and false if not
		if($row != "Error"){
			if($rownum > 0){
				return true;	
			}else{
				return false;	
			}
		}
	}
	
	//reset password
	function passwordreset($username, $user_table, $pass_column, $user_column){
		$shEmail =new sh_Email();
		//conect to DB
		$this->dbconnect();
		//generate new password
		$newpassword1 = $this->createPassword();
		
		//make sure password column and table are set
		if($this->pass_column == ""){
			$this->pass_column = $pass_column;	
		}
		if($this->user_column == ""){
			$this->user_column = $user_column;	
		}
		if($this->user_table == ""){
			$this->user_table = $user_table;	
		}
		//check if encryption is used
		if($this->encrypt == true){
			$newpassword = md5($newpassword1);	
		}
		
		//update database with new password
		$qry = "UPDATE ".$this->user_table." SET ".$this->pass_column."='".$newpassword."' WHERE ".$this->user_column."='".stripslashes($username)."'";
		$result = mysql_query($qry) or die(mysql_error());
		
		$to = stripslashes($username);
		
		//some injection protection
		$illigals=array("n", "r","%0A","%0D","%0a","%0d","bcc:","Content-Type","BCC:","Bcc:","Cc:","CC:","TO:","To:","cc:","to:");
		$to1 = str_replace($illigals, "", $to);
		$getemail = explode("@",$to);
		
		//send only if there is one email
		if(sizeof($getemail) > 2){
			return false;	
		}else{
			$shEmail->temPlatePasswordReset($newpassword1,$username);
			return $shEmail;			
		}
	}
	
	//create random password with 8 alphanumerical characters
	function createPassword() {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 7) {
			$num = rand() % 6;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	//login form
	
	function loginform($formname, $formclass, $formaction){
		//conect to DB
		$this->dbconnect();
		if(isset($_REQUEST['attempt'])){
			echo '<span style="color:red">Wrong username or password</span>';
		}
		echo'<form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
		
				<div><label for="username">Email Address</label><br />
				<input name="username" id="username" type="text"></div>
				<div><label for="password">Password</label><br />
				<input name="password" id="password" type="password"></div>
				<input name="action" id="action" value="login" type="hidden">
				<div>
				<input name="submit" id="submit" value="Login" type="submit">
				&nbsp;&nbsp;&nbsp;<a href="'.$this->baseurl.'index.php?pg=forgotpassword" class="grey">Forgot Password?</a>
				</div>
			</form>';
	}
	
	//reset password form
	function resetform($formname, $formclass, $formaction){
		//conect to DB
		$this->dbconnect();
		echo'<form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
				<div><label for="username">Username</label>
				<input name="username" id="username" type="text"></div>
				<input name="action" id="action" value="resetlogin" type="hidden">
				<div><input name="submit" id="submit" value="Reset Password" type="submit"></div>
			</form>';
	}
	//function to install logon table
	function cratetable($tablename){
		//conect to DB
		$this->dbconnect();
		$qry = "CREATE TABLE IF NOT EXISTS ".$tablename." (
			  id int(11) NOT NULL auto_increment,
			  useremail varchar(50) NOT NULL default '',
			  password varchar(50) NOT NULL default '',
			  userlevel int(11) NOT NULL default '0',
			  PRIMARY KEY  (userid)
			)";
		$result = mysql_query($qry) or die(mysql_error());
		return;
	}
	function registration($userLevel){
		//conect to DB
		$this->dbconnect();
		//USERNAME column (value MUST be valid email)
		/*
		$this->user_column = $_REQUEST['email'];
		$this->pass_column = $_REQUEST['password'];
		$this->fname_column = $_REQUEST['fname'];
		$this->lname_column = $_REQUEST['lname'];
		$this->address_column = $_REQUEST['address'];
		$this->addresstwo_column = $_REQUEST['addresstwo'];
		$this->phone_column = $_REQUEST['phone'];
		$this->zip_column = $_REQUEST['zip'];
		$this->city_column = $_REQUEST['city'];
		$this->country_column = $_REQUEST['country'];
		*/
		$qry = 'INSERT INTO logon (
			'.$this->fname_column.',
			'.$this->lname_column.', 
			'.$this->address_column.', 
			'.$this->addresstwo_column.', 
			'.$this->phone_column.',  
			'.$this->zip_column.',   
			'.$this->city_column.',  
			'.$this->country_column.',
			'.$this->user_column.', 
			'.$this->user_level.',
			'.$this->pass_column.')			
			VALUES ("'.trim($_REQUEST["fname"]).'","'.trim($_REQUEST["lname"]).'","'.trim($_REQUEST["address"]).'","'.trim($_REQUEST["addresstwo"]).'","'.trim($_REQUEST["phone"]).'","'.trim($_REQUEST["zip"]).'","'.trim($_REQUEST["city"]).'","'.trim($_REQUEST["country"]).'","'.trim($_REQUEST["email"]).'",'.$_REQUEST["userlevel"].',"'.md5(trim($_REQUEST["password"])).'")';
		
		$result = mysql_query($qry) or die(mysql_error());
			
		return $result;
	}
function delUser($userid){
		$this->dbconnect();
		
		$result = $this->qry("UPDATE logon SET status = '0' WHERE userid='?'",$userid);
	
	if($result == true){
			return 1;
		}else{
			return 0;
		}	
							
	}
function editregistration($userLevel){
		//conect to DB
		$this->dbconnect();
		//USERNAME column (value MUST be valid email)
		/*
		$this->user_column = $_REQUEST['email'];
		$this->pass_column = $_REQUEST['password'];
		$this->fname_column = $_REQUEST['fname'];
		$this->lname_column = $_REQUEST['lname'];
		$this->address_column = $_REQUEST['address'];
		$this->addresstwo_column = $_REQUEST['addresstwo'];
		$this->phone_column = $_REQUEST['phone'];
		$this->zip_column = $_REQUEST['zip'];
		$this->city_column = $_REQUEST['city'];
		$this->country_column = $_REQUEST['country'];
		*/
		$qry = "UPDATE logon SET
			".$this->fname_column." = '?',
			".$this->lname_column." = '?', 
			".$this->address_column." = '?', 
			".$this->addresstwo_column." = '?', 
			".$this->phone_column." = '?',  
			".$this->zip_column." = '?',   
			".$this->city_column." = '?',  
			".$this->country_column." = '?',
			".$this->user_column." = '?', 
			".$this->user_level." = '?',
			".$this->pass_column." = '?' WHERE userid='?'"
		;			
			//VALUES ("'.trim($_REQUEST["fname"]).'","'.trim($_REQUEST["lname"]).'","'.trim($_REQUEST["address"]).'","'.trim($_REQUEST["addresstwo"]).'","'.trim($_REQUEST["phone"]).'","'.trim($_REQUEST["zip"]).'","'.trim($_REQUEST["city"]).'","'.trim($_REQUEST["country"]).'","'.trim($_REQUEST["email"]).'",'.$userLevel.',"'.md5(trim($_REQUEST["password"])).'")';
		
			$result = $this->qry($qry,trim($_REQUEST["fname"]),trim($_REQUEST["lname"]),trim($_REQUEST["address"]),trim($_REQUEST["addresstwo"]),trim($_REQUEST["phone"]),trim($_REQUEST["zip"]),trim($_REQUEST["city"]),trim($_REQUEST["country"]),trim($_REQUEST["email"]),$_REQUEST["userlevel"],md5(trim($_REQUEST["password"])),$_REQUEST['id']);
				if($result == true){
					return true;
				}else{
					return false;
				}
		
		//$result = mysql_query($qry) or die(mysql_error());
			
		//return $result;
	}
}
?>