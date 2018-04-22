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

$result1 = mysqli_query($sqlcon, "UPDATE `pic`.`users` SET `username` = '$username', `securitylvl` = '$securitylvl', `password` = '$password', `nickname` = '$nickname' WHERE `users`.`idusers` = '$idusers';
");

$result2 = mysqli_query($sqlcon, "DELETE FROM overallpros_has_users WHERE users_idusers='$idusers';");

$len = count($pros);
for($x=0 ; $x < $len ; $x++){
$result3 = mysqli_query($sqlcon, "INSERT INTO overallpros_has_users (`overallpros_overallprosid`, `users_idusers`) VALUES ('$pros[$x]', '$idusers');
");
	}
			}
	
if ( $result1 || $result2  ) 
{ 
mysqli_commit($sqlcon);
header('Location: ../../adminprofile.php?backresult=1&idusers='.$idusers);
exit;}
  

else
{ 
header('Location: ../../adminprofile.php?backresult=0&idusers='.$idusers);
  exit;

}  
?>
