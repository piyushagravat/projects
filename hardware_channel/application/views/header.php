<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="UTF-8">
    <title>Hardware | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterange picker -->
     <link href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

   
	 <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<script  type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/typeahead.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>dist/js/common.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>dist/js/common2.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>dashboard" class="logo"><b>Hardware Channel</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>images/avatar1.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $session_data["name"]; ?></span>
                </a>
                
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
              <img src="<?php echo base_url(); ?>images/avatar1.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $session_data["name"]; ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>              
            </li>
            
            <?php if($session_data["role"] == "Admin") { ?>
          
           <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Manage Manufacturer</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>manufacturer/inactive"><i class="fa fa-angle-right"></i>New Sign Ups</a></li>
				 <li><a href="<?php echo base_url(); ?>manufacturer/waiting"><i class="fa fa-angle-double-right"></i>Waiting For Approval</a></li>
                <li><a href="<?php echo base_url(); ?>manufacturer"><i class="fa fa-angle-double-right"></i>Approved Manufacturers</a></li>
              </ul>
            </li>
           
           <li><a href="<?php echo base_url(); ?>users"><i class="fa fa-user"></i>Manage User / Customer's</a></li>
           
           <li>
              <a href="<?php echo base_url(); ?>product">
                <i class="fa fa-shopping-cart"></i> <span>Manage Products</span>
              </a>
           </li>
           
           <li><a href="<?php echo base_url(); ?>ads"><i class="fa fa-folder-open-o"></i>Manage Advertise</a></li>
           <li><a href="<?php echo base_url(); ?>dealer"><i class="fa fa-folder-open-o"></i>Manage Dealers</a></li> 
           <li><a href="<?php echo base_url(); ?>brand"><i class="fa fa-folder-open-o"></i>Manage Brand</a></li> 
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gear"></i>
                <span>What's New</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>whatsnew"><i class="fa fa-angle-right"></i>Product</a></li>
                <li><a href="<?php echo base_url(); ?>event"><i class="fa fa-angle-double-right"></i>Events</a></li>
              </ul>
            </li>
           <li class="treeview">
              <a href="#">
                <i class="fa fa-folder-open-o"></i>
                <span>Manage Categories</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>categories"><i class="fa fa-angle-right"></i>Categories</a></li>
                <li><a href="<?php echo base_url(); ?>subcategories"><i class="fa fa-angle-double-right"></i>Sub-Categories</a></li>
                <li><a href="<?php echo base_url(); ?>subsubcategories"><i class="fa fa-angle-double-right"></i>Sub-Sub-Categories</a></li>
              </ul>
            </li>
           <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Enquiries</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>inquiry"><i class="fa fa-circle-o"></i>Advertisement Enquiries</a></li>
                <li><a href="<?php echo base_url(); ?>inquiry/productinquiry"><i class="fa fa-circle-o"></i>Product's Enquiries </a></li>
                <li><a href="<?php echo base_url(); ?>inquiry/whatsnewinquiry"><i class="fa fa-circle-o"></i>What's New Product Enquiries</a></li>
                <li><a href="<?php echo base_url(); ?>inquiry/manufeinquiry"><i class="fa fa-circle-o"></i>Manufacturer Enquiries</a></li>
				<li><a href="<?php echo base_url(); ?>inquiry/dealerinquiry"><i class="fa fa-circle-o"></i>Dealer Enquiries</a></li>
			  </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>reports/manufactureinquiry"><i class="fa fa-circle-o"></i>Manufacturer/Company List</a></li>
                <li><a href="<?php echo base_url(); ?>reports/customerlocation"><i class="fa fa-circle-o"></i>Registered Customer List</a></li>
                <li><a href="<?php echo base_url(); ?>reports/adsselectinquiry"><i class="fa fa-circle-o"></i>Advertisement Enquiries</a></li>
                 <li><a href="<?php echo base_url(); ?>reports/selwhatsnewinquiry"><i class="fa fa-circle-o"></i>What’s New Enquiries</a></li>
              </ul>
            </li>   
			<li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Pages</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>page/edit/5"><i class="fa fa-circle-o"></i>About Us</a></li>
                <li><a href="<?php echo base_url(); ?>page/edit/6"><i class="fa fa-circle-o"></i>Contact Us</a></li>
                 <li><a href="<?php echo base_url(); ?>page/edit/8"><i class="fa fa-circle-o"></i>Terms & Condition</a></li>
              </ul>
            </li>	
            <li><a href="<?php echo base_url(); ?>subscription"><i class="fa fa-user"></i>Manage Subscription</a></li>
            <?php } ?>
            <?php if($session_data["role"] == "Manufacture") { ?>
             <li>
              <a href="<?php echo base_url(); ?>product">
                <i class="fa fa-shopping-cart"></i> <span>Manage Products</span>
              </a>
           </li>
            
	    <?php } ?>
            
            <li>
              <a href="<?php echo base_url(); ?>setting">
                <i class="fa fa-gear"></i> <span>Account Settings</span>
              </a>
            </li>
            <li>
              <a href=" <?php echo base_url(); ?>welcome/logout">
                <i class="fa fa-power-off"></i> <span>Log Out</span>
              </a>
            </li>
          
        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>