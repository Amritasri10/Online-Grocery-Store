<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM category WHERE catid='$_GET[delid]'";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('category Record deleted successfully..');</script>";
		echo "<script>window.location='viewcategory.php';</script>";
	}
}
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View category </h3>							  

<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>Catgory title</th>
					<th>Description</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqlcategory = "SELECT a.*,b.catgory_title as maincat FROM category as a LEFT JOIN category  as b ON b.catid=a.sub_catid";
			$qsqlcategory= mysqli_query($con,$sqlcategory);
			while($rscategory= mysqli_fetch_array($qsqlcategory))
			{
				echo "<tr>
					<td>";
					if($rscategory['sub_catid'] != 0)
					{
					echo "<b>" . $rscategory['maincat'] . "</b> - ";
					}
				echo $rscategory['catgory_title'];
				echo "</td>
					<td>$rscategory[description]</td>
					<td>$rscategory[status]</td>
					<td>
					<a href='category.php?editid=$rscategory[0]' class='btn btn-info'style='color:white;'  >Edit</a>
					<a href='viewcategory.php?delid=$rscategory[0]' class='btn btn-danger' style='color:pink;' onclick='return confirmdelete()'>Delete</a>				
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