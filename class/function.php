<?php

function itemToCartwithOption($itemId = '', $itemOptionArray, $isAlbum = '',$imgId=''){
	include_once 'dbclass.php';
	$shDB =new sh_DB();
	
	if(isset($_REQUEST['additionalSide'])){
	$additionalSides = $_REQUEST['additionalSide'];
	}else{
		$additionalSides = 0;
	}
	
	if($isAlbum!=''){
		if($isAlbum['type']=='album'){
			$tableName = 'useralbum_img';
		
						$albumImageArray = array('useralbum_id' => $isAlbum['id']);									
						$albumImageArray = $shDB->selectOnMultipleCondition($albumImageArray,$tableName);				
		}
		
		if($isAlbum['type']=='collection'){
			$tableName = 'album_image';
		
						$albumImageArray = array('album_id' => $isAlbum['id']);									
						$albumImageArray = $shDB->selectOnMultipleCondition($albumImageArray,$tableName);
						
		}
	
	}
	
$data = array('id' => $itemId);									
						$product = $shDB->selectOnMultipleCondition($data,'prod_item');
						$product = $product[0];

	$totalImage = ($product['defaultsides']*$product['sidehole']) + ($additionalSides*$product['sidehole']); 
	
	
	if($_SESSION['sessionid']){
		$datainsert = array(
							'sessionid' => $_SESSION['sessionid'],
							'productid' => $product['id'],
							'name' => $product['name'],
							'sidehole' => $product['sidehole'],
							'addmaxsides' => $product['addmaxsides'],
							'addsidecost' => $product['addsidecost'],
							'defaultsides' => $product['defaultsides'],
							'additionalleaf' => $additionalSides,
							'basicprice' => $product['basicprice']					
							);
		
							$tempProductResult = $shDB->insert($datainsert,'temp_product');
							
							
							
							if($tempProductResult){
									
										$side = 1;
										for($i=1;$i<=$totalImage;$i++){
											// echo $i.'-'.$side.'<br />';
										if($isAlbum == ''){	
											
											if($imgId !=''){								
												$dataimginsert = array(
														'id' => '',
														'sideid' => $side,
														'temp_product_id' => $tempProductResult,
														'img_id' => $imgId
											);	
											}else{
											$dataimginsert = array(
																'id' => '',
																'sideid' => $side,
																'temp_product_id' => $tempProductResult
											);
												
											}
																		
										}else{
											if($isAlbum['type']=='collection'){
												$dataimginsert = array(
												'id' => '',
												'sideid' => $side,
												'temp_product_id' => $tempProductResult
												// 'img_id' => $albumImageArray[$i-1]['id']	 // uncomment if want to fill auto image									
												);
											}
											
											if($isAlbum['type']=='album'){
												$dataimginsert = array(
												'id' => '',
												'sideid' => $side,
												'temp_product_id' => $tempProductResult
												// 'img_id' => $albumImageArray[$i-1]['img_id']	 // uncomment if want to fill auto image									
												);
											}	
										}
										
										$tempProductImgResult = $shDB->insert($dataimginsert,'temp_product_img');	
										if(($i!=1)||($i!=0)){
											if(($i%$product['sidehole'])==0){$side++;}	
										}						
									}
									
							$optionSize = sizeof($itemOptionArray);
							if($optionSize>=1){
								foreach($itemOptionArray as $optArray){
									$datainsert = array(
										'id' => '',
										'temp_product_id' => $tempProductResult,
										'prod_item_option_id' => $optArray
										);
										$tempProductImgResult = $shDB->insert($datainsert,'temp_item_option');
								}
							}
							
							}
	 }
	 return true;	 
}



