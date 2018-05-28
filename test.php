<?php 
	require 'assets\redi\sqlcon.php';
session_start();
$max_case_has_action_id = mysqli_query($sqlcon, "SELECT Max(case_has_action.case_has_action_id) AS Max_case_has_action_id FROM   case_has_action");

$max_case_has_action_id = mysqli_fetch_row($max_case_has_action_id);
$max_case_has_action_id = implode("", $max_case_has_action_id);
echo $max_case_has_action_id;
$max_case_has_action_id =$max_case_has_action_id+1;
echo $max_case_has_action_id;

?>