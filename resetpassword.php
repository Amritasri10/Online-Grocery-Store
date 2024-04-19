<?php
include("header.php");
if(isset($_SESSION['custid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$cpassword = md5($_POST['cpassword']);
	//UPDATE Password Statement Starts here
	$sql="UPDATE customer SET cpassword = '$cpassword' WHERE custid='$_GET[custid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		unset($_SESSION['resettoken']);
		echo "<script>alert('Password updated successfully');</script>";
		echo "<script>window.location='login.php';</script>";
	}
	else
	{
		echo "<script>alert('Failed to update password');</script>";
	}
	//UPDATE Password Statement Ends here
}
if($_GET['resettoken'] == $_SESSION['resettoken'])
{
	$sqlcustomer ="SELECT * FROM customer where custid='$_GET[custid]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	echo mysqli_error($con);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
}
else
{
	echo "<script>alert('Password Reset Token expired..');</script>";
	echo "<script>window.location='index.php';</script>";
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Reset Password</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Reset Password</h2>
			<div class="login-form-grids">
				<h5>Change your Password Here</h5>
<form action="" method="post" onsubmit="return validateform()" >
	
	<div class="form-group">
		Email ID <span id="id_email" class="err_msg"></span>
		<input type="email" name="email" id="email" placeholder="Email Address"  class="form-control" value="<?php echo $rscustomer['email']; ?>" readonly>
	</div>

	<div class="form-group">
		New Password <span id="id_cpassword" class="err_msg"></span>
		<input type="password" name="cpassword" id="cpassword" placeholder="Password" class="form-control">
	</div>
	
	<div class="form-group">
		Confirm Password <span id="id_confirmpassword" class="err_msg"></span>
		<input type="password" name="confirmpassword"  id="confirmpassword" placeholder="Confirm Password" class="form-control">
	</div>
	
	<input type="submit" value="Reset password" name="submit" id="submit">
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
	