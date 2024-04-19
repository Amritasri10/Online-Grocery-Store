<?php
include("header.php");
if(isset($_POST['btnpayment']))
{
	$sqlbilling = "SELECT max(bill_no) as bill_no FROM billing";
	$qsqlbilling = mysqli_query($con,$sqlbilling);
	$rsbilling = mysqli_fetch_array($qsqlbilling);
	if(mysqli_num_rows($qsqlbilling) == 0 )
	{
		$billno= 1001;
	}
	else
	{
		$billno= $rsbilling['bill_no'] + 1;
	}
	//addressid cardholder cardno expdate cardno  btnpayment cardno  cvvno
	$sqldel = "INSERT INTO billing(`custid`, `addressid`, `city_id`, `staffid`, `bill_no`, `entry_type`, `purchdate`,  `total_amt`, `cardtype`, `cardno`, `cvvno`, `expirydate`, `comment`, `status`) values('$_SESSION[custid]', '$_POST[addressid]', '$_SESSION[locationid]', '0', '$billno', 'Invoice', '$dt', '$_POST[tprice]','$_POST[card_type]',  '$_POST[cardno]', '$_POST[cvvno]', '$_POST[expdate]','', 'Active')";
	$qsqldel = mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$insid = mysqli_insert_id($con);
			$sqlpurchase = "UPDATE purchase SET purchasestatus='Active',bilid='$insid' WHERE custid='$_SESSION[custid]' and purchasestatus='Pending'";
			$qsqlpurchase = mysqli_query($con,$sqlpurchase);
		echo "<script>alert('Billing Receipt generated successfully..');</script>";
		echo "<script>window.location='orderreceipt.php?bilid=$insid';</script>";
	}
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
<center><h3 class="page-header page-header icon-subheading">Payment Panel</h3></center>							  
<form method="post" action="" id="printarea" onsubmit="return validateform()">
 	  
<div class="row panel panel-default">
	<div class="col-md-12"><br></div>
	<div class="col-md-12">
		<table class="table table-bordered" id="tblstockentry">
			<thead>
				<tr>
					<th>Product Detail</th>
					<th>Cost per Quantity</th>
					<th>Total Quantity</th>
					<th>Total Cost</th>
				</tr>
			</thead>
			<tbody>
<?php
$tprice = 0;
$sqlpurchase = "SELECT purchase.*,product.*,type.*,purchase.price as purchaseprice, product.unit as product_unit FROM `purchase` LEFT JOIN product ON purchase.prodid=product.prodid LEFT JOIN type ON type.typeid=purchase.typeid WHERE purchase.custid='$_SESSION[custid]' and purchase.purchasestatus='Pending'";
$qsqlpurchase = mysqli_query($con,$sqlpurchase);
while($rspurchase = mysqli_fetch_array($qsqlpurchase))
{
		if($rspurchase['discount_price'] == 0)
	{
		$purchaseprice = intval($rspurchase['purchaseprice']); 
	}
	else
	{
		$purchaseprice = intval($rspurchase['purchaseprice'] - ($rspurchase['purchaseprice']*$rspurchase['discount_price']/100));
	}
	$sqltype = "SELECT * FROM type WHERE status='Active' AND prodid='$rspurchase[prodid]'  AND typeid='$rspurchase[typeid]'";
	$qsq1type = mysqli_query($con,$sqltype);
	$rstype = mysqli_fetch_array($qsq1type);
	echo "<tr>
	<td>$rspurchase[prodname] | ";
	if(mysqli_num_rows($qsq1type) >= 1)
	{
		echo "" . $rstype['product_unit'] . " " .  $rstype['color']  . " | " . " ₹" . $rstype['cost'];
	}
	else
	{
		echo "₹". $rspurchase['price'] ;
		if($rspurchase['discount_price'] >0)
		{
			echo " (" . $rspurchase['discount_price'] . "% discount)";
		}
		echo "| " . $rspurchase['product_unit'];
	}
	echo "</td>";
	echo "<td style='text-align: right;'>Rs. $purchaseprice</td>
	<td>$rspurchase[qty]</td>
	<td style='text-align: right;'>Rs." . $rspurchase['qty'] * $purchaseprice ."</td>
	</tr>";
	$tprice = $tprice + ($rspurchase['qty'] * $purchaseprice);
}
?>			
			</tbody>
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Grand Total</th>
					<th style='text-align: right;'>Rs.<?php echo $tprice; ?></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<input type="hidden" name="tprice" id="tprice" value="<?php echo $tprice; ?>" >
