<?php
include("header.php");
if(!isset($_SESSION['staffid']))
{
    echo "<script>window.location='stafflogin.php';</script>";  
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
<center><h3 class="page-header page-header icon-subheading">Stock Entry Receipt</h3></center>							  
<form method="post" action="" id="printarea">
<div class="row panel panel-default">
	
	<div class="col-md-12"><br></div>
	<div class="col-md-3">
		Bill No. <?php echo $rsbilling['bill_no']; ?>
	</div>
	<div class="col-md-3">
		Purchase Date <?php echo $rsbilling['purchdate']; ?>
	</div>
	<div class="col-md-3">
		City
			<?php
			$sqlcity = "SELECT * FROM city WHERE status='Active' AND city_id='$rsbilling[city_id]'";
			$qsq1city = mysqli_query($con,$sqlcity);
			$rscity = mysqli_fetch_array($qsq1city);
			echo $rscity['city'];
			?>
	</div>
	<div class="col-md-3">
		Seller
			<?php
			$sqlcustomer = "SELECT * FROM customer WHERE status='Active' AND custid='$rsbilling[custid]'";
			$qsq1customer = mysqli_query($con,$sqlcustomer);
			$rscustomer = mysqli_fetch_array($qsq1customer);
			echo $rscustomer['custname'];
			?>
	</div>
	<div class="col-md-12"><br>
		Comment :
		<?php echo $rsbilling['comment']; ?>
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
$sqlpurchase = "SELECT purchase.*,product.*,type.*,purchase.price as purchaseprice FROM `purchase` LEFT JOIN product ON purchase.prodid=product.prodid LEFT JOIN type ON type.typeid=purchase.typeid WHERE purchase.bilid='$_GET[bilid]'";
$qsqlpurchase = mysqli_query($con,$sqlpurchase);
while($rspurchase = mysqli_fetch_array($qsqlpurchase))
{
	$sqltype = "SELECT * FROM type WHERE status='Active' AND prodid='$rspurchase[prodid]'  AND typeid='$rspurchase[typeid]'";
	$qsq1type = mysqli_query($con,$sqltype);
	$rstype = mysqli_fetch_array($qsq1type);
	echo "<tr>
	<td>$rspurchase[prodname] | ₹$rspurchase[price] | $rspurchase[unit]</td>";
	echo "<td>$rstype[unit] $rstype[color] | Rs. $rstype[cost]</td>";
	echo "<td style='text-align: right;'>Rs. $rspurchase[purchaseprice]</td>
	<td>$rspurchase[qty]</td>
	<td style='text-align: right;'>Rs." . $rspurchase['qty'] * $rspurchase['purchaseprice'] ."</td>
	</tr>";
	$tprice = $tprice + ($rspurchase['qty'] * $rspurchase['purchaseprice']);
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
		<center><input type="button" name="btnprint" id="btnprint"  onclick="printDiv('printarea')" class="btn btn-primary btn-lg" value="Click here to Print" ></center>
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