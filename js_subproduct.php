<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
if(isset($_POST['jssubmit']))
{
$sqltype = "SELECT * FROM type WHERE prodid='$_REQUEST[prodid]' AND typeid='$_REQUEST[typeid]' AND status='Active' ORDER BY cost";
}
else
{
$sqltype = "SELECT * FROM type WHERE prodid='$_REQUEST[prodid]' AND typeid='$_GET[typeid]' AND status='Active' ORDER BY cost";
}
$qsqltype = mysqli_query($con,$sqltype);
$rstype = mysqli_fetch_array($qsqltype);
?>		
<div class="snipcart-thumb agileinfo_single_right_snipcart">
<h2 class="m-sing table table-bordered" style="padding: 10px;width: 75%;font-family: 'Open Sans';">Cost - ₹<?php if($rstype['discount'] == 0)
	{
		echo intval($rstype['cost']); 
	}
	else
	{
		echo intval($rstype['cost'] - ($rstype['cost']*$rstype['discount']/100));
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<strike>₹ " . intval($rstype['cost']) . "</strike> ";
		echo intval($rstype['discount']) ." % Off";
	}
	?></h2>
</div>
<div class="snipcart-details agileinfo_single_right_details">
	<fieldset>
		<input type="button" name="submit" value="Add to cart" class="button" onclick="add_to_cart()">
	</fieldset>
</div>