<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<title>Wedding Photographer, Online Photo Printing, Album, Recruitment, Sydney, Melbourne, Brisbane, Adelaide, Perth</title>
<meta name="keywords" content=" Wedding Photographer Sydney, Wedding Photographer Melbourne, Wedding Photographer Brisbane, Wedding Photographer Adelaide, Wedding Photographer Perth, Photo hosting, Online Photo Printing, Print on Metal, Online Photo Album, Wedding Photographer, Metal Printing, Online Photo Hosting, Photo Sharing, Photographer Portfolio, Photographer Recruitment”/>
<meta name="description" content="We are an Australian owned company based in Sydney. Our commitment is to provide a high level of service and commitment dedicated to serving the wedding photography industry in Australia."/>
<link rel="shortcut icon" href="<?php echo $log->baseurl;?>images/favicon.ico">  
<link href="<?php echo $css; ?>template.css" rel="stylesheet" type="text/css">  
<link href="<?php echo $css; ?>style.css" rel="stylesheet" type="text/css">
<link href="<?php echo $css; ?>tabmenu.css" rel="stylesheet" type="text/css">
<link href="<?php echo $css; ?>tooltip.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $js; ?>lightbox/js/jquery.lightbox-0.5.js"></script>

<script type="text/javascript" src="<?php echo $js; ?>function.js"></script>
<script type="text/javascript" src="<?php echo $js; ?>cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo $js; ?>Arista_20_Light_300.font.js"></script>

<script type="text/javascript" src="<?php echo $js; ?>slider.js"></script>

<script type="text/javascript" src="<?php echo $js; ?>jMenu.js"></script>


<!-- 
<script src="<?php echo $js; ?>jquery.lightbox_me.js" type="text/javascript" charset="utf-8"></script>
 -->
<script type="text/javascript" src="<?php echo $js; ?>jquery.idTabs.min.js"></script>
<script type="text/javascript" src="<?php echo $js; ?>ckeconfig.js"></script>
<!--<script type="text/javascript" src="<?php echo $js; ?>jtip.js"></script>
<script type="text/javascript" src="<?php echo $js; ?>webtoolkit.md5.js"></script>
-->
<script type="text/javascript" src="../ckeditor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor/samples/sample.js"></script>
<link href="../ckeditor/ckeditor/samples/sample.css" rel="stylesheet" type="text/css"> 

	<script src="sample.js" type="text/javascript"></script>
	<link href="sample.css" rel="stylesheet" type="text/css" />
	

	
<link rel="stylesheet" type="text/css" href="<?php echo $js; ?>lightbox/css/style-projects-jquery.css" />    
    

<link rel="stylesheet" type="text/css" href="<?php echo $js; ?>lightbox/css/jquery.lightbox-0.5.css" media="screen" />
   

<script type="text/javascript">
    $(function() {
       // $('a.veryeasylightbox').lightBox();

        $('a.veryeasylightbox').lightBox({
        	overlayBgColor: '#000',
        	overlayOpacity: 0.6,
        	imageLoading: '<?php echo $js; ?>lightbox/images/lightbox-ico-loading.gif',
        	imageBtnClose: '<?php echo $js; ?>lightbox/images/lightbox-btn-close.gif',
        	imageBtnPrev: '<?php echo $js; ?>lightbox/images/lightbox-btn-prev.gif',
        	imageBtnNext: '<?php echo $js; ?>lightbox/images/lightbox-btn-next.gif',
        	containerResizeSpeed: 350,
        	txtImage: 'Image',
        	txtOf: 'of'
           });
        
    });
    </script>
<script>
Cufon.replace('ul.cufonmenu', {
	hover: {
       color: '-linear-gradient(#666666, #000000)'
    }
    });
</script>
<script type="text/javascript">
//CKEDITOR.replace( 'productDesc',
//		{
//			toolbar : 'Basic'
//		});


		
var correctCards = 0;
//$( init );
//$( productAdd );

