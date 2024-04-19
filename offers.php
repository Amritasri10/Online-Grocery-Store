<?php
include("header.php");
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Products on  Offers</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!--- groceries --->
	<div class="products" style="padding: 2em 0;">
		<div class="container">
			<div class="col-md-12 products-right">
				<div class="agile_top_brands_grids" style="margin-top: 1px;">

<?php
$i = 0;
$sqlproduct = "SELECT * FROM product LEFT JOIN category ON product.catid=category.catid where product.status='Active' AND product.discount > 0 ";
if($_GET['subcatid'] != "")
{
	$sqlproduct = $sqlproduct . " AND product.catid ='$_GET[subcatid]' ";
}
else if($_GET['catid'] != "")
{
	$sqlproduct = $sqlproduct . " AND category.sub_catid ='$_GET[catid]' ";
}
$qsqlproduct = mysqli_query($con,$sqlproduct);
while($rsproduct = mysqli_fetch_array($qsqlproduct))
{
	$arrimg = unserialize($rsproduct['images']);
	if($arrimg[0] == "")
	{
		$imgname = "images/default_product_image.png";
	}
	else if(file_exists("imgupload/" . $arrimg[0]))
	{
		$imgname = "imgupload/" . $arrimg[0];
	}
	else
	{
		$imgname = "images/default_product_image.png";
	}
if($i == 0)
{
?>
<div class="row">
<?php
}
?>
	<div class="col-md-3 top_brand_left">
		<div class="hover14 column">
			<div class="agile_top_brand_left_grid">
				<div class="agile_top_brand_left_grid_pos">
<?php
if($rsproduct['discount'] != 0)
{
?>
<span class="btn-info" style="font-size: 12px;padding: 3px;font-family: monospace;"><?php echo intval($rsproduct['discount']); ?>% Off</span>
<?php
}
?>
				</div>
				<div class="agile_top_brand_left_grid1">
					<figure>
						<div class="snipcart-item block">
							<div class="snipcart-thumb">
								<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>"><img src="<?php echo $imgname; ?>" style="width: 150px;height: 150px;"></a>	
								<p><?php echo $rsproduct['prodname']; ?></p>
								<h4>₹<?php 
								if($rsproduct['discount'] == 0)
								{
									echo intval($rsproduct['price']); 
								}
								else
								{
									echo intval($rsproduct['price'] - ($rsproduct['price']*$rsproduct['discount']/100));
									echo "<span>₹ " . intval($rsproduct['price']) . "</span>";
								}
								?></h4>
							</div>
							<div class="snipcart-details top_brand_home_details">
								<form action="#" method="post">
									<fieldset>
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="business" value=" ">
										<input type="hidden" name="item_name" value="Fortune Sunflower Oil">
										<input type="hidden" name="amount" value="35.99">
										<input type="hidden" name="discount_amount" value="1.00">
										<input type="hidden" name="currency_code" value="USD">
										<input type="hidden" name="return" value=" ">
										<input type="hidden" name="cancel_return" value=" ">
										<?php
										if($rsproduct['stockstatus'] == "Out Of Stock")
										{
										?>
										<input type="button" name="submit" value="Out Of Stock" class="btn btn-danger">
										<?php
										}
										else
										{
										?>
										<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>" class="btn btn-info">View More</a>
										<?php
										}
										?>
									</fieldset>
								</form>
							</div>
						</div>
					</figure>
				</div>
			</div>
		</div>
	</div>
<?php
	if($i == 3)
	{
		$i=0;
	}
	else
	{
		$i = $i + 1;
	}
	if($i == 0)
	{
	?>
	</div>
	<?php
	}
}
?>
						<div class="clearfix"> </div>
<br>	
				</div>

			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!--- groceries --->
<?php
include("footer.php");
?>