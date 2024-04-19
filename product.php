<?php
include("header.php");
if(!isset($_SESSION['staffid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$filecount = count($_FILES['file']['name']);
	if($filecount >= 1)
	{
		for($x=0; $x<$filecount;$x++)
		{
			$filename = time() . $_FILES['file']['name'][$x];
			$arrfile[] = $filename;
			move_uploaded_file($_FILES['file']['tmp_name'][$x],"imgupload/".$filename);
		}
	}
	$arrserialfile = serialize($arrfile);
	$prodspec = mysqli_real_escape_string($con,$_POST['prodspecif']);
	if(isset($_GET['editid']))
	{
		//Update Statement Starts Here
		$sql="UPDATE product SET catid='$_POST[catid]',prodname='$_POST[prodname]',price='$_POST[price]',discount='$_POST[discount]',unit='$_POST[unit]',stockstatus='$_POST[stockstatus]',prodspecif='$prodspec'";
		if($_FILES['file']['name'][0] != "")
		{
		$sql = $sql . ",images='$arrserialfile'";
		}
		$sql = $sql . ",status='$_POST[status]' WHERE prodid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Product updated successfully');</script>"; 
		}
		//Update Statement Ends Here
	}
	else
	{
		//Insert Statement Starts here
		$sql="INSERT INTO product(catid,prodname ,price,discount,unit,stockstatus,prodspecif,images,status) VALUES('$_POST[catid]','$_POST[prodname]','$_POST[price]','$_POST[discount]','$_POST[unit]','$_POST[stockstatus]','" . nl2br($prodspec) . "','$arrserialfile','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Product Record Inserted successfully..');</script>"; 
			echo "<script>window.location='product.php';</script>";
		}
		//Insert Statement Ends here
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM product where prodid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	echo mysqli_num_rows($qsqledit);
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT  * FROM product where prodid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
<style>
/* The heart of the matter */
.img-group > .row {
  overflow-x: auto;
  white-space: nowrap;
}
.img-group > .row > .col-sm-4 {
  display: inline-block;
  float: none;
}

/* Decorations */
.col-sm-4 { color: #fff; font-size: 48px; padding-bottom: 5px; padding-top: 5px; }
.col-sm-4:nth-child(3n+1) { background: #c69; }
.col-sm-4:nth-child(3n+2) { background: #9c6; }
.col-sm-4:nth-child(3n+3) { background: #69c; }
</style>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Product</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Product</h2>
			<div class="login-form-grids" style="width: 100%;">
				<h5>Enter Product detail</h5>
<form action="" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
<div class="row">	
	<div class="col-md-6">
	
		<div class="form-group">
			Product Name  <span id="id_prodname" class="err_msg"></span>
			<input type="text" name="prodname" id="prodname" placeholder="Enter Product name." class="form-control" value="<?php echo $rsedit['prodname']; ?>" >
		</div>
		
		<div class="form-group">
			Price <span id="id_price" class="err_msg"></span>
			<input type="text" name="price" id="price" placeholder="Enter price." class="form-control"  value="<?php echo $rsedit['price']; ?>" >
		</div>
		<div class="form-group">
			Discount (in Percentage %) 
			<input type="text" name="discount" id="discount" placeholder="Enter discount." class="form-control"   value="<?php echo $rsedit['discount']; ?>" >
		</div>
		<div class="form-group">
			Unit <span id="id_unit" class="err_msg"></span>
			<input type="text" name="unit" id="unit" placeholder="Enter unit." class="form-control" value="<?php echo $rsedit['unit']; ?>" >
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
		Product Category <span id="id_catid" class="err_msg"></span>
		<select name="catid" id="catid" class="form-control">
			<option value="">Select Category</option>
			<?php
			$sqlcategory = "SELECt * FROM category WHERE status='Active' AND sub_catid!='0' ORDER BY catid";
			$qsqlcategory = mysqli_query($con,$sqlcategory);
			while($rscategory = mysqli_fetch_array($qsqlcategory))
			{
				$sqlmaincategory = "SELECt * FROM category WHERE status='Active' AND catid='$rscategory[sub_catid]' ORDER BY catid	";
				$qsqlmaincategory = mysqli_query($con,$sqlmaincategory);
				$rsmaincategory = mysqli_fetch_array($qsqlmaincategory);
				if($rscategory['catid'] == $rsedit['catid'])
				{
					echo "<option value='$rscategory[catid]' selected>$rsmaincategory[catgory_title] -> $rscategory[catgory_title]</option>";
				}
				else
				{
					echo "<option value='$rscategory[catid]'>$rsmaincategory[catgory_title] -> $rscategory[catgory_title]</option>";
				}
			}
			?>
		</select>
		</div>   

		<div class="form-group">
			images  <span id="id_file" class="err_msg"></span>
			<input type="file" name="file[]" id="file"  class="form-control" multiple accept="image/*">
		</div>
				
<div class="form-group">			
	<div class="img-group">
		<div class="row text-center flex-nowrap">
		<?php
		$arrimg = unserialize($rsedit['images']);
		foreach($arrimg as $img)
		{
		?>
			<div class="col-sm-4"><img src="imgupload/<?php echo $img; ?>" style="width: 125px;height: 125px;cursor: pointer;"  data-toggle="modal" data-target="#imgmodal" onclick="funloadimg('imgupload/<?php echo $img; ?>')" ></div>
		<?php
		}
		?>
		</div>
	</div>
</div>

	</div>
	<div class="col-md-12">
		<div class="form-group">
			Product Specification <span id="id_prodspecif" class="err_msg"></span>
			<textarea name="prodspecif" id="prodspecif" placeholder="Enter Product Specification" class="form-control" style="height: 200px;" ><?php echo str_replace("<br />","", $rsedit['prodspecif']); ?></textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			Stock status  <span id="id_stockstatus" class="err_msg"></span>
			<select name="stockstatus" id="stockstatus" class="form-control"  >
				<option value="">Select Stock Status</option>
				<?php
				$arr = array("Avaiable","Out Of Stock");
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
	<div class="col-md-12">
		<center><input type="submit" value="Submit" name="submit" id="submit" style="width: 25%;"></center>
	</div>
</form>
			</div>
		</div>
	</div>
<!-- //register --><br>
<?php
include("footer.php");
?>
<div class="modal fade" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Image Window</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<img id="imgpreview" src="images/loading.gif" style="width: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function funloadimg(img)
{
	$('#imgpreview').prop('src', img)
}
</script>       prodspecif stockstatus status
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
	if($("#prodname").val() == "")
	{
		$('#id_prodname').html("Product name should not be empty...");
		validate = "false";
	}
	//###############################################
	if(!$("#price").val().match(numericExpression))
	{
		$('#id_price').html("Entered price is not valid...");
		validate = "false";
	} 
	//###############################################
	if($("#price").val() == "")
	{
		$('#id_price').html("Price should not be empty...");
		validate = "false";
	}     
	//###############################################
	//###############################################
	if($("#unit").val() == "")
	{
		$('#id_unit').html("Unit should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#catid").val() == "")
	{
		$('#id_catid').html("Kindly select category...");
		validate = "false";
	}
	//###############################################
	if($("#file").val() == "")
	{
		$('#id_file').html("Kindly select image...");
		validate = "false";
	} 
	//###############################################
	if($("#prodspecif").val() == "")
	{
		$('#id_prodspecif').html("Product specification should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#stockstatus").val() == "")
	{
		$('#id_stockstatus').html("Kindly select the stock status...");
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
	