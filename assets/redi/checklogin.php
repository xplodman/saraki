<meta charset="utf-8">

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require 'sqlcon.php';
	
	if($sqlcon == false){
		exit;
	}
	
	$username=$_POST['username'];
	$password=$_POST['password'];

	$result = mysqli_query($sqlcon, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
	$result2 = mysqli_query($sqlcon, "Select pros.prosname,
	  pros.idpros,
	  users.idusers,
	  users.nickname,
	  users.securitylvl,
	  users.info_done,
	  users.username
	From pros_has_users
	  Inner Join pros On pros.idpros = pros_has_users.idpros
	  Right Join users On pros_has_users.idusers = users.idusers Where users.username ='$username'");
	$row2 = mysqli_fetch_assoc($result2);

		
			if(mysqli_num_rows($result) == 0) {
				header('Location: ../../login.php?backresult=0');
				exit;
			}else{
				if($row2['securitylvl'] == "a"){
					session_start();
					$_SESSION['timestamp'] = time();
					$_SESSION["authenticate"] = "true";
					$_SESSION["prosname"] = $row2['prosname'];
					$_SESSION["prosid"] = $row2['idpros'];
					$_SESSION["nickname"] = $row2['nickname'];
					$_SESSION["securitylvl"] = $row2['securitylvl'];
					$_SESSION["admin_id"] = $row2['idusers'];
					$_SESSION["idusers"] = $row2['idusers'];
					header('Location: ../../adminindex.php');
					exit;
			}elseif($row2['securitylvl'] == "d"){
			if($row2['info_done'] == "0"){
				header('Location: ../../data_entry_info.php?idusers='.$row2[idusers]);
				exit;
			}
			
			$get_mysql_time = mysqli_query($sqlcon, "SELECT TIME_FORMAT(NOW(), '%H%i')");
			$get_mysql_time = mysqli_fetch_row($get_mysql_time);
			$get_mysql_time = implode("", $get_mysql_time);

			if($get_mysql_time < "0830") { 
				header('Location: ../../login.php?backresult=88');
				exit;
			}
			
			
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$ip_range = strrpos($ip_address, '.'); //getting position of the last dot
			$ip_range = substr($ip_address, 0, $ip_range); //getting the characters until that position.
			
		
			
			$maxattendanceid = mysqli_query($sqlcon, "Select Max(`attendance`.attendanceid) From `attendance`");
			$maxattendanceidrow = mysqli_fetch_row($maxattendanceid);
			$maxattendanceid = implode("", $maxattendanceidrow);
			$maxattendanceid=$maxattendanceid+1;
			
			
			$result3 = mysqli_query($sqlcon, "INSERT INTO `pic`.`attendance` (`attendanceid`, `checkindate`, `checkintime`, `checkoutdate`, `checkouttime`, `idusers`, `ip_address`, `ip_address_2`) VALUES ($maxattendanceid, curdate(), curtime(), curdate(), curtime(), $row2[idusers], '$ip_address', '$ip_address')"); 
			mysqli_commit($sqlcon);
			session_start();
			$_SESSION['timestamp'] = time();
			$_SESSION["authenticate"] = "true";
			$_SESSION["prosname"] = $row2['prosname'];
			$_SESSION["prosid"] = $row2['idpros'];
			$_SESSION["nickname"] = $row2['nickname'];
			$_SESSION["securitylvl"] = $row2['securitylvl'];
			$_SESSION["idusers"] = $row2['idusers'];
			header('Location: ../../userindex.php');
			exit;
		}else{
			header('Location: ../../login.php?backresult=7');
			exit;
		};
	};
}
?>
