<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

       
        
        
        
        
        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
            <div class="row">
            <div class="col-md-8">
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
                        
                          <?php $i=0; foreach($viewdata as $item) { ?>
                          <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $item->first_name." ".$item->last_name; ?></td>
                            <td><?php echo $item->email; ?></td>
                            <td><?php echo $item->company_name; ?></td>
                            <td><?php echo $item->contact; ?></td>
                            <td><?php echo $item->created_date; ?></td>
                            
                          </tr>
                          <?php $i++; } ?>
                          
                          
                          <tr>
                          <td><a href="pages/examples/invoice.html">OR9842</a></td>
                          <td>2</td>
                          <td><span class="label label-success">12-7-2015</span></td>
                          <td><div class="sparkbar" data-color="#00a65a" data-height="20">High</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR1848</a></td>
                          <td>5</td>
                          <td><span class="label label-warning">Pending</span></td>
                          <td><div class="sparkbar" data-color="#f39c12" data-height="20">High</div></td>
                        </tr>
                        <tr>
                          <td><a href="pages/examples/invoice.html">OR7429</a></td>
                          <td>15</td>
                          <td><span class="label label-danger">12-7-2015</span></td>
                          <td><div class="sparkbar" data-color="#f56954" data-height="20">Low</div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-4">
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
