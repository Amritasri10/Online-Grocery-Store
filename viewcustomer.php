<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM customer WHERE custid='$_GET[delid]'";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('customer Record deleted successfully..');</script>";
		echo "<script>window.location='viewcustomer.php';</script>";
	}
}
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View customer </h3>							  

<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>Customer Name</th>
					<th>Email</th>
					<th>Mobile Number</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqlcustomer= "SELECT * FROM customer WHERE cust_type='Customer'";
			$qsqlcustomer= mysqli_query($con,$sqlcustomer);
			while($rscustomer= mysqli_fetch_array($qsqlcustomer))
			{
				echo "<tr>
					<td>$rscustomer[custname]</td>
					<td>$rscustomer[email]</td>
					<td>$rscustomer[mob_no]</td>
					<td>$rscustomer[status]</td>
					<td>
					<a href='viewcustomer.php?delid=$rscustomer[0]' class='btn btn-danger' style='color:green;' onclick='return confirmdelete()'>Delete</a>	
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