function randSessionId(){
	include_once 'dbclass.php';
	$shDB =new sh_DB();
	$randstring = randStrGenerator();
	 $sessionData = array(
						'sessionid' => $randstring
						);
	$sessionData = $shDB->selectOnMultipleCondition($sessionData,'usersession');
		if($sessionData){
			randSessionId();
		}else{
		$datainsert = array(
									'sessionid' => $randstring
									);
							$insertResult = $shDB->insert($datainsert,'usersession');
							if($insertResult){
								$_SESSION['sessionid'] = $randstring;								
							}
		}
	}
	
	

		function reArrayFiles(&$file_post) {
		
		    $file_ary = array();
		    $file_count = count($file_post['name']);
		    $file_keys = array_keys($file_post);
		
		    for ($i=0; $i<$file_count; $i++) {
		        foreach ($file_keys as $key) {
		            $file_ary[$i][$key] = $file_post[$key][$i];
		        }
		    }
		
		    return $file_ary;
		}
		
function deleteFolder($directory, $empty = false) {
    if(substr($directory,-1) == "/") {
        $directory = substr($directory,0,-1);
    }

    if(!file_exists($directory) || !is_dir($directory)) {
        return false;
    } elseif(!is_readable($directory)) {
        return false;
    } else {
        $directoryHandle = opendir($directory);
       
        while ($contents = readdir($directoryHandle)) {
            if($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;
               
                if(is_dir($path)) {
                    deleteAll($path);
                } else {
                    unlink($path);
                }
            }
        }
       
        closedir($directoryHandle);

        if($empty == false) {
            if(!rmdir($directory)) {
                return false;
            }
        }
       
        return true;
    }
} 
function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755))
    {
        $result=false;
       
        if (is_file($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if (!file_exists($dest)) {
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true);
                }
                $__dest=$dest."/".basename($source);
            } else {
                $__dest=$dest;
            }
            $result=copy($source, $__dest);
            chmod($__dest,$options['filePermission']);
           
        } elseif(is_dir($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if ($source[strlen($source)-1]=='/') {
                    //Copy only contents
                } else {
                    //Change parent itself and its contents
                    $dest=$dest.basename($source);
                    @mkdir($dest);
                    chmod($dest,$options['filePermission']);
                }
            } else {
                if ($source[strlen($source)-1]=='/') {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                } else {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                }
            }

            $dirHandle=opendir($source);
            while($file=readdir($dirHandle))
            {
                if($file!="." && $file!="..")
                {
                     if(!is_dir($source."/".$file)) {
                        $__dest=$dest."/".$file;
                    } else {
                        $__dest=$dest."/".$file;
                    }
                    //echo "$source/$file ||| $__dest<br />";
                    $result=smartCopy($source."/".$file, $__dest, $options);
                }
            }
            closedir($dirHandle);
           
        } else {
            $result=false;
        }
        return $result;
    } 
function invitation(){
include_once 'dbclass.php';
$shDB =new sh_DB();
$description = htmlentities(trim($_REQUEST['albumDescription']), ENT_QUOTES);
$securityCode = trim($_REQUEST['securityCode']);
if($description != ''){
	$updatedata = array(		
						'description' => $description
					);	
	$updateres = $shDB->update($updatedata,$_REQUEST['id'],'album');
	if($updateres){
		return true;
	}	
}
/*
	$user = $_REQUEST['userid'];
	foreach($user as $userid){
		$data = array(		
					'id' => $userid
					);									
		$Result = $shDB->selectOnMultipleCondition($data,'album_guest');
		if($Result){
			$res = $Result[0];
				$isSentMail = sendMailInvitation($res['guest_id']);
				if($isSentMail==true){
					$updatedata = array(		
						'notified' => '1'
					);	
					$shDB->update($updatedata,$res['id'],'album_guest');
				}
			
		}else{
			return false;
		}
	}	

*/
}

function timetodb($string = ''){
		if($string == ''){
			return date("Y-m-d H:i:s");
		}else{
			return date('Y-m-d H:i:s',strtotime($string));
		}
	}
	
	
	
function randStrGenerator(){
						$characters = array(
"A","B","C","D","E","F","G","H","J","K","L","M",
"N","P","Q","R","S","T","U","V","W","X","Y","Z",
"1","2","3","4","5","6","7","8","9");

//make an "empty container" or array for our keys
$keys = array();

//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
while(count($keys) < 20) {
    //"0" because we use this to FIND ARRAY KEYS which has a 0 value
    //"-1" because were only concerned of number of keys which is 32 not 33
    //count($characters) = 33
    $x = mt_rand(0, count($characters)-1);
    if(!in_array($x, $keys)) {
       $keys[] = $x;
    }
}

foreach($keys as $key){
   $random_chars .= $characters[$key];
}
return  $random_chars;
					}

