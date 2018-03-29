<!DOCTYPE html>
<html dir="rtl" lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>تقرير متابعة الغياب و الحضور</title>
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
		$date=$_POST['date_start'];
		$date2=$_POST['date_start'];
		$date3=$_POST['date_start'];
		$end_date=$_POST['date_end'];
		$end_date2=$_POST['date_end'];
		$end_date3=$_POST['date_end'];
			$query = "select ca.nickname";
		while (strtotime($date) <= strtotime($end_date)) {
			$query .= ", max(case when ca.db_date = '$date' then coalesce(p.checkintime , 'غياب') end) `$date`";
			$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
	$query .= "
	from
	(
	  select c.db_date, a.nickname, a.idusers
	  from time_dimension c
	  cross join users a
	  WHERE
      a.securitylvl = 'd'
	) ca
	left join attendance p
	  on ca.idusers = p.idusers
	  and ca.db_date = p.checkindate
	group by ca.idusers, ca.nickname
	order by ca.idusers;";	
	$result = mysqli_query($sqlcon, $query);
	?>
		
<body>
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
										<span>تقرير متابعة الغياب و الحضور  من <?php echo $date3; ?> إلى <?php echo $end_date3; ?></span>
									</b>
								</font>
							</div>
						</div>
					</div>
					<br>
					<table  border="5" align="center"  style="width:98%">
						<tr>
							<td width="5%" align="center">
								<font size="3" style="bold" >
									<b>#</b>
								</font>
							</td>
							<td width="15%" align="center">
								<font size="3" style="bold" >
									<b>إسم المستخدم</b>
								</font>
							</td>
							<?php 
									while (strtotime($date2) <= strtotime($end_date2))
									{
										?>
										<td align="center">
											<font  style="bold" >
											<b><?php echo $date2; ?></b>
											</font>
										</td>
										<?php
										$date2 = date("Y-m-d", strtotime("+1 day", strtotime($date2)));
									}
							?>
						</tr>
						
						<?php
						$row_numbers=1;
							while($row = mysqli_fetch_array($result))
							{
                                foreach ($row as $key => $value) {
                                    if (!is_int($key)) {
                                        unset($row[$key]);
                                    }
                                }
                                ?>
								<tr>
								<td align="center"><?php echo $row_numbers; ?></td>
                                    <?php
                                    $len=count($row);
                                    for ($i=0;$i<$len;$i++){
                                        ?>
                                        <td align="center"><?php echo $row[$i]; ?></td>
                                        <?php
                                    }
                                    ?>
								</tr>
							<?php
							$date3 = date("Y-m-d", strtotime("+1 day", strtotime($date3)));
							$row_numbers++;
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
</html>