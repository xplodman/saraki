<meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require 'sqlcon.php';
session_start();

	$character = array(" ", "	", "(", ")", "-", "/");
	
	$nickname=$_POST['nickname'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$pros=$_POST['material_matid1'];
	$proscount=count($pros);
	
	$result1 = mysqli_query($sqlcon, "INSERT INTO `pic`.`users` (`idusers`, `username`, `password`, `nickname`, `securitylvl`) VALUES (NULL, '$username', '$password', '$nickname', 'd');"); 
	
	

				}


	if ( $result1 ) 
	{ 
	mysqli_commit($sqlcon);
	
	$maxid = mysqli_query($sqlcon, "SELECT MAX(idusers) FROM users");
	$maxidrow = mysqli_fetch_row($maxid);
	$comma_separated = implode("", $maxidrow);
	$len = count($pros);
	for($x=0 ; $x < $len ; $x++){
	  $result133 = mysqli_query($sqlcon, "INSERT INTO `pic`.`pros_has_users` (`idpros`, `idusers`) VALUES ('$pros[$x]','$comma_separated');");
	}
	mysqli_commit($sqlcon);
	header('Location: ../../users.php?backresult=1');
	$fh = fopen('/tmp/track.txt','a');
	fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
	fclose($fh);
	exit;
	}
	{ 
	header('Location: ../../users.php?backresult=0');
	$fh = fopen('/tmp/track.txt','a');
	fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
	fclose($fh);
	}  
?>
