<?php
include("header.php");
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View Order Report </h3>							  

<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>Bill No.</th>
					<th>Purchase Date</th>					
					<th>Seller</th>
					<th>City</th>
					<th style='text-align: right;'>Total Amount</th>
					<th>No. of Products</th>
					<th>Delivery Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqlbilling= "SELECT * FROM `billing` LEFT JOIN customer ON customer.custid=billing.custid LEFT JOIN city ON city.city_id=billing.city_id LEFT JOIN staff ON staff.staffid=billing.staffid WHERE billing.entry_type='Invoice'";
			if(isset($_SESSION['custid']))
			{
				$sqlbilling = $sqlbilling . " AND billing.custid='$_SESSION[custid]'";
			}
			//echo $sqlbilling;
			$qsqlbilling= mysqli_query($con,$sqlbilling);
			while($rsbilling= mysqli_fetch_array($qsqlbilling))
			{
				$sqlpurchqty = "SELECT * FROM purchase WHERE bilid='$rsbilling[0]'";
				$qsqlpurchqty  = mysqli_query($con,$sqlpurchqty);
				echo "<tr>
					<td>$rsbilling[bill_no]</td>
					<td>" . date("d-m-Y",strtotime($rsbilling['purchdate'])) . "</td>
					<td>$rsbilling[custname] - $rsbilling[mob_no]</td>
					<td>" . $rsbilling['city'] . "</td>
					<td style='text-align: right;'>₹$rsbilling[total_amt]</td>
					<td>" . mysqli_num_rows($qsqlpurchqty) . "</td>
					<td>";
					if($rsbilling['delivdate'] == "0000-00-00")
					{
						echo "Pending Delivery";
					}
					else
					{
						echo "Delivered on - <br>" . date("d-m-Y",strtotime($rsbilling['delivdate']));
					}
				echo "</td> 
					<td> 
					<a href='orderreceipt.php?bilid=$rsbilling[0]' class='btn btn-danger' style='color:white;'>View Receipt</a>	
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