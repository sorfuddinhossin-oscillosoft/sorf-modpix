<?php 
if(isset($_REQUEST['status'])){
	$status = $_REQUEST['status'];
}else{
	$status = 'Enlisted';
}

$selectOrder = array(	
					'status' => $status,
					'userid'  => $_SESSION['userid']
				);									
$order = $shDB->selectOnMultipleCondition($selectOrder,'`order`');

/*
$result = $shDB->select('`order`','status',$status);
	
	//$result = $shDB->select('album','id',2);
	
	$order = $result['records'];
*/
?>
<div id="rightContent">
	<div class="rightContentDiv">
		<div class="leftFloat div100">
			<li class="orderMenu">&nbsp;&nbsp;</li>
			<li class="orderMenu"><a title="Delivered Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=orderlist&status=Delivered">Delivered</a></li>
			<li class="orderMenu"><a title="On Progress Orders" href="<?php echo $log->baseurl;?>user/index.php?pg=orderlist&status=On%20Progress">On Progress</a></li>
			<li class="orderMenu"><a title="Enlisted" href="<?php echo $log->baseurl;?>user/index.php?pg=orderlist&status=Enlisted">Enlisted</a></li>
		</div>
		<div class="innerWhiteContainer">
			<div class="innerWhiteContainerHeader">
				<div class="leftFloat">
					<table cellpadding="3" cellspacing="0">
						<th>
							<td><div class="orderListIcon">&nbsp;</div></td><td>Order List</td>
						</th>
					</table>
				</div>
				<!--
				<div class="rightFloat">
					<table cellpadding="0" cellspacing="0">
						<th>
							<td style="padding-top:5px;"><a title="Close" href="#" class="deleteRowBtn">&nbsp;</a></td>
						</th>
					</table>					
				</div>	
				-->			
			</div>
			<div class="leftFloat div100">
				<?php if($order){?>
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:24%; padding-left:2%;">Order By</td>
						<td align="left" class="tableHeader" style="width:22%">Order Date</td>
						<td align="left" class="tableHeader" style="width:25%">Total Payment</td>
						<td align="left" class="tableHeader" style="width:15%">Status</td>
						<td align="center" class="tableHeader" style="width:12%">Action</td>
					</tr>					
					<?php
					foreach($order as $ord)
					{
						$user = $shDB->select('logon','id',$ord['userid']);
						$username = $user['records'][0]['fname'].' '.$user['records'][0]['lname'];
					?>
					<tr>
						<td align="left" style="width:24%; padding-left:2%; border-bottom:dotted #CCCCCC 1px;">
						<a title="Click to view my details" href="#"><?php echo $username;?></a></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><?php echo $ord['ordertime'];?></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;">AUD - <font class="currency"><?php echo $ord['totalamount'];?></font></td>
						<td align="left" style="border-bottom:dotted #CCCCCC 1px;"><span class="ordStatusOpen"><?php echo $ord['status'];?></span></td>
						<td align="center" style="border-bottom:dotted #CCCCCC 1px;">
						<a title="Record Details" href="<?php echo $log->baseurl;?>user/index.php?pg=orderdetails&id=<?php echo $ord['id'];?>" class="detailsRowBtn">&nbsp;</a>
						</td>
					</tr>					
					<?php } ?>	
					<tr>
						<td align="center" colspan="5">
						<?php // echo $result['pagination'];?>
						</td>
					</tr>											
				</table>
				<?php }else{?>
				<table cellpadding="3" cellspacing="0" style="table-layout:fixed; width:100%;">
					<tr>
						<td align="left" class="tableHeader" style="width:90%; padding-left:2%;">
					<p class="greenMessage" style="color:red">No orders available.</p>
					</td>
					</tr>
					</table>
				<?php }?>
			</div>
		</div>
	</div>
</div>
