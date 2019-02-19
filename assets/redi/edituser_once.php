<meta charset="utf-8">

<?php 
require 'sqlcon.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$character = array(" ", "	", "(", ")", "-", "/");

	$idusers=$_GET['idusers'];
	$rest_day=$_POST['rest_day'];
	$am_pm =$_POST['am_pm'];
	$prosid =$_POST['prosid'];

	$result1 = mysqli_query($sqlcon, "INSERT INTO `pic`.`rest_day` (`id`, `rest_day`, `am_pm`, `idusers`, `idpros`) VALUES (NULL, '$rest_day', '$am_pm', '$idusers', '$prosid');");

	$result2 = mysqli_query($sqlcon, "UPDATE `pic`.`users` SET `info_done` = '1' WHERE `users`.`idusers` = '$idusers';");
}

if ( $result1  )
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