$( addImageToProduct );
function testfunction( event, ui ){
	var imgId = ui.draggable.attr( 'id' );
	var prodimgId =  $(this).attr( 'title' );
	 var dropItem = $(this);
    $.post(base_url+"ajax/addphototocart.php",
  			{id: imgId,tempproductimgid: prodimgId}, function(data){ 
  	  			//alert(data); 
  				if(data.length >0) {
  					dropItem.html('');
	  				dropItem.append(data);
	  				location.href=base_url+"index.php?pg=mycart";
  				}
			});	
}


function handleImgDropToProductCart( event, ui ) {
	alert('Yeah in the right place');
    var imgId = ui.draggable.attr( 'id' );
   
    var prodId =  $(this).attr( 'title' );
    var dropItem = $(this).children('ul');
    $.post(base_url+"ajax/addphototoprodunlimited.php",
	  			{id: imgId,productid: prodId}, function(data){  
	  				if(data.length >0) {
	  					dropItem.append(data);	
		  				alert('Product addded successfully');
	  					location.href=base_url+"index.php?pg=mycart";
	  				}
				});	

}
function addImageToProduct(){
	$('.cartAlbum li').sortable();
	$('.thumbimagediv').draggable( {
	      containment: '#rightContent',
	     // stack: '#rightContent',
	      cursor: 'move',
	      revert: true
	    } );
    
	$('.cartPhotoImgHolder').droppable({
		 accept: '.thumbimagediv',
	      hoverClass: 'hovered',
	      drop: testfunction
		});

	/*
	$('.cartPhotoHolderDiv').droppable( {
	      accept: '.thumbimagediv',
	      hoverClass: 'hovered',
	      drop: handleImgDropToProductCart
	    } );
   */
	$('.cartPhotoHolder').sortable({
			update: function(event, ui) {
			var sortOrder = $(this).sortable('toArray').toString();
			var prodId =  $(this).attr( 'title' );
			 $.post(base_url+"ajax/imagesorting.php",
					 {productid: prodId,sortstring:sortOrder},
			  			function(data){  
				  			var res = parseInt(data);
			  				if(res == 0){
				  				alert('Order saved succesfully');
				  				location.href=base_url+"index.php?pg=mycart";
				  				}else{
				  					alert('Error in order save');
					  				}
						});	
			
		}
	
	});
}





function handleProductDrop( event, ui ) {
	var productid = ui.draggable.attr( 'title' );
	
		//ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
	var appendHtml = '<div class="leftFloat div100 rounded5box" id="cartProduct'+productid+'">'+
		'<div align="left" class="leftFloat div94 botBorder1">'+
		'<span class="leftFloat"><strong>Product 1</strong></span>'+
		'<span class="rightFloat"><a class="deleteRowBtn" href="javascript:deleteCartProduct('+productid+')" title="Delete that product from Cart.">&nbsp;</a></span>'+
		'</div>'+
		'<div align="left" class="leftFloat div94">'+
		'<table cellspacing="0" cellpadding="2" style="width:100%;">'+
		'<tbody><tr>'+
		'</tr><tr><td><img class="photoCart" src="http://demo.oscillosoft.com/modpix_final/images/u1.png"></td></tr>'+
		'</tbody></table>'+
		'</div>'+											
		'</div>';
	 	$("#dropableList").append(appendHtml);
	 		ui.draggable.fadeOut();
	  //  ui.draggable.draggable( 'option', 'revert', false );
}

