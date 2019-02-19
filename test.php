<?php
require 'assets/redi/sqlcon.php';
$result=mysqli_query($sqlcon, "SELECT
  users.idusers
FROM
  users
  INNER JOIN pros_has_users ON pros_has_users.idusers = users.idusers
  INNER JOIN pros ON pros_has_users.idpros = pros.idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  
  users.securitylvl = 'd'
GROUP BY
  users.idusers");
  if (!$result)
    {
        echo("Error description in result: " . mysqli_error($sqlcon));
        exit;
    }
  while($userinfores = mysqli_fetch_assoc($result)){	
echo $userinfores['idusers'];
	$result22=mysqli_query($sqlcon, "UPDATE `pic`.`users` SET `info_done` = '0' WHERE `idusers` = '$id'");
	mysqli_commit($sqlcon);
  }
?>
