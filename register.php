<?php
include("header.php");
if(isset($_SESSION['custid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$cpassword = md5($_POST['cpassword']);
	//Insert Statement Starts here
	$sql="INSERT INTO customer(cust_type,custname,email,mob_no,cpassword,status) VALUES('Customer','$_POST[custname]','$_POST[email]','$_POST[mob_no]','$cpassword','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer Registered successfully');</script>";
		echo "<script>window.location='login.php';</script>";
	}
	//Insert Statement Ends here
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Customer Registration Panel</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Register Here</h2>
			<div class="login-form-grids">
				<h5>profile information</h5>
<form action="" method="post" onsubmit="return validateform()" >
	
	<div class="form-group">
	Customer Name  <span id="id_custname" class="err_msg"></span>
	<input type="text" name="custname" id="custname" placeholder="Customer Name." class="form-control" >
	</div>
	
	<div class="form-group">
	Email ID <span id="id_email" class="err_msg"></span>
	<input type="email" name="email" id="email" placeholder="Email Address"  class="form-control">
	</div>
	
	<div class="form-group">
	Mobile No. <span id="id_mob_no" class="err_msg"></span>
	<input type="number" name="mob_no" id="mob_no" placeholder="Mobile No."  class="form-control">
	</div>
	
	<div class="form-group">
	Password <span id="id_cpassword" class="err_msg"></span>
	<input type="password" name="cpassword" id="cpassword" placeholder="Password" class="form-control">
	</div>
	
	<div class="form-group">
	Confirm Password <span id="id_confirmpassword" class="err_msg"></span>
	<input type="password" name="confirmpassword"  id="confirmpassword" placeholder="Confirm Password" class="form-control">
	</div>
	
	<div class="register-check-box">
		<div class="check">
			<label class="checkbox"><input type="checkbox" name="checkbox" name="condition" id="condition"><i> </i>I accept the terms and conditions</label> 
	</div>
	<input type="submit" value="Register" name="submit" id="submit">
</form>
			</div>
		</div>
	</div><br>
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
	if(!$("#custname").val().match(alphaspaceExp))
	{
		$('#id_custname').html("Customer name is not valid...");
		validate = "false";
	}
	//###############################################
	if($("#custname").val() == "")
	{
		$('#id_custname').html("Customer name should not be empty...");
		validate = "false";
	}
	//###############################################
	if(!$("#email").val().match(emailExp))
	{
		$('#id_email').html("Entered Email Id is not valid...");
		validate = "false";
	}
	//###############################################
	if($("#email").val() == "")
	{
		$('#id_email').html("Email ID should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#mob_no").val().length != 10)
	{
		$('#id_mob_no').html("Entered Mobile Number should contain 10 digits...");
		validate = "false";
	}
	//###############################################
	if(!$("#mob_no").val().match(numericExpression))
	{
		$('#id_mob_no').html("Entered Mobile Number is not valid...");
		validate = "false";
	} 
	//###############################################
	if($("#mob_no").val() == "")
	{
		$('#id_mob_no').html("Mobile Number should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#cpassword").val().length < 6)
	{
		$('#id_cpassword').html("Password should contain more than 6 characters..");
		validate = "false";
	}  
	//###############################################
	if($("#cpassword").val() == "")
	{
		$('#id_cpassword').html("Password should not be empty...");
		validate = "false";
	} 
	//###############################################
	if($("#cpassword").val() != $("#confirmpassword").val())
	{
		$('#id_confirmpassword').html("Password and Confirm password not matching...");
		validate = "false";
	}
	//###############################################
	if($("#confirmpassword").val() == "")
	{
		$('#id_confirmpassword').html("Confirm password should not be empty...");
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
	