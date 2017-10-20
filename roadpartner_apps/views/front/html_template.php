<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($title)) ? $title :"Welcome to road partner !" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Javascript -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/bootstrap/js/bootstrap.min.js"></script>
   <!-- <script src="<?php /*echo base_url(); */?>assets/admin/js/jquery-1.10.2.js"></script>
	<link href="<?php /*echo base_url(); */?>assets/front/css/bootstrap.min.css" rel="stylesheet">-->
	<link href="<?php echo base_url(); ?>my-assets/front/css/jquery.datetimepicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/jquery.timepicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/form-elements.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <style type="text/css">
        .navbar-inverse {
            background-color: #fff;
            border-color: #18badf;
        }
        .error {
            color: #ff0000;
            font-size: 12px;
        }
        label {
            color: #42bfc2;
            font-weight: bolder !important;
        }
    </style>
</head>
<body>
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <?php $this->load->view('front/include/header'); ?>
                {msg_content}
                {content}
            </div>
        </div>
    </div>
    <?php $this->load->view('front/include/footer'); ?>
	 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="<?php /*echo base_url(); */?>assets/admin/js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAe7tyNmgVITbsyiKpGViR_Czuwer5lp04"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/jquery.datetimepicker.full.min.js"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/custom.js"></script>

    <!-- Javascript -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.backstretch.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/scripts.js"></script>
    <!--[if lt IE 10]>
    <script src="assets/js/placeholder.js"></script>
    <![endif]-->
    <!-- Set background image -->
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $.backstretch("<?php echo base_url(); ?>assets/front/img/backgrounds/1.jpg");
        });
    </script>
</body>
</html>