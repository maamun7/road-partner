<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo (isset($title)) ? $title :"Admin Panel" ?></title>
        <meta name="description" content="@yield('meta_description', 'Default Description')">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">        
		<?php $this->load->view('admin/include/all_css_link'); ?>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
        <script type="text/javascript">
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        </script>
		<div class="wrapper">
			<!-- Header -->
			<header class="main-header">
				<!-- Logo -->
				<a href="<?php echo base_url();?>admin" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>A</b>LT</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>ROAD PARTNER</b> &nbsp; Admin</span>
				</a>
				{top_menus}
			</header>
			
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				{left_menus}
			</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">			
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1> {page_title} </h1>
					<!--- breadcrumbs --->
					{breadcrumb}
				</section>
				<!-- Main content -->
				<section class="content">
                    <!--Flash Message-->
                    {flash_message}
                    <!--Content-->
					{main_content}
				</section> <!-- /.content -->		
			</div><!-- /.content-wrapper -->
			<footer class="main-footer">
				<?php $this->load->view('admin/include/footer'); ?>
			</footer>
		</div><!-- ./wrapper -->
		<!-- Right sidebar for changing settings -->
		<?php $this->load->view('admin/include/right_sidebar'); ?>
		<!-- All JS Links -->
		<?php $this->load->view('admin/include/all_js_link'); ?>
	</body>
</html>