function init() {

  // Hide the success message
  $('#successMessage').hide();
  $('#successMessage').css( {
    left: '580px',
    top: '250px',
    width: 0,
    height: 0
  } );

  // Reset the game
  correctCards = 0;
  // $('#cardPile').html( '' );
  $('#cardSlots').html( '' );

  // Create the pile of shuffled cards
  var numbers = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ];
  numbers.sort( function() { return Math.random() - .5 } );
 
  for ( var i=0; i<10; i++ ) {
	  $('<div>' + numbers[i] + '</div>').data( 'number', numbers[i] ).attr( 'id', 'card'+numbers[i] ).appendTo( '#cardPile' );
	    // $('<div>' + numbers[i] + '</div>').data( 'number', numbers[i] ).attr( 'id', 'card'+numbers[i] ).appendTo( '#cardPile' );
  }
 

  
	$('#cardPile div').draggable( {
	      containment: '#content1',
	      stack: '#cardPile div',
	      cursor: 'move',
	      revert: true
	    } );
	/*
	
		  for ( var i=0; i<10; i++ ) {
		    $('<div>' + numbers[i] + '</div>').data( 'number', numbers[i] ).attr( 'id', 'card'+numbers[i] ).appendTo( '#cardPile' ).draggable( {
		      containment: '#content1',
		      stack: '#cardPile div',
		      cursor: 'move',
		      revert: true
		    } );
		  }
		*/
  // Create the card slots
  var words = [ 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten' ];
  for ( var i=1; i<=10; i++ ) {
    $('<div>' + words[i-1] + '</div>').data( 'number', i ).appendTo( '#cardSlots' ).droppable( {
      accept: '#cardPile div',
      hoverClass: 'hovered',
      drop: handleCardDrop
    } );
  }

}


function handleCardDrop( event, ui ) {

  var slotNumber = $(this).data( 'number' );
  var cardNumber = ui.draggable.data( 'number' );
	alert( 'The square with ID "' + slotNumber + '" was dropped onto me!' );
  // If the card was dropped to the correct slot,
  // change the card colour, position it directly
  // on top of the slot, and prevent it being dragged
  // again

  if ( slotNumber == cardNumber ) {
    ui.draggable.addClass( 'correct' );
    ui.draggable.draggable( 'disable' );
    $(this).droppable( 'disable' );
    ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
    ui.draggable.draggable( 'option', 'revert', false );
    correctCards++;
  }else{
	  alert('Dropped in wrong place');
	  }
  
  // If all the cards have been placed correctly then display a message
  // and reset the cards for another go

  if ( correctCards == 10 ) {
    $('#successMessage').show();
    $('#successMessage').animate( {
      left: '380px',
      top: '200px',
      width: '400px',
      height: '100px',
      opacity: 1
    } );
  }
}



</script>
<script>
$(document).ready(function() {
 
	var changeTooltipPosition = function(event,position) {
		if(position=='right'){
		  var tooltipX = event.pageX - 300;
		  var tooltipY = event.pageY - 20;
		}
		if(position=='left'){
			  var tooltipX = event.pageX + 20;
			  var tooltipY = event.pageY - 20;
			}
	 
	  $('div.tooltip').css({top: tooltipY, left: tooltipX});
	};
 
	var showTooltip = function(event) {
	  $('div.tooltip').remove();
	  var reldata = $(this).attr('rel').split(',');
	  var id = reldata[0];
	  var position = reldata[1];
	  var pagelink = reldata[2];

	  if(position==='right'){
	  $('<div class="tooltip"><div class="arrow"></div><div class="content"></div>')
            .appendTo('body');
	  }
	  if(position==='left'){
		  $('<div class="tooltip"><div class="leftarrow"></div><div class="content"></div>')
	            .appendTo('body');
		  }
	  $('.tooltip div.content').load(base_url+"ajax/"+pagelink+"?id="+id);
	  changeTooltipPosition(event,position);
	};
    var changeTooltipPositiononMounseMove = function(event){
	   	 var reldata = $(this).attr('rel').split(',');
	  	  var id = reldata[0];
	  	  var position = reldata[1];
	  	  var pagelink = reldata[2];
		  changeTooltipPosition(event,position);
        }
    
	var hideTooltip = function() {
	   $('div.tooltip').remove();
	};
 
	$("span.hint,label.username'").bind({
	   mousemove : changeTooltipPositiononMounseMove,
	   mouseenter : showTooltip,
	   mouseleave: hideTooltip
	});
});

