<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
include("dbconnection.php");
if(isset($_POST['btnquantityupdate']))
{
$sqlupd = "UPDATE purchase set quantity='$_POST[quantity]' WHERE purchase_id='$_POST[purchase_id]'";
$qsqlupd = mysqli_query($con,$sqlupd);
echo mysqli_error($con);
}
if(isset($_POST['btnquantitydelete']))
{
$sqldel = "DELETE FROM purchase WHERE purchase_id='$_POST[cartid]'";
$qsqldel = mysqli_query($con,$sqldel);
echo mysqli_error($con);
}
?>
<?php
$tcost = 0;
$sqlpurchase ="SELECT purchase.*,product.product_type,product.product_brand,product.product_img, paintcolor.color_title,paintcolor.image,paintcolor.paintcolor FROM purchase LEFT JOIN product on product.product_id=purchase.product_id LEFT JOIN paintcolor ON paintcolor.paintcolor_id=purchase.paintcolor_id where purchase.status='Pending' AND purchase.customer_id='$_SESSION[customer_id]'";
$qsqlpurchase= mysqli_query($con,$sqlpurchase);
while($rspurchase = mysqli_fetch_array($qsqlpurchase))
{
$tcost = $tcost + ($rspurchase['quantity'] * $rspurchase['cost']);
}
echo $tcost;
?>