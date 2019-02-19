<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$max_case_has_action_id = mysqli_query($sqlcon, "SELECT Max(case_has_action.case_has_action_id) AS Max_case_has_action_id FROM   case_has_action");

$max_case_has_action_id = mysqli_fetch_row($max_case_has_action_id);
$max_case_has_action_id = implode("", $max_case_has_action_id);
$max_case_has_action_id =$max_case_has_action_id+1;


$idusers=$_SESSION["idusers"];

$case_number=$_POST['case_number'];
$case_number = explode("-", $case_number);

$case_year=$_POST['case_year'];
$case_type=$_POST['case_type'];
$case_depart=$_POST['case_depart'];
$action_type=$_POST['action_type'];

$case_number = array_filter($case_number);

//echo '<pre>'; print_r($case_number); echo '</pre>';

$len_case_number = count($case_number);

//echo $len_case_number;
//exit;


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
  `case`.caseyear = '$case_year' AND
  `case`.casetype_idcasetype = '$case_type' AND
  `case`.departs_iddeparts = '$case_depart'");

    if(mysqli_num_rows($case_id_query) == 0){ // if case not found
        array_push($not_found_case_number, $case_number[$y]);
        array_push($not_found_case_year, $case_year);
        array_push($not_found_case_type, $case_type);
        array_push($not_found_case_depart, $case_depart);
        goto search_again; // search again with a new values
    }

    $case_id = mysqli_fetch_assoc($case_id_query);

    $insert_case_action = mysqli_query($sqlcon, "    INSERT INTO `pic`.`case_has_action` (`case_idcase`, `action_action_id`, `insert_date`, `update_date`, `status`, `remove`, `users_idusers`, `case_has_action_id`) VALUES ('$case_id[idcase]', '$action_type', CURRENT_TIMESTAMP, NULL, '1', '0', '$idusers', '$max_case_has_action_id');");

    if ($insert_case_action === false) {
        array_push($failed_in_action_case_number, $case_number[$y]);
        array_push($failed_in_action_case_year, $case_year);
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


if ( $insert_case_action )
{
    header('Location: ../../actions.php?backresult=1');
    mysqli_commit($sqlcon);
    exit;
}
{
    header('Location: ../../actions.php?backresult=0');
    exit;
}

?>
