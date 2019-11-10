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
$pros_id= mysqli_real_escape_string($con, $_POST['pros_id']);
$group_id= mysqli_real_escape_string($con, $_POST['group_id']);
$user_id= mysqli_real_escape_string($con, $_POST['user_id']);
$issue_id= mysqli_real_escape_string($con, $_POST['issue_id']);
$date = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date']))->format("Y-m-d");

$old_pros_id= mysqli_real_escape_string($con, $_GET['old_pros_id']);
$old_group_id= mysqli_real_escape_string($con, $_GET['old_group_id']);
$old_user_id= mysqli_real_escape_string($con, $_GET['old_user_id']);
$old_issue_id= mysqli_real_escape_string($con, $_GET['old_issue_id']);

$update_transaction= mysqli_query($con, "UPDATE `user_has_issue_in_group_at_pros` SET `user_user_id` = '$user_id', `issue_issue_id` = '$issue_id', `pros_pros_id` = '$pros_id', `group_group_id` = '$group_id', `date` = '$date' WHERE `user_has_issue_in_group_at_pros`.`user_user_id` = '$old_user_id' AND `user_has_issue_in_group_at_pros`.`issue_issue_id` = '$old_issue_id' AND `user_has_issue_in_group_at_pros`.`pros_pros_id` = '$old_pros_id' AND `user_has_issue_in_group_at_pros`.`group_group_id` = '$old_group_id';
");

if ($update_transaction) {
    mysqli_commit($con);
    header('Location: ../transaction_profile.php?group_id='.$group_id.'&user_id='.$user_id.'&pros_id='.$pros_id.'&issue_id='.$issue_id.'&backresult=1');
    exit;
}else{
    header('Location: ../transaction_profile.php?group_id='.$group_id.'&user_id='.$user_id.'&pros_id='.$pros_id.'&issue_id='.$issue_id.'&backresult=0');
    exit;//if ($insert_case){
}

?>

