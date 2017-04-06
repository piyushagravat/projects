<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?php echo $ads->ads_name; ?> Report</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>reports">Ads Reports</a></li>
            <li class="active">List of Ads Reports</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                
                  <h3 class="box-title">Ads Click Reports</h3>
                  
                  <div class="box-tools">
                    <div class="input-group">
                          <a href="<?php echo base_url(); ?>reports/download/<?php echo $adsaid; ?>"> <button class="btn btn-block btn-primary btn-sm">Download Report</button></a>                 
                    </div>
                  </div>
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
                    <?php
					
					foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $item->id; ?></td>
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
                    <?php } ?>
                   
                    <tr>
                    <td colspan="7"><div class="box-tools">
                    <div class="input-group">
                      
                      <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                      <?php echo $pagination; ?>
                    </ul>
                  </div>
                    </div>
                  </div></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>