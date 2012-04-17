<?php
//start session
session_start();
class user{
	//database setup 
    //MAKE SURE TO FILL IN DATABASE INFO
	var $hostname_logon = 'localhost';		//Database server LOCATION
	var $database_logon = 'oscillos_callcare';		//Database NAME
	var $username_logon = 'oscillos_ccare';		//Database USERNAME
	var $password_logon = 'callcare123';		//Database PASSWORD
	
	var $zoho_credential = 'zoho_credential';

function allzohosettings(){
		$this->dbconnect();
		$result1 = $this->qry("SELECT * FROM ".$this->zoho_credential);
		while($row = mysql_fetch_array($result1))
		  {
		  	 $result[]=$row; 
		  }  
		  	
		 return $result;
	}
	
function changePotStatus($id,$salespersontype,$rdate,$status,$incontract,$representativenotes,$receptionnotes,$leadtickbox,$paperworkbox,$futuretickbox,$productid,$isUpload){
	$rdate = date('Y-m-d',strtotime($rdate));
	/*
	if($status=='Submitted'){
		if($leadtickbox=='Yes'){
			if($paperworkbox=='No'){
				$status = 'Finish';
			}
		}
		}
	*/
	
$result = $this->qry("UPDATE potential SET status  ='?',salespersontype='?',incontract ='?',renewaldate ='?',salesrepresentnotes='?', salesrecepnotes='?',leadtickbox='?',paperworkbox='?',futuretickbox='?',product ='?',documentuploaded ='?' WHERE id='?'",$status,$salespersontype,$incontract,$rdate,$representativenotes,$receptionnotes,$leadtickbox,$paperworkbox,$futuretickbox,$productid,$isUpload,$id);
		 
		if($result == true){
			return true;
		}else{
			return false;
		}
	}
	
function editnumber($id,$number){
$result = $this->qry("UPDATE potential SET number  ='?' WHERE id='?'",$number,$id);
if($result == true){
			return 1;
		}else{
			return 0;
		}
	}
	function editabn($id,$abn,$zohoid){
		include_once 'mycurl.php';
		include_once 'xml.class.php';
		include_once 'class.zoho.php';
		$zoho = new zoho();
		$xml = new Xml2Assoc();
		
		$myCurl = new CURL();
		
		$postedData = '<Accounts>							
						<row no="1">								
							<FL val="Company ABN/ACN">'.$abn.'</FL>					
						</row>						   
						</Accounts>';
		$postData = array(
       'xmlData' => $postedData
    );
		$zCredentials = $zoho->getZohoCredentials();
		$apiKey = $zCredentials['api'];
		$ticket = $zCredentials['ticket'];
		
		$result = $myCurl->post('https://crm.zoho.com/crm/private/xml/Accounts/updateRecords?newFormat=1&apikey='.$apiKey.'&ticket='.$ticket.'&id='.$zohoid,$postData);
		$results = $xml->parseString($result, false);
		if(is_array($results)){
			$resultid = $results['response'][0]['result']['recorddetail']['FL'][0][0];
		}
		if($resultid){			
			$result = $this->qry("UPDATE account SET abnnumber  ='?' WHERE id='?'",$abn,$id);
			if($result == true){
						return 1;
					}else{
						return 0;
					}
		}else{
			return 0;
		}
	}
function editsubject($id,$subject){
$result = $this->qry("UPDATE potential SET subject  ='?' WHERE id='?'",$subject,$id);
if($result == true){
			return 1;
		}else{
			return 0;
		}
	}
		
function finishpotentialbyId($id){
	$result = $this->qry("UPDATE potential SET status ='Finish' WHERE id='?'",$id);
	if($result == true){
			return true;
		}else{
			return false;
		}
	}
function updatePotFileUpload($id,$file){
	$result = $this->qry("UPDATE potential SET uploadedfile  ='?' WHERE id='?'",$file,$id);
	if($result == true){
			return true;
		}else{
			return false;
		}
	}
	
function clearTempNumberTable(){
		$this->dbconnect();
		$userid =  $_SESSION['loggedin'];
		$qry = "DELETE from temp_potential WHERE tempid = '$userid'";
	// $result = mysql_query($qry) or die(mysql_error());
	$result = $this->qry($qry);
	if($result == true){
			return 1;
		}else{
			return 0;
		}	
							
	}
		
