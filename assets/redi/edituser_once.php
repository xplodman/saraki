<meta charset="utf-8">

<?php 
require 'sqlcon.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$character = array(" ", "	", "(", ")", "-", "/");

	$idusers=$_GET['idusers'];
	
	$query = "UPDATE `pic`.`users` SET `info_done` = '1'";
	
	if (!empty($_POST['nickname'])) {
    $nickname = $_POST['nickname'];
	$query .=",`nickname` = '$nickname'";
	}
	if (!empty($_POST['national_id'])) {
    $national_id = $_POST['national_id'];
	$query .=",`national_id` = '$national_id'";
	}
	if (!empty($_POST['mob_number'])) {
    $mob_number = $_POST['mob_number'];
	$query .=",`mob_number` = '$mob_number'";
	}
	if (!empty($_POST['notes'])) {
    $notes = $_POST['notes'];
	$query .=",`notes` = '$notes'";
	}
	if (!empty($_POST['address'])) {
    $address = $_POST['address'];
	$query .=",`address` = '$address'";
	}
	if (!empty($_POST['outsource_company_id'])) {
    $outsource_company_id = $_POST['outsource_company_id'];
	$query .=",`outsource_company_outsource_company_id` = '$outsource_company_id'";
	}
	if (!empty($_POST['am_pm'])) {
    $am_pm = $_POST['am_pm'];
	$query .=",`am_pm` = '$am_pm'";
	}
	if (!empty($_POST['rest_day'])) {
    $rest_day = $_POST['rest_day'];
	$query .=",`rest_day` = '$rest_day'";
	}

	
	$query .="WHERE `users`.`idusers` = '$idusers';";

	$result2 = mysqli_query($sqlcon, $query);
}

if ( $result2  )
{
mysqli_commit($sqlcon);
header('Location: ../../login.php');
exit;}


else
{
header('Location: ../../data_entry_info.php?backresult=0&idusers='.$idusers);

  exit;

}
?>
