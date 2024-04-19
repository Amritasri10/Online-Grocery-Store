<?php
include("header.php");
if(!isset($_SESSION['staffid']))
{
    echo "<script>window.location='stafflogin.php';</script>";  
}
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM product WHERE prodid='$_GET[delid]'";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('product Record deleted successfully..');</script>";
		echo "<script>window.location='viewproduct.php';</script>";
	}
}
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View Product </h3>							  
 
<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
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
					<th>Sub Products</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqlproduct = "SELECT product.*,category.catgory_title, product.status as prodstatus FROM product LEFT JOIN category ON product.catid=category.catid";
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
					<td>$rsproduct[prodstatus]</td>
					<td style='text-align: center;'>";
				echo "<a href='type.php?prodid=$rsproduct[prodid]' class='btn btn-primary' style='color: white;width: 100%;' >Add <br>Sub Products</a>";
$sqlsubproducts = "SELECT * FROM type WHERE prodid='$rsproduct[0]'";
$qsqlsubproducts= mysqli_query($con,$sqlsubproducts);
echo "( " . mysqli_num_rows($qsqlsubproducts) . " Products)";
				echo "</td>
					<td>
					<a href='product.php?editid=$rsproduct[0]' class='btn btn-info' style='color:white;width: 100%;'  >Edit</a>
					<a href='viewproduct.php?delid=$rsproduct[0]' class='btn btn-danger' style='color: white;width: 100%;' onclick='return confirmdelete()'>Delete</a>
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