function myWindowWidth() {
	  var myWidth = 0, myHeight = 0;
	  if( typeof( window.innerWidth ) == 'number' ) {
	    //Non-IE
	    myWidth = window.innerWidth;
	    myHeight = window.innerHeight;
	  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
	    //IE 6+ in 'standards compliant mode'
	    myWidth = document.documentElement.clientWidth;
	    myHeight = document.documentElement.clientHeight;
	  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
	    //IE 4 compatible
	    myWidth = document.body.clientWidth;
	    myHeight = document.body.clientHeight;
	  }
	 // window.alert( 'Width = ' + myWidth );
	 // window.alert( 'Height = ' + myHeight );
	  return myWidth;
	}

</script>
<style type="text/css" media="screen">
			
		</style>
</head>
<body>
 <?php 
 if(isset($_SESSION['loggedin'])){
$selectOrderById = array(		
							'id' => $_SESSION['userid']
							);									
$userdetails = $shDB->selectOnMultipleCondition($selectOrderById,'`logon`');
$userdetails = $userdetails[0];
 }
?>
      
	<div id="wrapper-outer-header">
	
	<div id="wrapper-outer">

	<!--header-->
	<div id="headerwrapper">
		
		<div id="header-left">
		<!--logo-->
		<div id="logo" align="left">
        	<a href="<?php echo $log->baseurl;?>index.php"><img width="288" height="78" src="<?php echo $log->baseurl;?>images/modpix_logo.png" border="0"/></a>
        </div>
		<!--end of : logo-->
		</div>
		
		<div id="header-right">
		<!--menu-->
		<div id="menu_container">
		
			<?php
			$selectProductDatainTemp = array(		
							'sessionid' => $_SESSION['sessionid']
							);		
												
		$dataInTempProduct = $shDB->selectOnMultipleCondition($selectProductDatainTemp,'temp_product'); 
			echo '<div class="welcome">';
			if(isset($_SESSION['loggedin'])){
				echo 'Welcome&nbsp;<a href="'.$log->baseurl.'user/">'.$userdetails['fname'].' '.$userdetails['lname'].'</a>&nbsp;';
				
				
				if($dataInTempProduct){
					echo '<a class="placeorder" href="'.$log->baseurl.'index.php?pg=checkout"></a>';
				}
				//echo '<a class="mycart" href="'.$log->baseurl.'index.php?pg=mycart"></a>&nbsp;';
				echo '<a class="home" href="'.$log->baseurl.'user/index.php?pg=dashboard"></a>';
			}elseif(isset($_SESSION['scode'])){
				
				if($_SESSION['userlevel']==3){
				
				
				if($dataInTempProduct){
					echo '<a class="placeorder" href="'.$log->baseurl.'index.php?pg=checkout"></a>';
				}
				//echo '<a class="mycart" href="'.$log->baseurl.'index.php?pg=mycart"></a>&nbsp;';
				echo '<a class="home" href="'.$log->baseurl.'index.php?pg=invitation"></a>';
				}
				
			if($_SESSION['userlevel']==4){
				
			
				if($dataInTempProduct){
					echo '<a class="placeorder" href="'.$log->baseurl.'index.php?pg=checkout"></a>';
				}
				//echo '<a class="mycart" href="'.$log->baseurl.'index.php?pg=mycart"></a>&nbsp;';
					echo '<a class="home" href="'.$log->baseurl.'index.php?pg=invitation"></a>';
				}
			}else{
			
			
			if($dataInTempProduct){
					echo '<a class="placeorder" href="'.$log->baseurl.'index.php?pg=checkout"></a>';
				}
				// echo '<a class="mycart" href="'.$log->baseurl.'index.php?pg=mycart"></a>&nbsp;';
			}
			echo '</div>'; 
			?>
		
			<!--<div id="menu_inner_wrapper">
				<ul class="menu"  align="right">
				<?php if(isset($_SESSION['loggedin'])){?>
					<li><a class="logout" href="<?php echo $log->baseurl;?>index.php?pg=logout"></a></li>
					<?php }else{?>
					<li><a class="login" href="<?php echo $log->baseurl;?>index.php?pg=login"></a></li>
					<?php } ?>
					<li><a class="contactus" href="<?php echo $log->baseurl;?>index.php?pg=contactus"></a></li>
					<li><a class="inquiry" href="<?php echo $log->baseurl;?>index.php?pg=inquiry"></a></li>
					<li><a class="products" href="<?php echo $log->baseurl;?>index.php?pg=products"></a></li>
					<li><a class="whoweare" href="<?php echo $log->baseurl;?>index.php?pg=whoweare"></a></li>
				</ul>
			</div>	
		-->
		<div id="menu_inner_wrapper">
				<ul class="cufonmenu"  align="right">
				<?php if((isset($_SESSION['loggedin']))||(isset($_SESSION['scode']))){?>
					<li><a class="" href="<?php echo $log->baseurl;?>index.php?pg=logout">Logout</a></li>
					<?php }else{?>
					<li><a class="" href="<?php echo $log->baseurl;?>index.php?pg=login">Login</a></li>
					<?php } ?>
					<li><a class="" href="<?php echo $log->baseurl;?>index.php?pg=contactus">Contact Us</a></li>
					<li><a class="" href="<?php echo $log->baseurl;?>index.php?pg=payment">Payment</a></li>
					<li><a class="" href="<?php echo $log->baseurl;?>index.php?pg=inquiry">Inquiry</a></li>
					<!--<li><a class="" href="<?php //echo $log->baseurl;?>index.php?pg=photographer">Photographer</a></li>-->
					<li><a class="" href="<?php echo $log->baseurl;?>index.php?pg=products">Products</a></li>
					<li><a class="" href="<?php echo $log->baseurl;?>index.php?pg=whoweare">Who we are?</a></li>
				</ul>
			</div>	
		</div>
		
		<!--end of : menu-->
		</div>
		
	</div>
	
	<!--end of : header-->
	<script type="text/javascript" charset="utf-8">
        $(function() {
            function launch() {
                 $('#sign_up').lightbox_me({centered: true, 
                     onLoad: function() {
                    	 
                      }
                 });
            }
            
            $('.veryeasylightbox').click(function(e) {
           	 var myhtml = $(this).attr('rel');
                $("#sign_up").lightbox_me({centered: true, onLoad: function() {
               		
                	$("#sign_up").html('');
                	var imgsrc = '<img src="'+myhtml+'">';
                   	$("#sign_up").append(imgsrc);
              	 }});
				
                e.preventDefault();
            });

        });
    </script>
    <div style="height: 2927px; position: absolute; width: 100%; top: 0px; left: 0px; right: 0px; bottom: 0px; z-index: 1001; background: none repeat scroll 0% 0% black; opacity: 0.3; display: none;" class="lb_overlay js_lb_overlay"></div>
    <div style="height: 2927px; position: absolute; width: 100%; top: 0px; left: 0px; right: 0px; bottom: 0px; z-index: 1001; background: none repeat scroll 0% 0% black; opacity: 0.3; display: none;" class="lb_overlay js_lb_overlay"></div>
    <div style="height: 2927px; position: absolute; width: 100%; top: 0px; left: 0px; right: 0px; bottom: 0px; z-index: 1001; background: none repeat scroll 0% 0% black; opacity: 0.3; display: none;" class="lb_overlay js_lb_overlay"></div>
    <div style="display: none; left: 50%; margin-left: -223px; z-index: 1002; position: fixed; top: 50%; margin-top: -159px;background:white;" id="sign_up">
    
    </div>