	function getSalesOrderById($salesid){
		$this->dbconnect();
		$userid	= $_SESSION['userid'];
		$result = $this->qry("SELECT * FROM salesorder WHERE salesorderid ='?';" , $salesid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
	
	
	function getAccountsById($accountid){
		$this->dbconnect();		
		$result = $this->qry("SELECT * FROM account WHERE zohoid ='?';" , $accountid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
	function getAccountsByZohoId($zohoid){
		$this->dbconnect();		
		$result = $this->qry("SELECT * FROM account WHERE zohoid ='?';" , $zohoid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
	
function getProductByZohoId($zohoid){
		$this->dbconnect();		
		$result = $this->qry("SELECT * FROM products WHERE zohoid ='?';", $zohoid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
	
function getSalesRepresentativeId($representativeid){
		$this->dbconnect();		
		$result = $this->qry("SELECT * FROM logon WHERE userid ='?';" , $representativeid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
function getSalesmanagerById($salesManagerId){
		$this->dbconnect();		
		$result = $this->qry("SELECT * FROM salesmanager WHERE id =?;" , $salesManagerId);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}	
function getpotential($status){
		$this->dbconnect();
			$qry = "SELECT * FROM potential WHERE status='$status' ";
		
		$startDate = $rdate = date('Y-m-d',strtotime($_REQUEST['dateStart']));
		$endDate = date('Y-m-d',strtotime($_REQUEST['endStart']));
		$number = $_REQUEST['number'];
		$accountName = trim($_REQUEST['accountname']);
		
		if(isset($_REQUEST['dateStart'])&&isset($_REQUEST['endStart'])){
			if(($_REQUEST['dateStart']!='')&&($_REQUEST['endStart']!='')){
			$qry .= "AND createdate BETWEEN '$startDate' AND '$endDate' ";
			}
		}
		
		if(isset($_REQUEST['number'])){
			if($_REQUEST['number']!=''){
			$qry .= "AND number LIKE '%$number%' ";
			}
		}
		
		if(isset($_REQUEST['accountname'])){
			if($_REQUEST['accountname']!=''){
			$qry .= "AND accountname LIKE '%$accountName%' ";			
			}
		}
		
		$qry .= "ORDER BY createdate DESC;";
		
		$query = mysql_query($qry);
			
		while($row = mysql_fetch_array($query))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}
	
function getAllUser(){
		$this->dbconnect();
			$qry = "SELECT * FROM logon WHERE status = '1'";
		
		$result1 = $this->qry($qry);
		
		while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}
	
function getUserbyId($userid){
		$this->dbconnect();
		$qry = "SELECT * FROM logon WHERE userid = '?'";
		$result1 = $this->qry($qry,$userid);
		while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  			  	
			 return $result;
	}
	
function getpotential123($status){
		$this->dbconnect();
		$startDate = $_REQUEST['dateStart'];
		
		$endDate = $_REQUEST['endStart'];
		if(isset($_REQUEST['dateStart'])&&isset($_REQUEST['dateStart'])){
		$result1 = $this->qry("SELECT * FROM potential WHERE status='?' AND createdate BETWEEN '?' AND '?' ORDER BY createdate ASC;" , $status,$startDate,$endDate);
		}else{
		$result1 = $this->qry("SELECT * FROM potential WHERE status='?' ORDER BY createdate DESC;" , $status);
		}
		//$row=mysql_fetch_assoc($result);
		while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}

	function getpotentialbyId($potid){
		$this->dbconnect();
		
		$result = $this->qry("SELECT * FROM potential WHERE id ='?';" , $potid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
	
function getcontactbyId($contactid){
		$this->dbconnect();
		
		$result = $this->qry("SELECT * FROM contact WHERE id ='?';" , $contactid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
function getteamLeaderbyId($id){
		$this->dbconnect();
		
		$result = $this->qry("SELECT * FROM teamleader WHERE id ='?';" , $id);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}else{
			return 0;
		}
	}
	function getpotentialbyUserId($userid,$status){
		$this->dbconnect();
		$this->dbconnect();
			$qry = "SELECT * FROM potential WHERE status='$status' ";
		
		$startDate = $_REQUEST['dateStart'];
		$endDate = $_REQUEST['endStart'];
		$number = $_REQUEST['number'];
		$accountName = trim($_REQUEST['accountname']);
		
		if(isset($_REQUEST['dateStart'])&&isset($_REQUEST['endStart'])){
			if(($_REQUEST['dateStart']!='')&&($_REQUEST['endStart']!='')){
			$qry .= "AND createdate BETWEEN '$startDate' AND '$endDate' ";
			}
		}
		
		if(isset($_REQUEST['number'])){
			if($_REQUEST['number']!=''){
			$qry .= "AND number = '$number' ";
			}
		}
		
		if(isset($_REQUEST['accountname'])){
			if($_REQUEST['accountname']!=''){
			$qry .= "AND accountname LIKE '$accountName' ";
			}
		}
		
		$qry .= "AND salesrepresentativeid ='$userid' ";
		
		$qry .= "ORDER BY createdate DESC;";
		
		$result1 = $this->qry($qry);
		
		
		
		while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}
	
	function getNumber($tempid){
		$this->dbconnect();
		$userid	= $_SESSION['userid'];
		$result1 = $this->qry("SELECT * FROM temp_potential WHERE tempid ='?';" , $tempid);
		while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}

	
	function getTeamLeader(){
			$result1 = $this->qry("SELECT * FROM teamleader");
  	
			while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}
	
function getSalesPerson(){
			$result1 = $this->qry("SELECT * FROM logon WHERE userlevel!=0 AND status = 1");
  	
			while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}
	

	
function getSalesManager(){
			$result1 = $this->qry("SELECT * FROM salesmanager");
  	
			while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}

	
	
function getAccount(){
			$result1 = $this->qry("SELECT * FROM account ORDER BY name ASC");
  	
			while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  
			  	
			 return $result;
	}
function getContact(){
			$result1 = $this->qry("SELECT * FROM contact");  	
			while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  			  	
			 return $result;
	}

function getContactbyAccountId($zohoid){
			$result1 = $this->qry("SELECT * FROM contact WHERE accountzohoid ='?';" , $zohoid); 	
			while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  			  	
			 return $result;
	}
	
	
function getProducts(){
			$result1 = $this->qry("SELECT * FROM products ");  	
			while($row = mysql_fetch_array($result1))
			  {
			  	 $result[]=$row; 
			  }  			  	
			 return $result;
	}
	
function allsettings(){
		$this->dbconnect();
		$userid	= $_SESSION['userid'];
		$result = $this->qry("SELECT * FROM ".$this->zoho_credential);
		while($row = mysql_fetch_array($result))
			  {
			  	 $result[]=$row; 
			  }  			  	
			 return $result;
	}
	
		//connect to database
	function dbconnect(){
		$connections = mysql_connect($this->hostname_logon, $this->username_logon, $this->password_logon) or die ('Unabale to connect to the database');
		mysql_select_db($this->database_logon) or die ('Unable to select database!');	
		return;
	}

	function settings(){
		$this->dbconnect();
		$userid	= $_SESSION['userid'];
		$result = $this->qry("SELECT * FROM ".$this->zoho_credential." WHERE logonid ='?';" , $userid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row;
		}
	}
	
function addTeamLeader($name){
		$this->dbconnect();
		
$qry = 'INSERT INTO teamleader (
			name
			)			
			VALUES ("'.$name.'")';
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return mysql_insert_id();
		}else{
			return false;
		}
						
	}
function product_auto_suggest(){
	$this->dbconnect();
	$input = $_GET["prodname"];
	$data = array();
	// query your DataBase here looking for a match to $input
	$query = mysql_query("SELECT * FROM products WHERE name LIKE '%$input%'");
	while ($row = mysql_fetch_assoc($query)) {
	$name=$row['name'];
	$re_fname='<b>'.$input.'</b>';
	$final_fname = str_ireplace($q, $re_fname, $fname);
	echo '<div class="display_box" align="left">'.$final_fname.'</div>';		
	}
	
}
	
function addSalesPerson(){
		$this->dbconnect();
		$nowtime = date("Y-m-d H:i:s");
	$fname = $_REQUEST['fname'];
	$lname = $_REQUEST['lname'];
	$qry = 'INSERT INTO logon (
			fname,
			lname,
			userlevel,
			registration_date
			)			
			VALUES ("'.$fname.'","'.$lname.'",3,"'.$nowtime.'")';
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return mysql_insert_id();
		}else{
			return false;
		}
						
	}
	
function addsalesManager($name){
		$this->dbconnect();
		
$qry = 'INSERT INTO salesmanager (
			name
			)			
			VALUES ("'.$name.'")';
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return mysql_insert_id();
		}else{
			return false;
		}
						
	}

function delTempNumber($accountid){
		$this->dbconnect();
		
$qry = "DELETE from temp_potential WHERE id= $accountid";
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return 1;
		}else{
			return 0;
		}						
	}
function clearTempNumberList(){
		$this->dbconnect();
		$userid	= $_SESSION['userid'];
$qry = "DELETE from temp_potential WHERE tempid= $userid";
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return 1;
		}else{
			return 0;
		}						
	}
		
function addTempNumber($accountid,$number,$type,$carrier,$product){
		$this->dbconnect();
	$userid	= $_SESSION['userid'];	
$qry = 'INSERT INTO temp_potential (
			id,
			tempid,
			number,
			type,
			carrier,
			product,
			salesmanager
			)			
			VALUES ("","'.$accountid.'","'.$number.'","'.$type.'","'.$carrier.'","'.$product.'","'.$userid.'")';
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return mysql_insert_id();
		}else{
			return false;
		}						
	}
	
function addContact($accountzohoid,$contactzohoid,$fname,$lname,$email,$dob,$authorize){
		$this->dbconnect();
		
$qry = 'INSERT INTO contact (
			id,
			accountzohoid,
			zohoid,
			firstname,
			lastname,
			email,
			dob,
			isauthorized
			)			
			VALUES ("","'.$accountzohoid.'","'.$contactzohoid.'","'.$fname.'","'.$lname.'","'.$email.'","'.$dob.'","'.$authorize.'")';
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return mysql_insert_id();
		}else{
			return false;
		}						
	}
	
function addAccount($name,$zohoId,$abnumber){
		$this->dbconnect();
		
$qry = 'INSERT INTO account (
			name,
			zohoid,
			abnnumber,
			accounttype
			)			
			VALUES ("'.$name.'","'.$zohoId.'","'.$abnumber.'","Prospect")';
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return mysql_insert_id();
		}else{
			return false;
		}						
	}
	
