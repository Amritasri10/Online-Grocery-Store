<?php
include("header.php");
if(isset($_SESSION['custid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$sqlcustomer ="SELECT * FROM customer where email='$_POST[email]' AND status='Active'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsqlcustomer) == 1)
	{
		$rscustomer = mysqli_fetch_array($qsqlcustomer);
		//##################################
		include('phpmailer.php');
		$_SESSION['resettoken'] = rand();
		$currenturl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')) . "/resetpassword.php?resettoken=".$_SESSION['resettoken']."&custid=".$rscustomer['custid'];
		$subject = "Password reset for SuperMarket Grocery Store";
		$message = "Hello " . $rscustomer['custname'] . ",<br><br>
					We have received a request for changing your password for SuperMarket Grocery Store.<br>
					If you want to change your password, <b><A HREF='$currenturl'>Click here</A>.</b><br>
					Please note that the above link is valid for one use only and expires after 24 hours. Make sure to use the latest link.";
		sendmail($_POST['email'], $rscustomer['custname'] , $subject, $message);
		//##################################
		echo "<script>alert('Password Recovery Mail sent to Registered Mail ID...');</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid Email ID..');</script>";
	}
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Forgot Password</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- login -->
	<div class="login">
		<div class="container">
			<h2>Forgot Password</h2>
		
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
				<form method="post" action="">
					<div class="form-group">
						<input type="email" placeholder="Enter Email Address" name="email" id="email" >
					</div>
					<input type="submit" name="submit" id="submit" value="Click here to Recover Password">
				</form>
			</div>
			<h4>For New Users</h4>
			<p><a href="register.php">Register Here</a> (Or) go back to <a href="index.php">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
		</div>
	</div>
<!-- //login -->
<?php
include("footer.php");
?>