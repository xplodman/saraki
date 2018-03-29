<?php
include_once "connection.php";

$prosecutionid=$_GET['prosecutionid'];
$prosecutionname=$_POST['prosecutionname'];


$query = mysqli_query($con, "UPDATE `prosecution` SET `prosecutionname`='$prosecutionname',`updatedate`=now() WHERE `prosecution`.`prosecutionid` = $prosecutionid;
")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
    mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1&prosecutionid='.$prosecutionid.'');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;}
?>