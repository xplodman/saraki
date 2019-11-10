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

$delete_pros= mysqli_query($con, "DELETE FROM `pros` WHERE `pros`.`pros_id` ='$pros_id';");

if ($delete_pros) {
    mysqli_commit($con);
    header('Location: ../prosecutions.php?backresult=1');
    exit;
}else{
    header('Location: ../prosecutions.php?backresult=0');
    exit;
}

?>