function ticketUpdate($email,$password,$logonid){
		$this->dbconnect();
		$nowtime = date("Y-m-d H:i:s");
		$ticket = $this->ticketGeneration($email,$password);
		
		$result = $this->qry("UPDATE ".$this->zoho_credential." SET ticket ='?',ticket_last_update='?' WHERE logonid='?'",$ticket,$nowtime,$logonid);
		 
		if($result == true){
			return true;
		}else{
			return false;
		}
						
	}

function updateFields($id,$field,$value){
	$this->dbconnect();
	$result = $this->qry("UPDATE job_field SET ? ='?' WHERE id='?'",$field,$value,$id);
	if($result == true){
			return true;
		}else{
			return false;
		}
}

function updatezohoidtopot($id,$zohoid){
	$this->dbconnect();
	$nowtime = date("Y-m-d H:i:s");
	$result = $this->qry("UPDATE potential SET zohoid ='?', submitdate ='?' WHERE id='?'",$zohoid,$nowtime,$id);
	if($result == true){
			return true;
		}else{
			return false;
		}
}

function updatesubmittime($id){
	$this->dbconnect();
	$nowtime = date("Y-m-d H:i:s");
	$result = $this->qry("UPDATE potential SET submitdate ='?' WHERE id='?'",$nowtime,$id);
	if($result == true){
			return true;
		}else{
			return false;
		}
}

