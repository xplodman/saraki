<!DOCTYPE html>
<html lang="en" dir="">
<?php
$pageTitle = 'Home page';
include_once "php/check_authentication.php";
include_once "layout/header.php";
include_once "php/functions.php";
?>
<body class="fix-header card-no-border fix-sidebar">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">النيابة العامة</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <?php
    include_once "layout/topbar.php";
    include_once "layout/sidebar.php";
    ?>
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <h3 class="card-title m-b-5"><span class="lstick"></span>Statistical number of issues in <?php echo date('M')." ".date('n')."/".date('Y') ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div id="collapseOne" class="panel-collapse collapse in" dir="ltr">
                                        <div id="chart1" dir="ltr"></div>
                                         <?php
                                        $query = "SELECT
  Coalesce(Count(user_has_issue_in_group_at_pros.user_user_id), 0) AS Count_user_user_id
FROM
  user_has_issue_in_group_at_pros
WHERE
  Month(user_has_issue_in_group_at_pros.date) = Month(CURRENT_DATE())";
                                        $results=mysqli_query($con, $query);
                                        $all_issues = 0;
                                        while($y = mysqli_fetch_assoc($results)) {
                                            $all_issues= $all_issues + $y['Count_user_user_id'];
                                        }
                                        echo "Total issues in ".date('M')." ".date('n')."/".date('Y')." is : ".$all_issues
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <h3 class="card-title m-b-5"><span class="lstick"></span>Statistical number of issues in <?php echo date('M', strtotime('-1 month'))." ".date('n', strtotime('-1 month'))."/".date('Y') ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div id="collapseOne" class="panel-collapse collapse in" dir="ltr">
                                        <div id="chart2" dir="ltr"></div>
                                        <?php
                                        $query = "SELECT
  Coalesce(Count(user_has_issue_in_group_at_pros.user_user_id), 0) AS Count_user_user_id
FROM
  user_has_issue_in_group_at_pros
WHERE
  Month(user_has_issue_in_group_at_pros.date) = Month(DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH))";
                                        $results=mysqli_query($con, $query);
                                        $all_issues = 0;
                                        while($y = mysqli_fetch_assoc($results)) {
                                            $all_issues= $all_issues + $y['Count_user_user_id'];
                                        }
                                        echo "Total issues in ".date('M', strtotime('-1 month'))." ".date('n', strtotime('-1 month'))."/".date('Y')." is : ".$all_issues
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <?php
        include_once "layout/footer.php";
        ?>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!--Menu sidebar -->
<script src="js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- Chart JS -->
<script src="assets/plugins/c3-master/c3.min.js"></script>
<script src="assets/plugins/d3/d3.min.js"></script>
<!-- ============================================================== -->
<script>

    var chart = c3.generate({
        bindto: "#chart1",
        data: {
            columns: [
                <?php
                $query = "SELECT
  Coalesce(Count(user_has_issue_in_group_at_pros.user_user_id), 0) AS Count_user_user_id,
  issue.issue_name
FROM
  user_has_issue_in_group_at_pros
  INNER JOIN issue ON user_has_issue_in_group_at_pros.issue_issue_id = issue.issue_id
WHERE
  Month(user_has_issue_in_group_at_pros.date) = Month(CURRENT_DATE())
GROUP BY
  issue.issue_name";
                $results=mysqli_query($con, $query);
                while($y = mysqli_fetch_assoc($results)) {
                    echo "['".$y['issue_name']."','".$y['Count_user_user_id']."'],";
                }
                ?>

            ],
            type: 'donut',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        donut: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });
    var chart = c3.generate({
        bindto: "#chart2",
        data: {
            columns: [
                <?php
                $query = "SELECT
  Coalesce(Count(user_has_issue_in_group_at_pros.user_user_id), 0) AS Count_user_user_id,
  issue.issue_name
FROM
  user_has_issue_in_group_at_pros
  INNER JOIN issue ON user_has_issue_in_group_at_pros.issue_issue_id = issue.issue_id
WHERE
  Month(user_has_issue_in_group_at_pros.date) = Month(DATE_SUB(CURRENT_DATE(),INTERVAL 1 MONTH))
GROUP BY
  issue.issue_name";
                $results=mysqli_query($con, $query);
                while($y = mysqli_fetch_assoc($results)) {
                    echo "['".$y['issue_name']."','".$y['Count_user_user_id']."'],";
                }
                ?>

            ],
            type: 'donut',
            empty: {
                label: {
                    text: "No Data Available"
                }
            }
        },
        donut: {
            label: {
                format: function(value, ratio, id) {
                    return value;
                }
            }
        }
    });

</script>

</body>
</html>