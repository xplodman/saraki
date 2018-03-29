    <meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
require 'sqlcon.php';
$character = array(" ", "	", "(", ")", "-", "/");
session_start();

$idusers= $_SESSION["idusers"];

$caseid=$_POST['students_stid'];


$len = count($caseid);
for($x=0 ; $x < $len ; $x++){
$result3 = mysqli_query($sqlcon, "UPDATE `pic`.`caseentry` SET `idusers` = '$idusers', `status` = '1' , `createdate` = CURDATE() WHERE `caseentry`.`idcaseentry` = '$caseid[$x]';");
	}	
	}	
	
if ( $result3 ) 
{ 
				mysqli_commit($sqlcon);

header('Location: ../../dataentry.php?backresult=1');
$fh = fopen('/tmp/track.txt','a');
fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
fclose($fh);}
else
{ 
header('Location: ../../dataentry.php?backresult=0');
$fh = fopen('/tmp/track.txt','a');
fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
fclose($fh);
}  
?>
