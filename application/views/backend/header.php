
<!doctype html>
<html lang="en">

<head>

	<title>
		<?php echo isset($title) ? "Wayan Susena :: " . $title : "Dashboard"; ?>
	</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('static/assets/'); ?>/img/ws.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">



	<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/bootstrap-datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/summernote.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/select2-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/chartist.min.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/vendor/chartist/css/chartist-custom.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/icon-font.min.css">


	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url('static/'); ?>assets/css/bootstrap-dashboard.css">

	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	
	<!-- DATE PICKER -->
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Minified JS library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Minified Bootstrap JS -->


<link href="<?php echo base_url('static/'); ?>assets/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="<?php echo base_url('static/'); ?>assets/datepicker/js/bootstrap-datetimepicker.min.js"></script>

</head>

<body>

	<!-- WRAPPER -->
	<div id="wrapper">

		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand" style="margin-right: 50px;">
				<a href="#" style="font-size: 18px; font-weight: bold; color: #555;">PROJECT</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php 
							if ($this->session->userdata('ses_foto') != NULL)
							{ 
							?>
							<img src="<?php echo base_url('static/photos/operator/'); ?><?php echo $this->session->userdata('ses_foto'); ?>" class="img-circle" width="700" alt="Get Biger Image">
							<?php 
							} 
							else 
							{
							?>
							<img src="<?php echo base_url('static/'); ?>assets/img/default-user.png" class="img-circle" alt="Avatar">
							<?php
							} 
							?>
							
							
							 <span><?php echo $this->session->userdata('ses_userid'); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<?php if(empty($this->session->userdata('ses_cid'))):?> <li><a href="<?php echo base_url('manage/operator/gantipwd'); ?>"><i class="lnr lnr-cog"></i> <span>Ganti Password</span></a></li>
								<li><a href="<?php echo base_url('logout'); ?>"><i class="lnr lnr-exit"></i> <span>Keluar</span></a></li>
							
								<?php endif; ?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->

		<!-- LEFT SIDEBAR -->
		
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<?php if($this->session->userdata('ses_admin')=='1' || $this->session->userdata('ses_admin')=='2'):?>
						<li>
							<a href="<?php echo base_url('manage'); ?>"<?php echo ($menu == 'dashboard') ? ' class="active"' : ''; ?>>
								<i class="lnr lnr-home"></i> <span>D A S H B O A R D</span>
							</a>
						</li>
						
						<?php endif; ?>
						
						<?php if($this->session->userdata('ses_admin')=='1'):?>
						<li>
							<a href="<?php echo base_url('manage/project'); ?>"<?php echo ($menu == 'project') ? ' class="active"' : ''; ?>>
								<i class="lnr lnr-star"></i> <span>DATA PROJECT</span>
							</a>
						</li>
						<?php endif;?>
						
						<?php if($this->session->userdata('ses_admin')=='1' || $this->session->userdata('ses_admin')=='2'):?>
						<li class="treeview">
						  <a href="<?php echo base_url('manage/itemproject'); ?>"<?php echo ($menu == 'itemproject') ? ' class="active"' : ''; ?>">
							<i class="fa fa-edit"></i> <span>ITEM PROJECT</span>
							<span class="pull-right-container">

							</span>
						  </a>
						  
						 </li>
						<?php endif;?>
						
						<li class="treeview">
						  <a href="<?php echo base_url('manage/docproject'); ?>"<?php echo ($menu == 'docproject') ? ' class="active"' : ''; ?>">
							<i class="fa fa-edit"></i> <span>FOTO PROJECT</span>
							<span class="pull-right-container">

							</span>
						  </a>
						  
						 </li>
						
						
						<?php if($this->session->userdata('ses_admin')=='1'):?>
						<li>
							<a href="<?php echo base_url('manage/operator'); ?>"<?php echo ($menu == 'operator') ? ' class="active"' : ''; ?>>
								<i class="lnr lnr-star"></i> <span>S I S T E M</span>
							</a>
						</li>
						<?php endif;?>
						
						
						
						<?php if(!empty($this->session->userdata('ses_admin'))):?>
						<li>
							<a href="<?php echo base_url('logout'); ?>"<?php echo ($menu == 'logout') ? ' class="active"' : ''; ?>>
								<i class="lnr lnr-home"></i> <span>K E L U A R</span>
							</a>
						</li>
						<?php endif; ?>

					</ul>
					
				</nav>
				
			</div>
			
		</div>
		
		<!-- END LEFT SIDEBAR -->

		<!-- MAIN -->
		<div class="main">

			<!-- MAIN CONTENT -->
			<div class="main-content">

				<div class="container-fluid">
