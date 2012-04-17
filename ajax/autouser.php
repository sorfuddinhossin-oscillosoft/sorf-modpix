<?php
include_once '../class/dbclass.php';
$shDB =new sh_DB();
$queryString = trim($_REQUEST['search']);

/*
	$data = array(
					'useremail' => $queryString,
					'fname' => $queryString,
					'lname' => $queryString,
					'address' => $queryString
	);									
				$result = $shDB->searchOnMultipleCondition($data,'logon');
			*/
$result = $shDB->search('useremail',$queryString,'logon');
echo '<ul style="list-style:none;width:362px;padding:0px;margin:0px;">';
foreach ($result as $res){
	if($res['isregister']==1){
		$name = '';
		$name = $res['fname'].' '.$res['lname'];
		//echo '<li style="color:#000" onclick="fill('.$res['id'].',\''.$name.'\');">'.$name.'<br /><span>'.$res['useremail'].'</span></li>';
?>
	<li style="width:362px;height:60px;padding:5px;border:1px solid #E6EAEC;background:#F7F9F9;margin:1px 0px;" onclick="fill('<?php echo $res['id']?>','<?php echo $name;?>')">
		<strong><?php echo $name;?></strong><br />
		<span><?php echo $res['useremail'];?></span>
	</li>
<?php 
	}
}
echo '</ul>';
?>
