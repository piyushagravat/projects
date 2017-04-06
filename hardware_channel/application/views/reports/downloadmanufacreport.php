<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manufacturer Enquiries Reports</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <!-- /.box-header -->
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
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
 <?php $filename = "Manufacturer_" . date('Ymd') . ".xls"; 
 		header("Content-Disposition: attachment; filename=\"$filename\"");
 		header("Content-Type: application/vnd.ms-excel");
  ?>