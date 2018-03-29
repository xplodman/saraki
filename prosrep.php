<!DOCTYPE html>
<html dir="rtl" lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>تقرير المتابعة</title>
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
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
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<?php
		require 'assets/redi/sqlcon.php';
		$day = date('w');
		$week_start=$_POST['week_start'];
		$week_end=$_POST['week_end'];
		
		$query="
		Select Count(`case`.idcase) As casecount,
		  pros.prosname As prosname,
		  overallpros.overallprosname,
		  overallpros.overallprosid
		From pros
		  Inner Join departs On departs.pros_idpros = pros.idpros
		  Inner Join `case` On departs.iddeparts = `case`.departs_iddeparts
		  Inner Join overallpros On overallpros.overallprosid = pros.overallprosid 
		  Where `case`.createdate between '$week_start' and '$week_end 23:59:59'
		";

		if (!empty($_POST['overallprosid'])) {
			$overallprosid=$_POST['overallprosid'];
		if(trim($overallprosid) != ''){
			$query .= " AND  `overallpros`.overallprosid = '$overallprosid'";
		}}
		
		
		$query .= " Group By pros.prosname, pros.idpros";
		$query .= " Order By casecount Desc";
		$result4 = mysqli_query($sqlcon, $query) or die(mysqli_error($sqlcon));
		  
		$query2="
		Select Count(`case`.idcase) As casecount,
		  overallpros.overallprosname,
		  overallpros.overallprosid
		From pros
		  Inner Join departs On departs.pros_idpros = pros.idpros
		  Inner Join `case` On departs.iddeparts = `case`.departs_iddeparts
		  Inner Join overallpros On overallpros.overallprosid = pros.overallprosid 
		Where `case`.createdate between '$week_start' and '$week_end 23:59:59'
		";

		if (!empty($_POST['overallprosid'])) {
			$overallprosid=$_POST['overallprosid'];
		if(trim($overallprosid) != ''){
			$query2 .= " AND  `overallpros`.overallprosid = '$overallprosid'";
		}}  
			$query2 .= " Group By overallpros.overallprosname, overallpros.overallprosid  ";
			$query2 .= " Order By casecount Desc";
	
	
		$result5 = mysqli_query($sqlcon, $query2) or die(mysqli_error($sqlcon));

		$query3="
		Select Count(`case`.idcase) As casecount,
		  overallpros.overallprosname,
		  overallpros.overallprosid
		From pros
		  Inner Join departs On departs.pros_idpros = pros.idpros
		  Inner Join `case` On departs.iddeparts = `case`.departs_iddeparts
		  Inner Join overallpros On overallpros.overallprosid = pros.overallprosid 
		Where `case`.createdate between '$week_start' and '$week_end 23:59:59'
		";
		$query3 .= " Order By casecount Desc";

		$result6 = mysqli_query($sqlcon, $query3) or die(mysqli_error($sqlcon));
		
	?>
<body onload="window.print(); window.close();">
<script type="text/javascript">
	window.print();
	window.onfocus=function(){ window.close();}
</script>
		<div class="page-header">
			<div class="row">
				<div class="col-xs-12">
					<img align="left" src="assets/images/prosecution.png" width="100" height="100">
					<br>
					<font size="3" style="bold" >
						<b>
							<table align="right">
								<tr>
									<td align="center">النيابة العامة</td>
								</tr>
								<tr>
									<td align="center">مركز معلومات النيابة العامة</td>
								</tr>
								<tr>
									<td align="center">فرع الإسكندرية</td>
								</tr>
							</table>
						</b>
					</font>
				</div>
			</div>
		</div>
		<!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="center">
					<div class="row">
						<div class="col-xs-12">
							<div>
								<font size="5" style="bold" >
									<b>
										<span>تقرير المتابعة من <?php echo $week_start; ?> إلى <?php echo $week_end; 
										
										if (!empty($_POST['overallprosid'])) {
											$overallprosid=$_POST['overallprosid'];
										if(trim($overallprosid) != ''){
											
											
											 $result6 = mysqli_query($sqlcon,"
												Select 
													overallpros.overallprosname,
													overallpros.overallprosid
												From overallpros
												Where overallpros.overallprosid = $overallprosid") or die(mysqli_error($sqlcon));
											$row6 = mysqli_fetch_assoc($result6);
											$overallprosname = $row6['overallprosname'];
											echo " لنيابات $overallprosname ";
										}}
										
										?>
										
										</span>
									</b>
								</font>
							</div>
						</div>
					</div>
					<br>
					<table  border="5" align="center"  style="width:98%">
						<tr>
							<td width="10%" align="center">
								<font size="3" style="bold" >
									<b>مسلسل</b>
								</font>
							</td>
							<td width="60%" align="center">
								<font size="3" style="bold" >
									<b>إسم النيابة</b>
								</font>
							</td>
							<td width="30%" align="center">
								<font size="3" style="bold" >
									<b>عدد القضايا</b>
								</font>
							</td>
						</tr>
						<?php
							$x=1;
							while($row4 = mysqli_fetch_assoc($result4))
							{
								
							?>
								<tr>
									<td align="center"><?php echo $x; ?></td>
									<td align="center"><?php echo $row4['prosname']; ?></td>
									<td align="center"><?php echo $row4['casecount']; ?></td>
								</tr>
							<?php
								$x=$x+1;
							};
							?>
							<?php
							$x=1;
							while($row5 = mysqli_fetch_assoc($result5))
							{
								
							?>
								<tr>
								<td width="10%" align="center">
									<font size="3" style="bold" >
										<b>#</b>
									</font>
								</td>
								<td width="60%" align="center">
									<font size="3" style="bold" >
										<b><?php echo $row5['overallprosname'];?></b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="3" style="bold" >
										<b><?php echo $row5['casecount'];?></b>
									</font>
								</td>
								</tr>
							<?php
							};
							?>
							<?php
							$x=1;
							while($row6 = mysqli_fetch_assoc($result6))
							{
								
							?>
								<tr>
								<td colspan="2" width="60%" align="center">
									<font size="4" style="bold" >
										<b>إجمالي نبايات الإسكندرية</b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="4" style="bold" >
										<b><?php echo $row6['casecount'];?></b>
									</font>
								</td>
								</tr>
							<?php
							};
							?>
					</table>
					<div class="col-xs-12" align="right">
						<div>
							<font size="2" style="bold" >
								<br>
								<b>
									<span>تحريراً في <?php echo date("Y/m/d"); ?></span>
								</b>
							</font>
						</div>
					</div>
				</div>
				
				<!-- PAGE CONTENT ENDS -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</body>
	<script language="JavaScript" type="text/javascript">
		var replaceDigits = function() {
		var map =
		[
		"&\#1632;","&\#1633;","&\#1634;","&\#1635;","&\#1636;",
		"&\#1637;","&\#1638;","&\#1639;","&\#1640;","&\#1641;"
		]

		document.body.innerHTML =
		document.body.innerHTML.replace(
		/\d(?=[^<>]*(<|$))/g,
		function($0) { return map[$0] }
		);
		}
	</script>
	<script type="text/javascript">
		window.onload = replaceDigits
	</script>
</html>
