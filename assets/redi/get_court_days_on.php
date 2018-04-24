<?php
$db = 'pic';
$db_admin = 'root';
$db_password = 'root';
$sqlcon = mysqli_connect("localhost", "$db_admin", "$db_password", "$db");

// show arabic result
$arabicsql= 'SET CHARACTER SET utf8';
if($sqlcon == false){
	exit;
}
mysqli_query($sqlcon,$arabicsql);
$court_id = $_POST['court_id'];
$get_court_days_on_query = mysqli_query($sqlcon, "
    SELECT
  court_session.court_session_days
FROM
  court_session
WHERE
  court_session.id_court_session = '$court_id'");

$get_court_days_on = mysqli_fetch_assoc($get_court_days_on_query);
$court_days_on = explode(",",$get_court_days_on['court_session_days']);
$all_days =['0','1','2','3','4','5','6'];

$court_days_off = array_diff($all_days, $court_days_on);

echo '"'.implode(",",$court_days_off).'"';