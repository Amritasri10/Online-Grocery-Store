<?php
include("header.php");
if(isset($_GET['deliveryid']))
{
	$sqlupd = "UPDATE billing set delivdate='$dt' WHERE  bilid='" . $_GET['deliveryid'] ."'";
	$qsqlupd = mysqli_query($con,$sqlupd);
	echo "<script>alert('Product delivered successfully..');</script>";
	echo "<script>window.location='orderreceipt.php?bilid=" . $_GET['deliveryid'] . "';</script>";
}
$sqlbilling = "SELECT * FROM billing where bilid='$_GET[bilid]'";
$qsqlbilling = mysqli_query($con,$sqlbilling);
$rsbilling = mysqli_fetch_array($qsqlbilling);
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
<center><h3 class="page-header page-header icon-subheading">Billing Receipt</h3></center>							  
<form method="post" action="" id="printarea">
<div class="row panel panel-default">
	
	<div class="col-md-12"><br></div>
	<div class="col-md-3">
		Bill No. <?php echo $rsbilling['bill_no']; ?>
	</div>
	<div class="col-md-3">
		Purchase Date: <br><?php echo date("d-m-Y",strtotime($rsbilling['purchdate'])); ?>
		<?php
		if($rsbilling['delivdate']!= "0000-00-00")
		{
			echo "<br>Delivered on : " . date("d-m-Y",strtotime($rsbilling['delivdate']));
		}
		?>
	</div>
	<div class="col-md-3">
		Customer:<br>
			<?php
			$sqlcustomer = "SELECT * FROM customer WHERE status='Active' AND custid='$rsbilling[custid]'";
			$qsq1customer = mysqli_query($con,$sqlcustomer);
			$rscustomer = mysqli_fetch_array($qsq1customer);
			echo $rscustomer['custname'];
			?>
	</div>
	<div class="col-md-3">
		<b>Delivery Address:</b><br>
			<?php
			$sqladdress = "SELECT * FROM address WHERE addressid='$rsbilling[addressid]'";
			$qsq1address = mysqli_query($con,$sqladdress);
			$rsaddress = mysqli_fetch_array($qsq1address);
			echo $rsaddress['address'] . ", " . $rsaddress['state'] . ",<br>PIN - " . $rsaddress['pincode'];
			?>
			<?php
			$sqlcity = "SELECT * FROM city WHERE status='Active' AND city_id='$rsbilling[city_id]'";
			$qsq1city = mysqli_query($con,$sqlcity);
			$rscity = mysqli_fetch_array($qsq1city);
			echo ", " . $rscity['city'];
			echo "<br><b>Mob No.</b> " . $rsaddress['contactno'];
			?>
	</div>
	<div class="col-md-12"><br></div>
</div>
 	  
<div class="row panel panel-default">
	<div class="col-md-12"><br></div>
	<div class="col-md-12">
		<table class="table table-bordered" id="tblstockentry">
			<thead>
				<tr>
					<th>Product Title</th>
					<th>Sub Type</th>
					<th>Cost per Quantity</th>
					<th>Total Quantity</th>
					<th>Total Cost</th>
				</tr>
			</thead>
			<tbody>
<?php
$tprice = 0;
$sqlpurchase = "SELECT purchase.*,product.*,type.*,purchase.price as purchaseprice, product.unit as product_unit,product.unit as prounit  FROM `purchase` LEFT JOIN product ON purchase.prodid=product.prodid LEFT JOIN type ON type.typeid=purchase.typeid WHERE purchase.bilid='$_GET[bilid]'";
$qsqlpurchase = mysqli_query($con,$sqlpurchase);
while($rspurchase = mysqli_fetch_array($qsqlpurchase))
{
	$purchaseprice =0;
	$sqltype = "SELECT * FROM type WHERE status='Active' AND prodid='$rspurchase[prodid]'  AND typeid='$rspurchase[typeid]'";
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
	echo "<tr>
	<td>$rspurchase[prodname] | ₹$purchaseprice ";
		if($rspurchase['discount_price'] >0)
		{
			echo " (" . $rspurchase['discount_price'] . "% discount)";
		}
	echo "| $rspurchase[product_unit]</td>";
	echo "<td>";
	if($rspurchase['prodid'] != 0)
	{
		echo "$rstype[unit] $rstype[color] | ₹ $rstype[cost]";
		if($rspurchase['discount_price'] >0)
		{
			echo " (" . $rspurchase['discount_price'] . "% discount)";
		}
		if($rspurchase['discount_price'] >0)
		{
			echo " (" . $rspurchase['discount_price'] . "% discount)";
		}
	}
	echo "</td>";
	echo "<td style='text-align: right;'>Rs. $purchaseprice</td>
	<td>$rspurchase[qty]</td>
	<td style='text-align: right;'>Rs." . ($rspurchase['qty'] * $purchaseprice) ."</td>
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
					<th style='text-align: right;'>Rs.<?php echo $tprice; ?></th>
				</tr>
			</thead>
		</table>
	</div>
</div>

</form>
<div class="row panel panel-default">
	<div class="col-md-12">
		<br>
		<center>
		<input type="button" name="btnprint" id="btnprint"  onclick="printDiv('printarea')" class="btn btn-primary btn-lg" value="Click here to Print" >
<?php
if(isset($_SESSION['staffid']))
{
		if($rsbilling['delivdate']== "0000-00-00")
		{
?>		
		<button type="button" class="btn btn-success btn-lg" onclick="return confirmdeliver('<?php echo $_GET['bilid']; ?>')" >Click Here to Deliver</button>
<?php
		}
}
?>
		</center>
		<br>
	</div>
</div>
 
 
								</section>
						</div>
					</div>
		</div>	
	</div>
	<!-- //icons -->

<?php
include("footer.php");
?>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script>
function confirmdeliver(bilid)
{
	if(confirm("This cannot be changed. Are you sure?") == true)
	{
		window.location="orderreceipt.php?deliveryid="+bilid;
	}
}
</script>