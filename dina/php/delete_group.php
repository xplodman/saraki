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

$delete_group= mysqli_query($con, "DELETE FROM `group` WHERE `group`.`group_id` ='$group_id';");

if ($delete_group) {
    mysqli_commit($con);
    header('Location: ../groups.php?backresult=1');
    exit;
}else{
    header('Location: ../groups.php?backresult=0');
    exit;
}

?>