function generateRandStr(){
	$length = 20;
      $randstr = "";
      for($i=0; $i<$length; $i++){
         $randnum = mt_rand(0,61);
         if($randnum < 10){
            $randstr .= chr($randnum+48);
         }else if($randnum < 36){
            $randstr .= chr($randnum+55);
         }else{
            $randstr .= chr($randnum+61);
         }
      }
      return $randstr;
   } 
   	
   
function getJobTitlefromSettings(){
		$this->dbconnect();
		$userid	= $_SESSION['userid'];
		$result = $this->qry("SELECT * FROM job_settings WHERE companyid ='?';" , $userid);
		$row=mysql_fetch_assoc($result);
		if($row != "Error"){
			return $row['jobtitle'];
			
		}
	}
	
function getJobTitlefromJobField($randid){
		$this->dbconnect();
		$userid	= $_SESSION['userid'];
		$title = $this->getJobTitlefromSettings();
		
		$result = $this->qry("SELECT value FROM job_field WHERE companyid ='?' AND jobrandid = '?' AND fieldname = '?';" , $userid,$randid,$title);
		$row=mysql_fetch_assoc($result);
		
		if($row != "Error"){
			return $row['value'];
		}
}


 function selectSalesOrder($start,$noofrecords){
  
   	$result1 = $this->qry("SELECT * FROM salesorder LIMIT ?, ?",$start,$noofrecords);
  	
	while($row = mysql_fetch_array($result1))
	  {
	  	 $result[]=$row; 
	  }  
	  	
	 return $result;
  }
  
 function selectSalesOrderbyid($id){
  
   	$result1 = $this->qry("SELECT * FROM salesorder WHERE salesorderid = '?'",$id);
  	
	while($row = mysql_fetch_array($result1))
	  {
	  	 $result[]=$row; 
	  }  
	  	
	 return $result;
  }
  
  
  function selectJobs($userid){
  
   	$result1 = $this->qry("SELECT * FROM job_field WHERE companyid=? AND fieldname = 'JOBOPENINGID'",$userid);
  	
	while($row = mysql_fetch_array($result1))
	  {
	  	 $result[]=$row; 
	  }  
	  	
	 return $result;
  }
  
  
  
 function selectJobField($randid){
  
 	$userid = $_SESSION['userid'];
   	$result1 = $this->qry("SELECT * FROM job_field WHERE companyid=? AND jobrandid = '?' AND fieldfor = 'jobopenings' ORDER BY displayorder ASC",$userid,$randid);
  	
	while($row = mysql_fetch_array($result1))
	  {
	  	 $result[]=$row; 
	  }  
	  	
	 return $result;
  }
  
 function selectCandidateField(){
  
 	$userid = $_SESSION['userid'];
   	$result1 = $this->qry("SELECT * FROM job_field WHERE companyid=? AND fieldfor = 'candidateform' ORDER BY displayorder ASC",$userid);
  	
	while($row = mysql_fetch_array($result1))
	  {
	  	 $result[]=$row; 
	  }  
	  	
	 return $result;
  }
  
  
