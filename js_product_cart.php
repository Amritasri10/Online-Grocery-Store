<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
?>
<table class="table table-bordered" id="tblstockentry">
	<thead>
		<tr>
			<th>Product Title</th>
			<th>Sub Type</th>
			<th>Cost per Quantity</th>
			<th>Total Quantity</th>
			<th>Total Cost</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php
$tprice = 0;
$sqlpurchase = "SELECT purchase.*,product.*,type.*,purchase.price as purchaseprice,product.unit as prounit FROM `purchase` LEFT JOIN product ON purchase.prodid=product.prodid LEFT JOIN type ON type.typeid=purchase.typeid WHERE purchase.purchasestatus='Pending' AND purchase.entry_type='Invoice' AND purchase.custid='$_SESSION[custid]'";
$qsqlpurchase = mysqli_query($con,$sqlpurchase);
while($rspurchase = mysqli_fetch_array($qsqlpurchase))
{
	$purchaseprice =0;
	$sqltype = "SELECT * FROM type WHERE status='Active' AND prodid='$rspurchase[prodid]' AND typeid='$rspurchase[typeid]'";
	$qsq1type = mysqli_query($con,$sqltype);
	$rstype = mysqli_fetch_array($qsq1type);
	if($rspurchase['discount_price'] == 0)
	{
		$purchaseprice = intval($rspurchase['purchaseprice']); 
	}
	else
	{
		$purchaseprice = intval($rspurchase['purchaseprice'] - ($rspurchase['purchaseprice']*$rspurchase['discount_price']/100));
	}
	echo "<tr id='trow$rspurchase[0]' >
	<td>";
	if($rspurchase['prodid'] == 0)
	{
		echo "$rspurchase[prodname] | ₹$rspurchase[price]";
		if($rspurchase['discount_price'] >0)
		{
			echo " (" . $rspurchase['discount_price'] . "% discount)";
		}
		echo " | $rspurchase[prounit]";
	}
	else
	{
		echo $rspurchase['prodname'];
	}
	echo "</td>
	<td>";
	if($rspurchase['prodid'] != 0)
	{
		echo "$rstype[prounit] $rstype[color] | ₹ $rstype[cost]";
		if($rspurchase['discount_price'] >0)
		{
			echo " (" . $rspurchase['discount_price'] . "% discount)";
		}
	}
	echo "</td>
	<td style='text-align: right;'>₹ $purchaseprice</td>
	<td><input type='number' name='qty' id='qty' value='" . intval($rspurchase['qty']) ."' class='form-control' style='width: 100px;' onchange='load_change_qty($rspurchase[0],this.value,$purchaseprice)'  onkeyup='load_change_qty($rspurchase[0],this.value,$purchaseprice)' ></td>
	<td style='text-align: right;' id='totasum$rspurchase[0]'>₹" . ($rspurchase['qty'] * $purchaseprice) ."</td><td><i class='fa fa-trash' aria-hidden='true' style='color: red;cursor: pointer;' onclick='delfromcart($rspurchase[0])'></i></td>
	</tr>";
	$tprice = $tprice + ($rspurchase['qty'] * $purchaseprice);
}
?>			
	</tbody>
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th>Grand Total</th>
			<th style='text-align: right;' id="tprice">₹<?php echo $tprice; ?></th>
			<th style='text-align: right;'></th>
		</tr>
	</thead>
</table>