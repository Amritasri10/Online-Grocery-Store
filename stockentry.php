<?php
include("header.php");
if(!isset($_SESSION['staffid']))
{
    echo "<script>window.location='stafflogin.php';</script>";  
}
if(isset($_POST['btnsubmit']))
{
	$inpprodid = $_POST['inpprodid'];
	$inptypeid =  $_POST['inptypeid'];
	$inptotqty =  $_POST['inptotqty'];
	$inpcostperqty =  $_POST['inpcostperqty'];
	$inptotalcost =  $_POST['inptotalcost'];
	$sqldel = "INSERT INTO billing(custid, addressid, city_id, staffid, bill_no, entry_type, purchdate, total_amt, comment, status) values('$_POST[custid]', '0', '$_POST[city_id]', '$_SESSION[staffid]', '$_POST[bill_no]', 'Purchase', '$_POST[purchdate]', '$_POST[grandtotal]', '$_POST[comment]', 'Active')";
	$qsqldel = mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$insid = mysqli_insert_id($con);
		for($i=0;$i<count($_POST['inpprodid']);$i++)
		{
			$sqlpurchase = "INSERT INTO purchase( prodid, typeid, custid, bilid, entry_type, qty, price, discount_price, comment, purchasestatus) VALUES ('$inpprodid[$i]','$inptypeid[$i]','$_SESSION[staffid]','$insid','Purchase','$inptotqty[$i]','$inpcostperqty[$i]','0','','Active')";
			$qsqlpurchase = mysqli_query($con,$sqlpurchase);
		}
		echo "<script>alert('Stock Entry done successfully..');</script>";
		echo "<script>window.location='stockentryreceipt.php?bilid=$insid';</script>";
	}
}

?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
<center><h3 class="page-header page-header icon-subheading">Stock Entry</h3></center>							  
<form method="post" action="" onsubmit="return validateform()">
<div class="row panel panel-default">
	
	<div class="col-md-12"><br></div>
	<div class="col-md-3">
		Bill No.  <span id="id_bill_no" class="err_msg"></span>
		<input type="number" name="bill_no" id="bill_no" placeholder="Bill No." class="form-control" value="<?php echo $rsedit['bill_no']; ?>" >
	</div>
	<div class="col-md-3">
		Purchase Date  <span id="id_purchdate" class="err_msg"></span>
		<input type="date" name="purchdate" id="purchdate" class="form-control" value="<?php echo $rsedit['purchdate']; ?>" max="<?php echo date("Y-m-d"); ?>" >
	</div>
	<div class="col-md-3">
		City <span id="id_city_id" class="err_msg"></span>
		<select  name="city_id" id="city_id" class="form-control" >
			<option value="">Select City</option>
			<?php
			$sqlcity = "SELECT * FROM city WHERE status='Active'";
			$qsq1city = mysqli_query($con,$sqlcity);
			while($rscity = mysqli_fetch_array($qsq1city))
			{
				if($rscity['city_id'] == $rsedit['city_id'])
				{
					echo "<option value='$rscity[city_id]' selected>$rscity[city]</option>";
				}
				else
				{
					echo "<option value='$rscity[city_id]'>$rscity[city]</option>";
				}
			}
			?>
		</select>
	</div>   
	<div class="col-md-3">
		Seller <span id="id_custid" class="err_msg"></span>
		<select  name="custid" id="custid" class="form-control" >
			<option value="">Select City</option>
			<?php
			$sqlcustomer = "SELECT * FROM customer WHERE status='Active' AND cust_type='Seller'";
			$qsq1customer = mysqli_query($con,$sqlcustomer);
			while($rscustomer = mysqli_fetch_array($qsq1customer))
			{
				if($rscustomer['custid'] == $rsedit['custid'])
				{
					echo "<option value='$rscustomer[custid]' selected>$rscustomer[custname]</option>";
				}
				else
				{
					echo "<option value='$rscustomer[custid]'>$rscustomer[custname]</option>";
				}
			}
			?>
		</select>
	</div>
	<div class="col-md-12"><br>
		Any Comments
		<textarea class="form-control" name="comment" id="comment"></textarea>
	</div>
	<div class="col-md-12"><br></div>
</div>
 	  
 
<div class="row panel panel-default">
	<div class="col-md-12"><br></div>
	<div class="col-md-6">
		Product Title  <span id="id_prodid" class="err_msg"></span>
		<select  name="prodid" id="prodid" class="form-control" onchange="load_product_type(this.value)" >
			<option value="">Select Product Title</option>
			<?php
			$sqlproduct = "SELECT * FROM product WHERE status='Active'";
			$qsq1product = mysqli_query($con,$sqlproduct);
			while($rsproduct = mysqli_fetch_array($qsq1product))
			{
				echo "<option value='$rsproduct[prodid]'>$rsproduct[prodname] | ₹$rsproduct[price] | $rsproduct[unit]</option>";
			}
			?>
		</select>
	</div>
	<div class="col-md-6" id="divtypeid"><?php include("jsproducttype.php"); ?></div>
	<div class="col-md-12" >&nbsp;</div>
	<div class="col-md-3">
		Total Quantity  <span id="id_totqty" class="err_msg"></span>
		<input type="number" name="totqty" id="totqty" class="form-control" onchange="load_change_qty(totqty.value,costperqty.value)" onkeyup="load_change_qty(totqty.value,costperqty.value)">
	</div>
	<div class="col-md-3">
		Cost per Quantity	<span id="id_costperqty" class="err_msg"></span>
		<input type="number" name="costperqty" id="costperqty" class="form-control" onchange="load_change_qty(totqty.value,costperqty.value)" onkeyup="load_change_qty(totqty.value,costperqty.value)">
	</div>
	<div class="col-md-3">
		Total Cost <span id="id_totalcost" class="err_msg"></span>
		<input type="number" name="totalcost" id="totalcost" class="form-control" readonly >
	</div>
	<div class="col-md-3">
	<br>
		<input type="button" name="btnsubmit" id="btnsubmit" style="width: 100%;" class="btn btn-info" value="Click to Add" onclick="fun_sub_rec()" >
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
					<th>Total Quantity</th>
					<th>Cost per Quantity</th>
					<th>Total Cost</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th>Grand Total</th>
					<th><input type="hidden" id="grandtotal" name="grandtotal" value="0"><span id="idgrandtotal">0</span></th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
