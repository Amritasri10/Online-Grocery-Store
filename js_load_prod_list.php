<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
include("dbconnection.php");
$sql = "SELECT product.*,category.category_name,category.sub_category_id as subcatid FROM product LEFT JOIN category  ON category.category_id=product.category_id WHERE product.status='Active' ";
if($_POST['category_id'] != 0)
{
$sql = $sql . " AND product.category_id='" . $_POST['category_id'] . "' ";
}
if($_POST['sub_category_id'] != 0)
{
$sql = $sql . " OR category.sub_category_id='" . $_POST['sub_category_id'] . "'";
}
$sql = $sql . " ORDER BY product.product_id DESC";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$sqlcat = "SELECT * FROM category WHERE category_id='$rs[subcatid]'";
	$qsqlcat = mysqli_query($con,$sqlcat);
	$rscat = mysqli_fetch_array($qsqlcat);
	if($rs['product_img'] == "")
	{
		$filename = "assets/images/noimage.jpg";
	}
	else if(file_exists("imgproduct/".$rs['product_img']))
	{
		$filename = "imgproduct/".$rs['product_img'];
	}
	else
	{
		$filename =  "assets/images/noimage.jpg";
	}	
?>
<div class="col-lg-12">
  <div class="listing-item">
	<div class="left-image" style="padding-left: 25px;padding-top: 50px;">
	<a href="product_detail.php?product_id=<?php echo $rs['product_id']; ?>"><img src="<?php echo $filename; ?>" alt="" style="width: 250px;" ></a>
	</div>
	<div class="right-content align-self-center">
	  <a href="product_detail.php?product_id=<?php echo $rs['product_id']; ?>"><h4><?php echo $rs['product_brand']; ?></h4></a>
	  <h6>Category: <?php
		if($rs['subcatid'] != 0)
		{
		echo $rscat['category_name'] . " - ";
		}
		echo $rs['category_name'];
		?></h6>
	  <span class="price"><div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div> Cost - ₹<?php echo $rs['product_cost']; ?></span>
	  <span class="details"><br></span>
		<div class="main-white-button">
		  <a href="product_detail.php?product_id=<?php echo $rs['product_id']; ?>"><i class="fa fa-eye"></i> Click Here to View</a>
		</div>
	</div>
  </div>
</div>
<?php
}
?>