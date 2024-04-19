<?php
include("header.php");
if(!isset($_SESSION['staffid']))
{
echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
$sqldel = "DELETE FROM type WHERE typeid='$_GET[delid]'";
$qsqldel = mysqli_query($con,$sqldel);
echo "<script>alert('Sub product Record deleted successfully..');</script>";
echo "<script>window.location='type.php?prodid=$_GET[prodid]';</script>";
}
if(isset($_POST['submit']))
{
	$filename = time() . $_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'],"imgsubproduct/".$filename);
	if(isset($_GET['editid']))
	{
		//Update Statement Starts Here
		$sql="UPDATE type SET color='$_POST[color]',";
		if($_FILES['image']['name'] != "")
		{
		$sql = $sql . "image='$filename',";
		}
		$sql = $sql . "cost='$_POST[cost]', discount='$_POST[discount]', unit='$_POST[unit]',stockstatus='$_POST[stockstatus]', status='$_POST[status]' WHERE typeid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Sub Products updated successfully');</script>";
			echo "<script>window.location='type.php?prodid=$_GET[prodid]';</script>";
		}
		//Update Statement Ends Here
	}
	else
	{
		//Insert Statement Starts here
		$sql="INSERT INTO type(prodid ,  color, image, cost, discount, unit,stockstatus, status) VALUES('$_GET[prodid]','$_POST[color]','$filename','$_POST[cost]','$_POST[discount]','$_POST[unit]','$_POST[stockstatus]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Sub Record added successfully');</script>";
			echo "<script>window.location='type.php?prodid=$_GET[prodid]';</script>";
		}
		//Insert Statement Ends here
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM type where typeid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	if($rsedit['image'] == "")
	{
		$img = "images/default_product_image.png";
	}
	else if(file_exists("imgsubproduct/" . $rsedit['image']))
	{
		$img = "imgsubproduct/" . $rsedit['image'];
	}
	else
	{
		$img = "images/default_product_image.png";
	}
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Sub Products</li>
			</ol>
		</div>
	</div>
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
<center><h3 class="page-header page-header icon-subheading">View Product </h3></center>

<div class="row">
	<div class="col-md-12 col-sm-12">
<table class="table table-striped table-bordered ">
	<thead>
		<tr>
			<th>Product Image</th>
			<th>Cateogry</th>
			<th>Product Name</th>
			<th>Product Cost</th>
			<th>Discount</th>
			<th>Unit</th>
			<th>Stock Status</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sqlproduct = "SELECT product.*,category.catgory_title FROM product LEFT JOIN category ON product.catid=category.catid WHERE product.prodid=$_GET[prodid]";
	$qsqlproduct = mysqli_query($con,$sqlproduct);
	while($rsproduct = mysqli_fetch_array($qsqlproduct))
	{
		$arrimg = unserialize($rsproduct['images']);
		if($arrimg[0] == "")
		{
			$imgname = "images/default_product_image.png";
		}
		else if(file_exists("imgupload/" . $arrimg[0]))
		{
			$imgname = "imgupload/" . $arrimg[0];
		}
		else
		{
			$imgname = "images/default_product_image.png";
		}
		echo "<tr>
			<td><img src='$imgname' style='width: 100px;height: 100px;'></td>
			<td>$rsproduct[catgory_title]</td>
			<td>$rsproduct[prodname]</td>
			<td>₹ $rsproduct[price]</td>
			<td>$rsproduct[discount]%</td>
			<td>$rsproduct[unit]</td>
			<td>$rsproduct[stockstatus]</td>
			<td>$rsproduct[status]</td>
			</tr>";
	}
	?>
	</tbody>
</table>
	</div>
</div>

								</section>

						</div>
	<div class="login-form-grids" style="width: 100%;">
				
			<center><h2>Sub Products</h2></center><hr>
<form action="" method="post" enctype="multipart/form-data" >
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
			Unit
			<input type="text" name="unit" id="unit" placeholder="Unit"  class="form-control" value="<?php echo $rsedit['unit']; ?>"  >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				Color
				<input type="text" name="color" id="color" placeholder="Enter color" class="form-control" value="<?php echo $rsedit['color']; ?>"  >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
Image
<input type="file" name="image" id="image" class="form-control">
<?php
if(isset($_GET['editid']))
{
?>
<img src="<?php echo  $img; ?>" style="width: 50px;height:50px;" >
<?php
}
?>
			</div>
		</div>
	</div>
	
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
			Cost
			<input type="text" name="cost"  id="cost" placeholder="Enter Cost" class="form-control" value="<?php echo $rsedit['cost']; ?>"  >
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
			Discount
			<input type="text" name="discount" id="discount" placeholder="Email ID"  class="form-control" value="<?php echo $rsedit['discount']; ?>"  >
			</div>
		</div>
	</div>
		
	<div class="row" >
		<div class="col-md-6">
			<div class="form-group">
			Stock Status
			<select name="stockstatus" id="stockstatus" class="form-control">
				<option value="">Select Stock Status</option>
				<?php
				$arr = array("Available","Out of Stock");
				foreach($arr as $val)
				{
					if($val == $rsedit['stockstatus'])
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
			<div class="form-group">
			Status
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
	</div>
	<hr>
	<center><input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary" style="width: 250px;" ></center>
</form>
			</div>
			<hr>
			
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<center><h3 class="page-header page-header icon-subheading">View Sub Products </h3></center>	  
<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>Product<br>Image</th>
					<th>Color</th>
					<th style="text-align: right;">Product Cost</th>
					<th>Discount</th>
					<th>Unit</th>
					<th>Stock Status</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqltype = "SELECT * FROM type WHERE prodid='$_GET[prodid]'";
			$qsqltype = mysqli_query($con,$sqltype);
			while($rstype = mysqli_fetch_array($qsqltype))
			{
				$arrimg = $rstype['image'];
				if($arrimg == "")
				{
					$imgname = "images/default_product_image.png";
				}
				else if(file_exists("imgsubproduct/" . $arrimg))
				{
					$imgname = "imgsubproduct/" . $arrimg;
				}
				else
				{
					$imgname = "images/default_product_image.png";
				}
				echo "<tr>
					<td><img src='$imgname' style='width: 50px;height: 50px;'></td>
					<td>$rstype[color]</td>
					<td style='text-align: right;'>₹$rstype[cost]</td>
					<td style='text-align: right;'>$rstype[discount]%</td>
					<td  style='text-align: right;'>$rstype[unit]</td>
					<td>$rstype[stockstatus]</td>
					<td>$rstype[status]</td>
					<td>
					<a href='type.php?editid=$rstype[0]&prodid=$_GET[prodid]' class='btn btn-info' style='color:white;width: 100%;'  >Edit</a>
					<a href='type.php?delid=$rstype[0]&prodid=$_GET[prodid]' class='btn btn-danger' style='color: white;width: 100%;' onclick='return confirmdelete()'>Delete</a>
					</tr>";
			}
			?>
			</tbody>
		</table>
	</div>
</div>
 
								</section>

						</div>
					</div>
		</div>	
	</div>
	<!-- //icons -->
			
		</div>
	</div>
<!-- //register -->
<?php
include("footer.php");
?>
<script>
function confirmdelete()
{
	if(confirm("Are you sure?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>