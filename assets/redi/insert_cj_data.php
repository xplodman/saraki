<meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	require 'sqlcon.php';
	session_start();
	$Prosecution_radio = $_POST['Prosecution_radio'];
	if ($Prosecution_radio == '1'){
		
		$nickname=$_POST['nickname'];
		$job=$_POST['job'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$national_id=$_POST['national_id'];
		$pros=$_POST['pros'];

		$result1 = mysqli_query($sqlcon, "INSERT INTO `pic`.`cj_data` (`id`, `name`, `job`, `username`, `password`, `pros_idpros`, `pros_type`, `national_id`) VALUES (NULL, '$nickname', '$job', '$username', '$password', '$pros', '$Prosecution_radio', '$national_id');")or die(mysqli_error($sqlcon));
		
	}elseif($Prosecution_radio == '2'){
		
		$nickname=$_POST['nickname'];
		$job=$_POST['job'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$over_all_pros=$_POST['over_all_pros'];

		$result1 = mysqli_query($sqlcon, "INSERT INTO `pic`.`cj_data` (`id`, `name`, `job`, `username`, `password`, `overallpros_overallprosid`, `pros_type`, `national_id`) VALUES (NULL, '$nickname', '$job', '$username', '$password', '$over_all_pros', '$Prosecution_radio', '$national_id');")or die(mysqli_error($sqlcon));
		
	}
}
if ( $result1 )
{
	mysqli_commit($sqlcon);
	header('Location: ../../cj_data.php?backresult=1');
	exit;
}
{
	header('Location: ../../cj_data.php?backresult=0');
	exit;
}

?>
