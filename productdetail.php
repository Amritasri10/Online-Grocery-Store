<?php
include("header.php");
$sqlproduct = "SELECT * FROM product LEFT JOIN category ON product.catid=category.catid where product.status='Active' AND product.prodid='$_GET[prodid]'";
$qsqlproduct = mysqli_query($con,$sqlproduct);
$rsproduct = mysqli_fetch_array($qsqlproduct);
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
$_GET['prodid']	 = $_GET['prodid'];
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Product Detail</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
	<div class="products">
		<div class="container">
			<div class="agileinfo_single">
				
				<div class="col-md-4 agileinfo_single_left">
					<img id="example" src="<?php echo $imgname; ?>" alt=" " class="img-responsive">
				</div>
				<div class="col-md-8 agileinfo_single_right">
				<h2><?php echo $rsproduct['prodname']; ?></h2>
					<div class="w3agile_description">
						<h4>Description :</h4>
						<p><?php echo $rsproduct['prodspecif']; ?></p>
					</div>
					<div class="snipcart-item block">
<b>Select Product Type:</b>
<?php
	$sqltype = "SELECT * FROM type WHERE prodid='$_GET[prodid]' AND status='Active' ORDER BY cost";
	$qsqltype = mysqli_query($con,$sqltype);
	if(mysqli_num_rows($qsqltype) >=1)
	{
?>
<input type="hidden" name="prodid" id="prodid" value="<?php echo $_GET['prodid']; ?>" >
<select class="form-control" name="typeid" id="typeid" style="width: 75%;height: 50px;" onchange="load_product_type(this.value)">
	<?php
	$iq=0;
	$typeid=0;
	while($rstype = mysqli_fetch_array($qsqltype))
	{
		if($iq == 0)
		{
			$_GET['typeid'] = $rstype['typeid'];
			$iq=1;
		}
		echo "<option value='$rstype[typeid]' >$rstype[unit] $rstype[color] |  ";
		echo "₹" .  intval($rstype['cost']);
		if($rstype['discount'] >0)
		{
		echo " ("  . intval($rstype['discount']) ." % Off) ";
		echo " | <span style='color: green;'>After discount - "   . "₹" . intval($rstype['cost'] - ($rstype['cost']*$rstype['discount']/100)) ."</span> ";
		}
		echo "</option>";
	}
	?>
</select>
<div id="div_js_subproduct"><?php include("js_subproduct.php"); ?></div>
<?php
	}
	else
	{
?>
	<input type="hidden" name="prodid" id="prodid" value="<?php echo $_GET['prodid']; ?>" >
	<input type="hidden" name="typeid" id="typeid" value="0" >
	<div class="snipcart-thumb agileinfo_single_right_snipcart">
		<h2 class="m-sing table table-bordered" style="padding: 20px;width: 75%;font-family: 'Open Sans';">Cost - ₹<?php if($rsproduct['discount'] == 0)
		{
			echo intval($rsproduct['price']); 
		}
		else
		{
			echo intval($rsproduct['price'] - ($rsproduct['price']*$rsproduct['discount']/100));
			echo "&nbsp;&nbsp;&nbsp;&nbsp;<strike>₹ " . intval($rsproduct['price']) . "</strike> ";
			echo intval($rsproduct['discount']) ." % Off";
		}
		?></h2>
	</div>
<div class="snipcart-details agileinfo_single_right_details">
	<fieldset>
<?php
if(isset($_SESSION['custid']))
{
?>
		<input type="button" name="submit" value="Add to cart" class="button" onclick="add_to_cart('<?php echo $_GET['prodid']; ?>',0)">
<?php
}
else
{
?>
		<a class="btn btn-primary" href="login.php?page=productdetail.php&prodid=<?php echo $_GET['prodid']; ?>" >Click Here to Login</a>
<?php
}
?>
	</fieldset>
</div>
<?php
	}
?>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- new -->
	<div class="newproducts-w3agile">
		<div class="container">
			<h3>Products On  offers</h3>
				<div class="agile_top_brands_grids">
				
<?php
$i = 0;
$sqlproduct = "SELECT * FROM product LEFT JOIN category ON product.catid=category.catid where product.status='Active'";
if($_GET['subcatid'] != "")
{
	$sqlproduct = $sqlproduct . " AND product.catid ='$_GET[subcatid]' ";
}
else if($_GET['catid'] != "")
{
	$sqlproduct = $sqlproduct . " AND category.sub_catid ='$_GET[catid]' ";
}
$sqlproduct =  $sqlproduct  . " and product.discount>='1' ORDER BY RAND() LIMIT 4";
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
								<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>"><img title=" " alt=" " src="<?php echo $imgname; ?>" style="width: 150px;height: 150px;"></a>		
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
<fieldset>
	<?php
	if($rsproduct['stockstatus'] == "Out Of Stock")
	{
	?>
		<input type="button" name="submit" value="Out Of Stock" class="btn btn-danger" alert()>
	<?php
	}
	else
	{
	?>
		<a href="productdetail.php?prodid=<?php echo $rsproduct[0]; ?>" value="Out Of Stock" class="btn btn-danger">View</a>
	<?php
	}
	?>
</fieldset>
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
				</div>
		</div>
	</div>
<!-- //new -->
<?php
include("footer.php");
?>
<script>
function load_product_type(typeid)
{
	var prodid = $("#prodid").val();
	$.post("js_subproduct.php",
	{
		prodid: prodid,
		typeid: typeid,
		jssubmit: "submit",
	},
	function(data){
		$("#div_js_subproduct").html(data);
	});
}
</script>
<script>
function add_to_cart()
{
	var prodid = $("#prodid").val();
	var typeid = $("#typeid").val();
	$.post("js_cart.php",
	{
		prodid: prodid,
		typeid: typeid
	},
	function(data){
		alert("Product Added to the cart...");
	});
}
</script>