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

$result2 = mysqli_query($sqlcon, "DELETE FROM pros_has_users WHERE idusers='$idusers';");


$len = count($pros);
for($x=0 ; $x < $len ; $x++){
$result3 = mysqli_query($sqlcon, "INSERT INTO `pic`.`pros_has_users` (`idpros`, `idusers`) VALUES ('$pros[$x]', '$idusers');
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
