<?php 
class imageprocessor {
	public $Thumbsize;	
	private $anotherVal;
	
	public function __construct() {	
		
	}
	
	public function __destruct() {	
		
	}

	
	public function readDirectory($dir = '.') {
			if ($handle = opendir($dir)) {
		    while (false !== ($file = readdir($handle))) {
		        $filelist[] = $file;
		    }
		    closedir($handle);
		    return $filelist;
		}		
	}
	
	public function makeDirectory($dir = '.') {		
		if(is_dir($dir)==false){
			if(mkdir($dir, 0777, true)){
				return true;
			}	
		}else{
			return false;
		}
	}
public function createalbumphotothumbsDir($mydir,$fileName = '',$albumid='') {		
			if(($userId == '')||($albumName=='')||($fileName=='')){
				//return false;
			}
	$dir = str_replace(chr(92),chr(47),getcwd());
	$dir = $dir.'/user';
	$useralbumdir = $mydir;
	
	$useralbumthumbdir = $useralbumdir.'/thumbs';
	
		if (!file_exists($useralbumthumbdir.'/'.$fileName)) {
			$thumb = new easyphpthumbnail;
			$thumb -> Thumbsize = 200;
			$thumb -> Copyrighttext = 'MODPIX';
			$thumb -> Copyrightposition = '50% 90%';
			$thumb -> Copyrightfonttype = $dir . '/handwriting.ttf';
			$thumb -> Copyrightfontsize = 12;
			$thumb -> Copyrighttextcolor = '#FFFFFF'; 
			$thumb -> Thumblocation = $useralbumthumbdir.'/';
			$thumb -> Thumbfilename = $file;
			$thumb -> Createthumb($useralbumdir.'/'.$fileName,'file');
			}		
	}
	public function createalbumphotothumbs($userId='',$albumName = '',$fileName = '',$albumid='') {		
			if(($userId == '')||($albumName=='')||($fileName=='')){
				//return false;
			}
	$dir = str_replace(chr(92),chr(47),getcwd());
	
	$useralbumdir = $dir.'/profile/'.$userId.'/'.$albumid.'_'.$albumName;
	
	$useralbumthumbdir = $dir.'/profile/'.$userId.'/'.$albumid.'_'.$albumName.'/thumbs';
	
	
		if (!file_exists($useralbumthumbdir.'/'.$fileName)) {
			$thumb = new easyphpthumbnail;
			$thumb -> Thumbsize = 200;
			$thumb -> Copyrighttext = 'MODPIX';
			$thumb -> Copyrightposition = '50% 90%';
			$thumb -> Copyrightfonttype = $dir . '/handwriting.ttf';
			$thumb -> Copyrightfontsize = 12;
			$thumb -> Copyrighttextcolor = '#FFFFFF'; 
			$thumb -> Thumblocation = $useralbumthumbdir.'/';
			$thumb -> Thumbfilename = $file;
			$thumb -> Createthumb($useralbumdir.'/'.$fileName,'file');
			}		
	}
	
function uploadPhototoDirectory($dir = '',$id='',$file = ''){
		
			
		$useralbumdir = $dir;
		//$useralbumdirThumbs = $dir.'/thumbs';
		
		if ((($_FILES["$file"]["type"] == "image/gif")
		|| ($_FILES["$file"]["type"] == "image/jpeg")
		|| ($_FILES["$file"]["type"] == "image/png")
		|| ($_FILES["$file"]["type"] == "image/pjpeg"))
		&& ($_FILES["$file"]["size"] < 2000000))
		  {
		  	
		  
		  if ($_FILES["$file"]["error"] > 0)
		    {
		    	return 'Error in file. Please try another photo';
		    }
		  else
		    {
//		    echo "Upload: " . $_FILES["$file"]["name"] . "<br />";
//		    echo "Type: " . $_FILES["$file"]["type"] . "<br />";
//		    echo "Size: " . ($_FILES["$file"]["size"] / 1024) . " Kb<br />";
//		    echo "Temp file: " . $_FILES["$file"]["tmp_name"] . "<br />";
		
		    if (file_exists($useralbumdir. $_FILES["$file"]["name"]))
		      {
		      	return false;
		      }
		    else
		      {
		      	if(move_uploaded_file($_FILES["$file"]["tmp_name"],
		     	 $useralbumdir . $_FILES["$file"]["name"])){
		      		$this->createalbumphotothumbsDir($useralbumdir,$_FILES["$file"]["name"]);
		      		
		      		$datainsert = array(
					'id' => '',
					'album_id' => $id,
					'image' => $_FILES["$file"]["name"],
					'modified_time' => date("Y-m-d H:i:s")
					);
					
					$shDB =new sh_DB();
					$imageResult = $shDB->insert($datainsert,'album_image');
					if($imageResult){
						return $imageResult;
					}
					
		      }else{
		      	 return false;
		      }
		      }
		    }
		  }
		else
		  {
		  	return 'Problem in file upload. Invalid file type or size';
		  }
	}
	
function uploadMainPhototoAlbum($userId='',$albumName = '',$file = '',$albumid){
		$dir = str_replace(chr(92),chr(47),getcwd());	
		$useralbumdir = $dir.'/profile/'.$userId.'/'.$albumid.'_'.$albumName.'/mainphoto/';
		
		if ((($_FILES["$file"]["type"] == "image/gif")
		|| ($_FILES["$file"]["type"] == "image/jpeg")
		|| ($_FILES["$file"]["type"] == "image/png")
		|| ($_FILES["$file"]["type"] == "image/pjpeg"))
		&& ($_FILES["$file"]["size"] < 200000000))
		  {
		
		  if ($_FILES["$file"]["error"] > 0)
		    {
		    	return 'Error in file. Please try another photo';
		    }
		  else
		    {
		
		    if (file_exists($useralbumdir. $_FILES["$file"]["name"]))
		      {
		      	return 0;
		      }
		    else
		      {
		      	if(move_uploaded_file($_FILES["$file"]["tmp_name"],
		     	 $useralbumdir . $_FILES["$file"]["name"])){	      		
		      		$datainsert = array(			
						'mainphoto' => $_FILES["$file"]["name"]					
					);
					$shDB =new sh_DB();
					$imageResult = $shDB->update($datainsert,$albumid,'album');
					if($imageResult){
						return 1;
					}
			     }else{
			     echo 'can not be uploaded';
		      	 return 0;
		      }
		      }
		    }
		  }
		else
		  {
		  	return 'Problem in file upload. Invalid file type or size';
		  }
	}
	
