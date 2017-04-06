<?php  error_reporting(0); ?>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Customer Reports</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Registered Customer List With Location</a></li>
            <li class="active">List of Customer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Customer</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                        <a href="<?php echo base_url(); ?>reports/downloadcustdata/<?php echo $sellocation; ?>" target="_blank"> <button class="btn btn-block btn-primary btn-sm">Download Report</button></a>                                    
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
				
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Customer Name</th>
					  <th>Manufacturer Name</th>
					  <th>Email</th>
                      <th>Location</th>
                      <th>Contact No</th>
                      <th>Inquiry Type</th>
					  <th>Inquiry Date</th>
					  <th>Detail</th>
                    </tr>
                    <?php $i=0; foreach($viewdata as $item) {
					$manufacture = $this->inquiryModel->getmanufactuinfo($item->mid);
					$pro = $this->inquiryModel->get_maufacturer_by_pid($item->pid);
				    $clientinfo = $this->inquiryModel->getmanufactuinfo($pro->manufacture_id);
					
					
					
                    ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><?php echo $item->name; ?></td> 
					  <td><span class="label label-default"><?php   if(count($clientinfo) == 0) { ?><?php echo $manufacture->company_name;  ?> <?php }else {   echo $clientinfo->company_name;}   ?></span></td>
					  <td><?php echo $item->email; ?></td> 
                      <td><?php echo $item->city; ?></td>
                      <td><?php echo $item->mobile; ?></td>
                      <td><?php echo $item->inquiry_type; ?></td>
					  <td><?php echo $item->inquirydate; ?></td>
					  <td><?php echo $item->details; ?></td>
                    </tr>
                    <?php $i++; } ?>
                   
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
