<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";

$user_name= mysqli_real_escape_string($con, $_POST['user_name']);
$user_phone= mysqli_real_escape_string($con, $_POST['user_phone']);

$insert_user = mysqli_query($con, "INSERT INTO `user` (`user_id`, `user_name`, `user_phone_num`, `created_at`, `modified_at`) VALUES (NULL, '$user_name', '$user_phone', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));

if ($insert_user){
    mysqli_commit($con);
    header('Location: ../index.php?backresult=1');
    exit;
}else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
    header('Location: ../index.php?backresult=0'); //رقم الحيازة مكرر
    exit;
}
?>
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
//    ?>
<!--</table>-->

