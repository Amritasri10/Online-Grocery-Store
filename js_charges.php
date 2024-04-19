<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
include("dbconnection.php");
if(isset($_POST['entrypincode']))
{
	$custpincode = $_POST['entrypincode'];
}
else
{
	$sqlcustpin = "SELECT * FROM customer where customer_id='$_SESSION[customer_id]'";
	$qsqlcustpin  = mysqli_query($con,$sqlcustpin);
	$rscustpin  = mysqli_fetch_array($qsqlcustpin);
	$custpincode = $rscustpin['pincode'];
}
//Source Pin code starts here
$sqlcustpins = "SELECT * FROM city where pincode LIKE '%$custpincode%'";
$qsqlcustpins  = mysqli_query($con,$sqlcustpins);
if(mysqli_num_rows($qsqlcustpins) >= 1)
{
	$rscustpins  = mysqli_fetch_array($qsqlcustpins);
	$sourcepincode=$rscustpins['seller_pincode'];
	//Source Pin code ends here
	$destinationpincode=$custpincode;
	include("ajaxtotalkm.php");
	//##############################################
	$sqldel_charge_setting = "SELECT * FROM del_charge_setting WHERE '" . $km . "' BETWEEN distance_from AND distance_to";
	$qsqldel_charge_setting = mysqli_query($con,$sqldel_charge_setting);
	$rsdel_charge_setting = mysqli_fetch_array($qsqldel_charge_setting);
	echo $deliverycharge= $rsdel_charge_setting['cost'];
	//##############################################
}
else
{
	echo 0;
}
?>