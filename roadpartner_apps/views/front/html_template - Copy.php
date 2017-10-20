<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($title)) ? $title :"Welcome to road partner !" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.10.2.js"></script>
	<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/jquery.datetimepicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/jquery.timepicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <style type="text/css">
        .navbar-inverse {
            background-color: #fff;
            border-color: #18badf;
        }
        .error {
            color: #ff0000;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <?php $this->load->view('front/include/header'); ?>
    <div class="container">
        {msg_content}
        {content}
		<!--</div>--> <!-- /#page-wrapper -->
    </div>
    <?php $this->load->view('front/include/footer'); ?>
	 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAe7tyNmgVITbsyiKpGViR_Czuwer5lp04"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/jquery.datetimepicker.full.min.js"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>my-assets/front/js/custom.js"></script>
</body>
</html>