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

$issue_id=mysqli_real_escape_string($con, $_GET['issue_id']);
$issue_name=mysqli_real_escape_string($con, $_POST['issue_name']);

$update_issue= mysqli_query($con, "UPDATE `issue` SET `issue_name` = '$issue_name', `modified_at` = NOW() WHERE `issue`.`issue_id` = '$issue_id';");

if ($update_issue) {
    mysqli_commit($con);
    header('Location: ../issue_profile.php?issue_id='.$issue_id.'&backresult=1'); //رقم الحصر مكرر
    exit;
}else{
    header('Location: ../issue_profile.php?issue_id='.$issue_id.'&backresult=0');
    exit;
}
?>

