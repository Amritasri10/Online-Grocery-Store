<?php
include("header.php");
if(!isset($_SESSION['custid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	//Insert Statement Starts here
	$sql="UPDATE customer SET custname='$_POST[custname]',email='$_POST[email]',mob_no='$_POST[mob_no]' where custid='" . $_SESSION['custid'] . "'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer Profile updated successfully');</script>";
		echo "<script>window.location='customerprofile.php';</script>";
	}
	//Insert Statement Ends here
}
if(isset($_SESSION['custid']))
{
	$sqlcustomer ="SELECT * FROM customer where custid='" . $_SESSION['custid'] . "' ";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	echo mysqli_error($con);
	$rscustomer  = mysqli_fetch_array($qsqlcustomer);
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Customer Profile</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>My Profile</h2>
			<div class="login-form-grids">
				<h5>profile information</h5>
<form action="" method="post">
	
	<div class="form-group">
	Customer Name
	<input type="text" name="custname" id="custname" placeholder="Customer Name." class="form-control" value="<?php echo $rscustomer['custname']; ?>" >
	</div>
	
	<div class="form-group">
	Email ID
	<input type="email" name="email" id="email" placeholder="Email Address"  class="form-control" value="<?php echo $rscustomer['email']; ?>" >
	</div>
	
	<div class="form-group">
	Mobile No.
	<input type="number" name="mob_no" id="mob_no" placeholder="Mobile No."  class="form-control" value="<?php echo $rscustomer['mob_no']; ?>" >
	</div>
	
	
	<input type="submit" value="Update Profile" name="submit" id="submit">
</form>
			</div>
		</div>
	</div>
<!-- //register -->
<?php
include("footer.php");
?>