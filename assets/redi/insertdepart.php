<meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require 'sqlcon.php';
session_start();

	$character = array(" ", "	", "(", ")", "-", "/");
	
	$departname=$_POST['departname'];
	$prosid=$_POST['prosid'];
	
	$result1 = mysqli_query($sqlcon, "INSERT INTO `pic`.`departs` (`iddeparts`, `departname`, `pros_idpros`) VALUES (NULL, '$departname', '$prosid');"); 
	
	

				}


	if ( $result1 ) 
	{ 
	mysqli_commit($sqlcon);
	header('Location: ../../pros.php?backresult=1');
	$fh = fopen('/tmp/track.txt','a');
	fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
	fclose($fh);
	exit;
	}
	{ 
	header('Location: ../../pros.php?backresult=0');
	$fh = fopen('/tmp/track.txt','a');
	fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
	fclose($fh);
	}  
?>
