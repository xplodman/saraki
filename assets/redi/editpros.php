    <meta charset="utf-8">

<?php 
require 'sqlcon.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$character = array(" ", "	", "(", ")", "-", "/");

$idpros=$_GET['idpros'];
$departs=$_POST['duallistbox_demo1'];
$prosname=$_POST['prosname'];
$overallprosid=$_POST['overallprosid'];

$result1 = mysqli_query($sqlcon, "UPDATE `pic`.`pros` SET `prosname` = '$prosname' , `overallprosid` = '$overallprosid' WHERE `pros`.`idpros` = '$idpros' ;");



$len = count($departs);
for($x=0 ; $x < $len ; $x++){
$result3 = mysqli_query($sqlcon, "UPDATE `pic`.`departs` SET `pros_idpros` = '$idpros' WHERE `departs`.`iddeparts` = '$departs[$x]';");
	}

			}
	
if ( $result1 || $result2  ) 
{ 
mysqli_commit($sqlcon);
header('Location: ../../prosprofile.php?backresult=1&idpros='.$idpros);
$fh = fopen('/tmp/track.txt','a');
fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
fclose($fh);
exit;}
  

else
{ 
header('Location: ../../prosprofile.php?backresult=0&idpros='.$idpros);
$fh = fopen('/tmp/track.txt','a');
fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
fclose($fh);
  exit;

}  
?>
