<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM city WHERE city_id='$_GET[delid]'";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('city Record deleted successfully..');</script>";
		echo "<script>window.location='viewcity.php';</script>";
	}
}
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View city </h3>							  

<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>City</th>
					<th>Pincodes</th>
					<th>Description</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqlcity = "SELECT * FROM city";
			$qsqlcity= mysqli_query($con,$sqlcity);
			while($rscity= mysqli_fetch_array($qsqlcity))
			{
				echo "<tr>
					<td>$rscity[city]</td>
					<td>$rscity[pincodes]</td>
					<td>$rscity[description]</td>
					<td>$rscity[status]</td>
					<td>
					<a href='city.php?editid=$rscity[0]' class='btn btn-info'style='color:white;'  >Edit</a>
					<a href='viewcity.php?delid=$rscity[0]' class='btn btn-danger' style='color: black;' onclick='return confirmdelete()'>Delete</a>					
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