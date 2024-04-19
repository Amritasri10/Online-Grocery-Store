<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
$sqladdress= "SELECT * FROM address LEFT JOIN city ON address.city_id=city.city_id WHERE address.addressid='$_POST[addressid]'";
$qsqladdress= mysqli_query($con,$sqladdress);
echo mysqli_error($con);
$rscustprofile= mysqli_fetch_array($qsqladdress);
?>
<div class="form-group"> 
	<label>Delivery Address</label>
	<div class=""> 
	<textarea type="text" class="form-control" name="address" id="address" placeholder="Enter Delivery Address" readonly><?php echo $rscustprofile['address']; ?></textarea>
	</div>
</div>
<div class="form-group"> 
	<label>Enter City</label>
	<div class=""> <input type="text" class="form-control coupon" name="city" id="city" placeholder="Enter City" readonly value="<?php echo  $rscustprofile['city']; ?>" >
	</div>
</div>
<div class="form-group"> 
	<label>Enter PIN Code</label>
	<div class=""> <input type="text" class="form-control coupon" name="pincode" id="pincode" placeholder="PIN Code"  value="<?php echo  $rscustprofile['pincode']; ?>" readonly>
	</div>
</div>
<div class="form-group"> 
	<label>Mobile Number</label>
	<div class=""> <input type="text" class="form-control coupon" name="mob_no" id="mob_no" placeholder="Enter Mobile Number" value="<?php echo  $rscustprofile['contactno']; ?>" readonly>
	</div>
</div>