<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
		<title>تقرير متابعة الحضور و الغياب</title>
    <link href="needs/tableexport.min.css" rel="stylesheet">
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
    <script src="assets/js/jquery.table2excel.js"></script>
    <style>
        @media print{@page {size: landscape}}
    </style>
</head>
	<?php
		require 'assets/redi/sqlcon.php';
	session_start();
	$date="1/7/2019";
	$date2="1/7/2019";
	$date3="1/7/2019";

	$end_date="1/8/2019";
	$end_date2="1/8/2019";
	$end_date3="1/8/2019";
	

			$query = "select ca.nickname, ca.rest_day";
		while (strtotime($date) <= strtotime($end_date)) {
			$query .= ", max(case when ca.db_date = '$date' then CONCAT_WS(' / ', TIME_FORMAT(p.checkintime, '%l:%i %p')) end) `$date حضور`";
			$query .= ", max(case when ca.db_date = '$date' then CONCAT_WS(' / ',TIME_FORMAT(p.checkouttime, '%l:%i %p')) end) `$date انصراف`";
			$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
	$query .= "
	from
	(
	  select c.db_date, a.nickname,a.rest_day, a.idusers,a.outsource_company_outsource_company_id
	  from time_dimension c
	  cross join users a
	    INNER JOIN pros_has_users ON pros_has_users.idusers = a.idusers
  INNER JOIN pros ON pros_has_users.idpros = pros.idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
	  WHERE
      a.securitylvl = 'd' AND overallpros.overallprosid IN ('1', '2', '3', '4', '5')";

$query .= "
	
	) ca
	left join attendance p
	  on ca.idusers = p.idusers
	  and ca.db_date = p.checkindate
	 WHERE
  ca.outsource_company_outsource_company_id = '1'
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
										<span>تقرير متابعة الحضور و الغياب  عن يوم <?php echo $date3; ?> و حتى يوم <?php echo $end_date3; ?></span>
									</b>
								</font>
							</div>
						</div>
					</div>
					<br>
            <table border="5" align="center" style="width:98%" id="attend" tableexport-key="attend">
						<tr>
							<td width="5%" align="center">
								<font size="3" style="bold" >
									<b>#</b>
								</font>
							</td>
							<td width="15%" align="center">
								<font size="3" style="bold" >
									<b>الإسم</b>
								</font>
							</td>
							<td width="15%" align="center">
								<font size="3" style="bold" >
									<b>بوم الراحة</b>
								</font>
							</td>
							<?php 
								while (strtotime($date2) <= strtotime($end_date2))
								{
									?>
									<td align="center">
										<font size="3" style="bold" >
										<b><?php echo $date2." حضور " ; ?></b>
										</font>
									</td>
									
									<td align="center">
										<font size="3" style="bold" >
										<b><?php echo $date2." انصراف " ; ?></b>
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
                                        <td align="center">
											<?php
												switch ($row[$i]) {
													case "Saturday":
														echo "السبت";
														break;
													case "Sunday":
														echo "الأحد";
														break;
													case "Monday":
														echo "الإثنين";
														break;
													case "Tuesday":
														echo "الثلاثاء";
														break;
													case "Wednesday":
														echo "الأربعاء";
														break;
													case "Thursday":
														echo "الخميس";
														break;
													case "":
														echo "غياب";
														break;
													default:
														echo $row[$i];
												}
											?>
										</td>
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
<script type="text/javascript" src="needs/jquery.min.js.download"></script>
<script type="text/javascript" src="needs/xlsx.core.min.js.download"></script>
<script type="text/javascript" src="needs/Blob.min.js.download"></script>
<script type="text/javascript" src="needs/FileSaver.min.js.download"></script>
<script type="text/javascript" src="needs/tableexport.min.js.download"></script>
<script>

    var attend = document.getElementById('attend');
    TableExport(attend);

</script>
</html>