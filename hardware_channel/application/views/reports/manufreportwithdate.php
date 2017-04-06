<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manufacturer Reports</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Manufacturer Reports</a></li>
            <li class="active">List of Manufacturer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  
                  <?php if ( !empty($viewdata) ) { ?>
                  <h3 class="box-title">List of Manufacturer</h3>
                  <div class="box-tools">
                    <div class="input-group">
                        <a href="<?php echo base_url(); ?>reports/downloadmanufacture/<?php echo $txtstartdate ?>/<?php echo $txtenddate ?>/<?php echo $selmanufacture ?>" target="_blank"> <button class="btn btn-block btn-primary btn-sm">Download Report</button></a>                                    
                    </div>
                  </div>
                 
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Manufacture Name</th>
                      <th>Company Name</th>
					  <th>Email</th>
                      <th>Mobile No</th>
					  <th>Location</th>
					  <th>State</th>
					  <th>Enquiries Date</th>
					  <th>Enquiries Details</th>
                    </tr>
                    <?php $i=0; foreach($viewdata as $item) {  ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><span class="label label-default"><?php echo $item->first_name." ".$item->last_name; ?></span></td>
                      <td><?php echo $item->company_name; ?></td>
					  <td><?php echo $item->email; ?></td>                      
                      <td><?php echo $item->mobile; ?></td>
					  <td><?php echo $item->city; ?></td>
					  <td><?php echo $item->state; ?></td>
					  <td><?php echo $item->inquirydate; ?></td>					  
                      <td><?php echo $item->details; ?></td>
                    </tr>
                    <?php $i++; } ?>
                   
                  </table>
                </div><!-- /.box-body -->
                  <?php }else { ?>
                <h3 class="box-title">No Data Found.</h3>
                   <?php } ?>
                  
                  
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
