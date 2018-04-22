<meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require 'sqlcon.php';
session_start();
	$idusers=$_SESSION['idusers'];

	$character = array(" ", "	", "(", ")", "-", "/");
	
	$overallprosname=$_POST['overallprosname'];

	$max_overallpros_id = mysqli_query($sqlcon, "SELECT
  Max(overallpros.overallprosid) AS Max_overallprosid
FROM
  overallpros");
	$max_overallpros_id = mysqli_fetch_row($max_overallpros_id);
	$max_overallpros_id = implode("", $max_overallpros_id);
	$max_overallpros_id =$max_overallpros_id+1;

	$result1 = mysqli_query($sqlcon, "INSERT INTO `pic`.`overallpros` (`overallprosid`, `overallprosname`) VALUES ('$max_overallpros_id', '$overallprosname');");

	$result2 = mysqli_query($sqlcon, "INSERT INTO `pic`.`overallpros_has_users` (`overallpros_overallprosid`, `users_idusers`) VALUES ('$max_overallpros_id', '$idusers');");
				}



	if ( $result1 || $result2  )
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
