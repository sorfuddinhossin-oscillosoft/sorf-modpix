<?php
//start session
session_start();
class user{

	private function dbconnect(){
		$log = new logmein();
	    $conn = $log->dbconnect();
	    return $conn;
	}
	
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
		
	public function getAlbumById123($userid = ''){
		$this->dbconnect();
		
		if($userid == ''){
		$userid	= $_SESSION['userid'];
		}
		
		$result1 = $this->qry("SELECT * FROM album WHERE album_owner_id ='?';" , $userid);
		
		
		
		while($row = mysql_fetch_array($result1))
		  {
		  	 $result[]=$row; 
		  }  
		  	
		 return $result;
	}
	
	
	public function getAlbumByUserId($userid = ''){
		if($userid == ''){
		$userid	= $_SESSION['userid'];
			}
		$sql = "SELECT * FROM album WHERE album_owner_id = $userid";
		$allResult = $this->withPagination($url, $sql);
		return $allResult; // $allResult['records'] - is data; $allResult['pagination'] - is pagination; 
		}	
		
		
	public function withPagination($sql = ''){
		$conn = $this->dbconnect();
		$pager = new PS_Pagination($conn, $sql);
		$rs = $pager->paginate();
				
	
		if(!$rs) die(mysql_error());
		while($row = mysql_fetch_array($rs)) {
			$result[] = $row;
		}
		
		 // Records and Pagination Assignment
		$allResult['records'] = $result;
		$allResult['pagination'] = $pager->renderFullNav();
		
		// Return result and Paging String
		return $allResult;		
	}
		
}
?>