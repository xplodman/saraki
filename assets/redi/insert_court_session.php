<meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require 'sqlcon.php';
	session_start();
	$character = array(" ", "	", "(", ")", "-", "/");
	$court_session_name=$_POST['court_session_name'];
	$court_head_name=$_POST['court_head_name'];
	$court_session_days=$_POST['court_session_days'];
	$court_session_employe=$_POST['court_session_employe'];
	$prosid=$_POST['material_matid1'];
	$prosid = implode(",",$prosid);
	$court_session_days_string = implode(",",$court_session_days);

	$insert_court_session = mysqli_query($sqlcon, "INSERT INTO `pic`.`court_session` (`id_court_session`, `court_session_days`, `court_session_name`, `court_session_head`, `court_session_employe`, `insert_date`, `update_date`, `status`, `remove`, `pros_idpros`) VALUES (NULL, '$court_session_days_string', '$court_session_name', '$court_head_name', '$court_session_employe', CURRENT_TIMESTAMP, NULL, '1', '0', '$prosid');");
				}


	if ( $insert_court_session )
	{
	mysqli_commit($sqlcon);
	header('Location: ../../court_session.php?backresult=1');
	exit;
	}
	{
	header('Location: ../../court_session.php?backresult=0');
	}
?>
