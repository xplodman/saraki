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

$delete_issue= mysqli_query($con, "DELETE FROM `issue` WHERE `issue`.`issue_id` ='$issue_id';");

if ($delete_issue) {
    mysqli_commit($con);
    header('Location: ../issues.php?backresult=1');
    exit;
}else{
    header('Location: ../issues.php?backresult=0');
    exit;
}

?>

