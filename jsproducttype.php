<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
?>
Sub Product
<select  name="typeid" id="typeid" class="form-control" >
	<?php
	if(isset($_POST['prodid']))
	{
		$sqltype = "SELECT * FROM type WHERE status='Active' AND prodid='$_POST[prodid]'";
		$qsq1type = mysqli_query($con,$sqltype);
		if(mysqli_num_rows($qsq1type) == 0)
		{
			echo "<option value=''>NA</option>";
		}
		else
		{
			echo "<option value=''>Select Product Type</option>";
			while($rstype = mysqli_fetch_array($qsq1type))
			{
				echo "<option value='$rstype[typeid]'>$rstype[unit] $rstype[color] | Rs. $rstype[cost]</option>";
			}
		}
	}
	?>
</select>