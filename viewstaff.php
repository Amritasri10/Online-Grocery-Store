<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM staff WHERE staffid='$_GET[delid]'";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Staff Record deleted successfully..');</script>";
		echo "<script>window.location='viewstaff.php';</script>";
	}
}
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View staff </h3>							  

<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>City</th>
					<th>Staff Type</th>
					<th>Staff Name</th>
					<th>Login ID</th>
					<th>Email ID</th>
					<th>Contact Number</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqlstaff= "SELECT staff.*,city.city FROM staff LEFT JOIN city ON staff.city_id=city.city_id";
			$qsqlstaff= mysqli_query($con,$sqlstaff);
			while($rsstaff= mysqli_fetch_array($qsqlstaff))
			{
				echo "<tr>
					<td>$rsstaff[city]</td>
					<td>$rsstaff[staff_type]</td>
					<td>$rsstaff[staffname]</td>
					<td>$rsstaff[loginid]</td>
					<td>$rsstaff[emailid]</td>
					<td>$rsstaff[contactno]</td>
					<td>$rsstaff[status]</td>
					<td>
					<a href='staff.php?editid=$rsstaff[0]' class='btn btn-info'style='color:white;'>Edit</a>					 
					<a href='viewstaff.php?delid=$rsstaff[0]' class='btn btn-danger' style='color: yellow;' onclick='return confirmdelete()'>Delete</a>
					</td>
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