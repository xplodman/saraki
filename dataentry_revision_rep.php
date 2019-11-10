<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <link rel="icon" type="image/png" href="assets/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
		<title>تقرير متابعة مدخلين البيانات</title>
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
		//$pros_id=$_POST['pros_id'];
		$user_id=$_POST['user_id'];
		$week_start=$_POST['week_start'];
		$week_end=$_POST['week_end'];

			$creation_query = "
SELECT
  `case`.casenum,
  `case`.caseyear,
  casetype.casetypename,
  departs.departname,
  users.nickname,
  outsource_company.outsource_company_name
FROM
  `case`
  INNER JOIN casetype ON `case`.casetype_idcasetype = casetype.idcasetype
  INNER JOIN departs ON `case`.departs_iddeparts = departs.iddeparts
  INNER JOIN sarki ON `case`.sarki_idsarki = sarki.idsarki
  INNER JOIN users ON sarki.idusers = users.idusers
  INNER JOIN outsource_company ON users.outsource_company_outsource_company_id = outsource_company.outsource_company_id
  INNER JOIN pros ON departs.pros_idpros = pros.idpros
WHERE
  `case`.createdate BETWEEN '$week_start' and '$week_end 23:59:59' AND
  users.idusers = '$user_id'
ORDER BY
  RAND()
LIMIT 15";

	$creation_result = mysqli_query($sqlcon, $creation_query);
	?>

<body>
		<!-- /.page-header -->
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="center">
            <table border="5" align="center" style="width:98%" id="revision" tableexport-key="revision">
						<tr>
							<td width="5%" align="center">
								<font size="3" style="bold" >
									<b>الرقم</b>
								</font>
							</td>
							<td width="5%" align="center">
								<font size="3" style="bold" >
									<b>السنة</b>
								</font>
							</td>
							<td width="10%" align="center">
								<font size="3" style="bold" >
									<b>الجدول</b>
								</font>
							</td>
							<td width="15%" align="center">
								<font size="3" style="bold" >
									<b>القسم</b>
								</font>
							</td>
							<td width="20%" align="center">
								<font size="3" style="bold" >
									<b>اسم المدخل</b>
								</font>
							</td>
						</tr>
						
						<?php
							while($creation_rows = mysqli_fetch_array($creation_result))
							{
							?>
								<tr>
									<td align="center"> <?php echo $creation_rows['casenum']; ?> </td>
									<td align="center"> <?php echo $creation_rows['caseyear']; ?> </td>
									<td align="center"> <?php echo $creation_rows['casetypename']; ?> </td>
									<td align="center"> <?php echo $creation_rows['departname']; ?> </td>
									<td align="center"> <?php echo $creation_rows['nickname']; ?> </td>
								</tr>
							<?php
							}
							?>
					</table>
				
				</div>
				<?php
				$creation_count = "
SELECT
  Count(`case`.casenum) AS Count_casenum
FROM
  `case`
  INNER JOIN sarki ON `case`.sarki_idsarki = sarki.idsarki
WHERE
  `case`.createdate BETWEEN '$week_start' and '$week_end 23:59:59' AND
  sarki.idusers = '$user_id'
";

	$creation_count_result = mysqli_query($sqlcon, $creation_count);
	$creation_count_result = mysqli_fetch_array($creation_count_result)
				?>
				<table  border="5" align="center"  style="width:98%" class="table2excel" data-tableName="Test Table 2">
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
								<b><?php echo $creation_count_result['Count_casenum'];?></b>
							</font>
						</td>
					</tr>
				</table>
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

    var revision = document.getElementById('revision');
    TableExport(revision);

</script>
</html>
