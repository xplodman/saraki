<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$vacation = '1';
$early_excuse = '2';
$late_excuse = '3';
if ($_POST['request_type']=='vacation'){


    $idusers=$_SESSION["idusers"];

    $vacation_from=$_POST['vacation_from'];
    $vacation_to=$_POST['vacation_to'];
    $vacation_reason=$_POST['vacation_reason'];

    $insert_vacation = mysqli_query($sqlcon, "INSERT INTO `pic`.`request` (`request_id`, `request_type`, `request_from`, `request_to`, `request_reason`, `request_status`, `users_idusers`, `request_done_by`, `request_date`, `request_done_date`) VALUES (NULL, '$vacation', '$vacation_from', '$vacation_to', '$vacation_reason', '0', '$idusers', NULL, NOW(), NULL);")or die(mysqli_error($sqlcon));


    header('Location: ../../requests.php?backresult=1');
    mysqli_commit($sqlcon);
    exit;

}
elseif ($_POST['request_type']=='excuses'){


    $idusers=$_SESSION["idusers"];

    $excuses_date=$_POST['excuses_date'];
    $excuses_reason=$_POST['excuses_reason'];
    $excuses_type=$_POST['excuses_type'];
    if ($excuses_type=='1'){
        $excuses_type = $early_excuse;
    }else{
        $excuses_type = $late_excuse;
    }

    $insert_excuses = mysqli_query($sqlcon, "INSERT INTO `pic`.`request` (`request_id`, `request_type`, `request_from`, `request_to`, `request_reason`, `request_status`, `users_idusers`, `request_done_by`, `request_date`, `request_done_date`) VALUES (NULL, '$excuses_type', '$excuses_date', '$excuses_date', '$excuses_reason', '0', '$idusers', NULL, NOW(), NULL);")or die(mysqli_error($sqlcon));


    header('Location: ../../requests.php?backresult=1');
    mysqli_commit($sqlcon);
    exit;
}


?>
