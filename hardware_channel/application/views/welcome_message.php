<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

    <!-- Main content -->
        <section class="content">
  
           <div class="row">
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-primary" style="padding: 10px;">
                <div class="inner">
                  <h3><?php echo $countinactive; ?></h3>
                  <p>New Signups</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fw fa-users"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow" style="padding: 1px 10px 0px 10px;">
                <div class="inner">
                  <h3><?php echo $waiting; ?></h3>
                  <p>Waiting for Approval</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fw fa-users"></i>
                </div>
              </div>
            </div><!-- ./col -->
             
            <div class="col-lg-2 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-teal color-palette" style="padding: 10px;">
                <div class="inner">
                  <h3><?php echo $subscriberscount; ?></h3>
                  <p>Daily Subscription</p>
                </div>
                <div class="icon">
                  <i class="fa fa-question"></i>
                </div>
              </div>
            </div><!-- ./col -->
             <div class="col-lg-2 col-xs-4" >
              <!-- small box -->
              <div class="small-box bg-aqua" >
                <div class="inner">
                  <h3><?php echo $countads; ?></h3>
                  <p>Today Advertisment Enquiry</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-4" >
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $countproduct; ?></h3>
                  <p>Today Products Enquiry</p>
                </div>
                <div class="icon">
                  <i class="fa fa-envelope-o"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-4">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $countwhatsnew; ?></h3>
                  <p>Today What's New Enquiry</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fw fa-user"></i>
                </div>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
                   


		 <!-- Info boxes -->
          
            <div class="col-md-12">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">New Sign Ups</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Company Name</th>
			              <th>Contact No.</th>
                          <th>Created Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($viewdata as $item) {
							  $count= $this->ManufacturerModel->get_product_list($item->id)->row();
							  if(count($count) == 0)
							{
						?>
                          <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><span class="label label-warning"><?php echo $item->first_name." ".$item->last_name; ?></span></td>
                            <td><?php echo $item->email; ?></td>
                            <td><?php echo $item->company_name; ?></td>
                            <td><?php echo $item->contact; ?></td>
                            <td><?php echo $item->created_date; ?></td>
                            </tr>
                          <?php $i++; 
						    }
						  } ?>
                        
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?php echo base_url(); ?>manufacturer/inactive" class="btn btn-sm btn-info btn-flat pull-right">View All New Sign Ups</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
           
          </div><!-- /.row -->
          
          
          <div class="row">
            <div class="col-md-12">
              <!-- USERS LIST -->
              <!--  <div class="box box-danger">
              <div class="box-header with-border">
              </div> 
              </div>/.box -->
            </div>
          </div><!-- /.row -->
		
          <!-- /.row -->

        
          </div>
       
          <!-- /.row -->
		</div>
        
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
