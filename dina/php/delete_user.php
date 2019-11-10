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

$delete_user= mysqli_query($con, "DELETE FROM `user` WHERE `user`.`user_id` ='$user_id';");

if ($delete_user) {
    mysqli_commit($con);
    header('Location: ../users.php?backresult=1');
    exit;
}else{
    header('Location: ../users.php?backresult=0');
    exit;
}

?>

