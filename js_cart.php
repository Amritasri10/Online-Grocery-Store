<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
if($_REQUEST['typeid'] == 0)
{
	$sqlproduct = "SELECT * FROM product LEFT JOIN category ON product.catid=category.catid where product.status='Active' and product.prodid='$_POST[prodid]'";
	$qsqlproduct = mysqli_query($con,$sqlproduct);
	$rstproduct = mysqli_fetch_array($qsqlproduct);
	$price = $rstproduct['price'];
	$discount = $rstproduct['discount'];
}
else
{
	$sqltype = "SELECT * FROM type WHERE prodid='$_POST[prodid]' AND typeid='$_POST[typeid]' AND status='Active' ORDER BY cost";
	$qsqltype = mysqli_query($con,$sqltype);
	$rstype = mysqli_fetch_array($qsqltype);
	$price = $rstype['cost'];
	$discount = $rstype['discount'];
}
$sqldel = "DELETE FROM purchase WHERE prodid='$_POST[prodid]' AND typeid='$_POST[typeid]' AND custid='$_SESSION[custid]' AND purchasestatus='Pending'";
$qsqldel = mysqli_query($con,$sqldel);
$sqlpurchase = "INSERT INTO purchase(prodid, typeid, custid, bilid, entry_type, qty, price, discount_price, comment, purchasestatus) VALUES ('$_POST[prodid]','$_POST[typeid]','$_SESSION[custid]','0','Invoice','1','$price','$discount','','Pending')";
$qsqlpurchase = mysqli_query($con,$sqlpurchase);
?>