<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM address WHERE addressid ='$_GET[delid]'";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Address Record deleted successfully..');</script>";
		echo "<script>window.location='viewaddress.php';</script>";
	}
}
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View Address </h3>							  
<a href="address.php" class="btn btn-info" style='color: white;'>Add Address</a>
<hr>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>Address</th>
					<th>State</th>
					<th>Pin Code</th>
					<th>City</th>
					<th>Contact No.</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqladdress= "SELECT * FROM address LEFT JOIN city ON address.city_id=city.city_id WHERE address.custid='$_SESSION[custid]'";
			$qsqladdress= mysqli_query($con,$sqladdress);
			echo mysqli_error($con);
			while($rsaddress= mysqli_fetch_array($qsqladdress))
			{
				echo "<tr>
					<td>$rsaddress[address]</td>
					<td>$rsaddress[state]</td>
					<td>$rsaddress[pincode]</td>
					<td>$rsaddress[city]</td>
					<td>$rsaddress[contactno]</td>
					<td>
					<a href='viewaddress.php?delid=$rsaddress[0]' class='btn btn-danger' style='color:green;' onclick='return confirmdelete()'>Delete</a>	
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