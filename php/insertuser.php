<?php
include_once "connection.php";

$username=$_POST['username'];
$userappid=$_POST['userappid'];
$userapppw=$_POST['userapppw'];
$prosecutionid=$_POST['prosecutionid'];
$jobid=$_POST['jobid'];
$hardwareid=$_POST['hardwareid'];

$maxuserid = mysqli_query($con, "Select Max(`user`.`userid`) From `user`");
$maxuserid = mysqli_fetch_row($maxuserid);
$maxuserid = implode("", $maxuserid);
$maxuserid =$maxuserid+1;

$query = mysqli_query($con, "INSERT INTO `user`(`userid`, `username`, `userappid`, `userapppw`, `createddate`, `updatedate`, `prosecutionid`, `jobid`) VALUES ('$maxuserid','$username','$userappid','$userapppw',NOW(),NULL,'$prosecutionid','$jobid');")or die(mysqli_error($con));

$hardwareidlen = count($hardwareid);
for($x=0 ; $x < $hardwareidlen ; $x++) {
    $query2 = mysqli_query($con, "INSERT INTO `user_has_hardware`(`userid`, `hardwareid`, `status`, `createddate`, `updatedate`) VALUES ('$maxuserid','$hardwareid[$x]','1',NOW(),NULL);") or die(mysqli_error($con));
}
$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query & $query2) {
mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1');
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