<?php
								for($p1=0;$p1<8;$p1++)
								{
								?>
								<div class="productList" id="productList<?php echo $p1;?>" title="<?php echo $p1;?>">
									<div align="left" class="leftFloat div94Padless">
										<span class="leftFloat"><strong>Product <?php echo $p1+1; ?></strong></span>
										<span class="rightFloat"><a title="Add that product to Cart." href="javascript:" class="addBtn">&nbsp;</a></span>
									</div>
								</div>								
								<?php
								}
								?>
<script>
$( productAdd );
</script>