	function uploadPhototoAlbum($userId='',$albumName = '',$file = '',$albumid=''){
		
		$dir = str_replace(chr(92),chr(47),getcwd());	
		$useralbumdir = $dir.'/profile/'.$userId.'/'.$albumid.'_'.$albumName.'/';
		if ((($_FILES["$file"]["type"] == "image/gif")
		|| ($_FILES["$file"]["type"] == "image/jpeg")
		|| ($_FILES["$file"]["type"] == "image/png")
		|| ($_FILES["$file"]["type"] == "image/pjpeg"))
		&& ($_FILES["$file"]["size"] < 2000000))
		  {
		  	
		  
		  if ($_FILES["$file"]["error"] > 0)
		    {
		    	return 'Error in file. Please try another photo';
		    }
		  else
		    {
//		    echo "Upload: " . $_FILES["$file"]["name"] . "<br />";
//		    echo "Type: " . $_FILES["$file"]["type"] . "<br />";
//		    echo "Size: " . ($_FILES["$file"]["size"] / 1024) . " Kb<br />";
//		    echo "Temp file: " . $_FILES["$file"]["tmp_name"] . "<br />";
		
		    if (file_exists($useralbumdir. $_FILES["$file"]["name"]))
		      {
		      	return 'There is another photo in the same name. Please rename the photo and try again';
		      }
		    else
		      {
		      	if(move_uploaded_file($_FILES["$file"]["tmp_name"],
		     	 $useralbumdir . $_FILES["$file"]["name"])){
		      		$this->createalbumphotothumbs($userId,$albumName,$_FILES["$file"]["name"],$albumid);
		      		
		      		$datainsert = array(
					'id' => '',
					'album_id' => $_GET['id'],
					'image' => $_FILES["$file"]["name"],
					'modified_time' => date("Y-m-d H:i:s")
					);
					
					$shDB =new sh_DB();
					$imageResult = $shDB->insert($datainsert,'album_image');
					if($imageResult){
						return 'Upload sucessfull';
					}
					
		      }else{
		      	 return 'Problem in file upload. Please try again';
		      }
		      }
		    }
		  }
		else
		  {
		  	return 'Problem in file upload. Invalid file type or size';
		  }
	}

		public function extType($name) {		// function for file extention
			$type = $_FILES["$name"]["type"];
			switch($type){
				case 'image/gif':
						return 'gif';
				case 'image/jpeg':
						return 'jpeg';
				case 'image/pjpeg':
						return 'pjpeg';
				case 'image/png':
						return 'png';
				case 'image/tiff':
						return 'tiff';
				default :
					return false;
			}
		}
		
public function extTypeByName($name) {		// function for file extention
				switch($name){
				case 'image/gif':
						return 'gif';
				case 'image/jpeg':
						return 'jpeg';
				case 'image/pjpeg':
						return 'pjpeg';
				case 'image/png':
						return 'png';
				case 'image/tiff':
						return 'tiff';
				default :
					return false;
			}
		}
	
	
}

?>
