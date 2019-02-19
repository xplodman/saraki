    <meta charset="utf-8">

<?php 
require 'sqlcon.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$Prosecution_radio = $_POST['Prosecution_radio'];
	if ($Prosecution_radio == '1'){
		
	$cj_data_id=$_GET['cj_data_id'];
	$name=$_POST['name'];
	$job=$_POST['job'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$national_id=$_POST['national_id'];
	$pros=$_POST['pros'];

	$result1 = mysqli_query($sqlcon, "UPDATE `pic`.`cj_data` SET `name` = '$name', `job` = '$job', `username` = '$username', `password` = '$password', `pros_idpros` = '$pros', `national_id` = '$national_id', `pros_type` = '$Prosecution_radio', `overallpros_overallprosid` = NULL WHERE `cj_data`.`id` = '$cj_data_id'");

	}elseif ($Prosecution_radio == '2'){
		
	$cj_data_id=$_GET['cj_data_id'];
	$name=$_POST['name'];
	$job=$_POST['job'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$national_id=$_POST['national_id'];
	$over_all_pros=$_POST['over_all_pros'];

	$result1 = mysqli_query($sqlcon, "UPDATE `pic`.`cj_data` SET `name` = '$name', `job` = '$job', `username` = '$username', `password` = '$password', `national_id` = '$national_id', `overallpros_overallprosid` = '$over_all_pros', `pros_type` = '$Prosecution_radio' , `pros_idpros` = NULL WHERE `cj_data`.`id` = '$cj_data_id'");

	}

if ( $result1 ) 
{ 
mysqli_commit($sqlcon);
header('Location: ../../cj_data_profile.php?backresult=1&cj_data_id='.$cj_data_id);
exit;
}
  

else
{ 
header('Location: ../../cj_data_profile.php?backresult=0&cj_data_id='.$cj_data_id);
exit;

}  
}
?>
