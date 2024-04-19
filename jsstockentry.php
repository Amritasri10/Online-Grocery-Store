<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
$dt=date("Y-m-d");
$dttim=date("Y-m-d H:i:s");
/*
	product_type: product_type,
				product_id: product_id,
				paintcolor_id: paintcolor_id,
				status: status
*/
if($_POST['product_type'] == "Product" && $_POST['entrytype'] == "Insert")
{
	$sqlinsert = "INSERT INTO paint_stock(city_id,product_id,paintcolor_id,stock_status) VALUES('$_POST[city_id]','$_POST[product_id]','0','OutOfStock')";
	$qsqlinsert = mysqli_query($con,$sqlinsert);
}
if($_POST['product_type'] == "Product" && $_POST['entrytype'] == "Delete")
{
	$sqlinsert = "DELETE FROM  paint_stock WHERE city_id='$_POST[city_id]' AND product_id='$_POST[product_id]' AND stock_status='OutOfStock'";
	$qsqlinsert = mysqli_query($con,$sqlinsert);
}
if($_POST['product_type'] == "ProductColor" && $_POST['entrytype'] == "Insert")
{
	$sqlinsert = "INSERT INTO paint_stock(city_id,product_id,paintcolor_id,stock_status) VALUES('$_POST[city_id]','$_POST[product_id]','$_POST[paintcolor_id]','OutOfStock.')";
	$qsqlinsert = mysqli_query($con,$sqlinsert);
}
if($_POST['product_type'] == "ProductColor" && $_POST['entrytype'] == "Delete")
{
	echo $sqlinsert = "DELETE FROM  paint_stock WHERE city_id='$_POST[city_id]' AND product_id='$_POST[product_id]' AND paintcolor_id='$_POST[paintcolor_id]' AND stock_status='OutOfStock.'";
	$qsqlinsert = mysqli_query($con,$sqlinsert);
}
?>