function sendMailInvitation($userid,$collectionid){
	include_once 'dbclass.php';
	include_once 'class.email.php';
	$shDB =new sh_DB();
	$shMail =new sh_Email();
	$isMail = $shMail->temPlateInvitation($collectionid,$userid);
		if($isMail==true){
			return true;
		}else{
			return false;
		}
}


function addTempGuesttoLogon(){
include_once 'dbclass.php';
$shDB =new sh_DB();

		$data = array(		
					'album_id' => $_REQUEST['id']
					);
												
		$Result = $shDB->selectOnMultipleCondition($data,'album_guest');
		if($Result){
		foreach($Result as $res){
			$data = array(		
					'useremail' => $res['email']
					);									
			$emailExist = $shDB->selectOnMultipleCondition($data,'logon');
				if(!$emailExist){
					$datainsert = array(
						'id' => '',
						'useremail' => $res['email'],
						'userlevel' => 2
						);
						$insertResult = $shDB->insert($datainsert,'logon');
						if($insertResult){
								$guestinsert = array(
								'id' => '',
								'album_id' => $_REQUEST['id'],
								'guest_id' => $insertResult
								);
								$insertGuestResult = $shDB->insert($guestinsert,'album_guest');	
								if(!$insertGuestResult){
									return false;
								}else{
									$friendinsert = array(
								'id' => '',
								'userid' => $_SESSION['userid'],
								'friendid' => $insertResult
								);
								$insertFriendResult = $shDB->insert($friendinsert,'guest');	
									if(!$insertFriendResult){
										return false;
									}
								}							
						}	
				}else{
					$data = array(		
					'album_id' => $_REQUEST['id'],
					'guest_id' => $emailExist[0]['id']
					);									
					$guestExist = $shDB->selectOnMultipleCondition($data,'album_guest');
						if(!$guestExist){
						$guestinsert = array(
										'id' => '',
										'album_id' => $_REQUEST['id'],
										'guest_id' => $emailExist[0]['id']
										);
										$insertGuestResult = $shDB->insert($guestinsert,'album_guest');	
										if(!$insertGuestResult){
											return false;
										}
									$friendinsert = array(
										'id' => '',
										'userid' => $_SESSION['userid'],
										'friendid' => $emailExist[0]['id']
										);
										$insertFriendResult = $shDB->insert($friendinsert,'guest');	
											if(!$insertFriendResult){
												return false;
											}
						}else{
							$friendinsert = array(
								'id' => '',
								'userid' => $_SESSION['userid'],
								'friendid' => $emailExist[0]['id']
								);
								$insertFriendResult = $shDB->insert($friendinsert,'guest');	
								if(!$insertFriendResult){
									return false;
								}
						}
				}
			}
			
		}
return true;
}


//sending order notification bof
function sendOrderNotification($user_email){
	include_once 'dbclass.php';
	include_once 'class.email.php';
	$shDB =new sh_DB();
	
	$shMail =new sh_Email();
	$isMail = $shMail->temPlateOrderNotification($user_email);
		if($isMail==true){
			return true;
		}else{
			return false;
		}
}
//sending order notification bof

//get access for couple bof
function getAccess($selectAlbumByEmail){
	include_once 'dbclass.php';
	$shDB =new sh_DB();
	foreach($selectAlbumByEmail as $albByEmail){
			$selectAlbum = array(		
			'id' => $albByEmail['album_id'],
			'securitycode'  => (($_SESSION['scode'] !="")? $_SESSION['scode'] : $_REQUEST['upass'])
			);									
			$selectAlbum = $shDB->selectOnMultipleCondition($selectAlbum,'`album`');	
			if($selectAlbum){
				return $selectAlbum;
			}
	}	
	return '';
}
//get access for couple eof
?>
