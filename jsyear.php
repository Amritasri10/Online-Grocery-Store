<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
include("dbconnection.php");
$sql  = "SELECT vehicle.*, category.category_name FROM vehicle LEFT JOIN category ON vehicle.category_id=category.category_id where vehicle.vehicle_id!='0'";
if($_POST['category_id'] != "")
{
	$sql= $sql . " AND vehicle.category_id='" . $_POST['category_id'] . "'";
}
if($_POST['year'] != "")
{
	$sql= $sql . " AND vehicle.vehicle_year='" . $_POST['year'] . "'";
}
if($_POST['price_range'] != "")
{
	if($_POST['price_range'] == "Below 1 Lac")
	{
		$startprice =0;
		$endprice =100000;
	}
	else if($_POST['price_range'] == "1 Lac - 2 Lac")
	{
		$startprice =100001;
		$endprice =200000;
	}
	else if($_POST['price_range'] == "2 Lac - 3 Lac")
	{
		$startprice =200001;
		$endprice =300000;
	}
	else if($_POST['price_range'] == "3 Lac - 5 Lac")
	{
		$startprice =300001;
		$endprice =500000;
	}
	else if($_POST['price_range'] == "5 Lac and Above")
	{
		$startprice =500001;
		$endprice =20000000000000;
	}
	$sql= $sql . " AND (vehicle.price BETWEEN '" . $startprice . "' AND '" . $endprice . "')";
}
$sql= $sql . " AND vehicle.selling_price='0' ORDER BY vehicle.vehicle_id DESC";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
if(mysqli_num_rows($qsql) == 0)
{
	echo '<div class="col-md-12"><div class="alert alert-danger">Not Found</div></div>';
}
while($rs = mysqli_fetch_array($qsql))
{
	$sqlimg = "SELECT * FROM image WHERE fid='$rs[0]' AND image_type='VehSaleImg1' AND image_status='Active'";
	$qsqlimg = mysqli_query($con,$sqlimg);
	echo mysqli_error($con);
	$rsimg = mysqli_fetch_array($qsqlimg);
	if($rsimg['image_path'] == "")
	{
		$imgname = "admin/images/defaultimage.png";
	}
	else if(file_exists("admin/imgsalesvehicle/" . $rsimg['image_path']))
	{
		$imgname = "admin/imgsalesvehicle/" . $rsimg['image_path'];
	}
	else
	{
		$imgname = "admin/images/defaultimage.png";
	}
?>
		<div class="col-md-4 md-margin-bottom-40" style="border: 1px solid #ccc!important;"><br>
		   <a href="salesvehiclemore.php?vehicle_id=<?php echo $rs[0]; ?>"><img class="img-responsive" src="<?php echo $imgname; ?>" alt="" style="height: 220px;width: 100%;cursor: pointer;"></a>
		   <div  style="height: 140px;">
			<b style="font-size: 20px;"><?php echo $rs['vehicle_name']; ?></b><br>
			<label style="font-size: 14px;"><?php echo $rs['km_driven']; ?>KM </label>
			<label style="font-size: 14px;float: right;">Model - <?php echo $rs['vehicle_year']; ?></label><br>
			<b style="font-size: 15px;color: red;">Cost: ₹<?php echo intval($rs['price']); ?></b><br>
			<a href="salesvehiclemore.php?vehicle_id=<?php echo $rs[0]; ?>" class="btn btn-info">View More</a>
			</div>
		</div>
<?php
}
?>