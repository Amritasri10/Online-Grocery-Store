<?php
include("header.php");
if(isset($_POST['submit']))
{
	//Insert Statement Starts here
	$sql="INSERT INTO address(custid , city_id , address, state, pincode, contactno) VALUES('$_SESSION[custid]','$_POST[city_id]','$_POST[address]','$_POST[state]','$_POST[pincode]','$_POST[contactno]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Delivery Address Added successfully');</script>";
		echo "<script>window.location='viewaddress.php';</script>";
	}
	//Insert Statement Ends here
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Address</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Address</h2>
			<div class="login-form-grids" style="width: 100%;">
				<h5>Enter Address</h5>
<form action="" method="post" onsubmit="return validateform()">
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
				Address  <span id="id_address" class="err_msg"></span>
				<textarea name="address" id="address" class="form-control" placeholder="Enter Address"></textarea>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				City  <span id="id_city_id" class="err_msg"></span>
				<select name="city_id" id="city_id" class="form-control">
					<option value="">Select City</option>
					<?php
					$sqlcity = "SELECt * FROM city WHERE status='Active'";
					$qsqlcity = mysqli_query($con,$sqlcity);
					while($rscity = mysqli_fetch_array($qsqlcity))
					{
						if($rsedit['city_id'] == $rscity['city_id'])
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
		</div>
	</div>
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
				PIN Code  <span id="id_pincode" class="err_msg"></span>
				<input type="text" name="pincode" id="pincode" placeholder="Enter PIN code"  class="form-control"  value="<?php echo $rsedit['pincode']; ?>" >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				State  <span id="id_state" class="err_msg"></span>
				<input type="text" name="state" id="state" placeholder="Enter State"  class="form-control"  value="<?php echo $rsedit['state']; ?>" >
			</div>
		</div>
	</div>
	
	
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
			Mobile No.  <span id="id_contactno" class="err_msg"></span>
			<input type="number" name="contactno" id="contactno" placeholder="Enter Mobile No."  class="form-control" value="<?php echo $rsedit['contactno']; ?>" >
			</div>
		</div>
	</div>
	
	<input type="submit" value="Submit" name="submit" id="submit" >
</form>
			</div>
		</div>
	</div>
<!-- //register -->
<?php
include("footer.php");
?>
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
	if($("#address").val() == "")
	{
		$('#id_address').html("Address should not be empty...");
		validate = "false";
	}     
	//###############################################
	if($("#city_id").val() == "")
	{
		$('#id_city_id').html("Kindly select city...");
		validate = "false";
	}
	//###############################################
	if(!$("#pincode").val().match(numericExpression))
	{
		$('#id_pincode').html("Entered pincode is not valid...");
		validate = "false";
	} 
	//###############################################
	if($("#pincode").val() == "")
	{
		$('#id_pincode').html("Pincode should not be empty...");
		validate = "false";
	}     
	//###############################################
	if($("#state").val() == "")
	{
		$('#id_state').html("State should not be empty...");
		validate = "false";
	}    
     //###############################################
	if($("#contactno").val().length != 10)
	{
		$('#id_contactno').html("Entered Mobile Number should contain 10 digits...");
		validate = "false";
	}
	//###############################################
	if(!$("#contactno").val().match(numericExpression))
	{
		$('#id_contactno').html("Entered Mobile Number is not valid...");
		validate = "false";
	} 
	//###############################################
	if($("#contactno").val() == "")
	{
		$('#id_contactno').html("Mobile Number should not be empty...");
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
	