<meta charset="utf-8">
<?php
require 'sqlcon.php';
session_start();

$max_case_has_investigation_id = mysqli_query($sqlcon, "SELECT Max(case_has_investigation.id_case_has_investigation) AS Max_case_has_investigation_id FROM case_has_investigation");

$max_case_has_investigation_id = mysqli_fetch_row($max_case_has_investigation_id);
$max_case_has_investigation_id = implode("", $max_case_has_investigation_id);
$max_case_has_investigation_id = $max_case_has_investigation_id+1;

$idusers=$_SESSION["idusers"];

$case_number=$_POST['case_number'];
$case_year=$_POST['case_year'];
$case_type=$_POST['case_type'];
$case_depart=$_POST['case_depart'];
$investigation_number=$_POST['investigation_number'];
$investigation_year=$_POST['investigation_year'];
if(isset($_POST['scanned'])){
    $scanned = $_POST['scanned'];
}else{
    $scanned = '0';
}

$case_number = array_filter($case_number);
$case_year = array_filter($case_year);
$case_type = array_filter($case_type);
$case_depart = array_filter($case_depart);
$investigation_number = array_filter($investigation_number);
$investigation_year = array_filter($investigation_year);



$len_case_number = count($case_number);
$len_case_year = count($case_year);
$len_case_type = count($case_type);
$len_case_depart = count($case_depart);
$len_investigation_number = count($investigation_number);
$len_investigation_year = count($investigation_year);
$len_scanned = count($scanned);


if ($len_case_number != $len_case_year || $len_case_year != $len_case_type || $len_case_type != $len_case_depart || $len_case_depart != $len_case_type || $len_case_type != $len_investigation_number || $len_investigation_number != $len_investigation_year) {
    header('Location: ../../investigations.php?backresult=0');
    exit;
}

$not_found_case_number = [];
$not_found_case_year = [];
$not_found_case_type = [];
$not_found_case_depart = [];
$failed_in_investigation_case_number = [];
$failed_in_investigation_case_year = [];
$failed_in_investigation_case_type = [];
$failed_in_investigation_case_depart = [];
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
	search_again:
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
        //array_push($not_found_case_number, $case_number[$y]);
        //array_push($not_found_case_year, $case_year[$y]);
        //array_push($not_found_case_type, $case_type[$y]);
        //array_push($not_found_case_depart, $case_depart[$y]);
        // goto search_again; // search again with a new values
		
		
		$insert_not_found_case = mysqli_query($sqlcon, "INSERT INTO `pic`.`sarki` (`idsarki`, `date`, `from`, `to`, `year`,  `casetype_idcasetype`, `casetype2_idcasetype2`, `departs_iddeparts`, `createdate`, `updatedate`, `idusers`, `notes`) VALUES (NULL, NOW(), '$case_number[$y]', '$case_number[$y]', '$case_year[$y]', '$case_type[$y]', '2', '$case_depart[$y]', NOW(), NULL, '52', '');")or die(mysqli_error($sqlcon));
		
		$maxid = mysqli_query($sqlcon, "SELECT MAX(idsarki) FROM sarki");
		$maxidrow = mysqli_fetch_row($maxid);
		$comma_separated = implode("", $maxidrow);
		
		$maxcaseid = mysqli_query($sqlcon, "Select Max(`case`.idcase) From `case`");
		$maxcaseidrow = mysqli_fetch_row($maxcaseid);
		$maxcaseid = implode("", $maxcaseidrow);
		
		$maxcaseid=$maxcaseid+1;
		$result2 = mysqli_query($sqlcon, "INSERT INTO `pic`.`case` (`idcase`, `casenum`, `caseyear`, `sarki_idsarki`, `casetype2_idcasetype2`, `casetype_idcasetype`, `departs_iddeparts`, `createdate`, `updatedate`) VALUES ('$maxcaseid', '$case_number[$y]', '$case_year[$y]', '$comma_separated', '2', '$case_type[$y]', '$case_depart[$y]', NOW(), NULL);");
        
		goto search_again;
    }

    $case_id = mysqli_fetch_assoc($case_id_query);

    $insert_case_investigation = mysqli_query($sqlcon, "INSERT INTO `pic`.`case_has_investigation` (`id_case_has_investigation`, `case_idcase`, `insert_date`, `update_date`, `status`, `remove`, `users_idusers`, `investigation_number`, `investigation_year`, `departs_iddeparts`, `scanned`) VALUES ('$max_case_has_investigation_id', '$case_id[idcase]', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '1', '0', '$idusers', '$investigation_number[$y]', '$investigation_year[$y]', '$case_depart[$y]', '$scanned[$y]');");


    if ($insert_case_investigation === false) {
        array_push($failed_in_investigation_case_number, $case_number[$y]);
        array_push($failed_in_investigation_case_year, $case_year[$y]);
        array_push($failed_in_investigation_case_type, $case_id['departname']);
        array_push($failed_in_investigation_case_depart, $case_id['casetypename']);
    }

    
}
if(sizeof($not_found_case_year) > 0 and sizeof($failed_in_investigation_case_number) > 0) {
    header('Location: ../../investigations.php?backresult=4');
    session_start();
    $_SESSION["not_found_case_number"] = $not_found_case_number;
    $_SESSION["not_found_case_year"] = $not_found_case_year;
    $_SESSION["not_found_case_type"] = $not_found_case_type;
    $_SESSION["not_found_case_depart"] = $not_found_case_depart;
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
    $_SESSION["not_found_case_number"] = $not_found_case_number;
    $_SESSION["not_found_case_year"] = $not_found_case_year;
    $_SESSION["not_found_case_type"] = $not_found_case_type;
    $_SESSION["not_found_case_depart"] = $not_found_case_depart;
    mysqli_commit($sqlcon);
    exit;
}

if(sizeof($failed_in_investigation_case_number) > 0) {
    header('Location: ../../investigations.php?backresult=2');
    session_start();
    $_SESSION["failed_in_investigation_case_number"] = $failed_in_investigation_case_number;
    $_SESSION["failed_in_investigation_case_year"] = $failed_in_investigation_case_year;
    $_SESSION["failed_in_investigation_case_type"] = $failed_in_investigation_case_type;
    $_SESSION["failed_in_investigation_case_depart"] = $failed_in_investigation_case_depart;
    mysqli_commit($sqlcon);
    exit;
}

header('Location: ../../investigations.php?backresult=1');
mysqli_commit($sqlcon);
exit;

?>