function selectFieldByComId($userid=''){
 	if($userid==''){ 
 	$userid = $_SESSION['userid'];
 	}
 	
   	$result1 = $this->qry("SELECT * FROM job_field WHERE companyid=? ORDER BY displayorder ASC",$userid);
  	
	while($row = mysql_fetch_array($result1))
	  {
	  	 $result[]=$row; 
	  }  
	  	
	 return $result;
  }
  
function refreshFields(){
	require_once '../class/xml.class.php';
	$zohoCredentials = $this->settings();
	$noOfRecords = 200;
	$comId = $_SESSION['userid'];
	 
	$apiRequestURL = 'https://recruit.zoho.com/ats/private/xml/JobOpenings/getRecords?apikey='.$zohoCredentials['api'].'&ticket='.$zohoCredentials['ticket'].'&sortColumnString=Date%20opened&sortOrderString=desc&fromIndex=1&toIndex=200';
	$xml = new Xml2Assoc();
	
	$practice = $xml->parseFile($apiRequestURL, false);
	foreach ($practice['response'][0]['result']['JobOpenings']['row'] as $value) {
		$rand = $this->generateRandStr();
		 foreach($value['FL'] as $field){
		 	$result = $this->insertFieldtoDB($comId,$rand,trim($field['val']),trim($field[0]));
		 	echo $rand.' = '.$field['val'].' = '.$field[0].'<br />';
		 }
		 echo '<hr />';
	}
		
	}
	
