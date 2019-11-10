<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";

$issue_name= mysqli_real_escape_string($con, $_POST['issue_name']);

$insert_issue = mysqli_query($con, "INSERT INTO `issue` (`issue_id`, `issue_name`, `created_at`, `modified_at`) VALUES (NULL, '$issue_name', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));

if ($insert_issue){
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

