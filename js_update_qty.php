<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
if(isset($_POST['btnqtysubmit']))
{
	$sqlinspurchase = "UPDATE  purchase SET qty='$_POST[qty]' WHERE purchid='$_POST[purchid]'";
	$qsqlinspurchase = mysqli_query($con,$sqlinspurchase);
}
if(isset($_POST['btndelsubmit']))
{
	$sqlinspurchase = "DELETE FROM purchase WHERE purchid='$_POST[purchid]'";
	$qsqlinspurchase = mysqli_query($con,$sqlinspurchase);
}
$tprice = 0;
$sqlpurchase = "SELECT purchase.*,product.*,type.*,purchase.price as purchaseprice,product.unit as prounit FROM `purchase` LEFT JOIN product ON purchase.prodid=product.prodid LEFT JOIN type ON type.typeid=purchase.typeid WHERE purchase.purchasestatus='Pending' AND purchase.entry_type='Invoice' AND purchase.custid='$_SESSION[custid]'";
$qsqlpurchase = mysqli_query($con,$sqlpurchase);
while($rspurchase = mysqli_fetch_array($qsqlpurchase))
{
	$sqltype = "SELECT * FROM type WHERE status='Active' AND prodid='$rspurchase[prodid]' AND typeid='$rspurchase[typeid]'";
	$qsq1type = mysqli_query($con,$sqltype);
	$rstype = mysqli_fetch_array($qsq1type);
	$tprice = $tprice + ($rspurchase['qty'] * $rspurchase['purchaseprice']);
}
echo "₹" . $tprice;
?>