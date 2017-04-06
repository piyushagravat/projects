<?php  error_reporting(0); ?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Registered Customer List With Location</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Customer</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
				<style type="text/css">
				.box-body div{display:none;}
				</style>
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
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
 <?php $filename = "Register_Customer_withlocation_" . date('Ymd') . ".xls"; 
 		header("Content-Disposition: attachment; filename=\"$filename\"");
 		header("Content-Type: application/vnd.ms-excel");
  ?>