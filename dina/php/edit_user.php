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

$user_id=mysqli_real_escape_string($con, $_GET['user_id']);
$user_name=mysqli_real_escape_string($con, $_POST['user_name']);
$user_phone_num=mysqli_real_escape_string($con, $_POST['user_phone_num']);

$update_user= mysqli_query($con, "UPDATE `user` SET `user_name` = '$user_name',`user_phone_num` = '$user_phone_num', `modified_at` = NOW() WHERE `user`.`user_id` = '$user_id';");

if ($update_user) {
    mysqli_commit($con);
    header('Location: ../user_profile.php?user_id='.$user_id.'&backresult=1'); //رقم الحصر مكرر
    exit;
}else{
    header('Location: ../user_profile.php?user_id='.$user_id.'&backresult=0');
    exit;
}
?>

