<?php
include("header.php");
?>
	<!-- main-slider -->
		<ul id="demo1">
			<li>
				<img src="images/11.jpg" alt="" />
				<!--Slider Description example-->
				<div class="slide-desc">
					<h3>Buy Rice Products Are Now On Line With Us</h3>
				</div>
			</li>
			<li>
				<img src="images/22.jpg" alt="" />
				  <div class="slide-desc">
					<h3>Whole Spices Products Are Now On Line With Us</h3>
				</div>
			</li>
			
			<li>
				<img src="images/44.jpg" alt="" />
				<div class="slide-desc">
					<h3>Whole Spices Products Are Now On Line With Us</h3>
				</div>
			</li>
		</ul>
	<!-- //main-slider -->
	<!-- //top-header and slider -->
	<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
		<h2>Top selling offers</h2>
			<div class="grid_3 grid_5">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Trending offers</a></li>
						<li role="presentation"><a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours">Today Offers</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
							<div class="agile_top_brands_grids">
							
<?php
$sqlproduct= "SELECT * FROM product LEFT JOIN category ON product.catid=category.catid where product.status='Active' AND discount>='1' ORDER BY rand() LIMIT 9";
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
?>			
<div class="col-md-4 top_brand_left">
	<div class="hover14 column">
		<div class="agile_top_brand_left_grid">
			<div class="agile_top_brand_left_grid_pos">
				<img src="images/offer.png" alt=" " class="img-responsive" />
			</div>
			<div class="agile_top_brand_left_grid1">
				<figure>
					<div class="snipcart-item block" >
						<div class="snipcart-thumb">
							<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>"><img title=" " alt=" " src="<?php echo $imgname; ?>"  style="width: 150px;height: 175px;"/></a>		
							<p><?php echo $rsproduct['prodname']; ?></p>

									
							<h4>₹<?php echo intval($rsproduct['price'] - ($rsproduct['price']*$rsproduct['discount']/100)); ?> <?php echo "<span>₹ " . intval($rsproduct['price']) . "</span>"; ?></h4>
						</div>
						<div class="snipcart-details top_brand_home_details">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" />
									<input type="hidden" name="business" value=" " />
									<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
									<input type="hidden" name="amount" value="20.99" />
									<input type="hidden" name="discount_amount" value="1.00" />
									<input type="hidden" name="currency_code" value="USD" />
									<input type="hidden" name="return" value=" " />
									<input type="hidden" name="cancel_return" value=" " />
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
}
?>

								<div class="clearfix"> </div>
							</div>
					
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
							<div class="agile_top_brands_grids">
<?php
$sqlproduct= "SELECT * FROM product LEFT JOIN category ON product.catid=category.catid where product.status='Active' AND discount>='1' ORDER BY rand() LIMIT 9";
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
?>			
<div class="col-md-4 top_brand_left">
	<div class="hover14 column">
		<div class="agile_top_brand_left_grid">
			<div class="agile_top_brand_left_grid_pos">
				<img src="images/offer.png" alt=" " class="img-responsive" />
			</div>
			<div class="agile_top_brand_left_grid1">
				<figure>
					<div class="snipcart-item block" >
						<div class="snipcart-thumb">
							<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>"><img title=" " alt=" " src="<?php echo $imgname; ?>"  style="width: 150px;height: 175px;"/></a>		
							<p><?php echo $rsproduct['prodname']; ?></p>

									
							<h4>₹<?php echo intval($rsproduct['price'] - ($rsproduct['price']*$rsproduct['discount']/100)); ?> <?php echo "<span>₹ " . intval($rsproduct['price']) . "</span>"; ?></h4>
						</div>
						<div class="snipcart-details top_brand_home_details">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" />
									<input type="hidden" name="business" value=" " />
									<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
									<input type="hidden" name="amount" value="20.99" />
									<input type="hidden" name="discount_amount" value="1.00" />
									<input type="hidden" name="currency_code" value="USD" />
									<input type="hidden" name="return" value=" " />
									<input type="hidden" name="cancel_return" value=" " />
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
}
?>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- //top-brands -->
 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
         <a href="beverages.html"> <img class="first-slide" src="images/b1.jpg" alt="First slide"></a>
       
        </div>
        <div class="item">
         <a href="personalcare.html"> <img class="second-slide " src="images/b3.jpg" alt="Second slide"></a>
         
        </div>
        <div class="item">
          <a href="household.html"><img class="third-slide " src="images/b1.jpg" alt="Third slide"></a>
          
        </div>
      </div>
    
    </div><!-- /.carousel -->	
<!--banner-bottom-->
				<div class="ban-bottom-w3l">
					<div class="container">
					<div class="col-md-6 ban-bottom3">
							<div class="ban-top">
								<img src="images/p2.jpg" class="img-responsive" alt=""/>
								
							</div>
							<div class="ban-img">
								<div class=" ban-bottom1">
									<div class="ban-top">
										<img src="images/p3.jpg" class="img-responsive" alt=""/>
										
									</div>
								</div>
								<div class="ban-bottom2">
									<div class="ban-top">
										<img src="images/p4.jpg" class="img-responsive" alt=""/>
										
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-md-6 ban-bottom">
							<div class="ban-top">
								<img src="images/111.jpg" class="img-responsive" alt=""/>
								
								
							</div>
						</div>
						
						<div class="clearfix"></div>
					</div>
				</div>
<!--banner-bottom-->
<!--brands-->
	<div class="brands">
		<div class="container">
		<h3>Product Types</h3>
			<div class="brands-agile">

<?php
$sqlcategory = "SELECT a.*,b.catgory_title as maincat FROM category as a LEFT JOIN category  as b ON b.catid=a.sub_catid limit 20";
$qsqlcategory= mysqli_query($con,$sqlcategory);
while($rscategory= mysqli_fetch_array($qsqlcategory))
{
	$sqlsubcategory = "SELECT * FROM category  where status='Active' AND sub_catid='$rsmaincategory[catid]'";
	$qsqlsubcategory = mysqli_query($con,$sqlsubcategory);
?>
<div class="col-md-3 w3layouts-brand">
	<div class="brands-w3l">
		<p><a href="groceries.php?catid=<?php echo $rscategory[0]; ?>"><?php echo $rscategory['catgory_title']; ?></a></p><br>
	</div>
</div>
<?php
}
?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>	
<!--//brands-->
<!-- new -->
	<div class="newproducts-w3agile">
		<div class="container">
			<h3>New Products</h3>
				<div class="agile_top_brands_grids">
<?php
$sqlproduct= "SELECT * FROM product LEFT JOIN category ON product.catid=category.catid where product.status='Active' ORDER BY product.prodid DESC limit 4";
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
?>	
					<div class="col-md-3 top_brand_left-1">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid_pos">
									<img src="images/offer.png" alt=" " class="img-responsive">
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>"><img title=" " alt=" " src="<?php echo $imgname; ?>" style="width: 100%;height: 200px;"></a>		
												<p><?php echo $rsproduct['prodname']; ?></p>
													<h4>₹ <?php echo intval($rsproduct['price'] - ($rsproduct['price']*$rsproduct['discount']/100)); ?> <span><?php echo "<span>₹ " . intval($rsproduct['price']) . "</span>"; ?></span></h4>
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
}
?>
						<div class="clearfix"> </div>
				</div>
		</div>
	</div>
<!-- //new -->
<?php
include("footer.php");
?>