<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$idusers=$_SESSION["idusers"];

$case_number=$_POST['case_number'];
$case_year=$_POST['case_year'];
$case_type=$_POST['case_type'];
$case_depart=$_POST['case_depart'];
$action_type=$_POST['action_type'];

$case_number = array_filter($case_number);
$case_year = array_filter($case_year);
$case_type = array_filter($case_type);
$case_depart = array_filter($case_depart);
$action_type = array_filter($action_type);

//echo '<pre>'; print_r($case_number); echo '</pre>';
//echo '<pre>'; print_r($case_year); echo '</pre>';
//echo '<pre>'; print_r($case_type); echo '</pre>';
//echo '<pre>'; print_r($case_depart); echo '</pre>';
//echo '<pre>'; print_r($action_type); echo '</pre>';

$len_case_number = count($case_number);
$len_case_year = count($case_year);
$len_case_type = count($case_type);
$len_case_depart = count($case_depart);
$len_action_type = count($action_type);

//echo $len_case_depart.$len_case_year.$len_case_number.$len_case_type.$len_action_type;

if ($len_case_number != $len_case_year || $len_case_year != $len_case_type || $len_case_type != $len_case_depart || $len_case_depart != $len_case_type) {
    header('Location: ../../actions.php?backresult=0');
    exit;
}

$not_found_case_number = [];
$not_found_case_year = [];
$not_found_case_type = [];
$not_found_case_depart = [];
$failed_in_action_case_number = [];
$failed_in_action_case_year = [];
$failed_in_action_case_type = [];
$failed_in_action_case_depart = [];
for($y=0 ; $y < $len_case_number ; $y++)  // insert into case has action
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
    $case_id_query = mysqli_query($sqlcon, "
    SELECT
      `case`.idcase,
      departs.departname,
      casetype.casetypename
    FROM
      `case`
      INNER JOIN departs ON `case`.departs_iddeparts = departs.iddeparts
      INNER JOIN casetype ON `case`.casetype_idcasetype = casetype.idcasetype
    WHERE
      `case`.casenum = '$case_number[$y]' AND
      `case`.caseyear = '$case_year[$y]' AND
      `case`.casetype_idcasetype = '$case_type[$y]' AND
      `case`.departs_iddeparts = '$case_depart[$y]'");

    if(mysqli_num_rows($case_id_query) == 0){ // if case not found
        array_push($not_found_case_number, $case_number[$y]);
        array_push($not_found_case_year, $case_year[$y]);
        array_push($not_found_case_type, $case_type[$y]);
        array_push($not_found_case_depart, $case_depart[$y]);
        goto search_again; // search again with a new values
    }

    $case_id = mysqli_fetch_assoc($case_id_query);

    $insert_case_action = mysqli_query($sqlcon, "    INSERT INTO `pic`.`case_has_action` (`case_idcase`, `action_action_id`, `insert_date`, `update_date`, `status`, `remove`, `users_idusers`) VALUES ('$case_id[idcase]', '$action_type[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$idusers');");

    if ($insert_case_action === false) {
        array_push($failed_in_action_case_number, $case_number[$y]);
        array_push($failed_in_action_case_year, $case_year[$y]);
        array_push($failed_in_action_case_type, $case_id['departname']);
        array_push($failed_in_action_case_depart, $case_id['casetypename']);
    }

    search_again:
}
if(sizeof($not_found_case_year) > 0 and sizeof($failed_in_action_case_number) > 0) {
    header('Location: ../../actions.php?backresult=4');
    session_start();
    $_SESSION["not_found_case_number"] = $not_found_case_number;
    $_SESSION["not_found_case_year"] = $not_found_case_year;
    $_SESSION["not_found_case_type"] = $not_found_case_type;
    $_SESSION["not_found_case_depart"] = $not_found_case_depart;
    $_SESSION["failed_in_action_case_number"] = $failed_in_action_case_number;
    $_SESSION["failed_in_action_case_year"] = $failed_in_action_case_year;
    $_SESSION["failed_in_action_case_type"] = $failed_in_action_case_type;
    $_SESSION["failed_in_action_case_depart"] = $failed_in_action_case_depart;
    mysqli_commit($sqlcon);
    exit;
}

if(sizeof($not_found_case_year) > 0) {
    header('Location: ../../actions.php?backresult=3');
    session_start();
    $_SESSION["not_found_case_number"] = $not_found_case_number;
    $_SESSION["not_found_case_year"] = $not_found_case_year;
    $_SESSION["not_found_case_type"] = $not_found_case_type;
    $_SESSION["not_found_case_depart"] = $not_found_case_depart;
    mysqli_commit($sqlcon);
    exit;
}

if(sizeof($failed_in_action_case_number) > 0) {
    header('Location: ../../actions.php?backresult=2');
    session_start();
    $_SESSION["failed_in_action_case_number"] = $failed_in_action_case_number;
    $_SESSION["failed_in_action_case_year"] = $failed_in_action_case_year;
    $_SESSION["failed_in_action_case_type"] = $failed_in_action_case_type;
    $_SESSION["failed_in_action_case_depart"] = $failed_in_action_case_depart;
    mysqli_commit($sqlcon);
    exit;
}

header('Location: ../../actions.php?backresult=1');
mysqli_commit($sqlcon);
exit;

?>
