<?php
$treeview = $this->session->userdata("tree1");
// $treeview2 = $this->session->userdata("tree2");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>E-Aspiration | PGAS Solution</title>

	<link rel="icon" href="<?php echo base_url()?>/assets/dist/img/favicon.ico" type="image/ico">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/morris.js/morris.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<!-- <link rel="stylesheet" href="/css/master.css"> -->
</head>
<input type="hidden" name="nipg" id="nipg" value="<?php echo $this->session->userdata("nipg"); ?>">

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="#" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>PGAS</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>E-Aspiration</b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>

      </a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="<?php echo base_url('logout'); ?>"><span class="fa fa-sign-out"></span> Sign out</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url()?>assets/dist/img/favicon.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>
							<?php echo $this->session->userdata("name"); ?>
						</p>
						<p>
							<?php echo $this->session->userdata("nama_divisi"); ?>
						</p>
					</div>
				</div>
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">Navigation</li>
					<li class="<?php if($treeview == "kuesioner"){echo "active";} ?>">
						<a href="<?php echo base_url('daftar_kuesioner'); ?>">
							<i class="fa fa-check-square-o"></i>
							<span>Kuesioner</span>
						</a>
					</li>
					<li class="<?php if($treeview == "saran"){echo "active";} ?>">
						<a href="<?php echo base_url('kritik-saran'); ?>">
						<i class="fa fa-envelope"></i>
						<span>Kritik & Saran</span>
						</a>
					</li>
					<li class="<?php if($treeview == "password"){echo "active";} ?>">
						<a href="<?php echo base_url('password'); ?>">
		        	<i class="fa fa-lock"></i>
		        	<span>Ganti Password</span>
        		</a>
					</li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>
