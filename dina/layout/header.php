<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-icon.png">
    <title><?php echo $pageTitle;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-duallistbox/bootstrap-duallistbox.css" rel="stylesheet">
    <!-- page css -->
    <link href="css/pages/login-register-lock.css" rel="stylesheet">
    <!-- select2 -->
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!-- page css -->
    <link href="assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="css/pages/widget-page.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- toast CSS -->
    <link href="assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <!--c3 CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<![endif]-->
    <style type="text/css">
        body{
            zoom: 90%;
        }
        input{
            text-align:center;
        }
        @font-face {
            font-family: "My Custom Font";
            src: url(assets/fonts/arabic.otf) format("truetype");
        }
        .c3 text {
            font-size:14px;
            font-family: "My Custom Font";
        }

        div , i , h1 , h2 , h3 , h4 , h5 , h6 {
            font-family: "My Custom Font";
        }
    </style>
    <style>
        @import url('css/jquery.dataTables.css');
        td.details-control {
            background: url('assets/images/icon/add.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('assets/images/icon/close.png') no-repeat center center;
        }
        td {
            white-space: nowrap;
        }

        td.wrapok {
            white-space:normal
        }
        .has-danger .select2-selection {
            border-color: #ef5350 !important;
        }
        .select2-results__options{
            font-family: "My Custom Font" !important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }
        div.dt-buttons {
            position: relative;
            float: left;
        }
        .blink{
            -webkit-animation: blink 600ms infinite alternate;
            -moz-animation: blink 600ms infinite alternate;
            -o-animation: blink 600ms infinite alternate;
            animation: blink 600ms infinite alternate;
        }
        @-webkit-keyframes blink {
            from { opacity:1; }
            to { opacity:0; }
        }
        @-o-keyframes blink {
            from { opacity:1; }
            to { opacity:0; }
        }
        @-moz-keyframes blink {
            from { opacity:1; }
            to { opacity:0; }
        }
        @keyframes blink {
            from { opacity:1; }
            to { opacity:0; }
        };
    </style>
</head>