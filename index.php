<head>
<link rel="icon" type="image/png" href="assets/favicon.png" />
	<?php 
		session_start();
		if (!isset($_SESSION['authenticate']) and $_SESSION['authenticate']!="true")
			{
				header('Location: assets/redi/logout.php');
				$fh = fopen('/tmp/track.txt','a');
				fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
				fclose($fh);
			};
		{$_SESSION['authenticate']="true";}
		if (isset($_SESSION['authenticate']))
		{
			if(time() - $_SESSION['timestamp'] > 900) { //subtract new timestamp from the old one
			echo"<script>alert('15 Minutes over!');</script>";
			unset($_SESSION['authenticate']);
				header('Location: assets/redi/logout.php');
		} else {
			$_SESSION['timestamp'] = time(); //set new timestamp
				}}
		?>
</head>
<?php
require 'assets/redi/sqlcon.php';
$nickname=$_SESSION['nickname'];
$prosname=$_SESSION['prosname'];
$securitylvl=$_SESSION['securitylvl'];
$idusers=$_SESSION['idusers'];
	if($securitylvl == "a")
		{
			header('Location: adminindex.php');
		}else
		{
			header('Location: userindex.php');
		};
?>z