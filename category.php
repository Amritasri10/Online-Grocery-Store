<?php
include("header.php");
if(!isset($_SESSION['staffid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		//Update Statement Starts Here
		$sql="UPDATE category SET sub_catid='$_POST[sub_catid]',catgory_title='$_POST[catgory_title]',description='$_POST[description]',status='$_POST[status]' WHERE  catid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Category Record updated successfully');</script>";
		}
		//Update Statement Ends Here
	}
	else
	{
		//Insert Statement Starts here
		$sql="INSERT INTO category(sub_catid,catgory_title,description,status) VALUES('$_POST[sub_catid]','$_POST[catgory_title]','$_POST[description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Category Record inserted successfully');</script>";
			echo "<script>window.location='category.php';</script>";
		}
		//Insert Statement Ends here
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM category where catid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	echo mysqli_num_rows($qsqledit);
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Category</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Category</h2>
			<div class="login-form-grids">
				<h5>Enter Category information</h5>
<form action="" method="post" onsubmit="return validateform()" >
	
	<div class="form-group">
		Main Category  <span id="id_sub_catid" class="err_msg"></span>
		<select name="sub_catid" id="sub_catid" class="form-control">
			<option value="">Select Main Category</option>
			<?php
			$sqlcat = "SELECT * FROM category WHERE status='Active' AND sub_catid='0'";
			$qsqlcat = mysqli_query($con,$sqlcat);
			while($rscat = mysqli_fetch_array($qsqlcat))
			{
				if($rscat['catid'] == $rsedit['sub_catid'])
				{
					echo "<option value='$rscat[catid]' selected>$rscat[catgory_title]</option>";
				}
				else
				{
					echo "<option value='$rscat[catid]'>$rscat[catgory_title]</option>";
				}
			}
			?>
		</select>
	</div>
		
	<div class="form-group">
		Category Title  <span id="id_catgory_title" class="err_msg"></span>
		<input type="text" name="catgory_title" id="catgory_title" placeholder="Enter Category title" class="form-control" value="<?php echo $rsedit['catgory_title']; ?>" >
	</div>
	
	<div class="form-group">
		Description  <span id="id_description" class="err_msg"></span>
		<textarea name="description" id="description" placeholder="Enter Description" class="form-control" ><?php echo $rsedit['description']; ?></textarea>
	</div>
	
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
	if($("#catgory_title").val() == "")
	{
		$('#id_catgory_title').html("Category title should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#description").val() == "")
	{
		$('#id_description').html("Description should not be empty...");
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
	