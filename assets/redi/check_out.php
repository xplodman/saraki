<?php

session_start(); //to ensure you are using same session
require 'sqlcon.php';

	$idusers=$_SESSION["idusers"];

	$ip_address_2 = $_SERVER['REMOTE_ADDR'];

	$result3 = mysqli_query($sqlcon, "UPDATE `pic`.`attendance` SET `checkoutdate` = curdate(), `ip_address_2` = '$ip_address_2', `checkouttime` = curtime() WHERE `attendance`.`checkindate` = curdate() AND `attendance`.`idusers` = $idusers;");
	mysqli_commit($sqlcon);

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
header('Location: '.$uri_parts[0].'?backresult=1');
exit();
?>
