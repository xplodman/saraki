<!DOCTYPE html>
<html lang="en" dir="">
<?php
$pageTitle = 'Transaction profile';
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
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-10 align-self-center">
                    <h3 class="text-themecolor">Transaction profile</h3>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- search form -->
            <!-- ============================================================== -->
            <?php
            $transaction_query="
SELECT
  user.user_id,
  user.user_name,
  `group`.group_id,
  `group`.group_name,
  issue.issue_id,
  issue.issue_name,
  pros.pros_id,
  pros.pros_name,
  DATE_FORMAT(user_has_issue_in_group_at_pros.date, '%e/%c/%Y') AS date  
FROM
  user_has_issue_in_group_at_pros
  INNER JOIN `group` ON user_has_issue_in_group_at_pros.group_group_id = `group`.group_id
  INNER JOIN issue ON user_has_issue_in_group_at_pros.issue_issue_id = issue.issue_id
  INNER JOIN pros ON user_has_issue_in_group_at_pros.pros_pros_id = pros.pros_id
  INNER JOIN user ON user_has_issue_in_group_at_pros.user_user_id = user.user_id
WHERE
  user_has_issue_in_group_at_pros.user_user_id = $_GET[user_id] AND
  user_has_issue_in_group_at_pros.issue_issue_id = $_GET[issue_id] AND
  user_has_issue_in_group_at_pros.pros_pros_id = $_GET[pros_id] AND
  user_has_issue_in_group_at_pros.group_group_id = $_GET[group_id]";?>
            <!-- ============================================================== -->
            <!-- end of search form -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <a class="collapse-link" data-toggle="collapse" data-target="#search">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Record info</h4>
                            </div>
                        </a>
                        <div class="card-body">
                            <?php
                            $result = mysqli_query($con, $transaction_query);
                            $transaction_info = mysqli_fetch_assoc($result);
                            ?>
                            <form method="post" action="php/edit_transaction.php?old_group_id=<?php echo $transaction_info['group_id'] ?>&old_user_id=<?php echo $transaction_info['user_id'] ?>&old_pros_id=<?php echo $transaction_info['pros_id'] ?>&old_issue_id=<?php echo $transaction_info['issue_id'] ?>">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Prosecution</label>
                                                <select required name="pros_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <?php
                                                    $query = "SELECT
  pros.pros_id,
  pros.pros_name
FROM
  pros";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $prosecution){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($prosecution)) {
                                                                if((int)$transaction_info['pros_id'] == (int)$prosecution['pros_id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $prosecution["pros_id"];?>"><?php echo $prosecution["pros_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-danger">
                                                <label class="control-label">User</label>
                                                <select required name="user_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <?php
                                                    $query = "SELECT
  user.user_id,
  user.user_name
FROM
  user";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $user){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($user)) {
                                                                if((int)$transaction_info['user_id'] == (int)$user['user_id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $user["user_id"];?>"><?php echo $user["user_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Issue</label>
                                                <select required name="issue_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <?php
                                                    $query = "SELECT
  issue.issue_id,
  issue.issue_name
FROM
  issue";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $issue){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($issue)) {
                                                                if((int)$transaction_info['issue_id'] == (int)$issue['issue_id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $issue["issue_id"];?>"><?php echo $issue["issue_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Group</label>
                                                <select required name="group_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <?php
                                                    $query = "SELECT
  `group`.group_id,
  `group`.group_name
FROM
  `group`";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $group){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($group)) {
                                                                if((int)$transaction_info['group_id'] == (int)$group['group_id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $group["group_id"];?>"><?php echo $group["group_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <label class="control-label">date</label>
                                                <input autocomplete="off" required type="text" name="date" id="receive_date" class="form-control date_autoclose filters" placeholder="date" value="<?php echo $transaction_info['date'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <?php
        include_once "layout/footer.php";
        include_once "layout/modals.php";
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
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- This is data table -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="assets/plugins/toast-master/js/jquery.toast.js"></script>

<!-- Bootstrap Duallistbox -->
<script src="assets/plugins/bootstrap-duallistbox/bootstrap-duallistbox.js"></script>

<!-- Date Picker Plugin JavaScript -->
<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<!-- end - This is for export functionality only -->
<script>
    $('#datatable').DataTable({
        aaSorting: [ ],
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        } ],
        columnDefs: [ {
            visible: false,
            targets:   -2
        } ]
    });

    // DataTable
    var table = $('#datatable').DataTable();
</script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function () {
        $(".select2").select2({
        });
        // Add event listener for opening and closing details
        $('#datatable').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
    });
</script>
<?php
include_once "layout/common_script.php";
?>
</body>
</html>