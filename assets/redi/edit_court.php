    <meta charset="utf-8">

<?php 
require 'sqlcon.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$character = array(" ", "	", "(", ")", "-", "/");

	$id_court_session = $_GET['id_court_session'];
	$pros = $_POST['duallistbox_demo1'];

	$court_session_name = $_POST['court_session_name'];
	$court_session_head = $_POST['court_session_head'];
	$court_session_employe = $_POST['court_session_employe'];
	$court_session_days = $_POST['court_session_days'];
	if(sizeof($court_session_days) == 0) {
		header('Location: ../../court_profile.php?backresult=5&id_court_session=' . $id_court_session);
		exit;
	}
	$court_session_days_string = implode(",", $court_session_days);
	$pros = implode("", $pros);

	$result1 = mysqli_query($sqlcon, "UPDATE `pic`.`court_session` SET `court_session_days` = '$court_session_days_string', `court_session_name` = '$court_session_name', `court_session_head` = '$court_session_head', `court_session_employe` = '$court_session_employe', `update_date` = NOW(), `pros_idpros` = '$pros' WHERE `court_session`.`id_court_session` = '$id_court_session';");


	if ($result1) {
		mysqli_commit($sqlcon);
		header('Location: ../../court_profile.php?backresult=1&id_court_session=' . $id_court_session);
		exit;
	} else {
		header('Location: ../../court_profile.php?backresult=0&id_court_session=' . $id_court_session);
		exit;

	}
}
?>
