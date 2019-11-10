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
$group_name=mysqli_real_escape_string($con, $_POST['group_name']);

$update_group= mysqli_query($con, "UPDATE `group` SET `group_name` = '$group_name', `modified_at` = NOW() WHERE `group`.`group_id` = '$group_id';");

if ($update_group) {
    mysqli_commit($con);
    header('Location: ../group_profile.php?group_id='.$group_id.'&backresult=1'); //رقم الحصر مكرر
    exit;
}else{
    header('Location: ../group_profile.php?group_id='.$group_id.'&backresult=0');
    exit;
}
?>

