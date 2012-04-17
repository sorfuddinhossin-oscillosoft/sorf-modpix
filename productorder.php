<?php 
$proditemdata = array(
							'id' => $_REQUEST['id']
							);
					$productItem = $shDB->selectOnMultipleCondition($proditemdata,'prod_item');
?>
<?php 
$fieldNames = $_POST['fieldname'];
$itemId = $_POST['itemid'];
$fieldMandatorys = $_POST['fieldmandatory'];

$validate = 1;
$selectItemOption = array();
//re-code bof
if(isset($_POST['itemOptionSubmit'])){
	if($fieldNames){
		foreach($fieldNames as $k=>$fieldName){
			$optName=str_replace(' ', '_', $fieldName);
			$fieldValue = $_POST[$optName];
			if($fieldMandatorys[$k]==1){
				if($fieldValue == ''){
					$errorMessage .=  '<span style="color:red">'.$fieldName.' is mandatory.</span><br />';
					$validate = 0;
				}
			}
			if($fieldValue!=''){
				array_push($selectItemOption,$fieldValue);
			}
			
		}
	}
	if($validate == 1){
		if(isset($_REQUEST['type'])){
			$albumArray = array('id' => $_REQUEST['albumid'],
								'type' => $_REQUEST['type']);
			$result = itemToCartwithOption($itemId,$selectItemOption,$albumArray);
		}else{
			 if($_REQUEST['imgid'] ==''){ 
			 	
				$result = itemToCartwithOption($itemId,$selectItemOption);
			 }else{ 
			 	
				 $result = itemToCartwithOption($itemId,$selectItemOption,'',$_REQUEST['imgid']);		
			 }
		}
		
		
		if($result){
			echo '<script>location.href=base_url+"index.php?pg=checkout";</script>';
		}
	}
}
//re-code eof

/* 
$fieldName = $_POST['fieldname'];
$itemId = $_POST['itemid'];
$fieldMandatory = $_POST['fieldmandatory'];
$fieldValue = $_POST['fieldvalue'];
$validate = 1;
$selectItemOption = array();
if(isset($_POST['itemOptionSubmit'])){
	if(sizeof($fieldName)>=1){
		foreach($fieldName as $key => $value){	
			$fieldValueField = $fieldValue[$key];	
			if($fieldMandatory[$key]==1){
				if(!$fieldValueField){
					$errorMessage .=  '<span style="color:red">'.$value.' is mandatory.</span><br />';
					$validate = 0;
				}
			}
			if($fieldValueField[0]!=''){
				array_push($selectItemOption,$fieldValueField[0]);
			}
		}
	}

	if($validate == 1){
		if(isset($_REQUEST['type'])){
			$albumArray = array(
							'id' => $_REQUEST['albumid'],
							'type' => $_REQUEST['type']
						);
						$result = itemToCartwithOption($itemId,$selectItemOption,$albumArray);
		}else{
			if($_REQUEST['imgid']==''){
				$result = itemToCartwithOption($itemId,$selectItemOption);
			}else{
				$result = itemToCartwithOption($itemId,$selectItemOption,'',$_REQUEST['imgid']);		
			}
		}
		
		
		if($result){
			echo '<script>location.href=base_url+"index.php?pg=checkout";</script>';
		}
	}
}  */

?>
<h1 class="pagetitle">Product Options</h1>
<div class="webcontent">
<div class="webTitleandTab">
	<div class="catNameandProductTitle">
		<strong style="font-size: 17px;"><?php echo $productItem[0]['name'];?> &nbsp; &nbsp; (<?php echo $settings['currency']. number_format($productItem[0]['basicprice'],2,'.','');?>)</strong><br />
		<strong >Set your item parameters</strong>
	</div>
	<div style="float: left; clear: both; font-style:italic;margin: 8px auto; font-size: 14px;font-weight: bold;">
		If you select an option which has cost, this cost will be added as extra with your  product base price.
	</div>
