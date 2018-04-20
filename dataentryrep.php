<!DOCTYPE html>
<html dir="rtl" lang="en">
	<head>
<link rel="icon" type="image/png" href="assets/favicon.png" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>تقرير المتابعة الإسبوعي</title>
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
		$result4 = mysqli_query($sqlcon,"
		Select Count(`case`.departs_iddeparts) As countcase,
		  users.nickname As nickname,
		  users.idusers As idusers
		From (((`case`
		  Join casetype On `case`.casetype_idcasetype = casetype.idcasetype)
		  Join departs On departs.iddeparts = `case`.departs_iddeparts)
		  Join sarki On sarki.idsarki = `case`.sarki_idsarki)
		  Join users On sarki.idusers = users.idusers
		  Inner Join pros On pros.idpros = departs.pros_idpros
		Where `case`.createdate between '$week_start' and '$week_end 23:59:59'
		Group By users.idusers
		Order By countcase Desc") or die(mysqli_error($sqlcon));
	$result5 = mysqli_query($sqlcon,"
		Select Count(`case`.departs_iddeparts) As countcase,
		  users.nickname As nickname,
		  users.idusers As idusers
		From (((`case`
		  Join casetype On `case`.casetype_idcasetype = casetype.idcasetype)
		  Join departs On departs.iddeparts = `case`.departs_iddeparts)
		  Join sarki On sarki.idsarki = `case`.sarki_idsarki)
		  Join users On sarki.idusers = users.idusers
		  Inner Join pros On pros.idpros = departs.pros_idpros
		Where `case`.createdate between '$week_start' and '$week_end 23:59:59'") or die(mysqli_error($sqlcon));		
	?>
		
<body onload="window.print(); window.close();">
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
										<span>تقرير المتابعة من <?php echo $week_start; ?> إلى <?php echo $week_end; ?></span>
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
									<b>إسم المستخدم</b>
								</font>
							</td>
							<td width="30%" align="center">
								<font size="3" style="bold" >
									<b>عدد القضايا</b>
								</font>
							</td>
						</tr>
						<script type="text/javascript">
							window.print();
							window.onfocus=function(){ window.close();}
						</script>
						<?php
							$x=1;
							while($row4 = mysqli_fetch_assoc($result4))
							{
								
							?>
								<tr>
									<td align="center"><?php echo $x; ?></td>
									<td align="center"><?php echo $row4['nickname']; ?></td>
									<td align="center"><?php echo $row4['countcase']; ?></td>
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
										<b>إجمالي</b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="3" style="bold" >
										<b><?php echo $row5['countcase'];?></b>
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
