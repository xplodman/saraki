		<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$idusers=$_SESSION["idusers"];

$investigation_number=$_POST['investigation_number'];
$investigation_year=$_POST['investigation_year'];
$investigation_depart=$_POST['investigation_depart'];

$investigation_number = array_filter($investigation_number);
$investigation_year = array_filter($investigation_year);
$investigation_depart = array_filter($investigation_depart);

$len_investigation_number = count($investigation_number);
$len_investigation_year = count($investigation_year);
$len_investigation_depart = count($investigation_depart);


if ( $len_investigation_number != $len_investigation_year || $len_investigation_year != $len_investigation_depart) {
    header('Location: ../../investigations.php?backresult=0');
    exit;
}

$not_found_investigation_number = [];
$not_found_investigation_year = [];
$not_found_investigation_depart = [];
$failed_in_investigation_number = [];
$failed_in_investigation_year = [];
$failed_in_investigation_depart = [];

for($y=0 ; $y < $len_investigation_number ; $y++)  // insert into case has action
{
//    echo $case_number[$y];
//
//    echo $case_year[$y];
//
//    echo $case_type[$y];
//
//    echo $case_depart[$y];
//
//    echo $action_type[$y];
//    echo "<br>";
    $investigation_update_query = mysqli_query($sqlcon, "
    UPDATE `pic`.`case_has_investigation` SET `update_date` = CURRENT_TIMESTAMP , `scanned` = '1' WHERE `case_has_investigation`.`investigation_number` = '$investigation_number[$y]' AND `case_has_investigation`.`investigation_year` = '$investigation_year[$y]' AND `case_has_investigation`.`departs_iddeparts` = '$investigation_depart[$y]';
");

    if ($investigation_update_query === false) {
        array_push($failed_in_investigation_number, $investigation_number[$y]);
        array_push($failed_in_investigation_year, $investigation_year[$y]);
        array_push($failed_in_investigation_depart, $investigation_depart[$y]);
    }

    search_again:
}
if(sizeof($not_found_investigation_number) > 0 and sizeof($failed_in_investigation_depart) > 0) {
    header('Location: ../../investigations.php?backresult=4');
    session_start();
    $_SESSION["not_found_investigation_number"] = $not_found_investigation_number;
    $_SESSION["not_found_investigation_year"] = $not_found_investigation_year;
    $_SESSION["not_found_investigation_type"] = $not_found_investigation_type;
    $_SESSION["not_found_investigation_depart"] = $not_found_investigation_depart;
    $_SESSION["failed_in_investigation_case_number"] = $failed_in_investigation_case_number;
    $_SESSION["failed_in_investigation_case_year"] = $failed_in_investigation_case_year;
    $_SESSION["failed_in_investigation_case_type"] = $failed_in_investigation_case_type;
    $_SESSION["failed_in_investigation_case_depart"] = $failed_in_investigation_case_depart;
    mysqli_commit($sqlcon);
    exit;
}

if(sizeof($not_found_case_year) > 0) {
    header('Location: ../../investigations.php?backresult=3');
    session_start();
    $_SESSION["not_found_investigation_number"] = $not_found_investigation_number;
    $_SESSION["not_found_investigation_year"] = $not_found_investigation_year;
    $_SESSION["not_found_investigation_depart"] = $not_found_investigation_depart;
    mysqli_commit($sqlcon);
    exit;
}

if(sizeof($failed_in_investigation_case_number) > 0) {
    header('Location: ../../investigations.php?backresult=2');
    session_start();
    $_SESSION["failed_in_investigation_number"] = $failed_in_investigation_number;
    $_SESSION["failed_in_investigation_year"] = $failed_in_investigation_year;
    $_SESSION["failed_in_investigation_depart"] = $failed_in_investigation_depart;
    mysqli_commit($sqlcon);
    exit;
}

header('Location: ../../investigations.php?backresult=1');
mysqli_commit($sqlcon);
exit;

?>
