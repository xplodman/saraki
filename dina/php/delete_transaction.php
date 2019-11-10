<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<!--<table>-->
<!--    --><?php
//    foreach ($_POST as $key => $value) {
//        echo "<tr>";
//        echo "<td>";
//        echo $key;
//        echo "</td>";
//        echo "<td>";
//        if (is_array($value)){
//            print_r($value);
//        }else{
//            echo $value;
//        }
//        echo "</td>";
//        echo "</tr>";
//    }
//    exit;
//    ?>
<!--</table>-->

<?php
include_once "connection.php";

$group_id=mysqli_real_escape_string($con, $_GET['group_id']);
$user_id=mysqli_real_escape_string($con, $_GET['user_id']);
$pros_id=mysqli_real_escape_string($con, $_GET['pros_id']);
$issue_id=mysqli_real_escape_string($con, $_GET['issue_id']);

$delete_transaction= mysqli_query($con, "DELETE FROM `user_has_issue_in_group_at_pros` WHERE `user_has_issue_in_group_at_pros`.`user_user_id` = '$user_id' AND `user_has_issue_in_group_at_pros`.`issue_issue_id` = '$issue_id' AND `user_has_issue_in_group_at_pros`.`pros_pros_id` = '$pros_id' AND `user_has_issue_in_group_at_pros`.`group_group_id` = '$group_id';
");

if ($delete_transaction) {
    mysqli_commit($con);
    header('Location: ../transaction.php?backresult=1');
    exit;
}else{
    header('Location: ../transaction.php?backresult=0');
    exit;//if ($insert_case){
}


//
//    $max_investigation_id = mysqli_query($con, "SELECT MAX(id_case_has_investigation) FROM `case_has_investigation`");
//    $max_investigation_id = mysqli_fetch_row($max_investigation_id);
//    $max_investigation_id = implode("", $max_investigation_id);
//    $max_investigation_id = $max_investigation_id+1;
//
//    $insert_investigation = mysqli_query($con, "INSERT INTO `case_has_investigation` (`id_case_has_investigation`, `investigation_number`, `investigation_year`, `case_id`, `case_status_idcase_status`, `users_id`, `prosecutor_id`, `createdate`, `updatedate`, `status`, `deleted`) VALUES ('$max_investigation_id', '$investigation_number', '$investigation_year', '$max_case_id', '$case_status', '$user_id', '$prosecutor', CURRENT_TIMESTAMP, NULL, '1', '0');");
//
//    if ($insert_investigation){
//        $max_case_has_investigation_has_charges_id = mysqli_query($con, "SELECT Max(case_has_investigation_has_charges.case_has_investigation_has_charges_id) AS Max_case_has_investigation_has_charges_id FROM case_has_investigation_has_charges");
//        $max_case_has_investigation_has_charges_id = mysqli_fetch_row($max_case_has_investigation_has_charges_id);
//        $max_case_has_investigation_has_charges_id = implode("", $max_case_has_investigation_has_charges_id);
//        $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;
//
//        $len_charges =  count($charges);
//        for($y=0 ; $y < $len_charges ; $y++)  // insert into case_has_investigation_has_charges
//        {
//            $insert_charges = mysqli_query($con, "INSERT INTO `case_has_investigation_has_charges` (`case_has_investigation_id_case_has_investigation`, `charges_id_charges`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_charges_id`) VALUES ('$max_investigation_id', '$charges[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_charges_id');");
//
//            $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;
//        }
//
//        $max_case_has_investigation_has_reason_to_done_id = mysqli_query($con, "SELECT Max case_has_investigation_has_reason_to_done.case_has_investigation_has_reason_to_done_id) AS Max_case_has_investigation_has_reason_to_done_id FROM case_has_investigation_has_reason_to_done");
//        $max_case_has_investigation_has_reason_to_done_id = mysqli_fetch_row($max_case_has_investigation_has_reason_to_done_id);
//        $max_case_has_investigation_has_reason_to_done_id = implode("", $max_case_has_investigation_has_reason_to_done_id);
//        $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;
//
//        $len_reason_to_done =  count($reason_to_done);
//        for($y=0 ; $y < $len_reason_to_done ; $y++)  // insert into case_has_investigation_has_charges
//        {
//            $insert_reason_to_done = mysqli_query($con, "INSERT INTO `case_has_investigation_has_reason_to_done` (`case_has_investigation_id_case_has_investigation`, `reason_to_done_id_reason_to_done`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_reason_to_done_id`) VALUES ('$max_investigation_id', '$reason_to_done[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_reason_to_done_id');");
//
//            $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;
//        }
//        mysqli_commit($con);
//        header('Location: ../investigation.php?backresult=1');
//        exit;
//    }else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
//        header('Location: ../investigation.php?backresult=2'); //رقم الحيازة مكرر
//        exit;
//    }
//}else{ // القضية مكررة أو هناك مشكلة في اضافة القضية
//    header('Location: ../investigation.php?backresult=3'); //رقم الحيازة مكرر
//    exit;
//}
?>

