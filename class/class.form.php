<?php 
class sh_Form {
		
	 //public $hostname_logon = 'localhost';				//Database server LOCATION
	public $emptymsg = ' can not be null<br />';
	public $validemailmsg = ' is not a valid email<br />';
	public $numericmsg = ' must be numeric<br />';
	
	public function __construct() {	
		
	}
	
	public function __destruct() {	
		
	}
	
 function getRealIp() {
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
         $ip=$_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
         $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
         $ip=$_SERVER['REMOTE_ADDR'];
       }
       return $ip;
    }

    function writeLog($where) {
    
    	$ip = getRealIp(); // Get the IP from superglobal
    	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
    	$date = date("d M Y");
    	
    	// create a logging message with php heredoc syntax
    	$logging = <<<LOG
    		\n
    		<< Start of Message >>
    		There was a hacking attempt on your form. \n 
    		Date of Attack: {$date}
    		IP-Adress: {$ip} \n
    		Host of Attacker: {$host}
    		Point of Attack: {$where}
    		<< End of Message >>
LOG;
// Awkward but LOG must be flush left
    
            // open log file
    		if($handle = fopen('hacklog.log', 'a')) {
    		
    			fputs($handle, $logging);  // write the Data to file
    			fclose($handle);           // close the file
    			
    		} else {  // if first method is not working, for example because of wrong file permissions, email the data
    		
    			$to = 'ADMIN@gmail.com';  
            	$subject = 'HACK ATTEMPT';
            	$header = 'From: ADMIN@gmail.com';
            	if (mail($to, $subject, $logging, $header)) {
            		echo "Sent notice to admin.";
            	}
    
    		}
    }

    function verifyFormToken($form) {
        
        // check if a session is started and a token is transmitted, if not return an error
    	if(!isset($_SESSION[$form.'_token'])) { 
    		return false;
        }
    	
    	// check if the form is sent with token in it
    	if(!isset($_POST['token'])) {
    		return false;
        }
    	
    	// compare the tokens against each other if they are still the same
    	if ($_SESSION[$form.'_token'] !== $_POST['token']) {
    		return false;
        }
    	
    	return true;
    }
    
    function generateFormToken($form) {
    
        // generate a token from an unique value, took from microtime, you can also use salt-values, other crypting methods...
    	$token = md5(uniqid(microtime(), true));  
    	
    	// Write the generated token to the session variable to check it against the hidden field when the form is sent
    	$_SESSION[$form.'_token'] = $token; 
    	
    	return $token;
    }
    
    function validate($data){
    	
    	if(!$data){
    		return false;
    	}
    	
    	$errMsg = '';  	
   
    	foreach($data as $key => $val){
    	 		$fieldval = '';
    	 		$validationArray = explode('|',$val);
    	 		$err = '';
    	 		$fieldval = $_REQUEST["$key"];
    	 		
			    	 if (in_array("empty", $validationArray)) {
			    			if($fieldval ==''){
						    	$err =  $key.$this->emptymsg;						    						    				    	
			    			}
						}
			    	 if (in_array("email", $validationArray)) {
				    	 		if($fieldval !=''){
					    			if($this->validEmail($fieldval) == false){
								    	$err =   $key.$this->validemailmsg;								    				    	
					    			}
				    	 		}
							}
							
					if (in_array("numeric", $validationArray)) {
								if($fieldval !=''){
									if(is_numeric($fieldval) == false){
								    	$err =  $key.$this->numericmsg;
								    	
					    			}
								}
							}
							
					$errMsg .= $err; 						
				}
   
    	if($errMsg == ''){  	
			return false;
    	}else{
    		return $errMsg;
    	}
    }
    
    function validEmail($email){
    	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
            if (preg_match($pattern, trim(strip_tags($email)))) { 
               	return true;
            } else { 
                return false;
            } 
    }
	
	
}
?>
