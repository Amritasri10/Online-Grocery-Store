<?php
include("header.php");
if(!isset($_SESSION['custid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$opassword = md5($_POST['opassword']);
	$cpassword = md5($_POST['cpassword']);
	//UPDATE Password Statement Starts here
	$sql="UPDATE customer SET cpassword = '$cpassword' WHERE cpassword='$opassword' AND custid='$_SESSION[custid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated successfully');</script>";
		echo "<script>window.location='customerchangepassword.php';</script>";
	}
	else	
	{
		echo "<script>alert('Failed to update password');</script>";
		echo "<script>window.location='customerchangepassword.php';</script>";
	}
	//UPDATE Password Statement Ends here
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Change customer Password</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Change Password</h2>
			<div class="login-form-grids" style="width: 50%;">
<form action="" method="post"  onsubmit="return validateform()">
	
	<div class="row" >
		<div class="col-md-12">
			<div class="form-group">
			Current Password  <span id="id_opassword" class="err_msg"></span>
			<input type="password" name="opassword" id="opassword" placeholder="Old Password" class="form-control">
			</div>
		</div>
	</div>
	
	
	<div class="row" >
		<div class="col-md-12">
			<div class="form-group">
			New Password  <span id="id_npassword" class="err_msg"></span>
			<input type="password" name="npassword" id="npassword" placeholder="New Password" class="form-control">
			</div>
		</div>
	</div>
	
	
	<div class="row" >
		<div class="col-md-12">
			<div class="form-group">
			Confirm Password   <span id="id_cpassword" class="err_msg"></span>
			<input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" class="form-control">
			</div>
		</div>
	</div>
	
	
		
	<input type="submit" value="Change Password" name="submit" id="submit" >
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
	if($("#opassword").val()== "")
	{
		$('#id_opassword').html("Current Password should not be empty..");
		validate = "false";
	}  
	//###############################################
	if($("#npassword").val().length < 6)
	{
		$('#id_npassword').html("Password should contain more than 6 characters..");
		validate = "false";
	}  
	//###############################################
	if($("#npassword").val() == "")
	{
		$('#id_npassword').html("Password should not be empty...");
		validate = "false";
	} 
	//###############################################
	if($("#npassword").val() != $("#cpassword").val())
	{
		$('#id_cpassword').html("Password and Confirm password not matching...");
		validate = "false";
	}
	//###############################################
	if($("#cpassword").val() == "")
	{
		$('#id_cpassword').html("Confirm password should not be empty...");
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
	