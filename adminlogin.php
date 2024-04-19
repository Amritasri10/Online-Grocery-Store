<?php
include("header.php");
//If staff is already logged then it should redirect to Dashboard page
if(isset($_SESSION['staffid']))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_POST['submit']))
{
	$pwd = md5($_POST['apassword']);
	$sqlstaff ="SELECT * FROM staff where loginid='$_POST[loginid]' AND apassword='$pwd' AND status='Active'";
	$qsqlstaff = mysqli_query($con,$sqlstaff);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsqlstaff) == 1)
	{
		$rsstaff = mysqli_fetch_array($qsqlstaff);
		echo "<script>alert('Logged in Successfully...');</script>";
		//Admin login session created
		$_SESSION['staffid'] = $rsstaff['staffid']; 
		echo "<script>window.location='dashboard.php';</script>";
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
				<li class="active">Admin Login Panel</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- login -->
	<div class="login">
		<div class="container">
			<h2>Admin Login Panel</h2>
		
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
<form name="frmadmin" method="post" action="">
	<div class="form-group">
		<input type="text" name="loginid" id="loginid" placeholder="Enter Login ID"  >
	</div>
	<div class="form-group">
		<input type="password" placeholder="Enter Password"  name="apassword" id="apassword" >
	</div>
	<div class="form-group">
		<input type="submit" name="submit" id="submit" value="Login">
	</div>
</form>
			</div>

		</div>
	</div>
<!-- //login -->
<?php
include("footer.php");
?>