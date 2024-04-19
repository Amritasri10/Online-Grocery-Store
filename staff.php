<?php
include("header.php");
if(isset($_SESSION['staffid ']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$pwd = md5($_POST['spassword']);
	if(isset($_GET['editid']))
	{
		//Update Statement Starts Here
		$sql="UPDATE staff SET city_id='$_POST[city_id]', staff_type='$_POST[staff_type]', staffname='$_POST[staffname]', loginid='$_POST[loginid]'";
		if($_POST['spassword'] != "")
		{
		$sql = $sql .", apassword='$pwd'";
		}
		$sql =$sql .", emailid='$_POST[emailid]', contactno='$_POST[contactno]', status='$_POST[status]' WHERE staffid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Staff account updated successfully');</script>";
		}
		//Update Statement Ends Here
	}
	else
	{
		//Insert Statement Starts here
		$sql="INSERT INTO staff(city_id, staff_type, staffname, loginid, apassword, emailid, contactno, status) VALUES('$_POST[city_id]','$_POST[staff_type]','$_POST[staffname]','$_POST[loginid]','$pwd','$_POST[emailid]','$_POST[contactno]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Staff Entry done successfully');</script>";
			echo "<script>window.location='staff.php';</script>";
		}
		//Insert Statement Ends here
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM staff where staffid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Staff</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Staff</h2>
			<div class="login-form-grids" style="width: 100%;">
				<h5>Staff information</h5>
<form action="" method="post" onsubmit="return validateform()">
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
				City <span id="id_city_id" class="err_msg"></span>
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
		<div class="col-md-6">
			<div class="form-group">
				Staff Type <span id="id_staff_type" class="err_msg"></span>
				<select name="staff_type" id="staff_type" class="form-control">
					<option value="">Select Staff Type</option>
					<?php
					$arr = array("Admin","Staff");
					foreach($arr as $val)
					{
						if($val == $rsedit['staff_type'])
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
		</div>
	</div>
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
				Staff Name <span id="id_staffname" class="err_msg"></span>
				<input type="text" name="staffname" id="staffname" placeholder="Staff Name"  class="form-control" value="<?php echo $rsedit['staffname']; ?>" >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				Login ID <span id="id_loginid" class="err_msg"></span>
				<input type="text" name="loginid" id="loginid" placeholder="Login ID"  class="form-control"  value="<?php echo $rsedit['loginid']; ?>" >
			</div>
		</div>
	</div>
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
			Password <span id="id_spassword" class="err_msg"></span>
			<input type="password" name="spassword" id="spassword" placeholder="Password" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
			Confirm Password <span id="id_confirmpassword" class="err_msg"></span>
			<input type="password" name="confirmpassword"  id="confirmpassword" placeholder="Confirm Password" class="form-control">
			</div>
		</div>
	</div>
	
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
			Email ID <span id="id_emailid" class="err_msg"></span>
			<input type="email" name="emailid" id="emailid" placeholder="Email ID"  class="form-control" value="<?php echo $rsedit['emailid']; ?>"  >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
			Mobile No.  <span id="id_contactno" class="err_msg"></span>
			<input type="number" name="contactno" id="contactno" placeholder="Mobile No."  class="form-control" value="<?php echo $rsedit['contactno']; ?>" >
			</div>
		</div>
	</div>    
		 
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
			Status  <span id="id_status" class="err_msg"></span>
			<select name="status" id="status" class="form-control">
				<option value="">Select Status</option>
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
		</div>
		<div class="col-md-6">
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
	if($("#city_id").val() == "")
	{
		$('#id_city_id').html("Kindly select city...");
		validate = "false";
	}
	//###############################################
	if($("#staff_type").val() == "")
	{
		$('#id_staff_type').html("Kindly select staff type...");
		validate = "false";
	}
	//###############################################
	if(!$("#staffname").val().match(alphaspaceExp))
	{
		$('#id_staffname').html("Staff name is not valid...");
		validate = "false";
	}
	//###############################################
	if($("#staffname").val() == "")
	{
		$('#id_staffname').html("Staff name should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#loginid").val() == "")
	{
		$('#id_loginid').html("Login ID should not be empty...");
		validate = "false";
	}     
	//###############################################
	if($("#spassword").val().length < 6)
	{
		$('#id_spassword').html("Password should contain more than 6 characters..");
		validate = "false";
	}  
	//###############################################
	if($("#spassword").val() == "")
	{
		$('#id_spassword').html("Password should not be empty...");
		validate = "false";
	} 
	//###############################################
	if($("#spassword").val() != $("#confirmpassword").val())
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
	if(!$("#emailid").val().match(emailExp))
	{
		$('#id_emailid').html("Entered Email Id is not valid...");
		validate = "false";
	}
	//###############################################
	if($("#emailid").val() == "")
	{
		$('#id_emailid').html("Email ID should not be empty...");
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
	