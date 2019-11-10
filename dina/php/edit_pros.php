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

$pros_id=mysqli_real_escape_string($con, $_GET['pros_id']);
$pros_name=mysqli_real_escape_string($con, $_POST['pros_name']);

$update_pros= mysqli_query($con, "UPDATE `pros` SET `pros_name` = '$pros_name', `modified_at` = NOW() WHERE `pros`.`pros_id` = '$pros_id';");

if ($update_pros) {
    mysqli_commit($con);
    header('Location: ../prosecution_profile.php?pros_id='.$pros_id.'&backresult=1'); //رقم الحصر مكرر
    exit;
}else{
    header('Location: ../prosecution_profile.php?pros_id='.$pros_id.'&backresult=0');
    exit;
}
?>