</div>
<div class="tabContent" style="clear: both;">
<span style="color: red;font-size: 12px;float: right; ">* Mandatory </span>
<form id="formOptionField" method="post" action="">
<?php 
if($validate == 0){
	echo $errorMessage;
}
?>
<?php 
if($productItem['addmaxsides']>0){?>
<table>
<tr><td>
<label>Additional Sides</label>
<select name="additionalSide">
	<option value="">Please Select</option>
	<?php for($m=1; $m<=80; $m++){?>
		<option value="<?php echo $m;?>"><?php echo $m;?></option>
	<?php }?>
</select>

</td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
</table>
<?php } ?>
<input type="hidden" name="itemid" value="<?php echo $_GET['id'];?>">
<input type="hidden" name="imgid" value="<?php echo $_GET['imgid'];?>">

		<?php
		//re-code bof
		$qry = 'select io.*, pto.*, pto.id as prodoptId from prod_item_option pto, itemoption io where pto.optionid = io.id AND pto.item_id='.$_REQUEST['id'].' AND io.status=1 order by io.name ASC';
		$query = $shDB->qry($qry); 
		$productItemOptions=array();
		while($result=mysql_fetch_array($query)){
			$productItemOptions[]=array('id'=>$result['id'],
										'item_id'=>$result['item_id'],
										'optionid'=>$result['optionid'],
										'prodoptId'=>$result['prodoptId'],
										'mandatory'=>$result['mandatory'],
										'cost'=>$result['cost'],
										'name'=>$result['name'],
										'value'=>$result['value'],
										'status'=>$result['status']);
		}
		
		$existsOptionName=array();
		$html ='';
		
		
		foreach($productItemOptions as $k=>$productItemOption){
			$mandatory=getMandatoryOrnot($productItemOptions, $productItemOption['name']);
		
			if(in_array($productItemOption['name'], $existsOptionName)){
				//$html .='<input type="hidden" name="fieldname['.$k.']" value="'.$productItemOption['name'].'">';
				$optName=str_replace(' ', '_', $productItemOption['name']);
				$html .='<input type="radio" name="'.$optName.'" value="'.$productItemOption['prodoptId'].'" '.((isset($_POST[$optName]) && $_POST[$optName] == $productItemOption['prodoptId'])?'checked="checked"':'').'>&nbsp;&nbsp;'.$productItemOption['value']."<br />";
			
			}else{
				$html .='<label>'.(($mandatory == 1)? '<span style="color: red;font-weight: bold; font-size: 16px; ">* </span>':'').$productItemOption['name'].'</label>';
				
				$html .='<input type="hidden" name="fieldname[]" value="'.$productItemOption['name'].'">';
				$html .='<input type="hidden" name="fieldmandatory[]" value="'.$mandatory.'">';
				
				$optName=str_replace(' ', '_', $productItemOption['name']);
				
				$html .='<input type="radio" name="'.$optName.'" value="'.$productItemOption['prodoptId'].'"'.((isset($_POST[$optName]) && $_POST[$optName] == $productItemOption['prodoptId'])?'checked="checked"':'').'>';
				
				
				/* $html .='<input type="hidden" name="fieldname['.$k.']" value="'.$productItemOption['name'].'">';
				$html .='<input type="hidden" name="fieldmandatory['.$k.']" value="'.$mandatory.'">';
				$html .='<input type="radio" name="fieldvalue['.$k.']" value="'.$productItemOption['prodoptId'].'">'; */
				
				if($productItemOption['cost']!=0){
					$html .= '&nbsp;&nbsp;'.$productItemOption['value'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="color:orange"> '.$settings['currency'].'&nbsp;'. number_format($productItemOption['cost'],2,'.','').'</strong><br />';
				}else{
					$html .='&nbsp; '.$productItemOption['value'].' <br />';	
				}
			}
			$existsOptionName[]=$productItemOption['name'];
		
		}
		echo $html;	
		
		
		function getMandatoryOrnot($productItemOptions, $productItemOptionname){
			$mandatory=0;
			foreach($productItemOptions as $k=>$productItemOption){
				if($productItemOption['name'] == $productItemOptionname){
					if($productItemOption['mandatory'] == 1){
						return $mandatory=$productItemOption['mandatory'];
					}
				}
			}
			
			return $mandatory=0;
		}
		
		//re-code eof
		/* $proditemoptiondata = array(
							'item_id' => $_REQUEST['id']
							);
					$productItemOption = $shDB->selectOnMultipleCondition($proditemoptiondata,'prod_item_option'); 
					
					
										
					
					$itemOptionValue = array();
					$itemOptionCost = array();
					$itemOptionName = '';
					$mandatory = '';
					$arrayCounter = sizeof($productItemOption);
					
					
					if($productItemOption){
					for($i=0;$i<$arrayCounter;$i++){
						
					
					//	if($productItemOption[$i]['mandatory']==1){
						//	$mandatory = 1;
						//}
						
						
						
						
						
						
						unset($proditemoptionDetails);
						
						$proditemoptionDetails = array(
							'id' =>  $productItemOption[$i]['optionid'],
							'status' => 1
							);
							
						$proditemoptionDetails = $shDB->selectOnMultipleCondition($proditemoptionDetails,'itemoption'); 
						$proditemoptionDetails = $proditemoptionDetails[0];	
						
							if($proditemoptionDetails){
							
								
								
									if($itemOptionName == ''){
										$itemOptionName = $proditemoptionDetails['name'];
										array_push($itemOptionValue,$proditemoptionDetails['value']);
										array_push($itemOptionCost,$proditemoptionDetails['cost']);
										
										$mandatory = $productItemOption[$i]['mandatory'];
									}else{
									
										if($itemOptionName == $proditemoptionDetails['name']){
										
											if($mandatory!=1){
												$mandatory = $productItemOption[$i]['mandatory'];
											}
											array_push($itemOptionValue,$proditemoptionDetails['value']);
											array_push($itemOptionCost,$productItemOption[$i]['cost']);
											$itemOptionName = $proditemoptionDetails['name'];
											if($i==$arrayCounter-1){
											
											
												
												echo '<label>'.$itemOptionName.'</label>';
												echo '<input type="hidden" name="fieldname['.$i.']" value="'.$itemOptionName.'">';
												
												echo '<input type="hidden" name="fieldmandatory['.$i.']" value="'.$mandatory.'">';
												$valueCounter = sizeof($itemOptionValue);
												for($i1=0;$i1<$valueCounter;$i1++){
													echo '<input type="radio" name="fieldvalue['.$i.'][]" value="'.$productItemOption[$i]['id'].'">';
													if($productItemOption[$i]['cost']!=0){
														echo '&nbsp; '.$itemOptionValue[$i1].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="color:orange"> '.$settings['currency'].'&nbsp;'.$productItemOption[$i]['cost'].'</strong><br />';
													}else{
														echo '&nbsp; '.$itemOptionValue[$i1].' <br />';	
													}
												}											
												
												echo '<hr />';
												unset($itemOptionValue);
												unset($itemOptionCost);
											$itemOptionValue = array();
											$itemOptionCost = array();
											}
										}else{
												
												echo 'No # '.$i.'<br />';
										
												//  $mandatory = $productItemOption[$i]['mandatory'];
												echo '<label>'.$itemOptionName.'</label>';
												echo '<input type="hidden" name="fieldname['.$i.']" value="'.$itemOptionName.'">';
												echo '<input type="hidden" name="fieldmandatory['.$i.']" value="'.$mandatory.'">';
												$valueCounter = sizeof($itemOptionValue);
												for($i1=0;$i1<$valueCounter;$i1++){
													echo '<input type="radio" name="fieldvalue['.$i.'][]" value="'.$productItemOption[$i]['id'].'">';
												if($productItemOption[$i]['cost']!=0){
														echo '&nbsp; '.$itemOptionValue[$i1].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="color:orange"> '.$settings['currency'].'&nbsp;'.$productItemOption[$i]['cost'].'</strong><br />';
													}else{
														echo '&nbsp; '.$itemOptionValue[$i1].' <br />';	
													}	
												}											
																						
												echo '<br />';
											unset($itemOptionValue);
											unset($itemOptionCost);
											$itemOptionValue = array();
												$itemOptionCost = array();
											$itemOptionName = $proditemoptionDetails['name'];
											array_push($itemOptionValue,$proditemoptionDetails['value']);	
											array_push($itemOptionCost,$productItemOption[$i]['cost']);								
										}
										}
									}
									
							}
						} */
						
						
						
						
						echo '<input type="submit" id="itemOptionSelect123" name="itemOptionSubmit" value = "Add to Cart">';
		?>
		</form>
		
</div>
</div>