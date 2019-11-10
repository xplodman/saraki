<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";

$pros_id= mysqli_real_escape_string($con, $_POST['pros_id']);
$group_id= mysqli_real_escape_string($con, $_POST['group_id']);
$user_id= mysqli_real_escape_string($con, $_POST['user_id']);
$issue_id= mysqli_real_escape_string($con, $_POST['issue_id']);
$date = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date']))->format("Y-m-d");

$insert_transaction = mysqli_query($con, "INSERT INTO `user_has_issue_in_group_at_pros` (`user_user_id`, `issue_issue_id`, `pros_pros_id`, `group_group_id`, `date`) VALUES ('$user_id', '$issue_id', '$pros_id', '$group_id', '$date');")or die(mysqli_error($con));

if ($insert_transaction){
    mysqli_commit($con);
    header('Location: ../transaction.php?backresult=1');
    exit;
}else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
    header('Location: ../transaction.php?backresult=0'); //رقم الحيازة مكرر
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

