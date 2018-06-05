<!DOCTYPE html>
<html dir="rtl" lang="en">
	<head>
<link rel="icon" type="image/png" href="assets/favicon.png" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>تقرير متابعة الحضور و الغياب</title>
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
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.table2excel.min.js"></script>
		
	</head>
	<?php
		require 'assets/redi/sqlcon.php';
	session_start();
	$admin_id = $_SESSION["admin_id"];
	$date=$_POST['daily_date'];
	$query = "select ca.nickname
, min(case when ca.db_date = '$date' then TIME_FORMAT(p.checkintime, '%l:%i%p') end) `checkintime`
, max(case when ca.db_date = '$date' then TIME_FORMAT(p.checkouttime, '%l:%i%p') end) `checkouttime`
from
	(
	  select c.db_date, a.nickname, a.idusers
	  from time_dimension c
	  cross join users a
	    INNER JOIN pros_has_users ON pros_has_users.idusers = a.idusers
  INNER JOIN pros ON pros_has_users.idpros = pros.idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
	  WHERE
      a.securitylvl = 'd' and overallpros_has_users.users_idusers = '$admin_id'
	) ca
	left join attendance p
	  on ca.idusers = p.idusers
	  and ca.db_date = p.checkindate
	group by ca.idusers, ca.nickname
	order by ca.idusers;";
	$result = mysqli_query($sqlcon, $query);
	?>

<body onload="window.print()">
<div id="page-content">
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
									<td align="center">مكتب النائب العام</td>
								</tr>
								<tr>
									<td align="center">مركز معلومات النيابة العامة</td>
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
										<span>تقرير متابعة الحضور و الغياب لمدخلي البيانات عن يوم <?php echo $date;?></span>
									</b>
								</font>
							</div>
						</div>
					</div>
					<br>
					<table  border="5" align="center"  style="width:98%" class="table2excel" data-tableName="Test Table 1">
						<tr>
							<td width="5%" align="center">
								<font size="3" style="bold" >
									<b>#</b>
								</font>
							</td>
							<td width="45%" align="center">
								<font size="3" style="bold" >
									<b>الإسم</b>
								</font>
							</td>
							<td align="center">
								<font size="3" style="bold" >
								<b>وقت الحضور</b>
								</font>
							</td>
							<td align="center">
								<font size="3" style="bold" >
									<b>وقت الإنصراف</b>
								</font>
							</td>
						</tr>
						<?php
						$row_numbers=1;
						while($row = mysqli_fetch_array($result))
						{
							?>
							<tr>
								<td align="center"><?php echo $row_numbers; ?></td>
								<td align="center"><?php echo $row['nickname']; ?></td>

									<?php
										if ($row['checkintime']==''){
											?>
												<td colspan="2" align="center"> غياب</td>
											<?php
											goto end_while;
										}else{
											?>
												<td align="center"><?php echo $row['checkintime']; ?></td>
											<?php
										}
									?>

								<td align="center"><?php echo $row['checkouttime']; ?></td>
								<?php end_while: ?>
							</tr>
						<?php
						$row_numbers++;
						}
						?>

					</table>
					<div class="col-xs-12" align="right">
						<div>
							<font size="2" style="bold" >
								<b>
									<span>تحريراً في <?php echo date("Y/n/j"); ?></span>
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
				</div>

	</body>
<!--	<script language="JavaScript" type="text/javascript">-->
<!--		var replaceDigits = function() {-->
<!--		var map =-->
<!--		[-->
<!--		"&\#1632;","&\#1633;","&\#1634;","&\#1635;","&\#1636;",-->
<!--		"&\#1637;","&\#1638;","&\#1639;","&\#1640;","&\#1641;"-->
<!--		]-->
<!---->
<!--		document.body.innerHTML =-->
<!--		document.body.innerHTML.replace(-->
<!--		/\d(?=[^<>]*(<|$))/g,-->
<!--		function($0) { return map[$0] }-->
<!--		);-->
<!--		}-->
<!--	</script>-->
<!--	<script type="text/javascript">-->
<!--		window.onload = replaceDigits-->
<!--	</script>-->
<script>
		$(function() {
			$(".table2excel").table2excel({
				name: "Excel Document Name",
				filename: "تقرير",
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		});
	</script>
</html>
