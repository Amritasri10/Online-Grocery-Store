<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
include("dbconnection.php");
?>
<div class="col-lg-6">
	<select class="form-control" name="sub_category_id<?php 
	if(isset($_POST['category_id']))
	{
	echo $_POST['category_id']; 
	}
	else
	{
	echo $rscategory['category_id'];
	}
	?>" id="sub_category_id<?php 
	if(isset($_POST['category_id']))
	{
	echo $_POST['category_id']; 
	}
	else
	{
	echo $rscategory['category_id'];
	}
	?>">
		<option value="">Select Sub Category</option>
		<?php
			$sqlsubcategory = "SELECT * FROM category WHERE status='Active' ";
			if(isset($rscategory['category_id']))
			{
			$sqlsubcategory = $sqlsubcategory ." AND sub_category_id='$rscategory[category_id]'";
			}
			if(isset($_POST['category_id']))
			{
			$sqlsubcategory = $sqlsubcategory ." AND sub_category_id='$_POST[category_id]'";
			}
			$qsqlsubcategory = mysqli_query($con,$sqlsubcategory);
			echo mysqli_error($con);
			while($rssubcategory = mysqli_fetch_array($qsqlsubcategory))
			{
				echo "<option value='$rssubcategory[category_id]'>$rssubcategory[category_name]</option>";
			}
		?>
	</select>
</div>
<div class="col-lg-6">
	<button type="button" class="btn btn-info" name="btnselect<?php 
	if(isset($_POST['category_id']))
	{
	echo $_POST['category_id']; 
	}
	else
	{
	echo $rscategory['category_id'];
	}
	?>" value="Search" onclick="fun_load_product_list(<?php 
	if(isset($_POST['category_id']))
	{
	echo $_POST['category_id']; 
	}
	else
	{
	echo $rscategory['category_id'];
	}
	?>,sub_category_id<?php 
	if(isset($_POST['category_id']))
	{
	echo $_POST['category_id']; 
	}
	else
	{
	echo $rscategory['category_id'];
	}
	?>.value)" >Select</button>
</div>