<div class="row panel panel-default">
	<div class="col-md-12"><br></div>
	<div class="col-md-6">
                        <div class="form-group"> 
							<label>Select Address (<a href='address.php' style='color: blue;'>Add New Addres</a>)</label> <span id="id_addressid" class="err_msg"></span>
                            <select class="form-control" name='addressid' id="addressid" onchange="fun_loadaddress(this.value)"> 
								<option value="">Select Address</option>
			<?php
			$sqladdress= "SELECT * FROM address LEFT JOIN city ON address.city_id=city.city_id WHERE address.custid='$_SESSION[custid]' AND address.city_id='$_SESSION[locationid]'";
			$qsqladdress= mysqli_query($con,$sqladdress);
			echo mysqli_error($con);
			while($rsaddress= mysqli_fetch_array($qsqladdress))
			{
				echo "<option value='$rsaddress[0]'>$rsaddress[address], $rsaddress[city] - $rsaddress[pincode] | Ph. No. $rsaddress[contactno] </option>";
			}
			?>
							</select>
                        </div>
						<div id="divaddr"><?php include("js_address.php");?></div>

	</div>
	<div class="col-md-6">
		<div class="form-group"> 
			<label>Card Type.</label> <span id="id_card_type" class="err_msg"></span>
			<div class="">
			<select class="form-control" name="card_type" id="card_type">
				<?php
				$arr = array("Visa","Master Card","American Express","Rupay");
				foreach($arr as $val)
				{
					echo "<option value='$val' >$val</option>";
				}
				?>
			</select>
			</div> 
		</div>        
		<div class="form-group"> 
			<label>Card Holder.</label> <span id="id_cardholder" class="err_msg"></span>
			<div class=""> <input type="text" class="form-control coupon" name="cardholder" id="cardholder" placeholder="Enter Card Holder detail"  >
			</div>
		</div>
		<div class="form-group"> 
			<label>Card No.</label> <span id="id_cardno" class="err_msg"></span>
			<div class=""> <input type="number" class="form-control coupon" name="cardno" id="cardno" placeholder="Enter Card No."  >
			</div>
		</div>
		<div class="form-group"> 
			<label>Expiry Date</label> <span id="id_expdate" class="err_msg"></span>
			<div class=""> <input type="month" class="form-control coupon" name="expdate" id="expdate" placeholder="Enter Expiry Date" min="<?php echo date("Y-m"); ?>" >
			</div>
		</div>
		<div class="form-group"> 
			<label>CVV No.</label> <span id="id_cvvno" class="err_msg"></span>
			<div class=""> <input type="number" class="form-control coupon" name="cvvno" id="cvvno" placeholder="Enter Card No." min="101" max="999"  >
			</div>
		</div>
	</div>
</div>
<div class="row panel panel-default">
	<div class="col-md-12">
		<hr>
		<center><input type="submit" name="btnpayment" id="btnpayment"  class="btn btn-primary btn-lg" value="Click here to Make Payment" ></center>
		<br>
	</div>
</div>


</form>
 
 
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
function fun_loadaddress(addressid)
{
	$.post("js_address.php",
	{
		addressid: addressid
	},
	function(data){
		$("#divaddr").html(data);
	});
}
</script>           
<script>
function validateform()
{
	//###########
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaspaceExp = /^[a-zA-Z\s]+$/;
	var alphanumbericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	//###########
	$(".err_msg").html('');
	var validate = "true";
	//###############################################
	if($("#addressid").val() == "")
	{
		$('#id_addressid').html("Kindly select address...");
		validate = "false";
	}     
	//###############################################
	if($("#card_type").val() == "")
	{
		$('#id_card_type').html("Kindly select card type...");
		validate = "false";
	}
	//###############################################
	if($("#cardholder").val() == "")
	{
		$('#id_cardholder').html("Card holder should not be empty...");
		validate = "false";
	}     
	//###############################################
	if($("#cardno").val().length != 16)
	{
		$('#id_cardno').html("Entered Card Number should contain 16 digits...");
		validate = "false";
	}
	//###############################################
	if($("#cardno").val() == "")
	{
		$('#id_cardno').html("Card number should not be empty...");
		validate = "false";
	}    
	//###############################################
	if($("#expdate").val() == "")
	{
		$('#id_expdate').html("Kindly select expiry date...");
		validate = "false";
	}	
	//###############################################
	if($("#cvvno").val() == "")
	{
		$('#id_cvvno').html("CVV number should not be empty...");
		validate = "false";
	}    
	//###############################################
	if(validate == "true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
	