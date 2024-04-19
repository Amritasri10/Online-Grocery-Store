<?php
include("header.php");
if(isset($_SESSION['custid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{ 
	$pwd = md5($_POST['cpassword']);
	$sqlcustomer ="SELECT * FROM customer where email='$_POST[email]' AND cpassword='$pwd' AND status='Active'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsqlcustomer) == 1)
	{
		$rscustomer = mysqli_fetch_array($qsqlcustomer);
		//Staff login session created
		$_SESSION['custid'] = $rscustomer['custid'];
		$sqldelpurchasecart ="DELETE FROM purchase where custid='"  . $_SESSION['custid'] . "' AND purchasestatus='Pending'";
		$qsql = mysqli_query($con,$sqldelpurchasecart);
		echo "<script>alert('Logged in Successfully...');</script>";
		if(isset($_GET['page']))
		{
			echo "<script>window.location='" . $_GET['page'] . "?prodid=" . $_GET['prodid'] . "';</script>";
		}
		else
		{
			echo "<script>window.location='index.php';</script>";
		}
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Login Page</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- login -->
	<div class="login">
		<div class="container">
			<h2>Login</h2>
		
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
				<form method="post" action="">
				<div class="form-group">
					<input type="email" placeholder="Email Address" name="email" id="email" >
					</div>
					<div class="form-group">
					<input type="password" placeholder="Password"  name="cpassword" id="cpassword">
					</div>
					
					<div class="forgot">
						<a href="forgotpassword.php">Forgot Password?</a>
					</div>
					<input type="submit" name="submit" id="submit" value="Login">
				</form>
			</div>
			<h4>For New People</h4>
			<p><a href="register.php">Register Here</a> (Or) go back to <a href="index.php">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
		</div>
	</div>
<!-- //login -->
<?php
include("footer.php");
?>