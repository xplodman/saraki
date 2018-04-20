<meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require 'sqlcon.php';
session_start();

	$character = array(" ", "	", "(", ")", "-", "/");
	
	$overallprosname=$_POST['overallprosname'];

	$result1 = mysqli_query($sqlcon, "INSERT INTO `pic`.`overallpros` (`overallprosid`, `overallprosname`) VALUES (NULL, '$overallprosname');");
				}


	if ( $result1 ) 
	{ 
		mysqli_commit($sqlcon);
		header('Location: ../../pros.php?backresult=1');
		exit;
	}
	{
		header('Location: ../../pros.php?backresult=0');
		exit;
	}  
?>
