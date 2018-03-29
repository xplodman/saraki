    <meta charset="utf-8">

<?php
require 'sqlcon.php';

$username=$_POST['username'];
$password=$_POST['password'];

$result = mysqli_query($sqlcon, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
$result2 = mysqli_query($sqlcon, "Select pros.prosname,
  pros.idpros,
  users.idusers,
  users.nickname,
  users.securitylvl,
  users.username
From pros_has_users
  Inner Join pros On pros.idpros = pros_has_users.idpros
  Inner Join users On pros_has_users.idusers = users.idusers Where users.username =$username"); 
$row2 = mysqli_fetch_assoc($result2);


if($row2['securitylvl'] == "a")
{
	
}
else
{
	$maxattendanceid = mysqli_query($sqlcon, "Select Max(`attendance`.attendanceid) From `attendance`");
$maxattendanceidrow = mysqli_fetch_row($maxattendanceid);
$maxattendanceid = implode("", $maxattendanceidrow);
$maxattendanceid=$maxattendanceid+1;

$ip_address = $_SERVER['REMOTE_ADDR'];

$result3 = mysqli_query($sqlcon, "INSERT INTO `pic`.`attendance` (`attendanceid`, `checkindate`, `checkintime`, `checkoutdate`, `checkouttime`, `idusers`, `ip_address`) VALUES ($maxattendanceid, curdate(), curtime(), NULL, NULL, $row2[idusers], '$ip_address');");
	mysqli_commit($sqlcon);
};

if(mysqli_num_rows($result) == 0) {

	header('Location: ../../login.php?backresult=0');
	$fh = fopen('/tmp/track.txt','a');
	fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
	fclose($fh);
	}
else
{ 
	if($row2['securitylvl'] == "a")
		{
			header('Location: ../../adminindex.php');
				session_start();
			$_SESSION['timestamp'] = time();
			$_SESSION["authenticate"] = "true";
			$_SESSION["prosname"] = $row2[prosname];
			$_SESSION["prosid"] = $row2[idpros];
			$_SESSION["nickname"] = $row2[nickname];
			$_SESSION["securitylvl"] = $row2[securitylvl];
			$_SESSION["idusers"] = $row2[idusers];
		}else
		{
			header('Location: ../../userindex.php');
				session_start();
			$_SESSION['timestamp'] = time();
			$_SESSION["authenticate"] = "true";
			$_SESSION["prosname"] = $row2[prosname];
			$_SESSION["prosid"] = $row2[idpros];
			$_SESSION["nickname"] = $row2[nickname];
			$_SESSION["securitylvl"] = $row2[securitylvl];
			$_SESSION["idusers"] = $row2[idusers];
		};

}
?>
