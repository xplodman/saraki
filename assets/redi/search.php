    <meta charset="utf-8">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
require 'sqlcon.php';

$casenum=$_POST['casenum'];
$year=$_POST['year'];
$type=$_POST['type'];
$depart=$_POST['depart'];


if (empty($casenum)) 
{
    $result = mysqli_query($sqlcon, "Select `case`.casenum,
									  `case`.caseyear,
									  casetype.casetypename,
									  departs.departname,
									  `case`.createdate,
									  `case`.casetype2_idcasetype2,
									  `users`.idusers,
									  `users`.nickname
									From `case`
									  Inner Join departs On departs.iddeparts = `case`.departs_iddeparts
									  Inner Join casetype On `case`.casetype_idcasetype = casetype.idcasetype
									  Inner Join sarki On `case`.sarki_idsarki = sarki.idsarki
									  Inner Join users On users.idusers = sarki.idusers
								Where`case`.caseyear = $year And casetype.idcasetype = $type And departs.iddeparts = $depart");
} elseif (empty($year))
{
	$result = mysqli_query($sqlcon, "Select `case`.casenum,
									  `case`.caseyear,
									  casetype.casetypename,
									  departs.departname,
									  `case`.createdate,
									  `case`.casetype2_idcasetype2,
									  `users`.idusers,
									  `users`.nickname
									  From `case`
									  Inner Join departs On departs.iddeparts = `case`.departs_iddeparts
									  Inner Join casetype On `case`.casetype_idcasetype = casetype.idcasetype
									  Inner Join sarki On `case`.sarki_idsarki = sarki.idsarki
									  Inner Join users On users.idusers = sarki.idusers
								Where `case`.casenum = $casenum And casetype.idcasetype = $type And departs.iddeparts = $depart");
} else 
{
    $result = mysqli_query($sqlcon, "Select `case`.casenum,
									  `case`.caseyear,
									  casetype.casetypename,
									  departs.departname,
									  `case`.createdate,
									  `case`.casetype2_idcasetype2,
									  `users`.idusers,
									  `users`.nickname
									  From `case`
									  Inner Join departs On departs.iddeparts = `case`.departs_iddeparts
									  Inner Join casetype On `case`.casetype_idcasetype = casetype.idcasetype
									  Inner Join sarki On `case`.sarki_idsarki = sarki.idsarki
									  Inner Join users On users.idusers = sarki.idusers 
								Where `case`.casenum = $casenum And `case`.caseyear = 2017 And casetype.idcasetype = 2 And departs.iddeparts = 2");
}



	};

	

	
if(mysqli_num_rows($result) == 0) {

	header('Location: ../../search.php?backresult=0');
	$fh = fopen('/tmp/track.txt','a');
	fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
	fclose($fh);
	}
else
{ 
	header('Location: ../../search.php');
	$fh = fopen('/tmp/track.txt','a');
	fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
	fclose($fh);
		session_start();

	$_SESSION["result"] = $result;
}  
?>
