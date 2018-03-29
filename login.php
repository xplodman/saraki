<?php
include_once "assets/redi/sqlcon.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الحضور و الإنصراف | Login</title>
    <style>
        @font-face {
            font-family: myFirstFont;
            src: url(fonts/arabicfont.otf);
        }
        p,
        th,
        td,
        tr,
        span.arabic {
            font-family: myFirstFont;
        }


        .c3 text {
            font-size:16px;
            font-family: myFirstFont;
        }
    </style>

    <style type='text/css'>
        table {
            table-layout: fixed;
            /* nothing here - table is block, so should auto expand to as large as it can get without causing scrollbars? */
        }

        .left {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .middle {
            text-align: left;
            /* expand this column to as large as it can get within table? */
        }

        .wrap {
            word-wrap: break-word;
            /* use up entire cell this div is contained in? */
        }
    </style>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/c3/c3.min.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
    <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>
<style>
    #over1 {
        position: absolute;
    }
    #over2 {
        position: absolute;
    }
    #over3 {
        position: absolute;
    }
    #over4 {
        position: absolute;
    }
    .maxwidth {
        max-width: 100%;
        max-height: 100%;
    }
    .square {
        height: 267px;
        width: 267px;
    }
    @-webkit-keyframes blink {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
    @-moz-keyframes blink {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
    @-o-keyframes blink {
        0% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
    .blink {
        -webkit-animation: blink 1s;
        -webkit-animation-iteration-count: infinite;
        -moz-animation: blink 1s;
        -moz-animation-iteration-count: infinite;
        -o-animation: blink 1s;
        -o-animation-iteration-count: infinite;
    }
</style>
<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div class="col-lg-12 center">
            <div class="square" align="left">
                <img id="over1" src="img/test1.png" class="animated flip maxwidth" >
                <img id="over2" src="img/test2.png" class="animated flip maxwidth" >
                <img id="over3" src="img/test3.png" class="animated fadeInDownBig maxwidth" >
                <img id="over4" src="img/test4.png" class="animated slideInRight maxwidth blink" >
            </div>
        </div>
        <div class="col-lg-12">
			<form method="post" action="assets/redi/checklogin.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
                <button type="Submit"  name="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <?php
            if (isset($_GET['backresult'])){
                $backresult=$_GET['backresult'];
                if ($backresult ==  "0") {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Check your username and password.
                    </div>
                    <?php
                }elseif ($backresult ==  "7") {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Call system admin to assign a prosecution.
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

</div>
<div class="footer">
    <div>
        <strong>Copyright</strong> We.Code &copy; 2017
    </div>
</div>
<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>