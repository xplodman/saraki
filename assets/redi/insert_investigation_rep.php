<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$idusers=$_SESSION["idusers"];

$investigation_count=$_POST['investigation_count'];
$investigation_added=$_POST['investigation_added'];
$investigation_scanned=$_POST['investigation_scanned'];
$investigation_pros=$_POST['investigation_pros'];

$investigation_count_20_5=$_POST['investigation_count_20_5'];
$investigation_added_20_5=$_POST['investigation_added_20_5'];
$investigation_scanned_20_5=$_POST['investigation_scanned_20_5'];

$maxid = mysqli_query($sqlcon, "SELECT MAX(investigation_rep_id) FROM investigation_rep");
$maxidrow = mysqli_fetch_row($maxid);
$comma_separated = implode("", $maxidrow);
$comma_separated = $comma_separated+1;

$insert_investigation_rep = mysqli_query($sqlcon, "INSERT INTO `pic`.`investigation_rep` (`investigation_rep_id`, `investigation_count`, `investigation_added`, `investigation_scanned`, `investigation_count_20_5`, `investigation_added_20_5`, `investigation_scanned_20_5`, `users_idusers`, `pros_idpros`, `investigation_rep_date`) VALUES ($comma_separated, $investigation_count, $investigation_added, $investigation_scanned, $investigation_count_20_5, $investigation_added_20_5, $investigation_scanned_20_5, $idusers, $investigation_pros, NOW());");
		
if ($insert_investigation_rep==true){
    header('Location: ../../investigation_rep.php?backresult=1');
    mysqli_commit($sqlcon);
    exit;
}else{
    header('Location: ../../investigation_rep.php?backresult=0');
    exit;
}



?>
