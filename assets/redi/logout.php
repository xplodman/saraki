<?php

session_start(); //to ensure you are using same session
require 'sqlcon.php';
if($prosid=$_SESSION['securitylvl'] == "a")
{

}
else
{
	$idusers=$_SESSION["idusers"];

	$ip_address_2 = $_SERVER['REMOTE_ADDR'];

	$result3 = mysqli_query($sqlcon, "UPDATE `pic`.`attendance` SET `checkoutdate` = curdate(), `ip_address_2` = '$ip_address_2', `checkouttime` = curtime() WHERE `attendance`.`checkindate` = curdate() AND `attendance`.`idusers` = $idusers;");
	mysqli_commit($sqlcon);
};


session_destroy(); //destroy the session
header("Location: ../../login.php"); //to redirect back to "index.php" after logging out
exit();
?>
