<meta charset="utf-8">

<?php 
	require 'sqlcon.php';

	if (!empty($_GET['over_all_pros_id'])) {
		$over_all_pros_id = $_GET['over_all_pros_id'];
		
		$get_users_ids = mysqli_query($sqlcon, "
		SELECT
		  users.idusers
		FROM
		  users
		  INNER JOIN pros_has_users ON pros_has_users.idusers = users.idusers
		  INNER JOIN pros ON pros_has_users.idpros = pros.idpros
		  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
		WHERE
		  (overallpros.overallprosid = '$over_all_pros_id')");

		while($users_ids = mysqli_fetch_assoc($get_users_ids)){
			$set_user_info_undone = mysqli_query($sqlcon, "UPDATE `pic`.`users` SET  `info_done` = '0' WHERE `users`.`idusers` ='$users_ids[idusers]';");
		}
		mysqli_commit($sqlcon);
		header('Location: ../../over_all_prosprofile.php?backresult=1&over_all_id='.$over_all_pros_id);
		exit;
	}

?>
