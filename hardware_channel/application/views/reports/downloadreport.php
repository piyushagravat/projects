<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="UTF-8">
    <title>GL Paid Ads | Dashboard</title>
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-collapse">
    <div class="wrapper">
      
      
      <!-- Left side column. contains the logo and sidebar -->
 <?php $ads = $this->adsModel->get_by_id($adsaid)->row();	?>     
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $ads->ads_name; ?> Report</h3>
                 	
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                  <tr>
                      <th>ID</th>
                      <th>IP Address</th>
                      <th>Host</th>
                      <th>Country</th>
                      <th>State</th>
                      <th>City</th>
                      <th>Browser</th>
                      <th>Platform</th>
                      <th>Date</th>
                      <th>Time</th>
                    </tr>
                  <?php $i = 1; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $item->ipaddress; ?></td>
                      <td><?php echo $item->host; ?></td>
                      <td><?php echo $item->country; ?></td>
                      <td><?php echo $item->state; ?></td>
                      <td><?php echo $item->city; ?></td>
                      <td><?php echo $item->browser; ?></td>
                      <td><?php echo $item->platform; ?></td>
                      <td><?php echo $item->date; ?></td>    
                      <td><?php echo $item->time; ?></td>                      
                    </tr>
                    <?php $i++; } ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
      
    
    </div><!-- ./wrapper -->


   
    
  </body>
</html>
 <?php $filename = "GL_Ads_" . date('Ymd') . ".xls"; 
 		header("Content-Disposition: attachment; filename=\"$filename\"");
 		header("Content-Type: application/vnd.ms-excel");
  ?>