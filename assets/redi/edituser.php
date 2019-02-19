<meta charset="utf-8">

<?php 
require 'sqlcon.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$character = array(" ", "	", "(", ")", "-", "/");

$idusers=$_GET['idusers'];
$pros=$_POST['duallistbox_demo1'];
$nickname=$_POST['nickname'];
$username =$_POST['username'];
$password =$_POST['password'];
$securitylvl =$_POST['securitylvl'];
$am_pm =$_POST['am_pm'];
$in_idpros =$_POST['in_idpros'];
$rest_day =$_POST['rest_day'];

	$national_id =$_POST['national_id'];
	$mob_number =$_POST['mob_number'];
	$notes =$_POST['notes'];
	$address =$_POST['address'];
	$outsource_company_id =$_POST['outsource_company_id'];
	$multi_skills =$_POST['multi_skills'];

	$result1 = mysqli_query($sqlcon, "UPDATE `pic`.`users` SET `username` = '$username', `securitylvl` = '$securitylvl', `password` = '$password', `nickname` = '$nickname', `national_id` = '$national_id', `mob_number` = '$mob_number', `notes` = '$notes', `address` = '$address', `outsource_company_outsource_company_id` = '$outsource_company_id', `am_pm` = '$am_pm', `idpros` = '$in_idpros', `rest_day` = '$rest_day' WHERE `users`.`idusers` = '$idusers';
");

$result2 = mysqli_query($sqlcon, "DELETE FROM pros_has_users WHERE idusers='$idusers';");


$len = count($pros);
for($x=0 ; $x < $len ; $x++){
$result3 = mysqli_query($sqlcon, "INSERT INTO `pros_has_users` (`idpros`, `idusers`) VALUES ('$pros[$x]', '$idusers');
");
	}

	$result232 = mysqli_query($sqlcon, "DELETE FROM users_has_skills WHERE users_idusers='$idusers';");

	$len_skills = count($multi_skills);
	for($y=0 ; $y < $len_skills ; $y++){
		$result323 = mysqli_query($sqlcon, "INSERT INTO `users_has_skills` (`skills_skills_id`, `users_idusers`) VALUES ('$multi_skills[$y]', '$idusers');
");
	}
			}

if ( $result1 || $result2  )
{
mysqli_commit($sqlcon);
header('Location: ../../userprofile.php?backresult=1&idusers='.$idusers);
$fh = fopen('/tmp/track.txt','a');
fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
fclose($fh);
exit;}


else
{
header('Location: ../../userprofile.php?backresult=0&idusers='.$idusers);
$fh = fopen('/tmp/track.txt','a');
fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
fclose($fh);
  exit;

}
?>