</div>


<div class="row panel panel-default">
	<div class="col-md-12">
		<br>
		<center><input type="submit" name="btnsubmit" id="btnsubmit"  class="btn btn-primary btn-lg" value="Click to Submit" ></center>
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
function load_product_type(prodid)
{
	  $.post("jsproducttype.php",
	  {
		prodid: prodid
	  },
	  function(data){
		$("#divtypeid").html(data);
	  });
}
</script>
<script>
//totqty totqty load_change_qty(totqty.value,costperqty.value) totalcost
function load_change_qty(totqty,costperqty)
{
	$("#totalcost").val($("#totqty").val() * $("#costperqty").val());
}
</script>
<script>
function load_change_product_qty(tblid,totqty,costperqty)
{
	$("#inptotalcost"+tblid).val(totqty * costperqty);
	var sum = 0;
	$(".totprice").each(function(){
		sum += +$(this).val();
	});
	$("#grandtotal").val(sum);
	$("#idgrandtotal").html(sum);
}
</script>
<script>
function delrow(tblid)
{
	$("#tblrow"+tblid).remove();
}
</script>
<script>
function fun_sub_rec()
{
	var protype="";
	var rowCount = $('#tblstockentry tbody tr').length;
	var totamt = $("#totqty").val() * $("#costperqty").val();
	if($("#typeid option:selected").text() == "Select Product Type")
	{
		protype = "NA";
	}
	else
	{
		protype = $("#typeid option:selected").text();
	}
	$("#tblstockentry tbody").append("<tr id='tblrow" + rowCount + "'><td><input type='hidden' name='inpprodid[]' id='inpprodid' value='" + $("#prodid").val() + "' ><input type='hidden' name='inptypeid[]' id='inptypeid' value='" + $("#typeid").val() + "' >" + $("#prodid option:selected").text() + "</td> <td>" + protype + "</td> <td><input type='number' name='inptotqty[]' id='inptotqty" + rowCount + "' value='" + $("#totqty").val() + "' class='form-control'  onchange='load_change_product_qty("+ rowCount +",inptotqty" + rowCount + ".value,inpcostperqty" + rowCount + ".value)'  onkeyup='load_change_product_qty("+ rowCount +",inptotqty" + rowCount + ".value,inpcostperqty" + rowCount + ".value)'  style='width: 100px;' ></td><td><input type='number' name='inpcostperqty[]' id='inpcostperqty" + rowCount + "' value='" + $("#costperqty").val() + "'  class='form-control' onchange='load_change_product_qty("+ rowCount +",inptotqty" + rowCount + ".value,inpcostperqty" + rowCount + ".value)'  onkeyup='load_change_product_qty("+ rowCount +",inptotqty" + rowCount + ".value,inpcostperqty" + rowCount + ".value)' style='width: 150px;' ></td><td><input type='number' name='inptotalcost[]' id='inptotalcost" + rowCount + "' value='" + totamt + "' style='width: 150px;' class='form-control totprice' readonly  >" + "</td><td><input type='button' class='btn btn-danger' value='X' onclick='delrow(" + rowCount + ")'  ></td> </tr>");
	$("#prodid").val('');
	$("#typeid").val('');
	$("#totqty").val('');
	$("#costperqty").val('');
	$("#totalcost").val('');
	var sum = 0;
	$(".totprice").each(function(){
		sum += +$(this).val();
	});
	$("#grandtotal").val(sum);
	$("#idgrandtotal").html(sum);
}
</script>            totqty costperqty totalcost
<script>       
function validateform()
{
	/*
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
	if($("#bill_no").val() == "")
	{
		$('#id_bill_no').html("Bill number should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#purchdate").val() == "")
	{
		$('#id_purchdate').html("Purchase date should not be empty...");
		validate = "false";
	} 
	//###############################################
	if($("#city_id").val() == "")
	{
		$('#id_city_id').html("Kindly select the city...");
		validate = "false";
	}
	//###############################################
	if($("#custid").val() == "")
	{
		$('#id_custid').html("Kindly select the seller...");
		validate = "false";
	}
	//###############################################
	if($("#prodid").val() == "")
	{
		$('#id_prodid').html("Kindly select the product title...");
		validate = "false";
	}
	//###############################################
	if($("#totqty").val() == "")
	{
		$('#id_totqty').html("Total quantity should not be empty...");
		validate = "false";
	} 
	//###############################################
	if($("#costperqty").val() == "")
	{
		$('#id_costperqty').html("Cost per quantity should not be empty...");
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
	*/
}
</script>
	