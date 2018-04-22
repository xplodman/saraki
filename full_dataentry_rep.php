<!DOCTYPE html>
<html dir="rtl" lang="en">
	<head>
<link rel="icon" type="image/png" href="assets/favicon.png" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>تقرير المتابعة </title>
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
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.table2excel.min.js"></script>
		<!--[if lte IE 9]>
		<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<!-- inline styles related to this page -->
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	<?php
		require 'assets/redi/sqlcon.php';
	session_start();
	$admin_id = $_SESSION["admin_id"];
		$day = date('w');
		$week_start=$_POST['week_start'];
		$week_end=$_POST['week_end'];
		$result4 = mysqli_query($sqlcon,"
		SELECT
  `case`.casenum,
  `case`.caseyear,
  casetype.casetypename,
  departs.departname,
  users.nickname,
  Date_Format(sarki.createdate, '%d/%m/%Y') AS createdate
FROM
  `case`
  INNER JOIN casetype ON `case`.casetype_idcasetype = casetype.idcasetype
  INNER JOIN departs ON `case`.departs_iddeparts = departs.iddeparts
  INNER JOIN sarki ON sarki.casetype_idcasetype = casetype.idcasetype AND sarki.departs_iddeparts = departs.iddeparts
    AND `case`.sarki_idsarki = sarki.idsarki
  INNER JOIN users ON sarki.idusers = users.idusers
  INNER JOIN pros ON departs.pros_idpros = pros.idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  `case`.createdate BETWEEN '$week_start' AND '$week_end 23:59:59' AND
  overallpros_has_users.users_idusers = '$admin_id'
ORDER BY
  users.idusers") or die(mysqli_error($sqlcon));
  
  
	$result5 = mysqli_query($sqlcon,"
		  SELECT
  Count(`case`.departs_iddeparts) AS countcase,
  users.nickname AS nickname,
  users.idusers AS idusers
FROM
  (((`case`
  JOIN casetype ON `case`.casetype_idcasetype = casetype.idcasetype)
  JOIN departs ON departs.iddeparts = `case`.departs_iddeparts)
  JOIN sarki ON sarki.idsarki = `case`.sarki_idsarki)
  JOIN users ON sarki.idusers = users.idusers
  INNER JOIN pros ON pros.idpros = departs.pros_idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  `case`.createdate BETWEEN '$week_start' AND '$week_end 23:59:59' AND
  overallpros_has_users.users_idusers = '$admin_id'
GROUP BY
  users.idusers
ORDER BY
  idusers") or die(mysqli_error($sqlcon));
	$result6 = mysqli_query($sqlcon,"
		SELECT
  Count(`case`.departs_iddeparts) AS countcase,
  users.nickname AS nickname,
  users.idusers AS idusers
FROM
  (((`case`
  JOIN casetype ON `case`.casetype_idcasetype = casetype.idcasetype)
  JOIN departs ON departs.iddeparts = `case`.departs_iddeparts)
  JOIN sarki ON sarki.idsarki = `case`.sarki_idsarki)
  JOIN users ON sarki.idusers = users.idusers
  INNER JOIN pros ON pros.idpros = departs.pros_idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  `case`.createdate BETWEEN '$week_start' AND '$week_end 23:59:59' AND
  overallpros_has_users.users_idusers = '$admin_id'
GROUP BY
  overallpros_has_users.users_idusers") or die(mysqli_error($sqlcon));
	?>
		
<body>
<script>
	$(function() {
		$(".table2excel").table2excel({
			name: "من <?php echo $week_start; ?> إلى <?php echo $week_end; ?>",
			filename: "تقرير المتابعة من <?php echo $week_start; ?> إلى <?php echo $week_end; ?>",
			fileext: ".xls",
			exclude_img: true,
			exclude_links: true,
			exclude_inputs: true
		});
	});
</script>
		<style>
		tr.row {
    border:1px solid black; 
}
		</style>
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
					<table border="5" align="center"  style="width:98%" class="table2excel">
						<tr>
							<td width="10%" align="center">
								<font size="3" style="bold" >
									<b>مسلسل</b>
								</font>
							</td>
							<td width="30%" align="center">
								<font size="3" style="bold" >
									<b>رقم القضية</b>
								</font>
							</td>
							<td width="30%" align="center">
								<font size="3" style="bold" >
									<b>أسم المنشئ</b>
								</font>
							</td>
							<td width="30%" align="center">
								<font size="3" style="bold" >
									<b>تاريخ الإنشاء</b>
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
									<td align="center"><?php echo $row4['casenum']." / ".$row4['caseyear']." / ".$row4['casetypename']." / ".$row4['departname']; ?></td>
									<td align="center"><?php echo $row4['nickname']; ?></td>
									<td align="center"><?php echo $row4['createdate']; ?></td>
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
								<tr bgcolor="#BDBDBD">
								<td width="10%" align="center">
									<font size="3" style="italic" >
										<b>#</b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="3" style="italic" >
										<b>إجمالي</b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="3" style="italic" >
										<b><?php echo $row5['nickname'];?></b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="3" style="italic" >
										<b><?php echo $row5['countcase'];?></b>
									</font>
								</td>
								</tr>
							<?php
							};
							?>
							<?php
							while($row6 = mysqli_fetch_assoc($result6))
							{
								
							?>
								<tr bgcolor="#8D8D8D">
								<td width="10%" align="center">
									<font size="5" style="bold" >
										<b>#</b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="5" style="bold" >
										<b>إجمالي</b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="5" style="bold" >
										<b>إجمالي</b>
									</font>
								</td>
								<td width="30%" align="center">
									<font size="5" style="bold" >
										<b><?php echo $row6['countcase'];?></b>
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
</html>
