<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
date_default_timezone_set("Asia/Calcutta");
include("dbconnection.php");
$dtim = date("Y-m-d H:i:s");
if($_POST['postmessage'] != "")
{
	$postmessage = mysqli_real_escape_string($con,$_POST['postmessage']);
	$sqlin = "INSERT INTO message(message_type,sender_id,receiver_id,message_date_time,message,status) values('$_POST[message_type]','$_POST[customer_id]','$_POST[painter_id]','$dtim','$postmessage','Active')";
	$qsql = mysqli_query($con,$sqlin);
	echo mysqli_error($con);
}
$arrmsg = [];
$sqlmessage="SELECT message.*,customer.customer_name,painter.name FROM message left JOIN customer ON customer.customer_id=message.sender_id LEFT JOIN painter ON painter.painter_id=message.receiver_id WHERE message.sender_id='$_POST[customer_id]' AND message.receiver_id='0' AND (message.message_type='Customer2Staff' OR message.message_type='Staff2Customer') ORDER BY message_date_time ASC";
$qsqlmessage = mysqli_query($con,$sqlmessage);
echo mysqli_error($con);
while($rsmessage = mysqli_fetch_array($qsqlmessage))
{
	$arrmsg[] = array("receiver_id"=>$rsmessage['receiver_id'],"message_type"=>$rsmessage['message_type'],"message_dttim"=>date("d-m-Y h:i A", strtotime($rsmessage['message_date_time'])),"message"=>$rsmessage['message'],"customer_name"=>$rsmessage['customer_name'],"staff_name"=>$rsmessage['name']);
	$arrlastid = $rsmessage[0];
}
$arrdata = array("messages"=>$arrmsg,"lastrecid"=>$arrlastid);
echo json_encode($arrdata);
?>