function refreshcandidateFormFields(){
	require_once '../class/xml.class.php';
	$zohoCredentials = $this->settings();
	$noOfRecords = 200;
	$comId = $_SESSION['userid'];
	 
	$apiRequestURL = 'https://recruit.zoho.com/ats/private/xml/Candidates/getFormFields?apikey='.$zohoCredentials['api'].'&ticket='.$zohoCredentials['ticket'];
	$xml = new Xml2Assoc();
	
	$practice = $xml->parseFile($apiRequestURL, false);
	//var_dump($practice);
	foreach ($practice['response'][0]['result']['Candidates']['section'] as $value) {
		echo $value['name'].'<br />';
		$rand = $this->generateRandStr();
		$groupName = $value['name'];
		foreach($value['FL'] as $field){
			$result = $this->insertCandidateFieldtoDB($comId,$rand,trim($field[0]),trim($field['isMandatory']),$field['maxlength'],$field['type'],$field['isUnique'],$groupName);
		}
	}
//	foreach ($practice['response'][0]['result']['JobOpenings']['row'] as $value) {
//		$rand = $this->generateRandStr();
//		 foreach($value['FL'] as $field){
//		 	$result = $this->insertFieldtoDB($comId,$rand,trim($field['val']),trim($field[0]));
//		 	echo $rand.' = '.$field['val'].' = '.$field[0].'<br />';
//		 }
//		 echo '<hr />';
//	}
		
	}
	//var_dump($practice);
	
//https://recruit.zoho.com/ats/private/xml/Candidates/getFormFields?apikey=bfa43af8f8dacb91002b9e1a7d22845d&ticket=c7b6c75c2f311395570014aa39478c30

function insertCandidateFieldtoDB($comId,$rand,$fieldName,$isMandatory,$maxLength,$fieldType,$isUnique,$groupName){
	$qry = 'INSERT INTO job_field (
			id,
			companyid,
			fieldfor,
			jobrandid, 
			fieldname, 
			ismandatory,
			maxlength,
			fieldtype,
			isunique,
			groupname
			)			
			VALUES ("","'.$comId.'","candidateform","'.$rand.'","'.$fieldName.'","'.$isMandatory.'","'.$maxLength.'","'.$fieldType.'","'.$isUnique.'","'.$groupName.'")';
	
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return true;
		}else{
			return false;
		}
}

	
function insertFieldtoDB($comId,$rand,$fieldName,$fieldValue){
	$qry = 'INSERT INTO job_field (
			id,
			companyid,
			fieldfor,
			jobrandid, 
			fieldname, 
			value
			)			
			VALUES ("","'.$comId.'","jobopenings","'.$rand.'","'.$fieldName.'","'.$fieldValue.'")';
	
	 $result = mysql_query($qry) or die(mysql_error());
	//$result = $this->qry($qry);
	if($result == true){
			return true;
		}else{
			return false;
		}
}

function ticketGeneration($email,$password){
	require_once '../class/mycurl.php';
	$url = 'https://accounts.zoho.com/login?servicename=ZohoCRM&FROM_AGENT=true&LOGIN_ID='.$email.'&PASSWORD='.$password; //Modified Time
	$myCurl = new CURL();		
	$result = $myCurl->get($url,False);
	$result = explode('TICKET=', $result);
	$result = explode('RESULT', $result[1]);
	$ticket = trim($result[0]);
	return $ticket;
}

function updateSalesOrder($saledorderid,$status){
		$this->dbconnect();
		 $result = $this->qry("UPDATE salesorder SET isupdate = ? WHERE salesorderid='?'",$status, $saledorderid);
		if($result == true){
			return true;
		}else{
			return false;
		}
	}
	
function settingsUpdate(){
		$this->dbconnect();
		$zohoid=$_REQUEST['userid'];
		$zohopass=$_REQUEST['userpass'];
		$zohoapi=$_REQUEST['api'];
		$userid	= $_SESSION['userid'];
		$result = $this->qry("UPDATE ".$this->zoho_credential." SET zohouserid ='?', password='?',api='?' WHERE logonid='?'",$zohoid,$zohopass,$zohoapi,$userid);
		 
		if($result == true){
			return true;
		}else{
			return false;
		}
				
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
}
?>