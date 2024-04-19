<?php
include("header.php");
if(isset($_SESSION['custid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	if($_GET['editid'])
	{
		//Update Statement Starts here
		$sql="UPDATE customer SET custname='$_POST[custname]',email='$_POST[email]',mob_no='$_POST[mob_no]',status='$_POST[status]' where custid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Seller Profile updated successfully');</script>";
		}
		//Update Statement Ends here
	}
	else
	{
		//Insert Statement Starts here
		$sql="INSERT INTO customer(cust_type,custname,email,mob_no,cpassword,status) VALUES('Seller','$_POST[custname]','$_POST[email]','$_POST[mob_no]','$cpassword','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Seller Entry done successfully');</script>";
			echo "<script>window.location='seller.php';</script>";
		}
		//Insert Statement Ends here
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM customer WHERE custid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Seller</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Seller Entry</h2>
			<div class="login-form-grids">
<form action="" method="post" onsubmit="return validateform()">
	
	<div class="form-group">
		Seller Name   <span id="id_custname" class="err_msg"></span>
		<input type="text" name="custname" id="custname" placeholder="Seller Name." class="form-control" value="<?php echo $rsedit['custname']; ?>" >
	</div>
	
	<div class="form-group">
		Email ID   <span id="id_email" class="err_msg"></span>
		<input type="email" name="email" id="email" placeholder="Seller Email Address"  class="form-control" value="<?php echo $rsedit['email']; ?>" >
	</div>
	
	<div class="form-group">
		Mobile No.   <span id="id_mob_no" class="err_msg"></span>
		<input type="number" name="mob_no" id="mob_no" placeholder="Seller Mobile No."  class="form-control" value="<?php echo $rsedit['mob_no']; ?>" >
	</div>
	
	<div class="form-group">
			Status   <span id="id_status" class="err_msg"></span>
			<select name="status" id="status" class="form-control">
				<option value="">Select Seller Status</option>
				<?php
				$arr = array("Active","Inactive");
				foreach($arr as $val)
				{
					if($val == $rsedit['status'])
					{
					echo "<option value='$val' selected>$val</option>";
					}
					else
					{
					echo "<option value='$val'>$val</option>";
					}
				}
				?>
			</select>
	</div>
	
	
	
	<input type="submit" value="Click Here to Submit" name="submit" id="submit">
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
	if(!$("#custname").val().match(alphaspaceExp))
	{
		$('#id_custname').html("Seller name is not valid...");
		validate = "false";
	}
	//###############################################
	if($("#custname").val() == "")
	{
		$('#id_custname').html("Seller name should not be empty...");
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
	if($("#status").val() == "")
	{
		$('#id_status').html("Kindly select the status...");
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
	