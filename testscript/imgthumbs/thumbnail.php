<?php

// Example for dynamic image
// See www.mywebmymail.com for more details

//if (isset($_REQUEST['thumb'])) {
    include_once('inc/easyphpthumbnail.class.php');
    // Your full path to the images
    $dir = str_replace(chr(92),chr(47),getcwd()) . '/gfx/';
    // Create the thumbnail
    $thumb = new easyphpthumbnail;
    $thumb -> Thumbsize = 150;
    $thumb -> Copyrighttext = 'MODPIX.COM';
    $thumb -> Copyrightposition = '50% 90%';
    $thumb -> Copyrightfonttype = $dir . 'handwriting.ttf';
    $thumb -> Copyrightfontsize = 12;
    $thumb -> Copyrighttextcolor = '#FFFFFF'; 

    // save to file
    
    // Create the thumbnail and output to file
		 $thumb -> Thumblocation = $dir . 'thumbs/';
		 $thumb -> Thumbprefix = 'test_';
		 $thumb -> Thumbsaveas = 'png';
		 $thumb -> Thumbfilename = 'mynewfilename.png';

   	 $thumb -> Createthumb($dir . 'image.jpg','file');
   	 
   // $thumb -> Createthumb($dir . basename($_REQUEST['thumb']));
   echo 'Thumbnail page';
//}

?>