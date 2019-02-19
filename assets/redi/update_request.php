		<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$idusers=$_SESSION["idusers"];

$request_id=$_GET['request_id'];
$request_status=$_GET['request_status'];

$investigation_update_query = mysqli_query($sqlcon, "UPDATE `pic`.`request` SET `request_status` = '$request_status', `request_done_by` = '$idusers', `request_done_date` = NOW() WHERE `request`.`request_id` = '$request_id';");

header('Location: ../../requests.php?backresult=1');
mysqli_commit($sqlcon);
exit;

?>
