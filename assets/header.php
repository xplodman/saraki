﻿<head>
<link rel="icon" type="image/png" href="assets/favicon.png" />
	<link rel="icon" type="image/png" href="assets/favicon.png" />
	<meta http-equiv="refresh" content="1500;url=assets/redi/logout.php" />
	<?php session_start();
		if (!isset($_SESSION['authenticate']) and $_SESSION['authenticate']!="true")
			{
				header('Location: assets/redi/logout.php');
				exit;
			};
		{$_SESSION['authenticate']="true";}

		if (isset($_SESSION['authenticate']))
		{
		 if(time() - $_SESSION['timestamp'] > 1500) { //subtract new timestamp from the old one
			echo"<script>alert('15 Minutes over!');</script>";
			unset($_SESSION['authenticate']);
				header('Location: assets/redi/logout.php');
		} else {
			$_SESSION['timestamp'] = time(); //set new timestamp
				}}
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8">
	<title>النيابات</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="assets/css/chosen.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
	<link rel="stylesheet" href="assets/css/daterangepicker.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-colorpicker.min.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<!--[if lte IE 9]>
		<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
	<![endif]-->
	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

	<!--[if lte IE 9]>
	  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
	<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->
	<script src="assets/js/ace-extra.min.js"></script>

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>