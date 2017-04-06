<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Send Inquiry from Advertisements</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Send Inquiry From Advertisements</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                   <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
					  <th>Email</th>
                      <th>Ads Name</th>
                      <th>Location</th>
					  <th>State</th>
                      <th>Mobile No.</th>
                      <th>Inquiry Date</th>
                      <th>Details</th>
                    </tr>
                    <?php $i=0; foreach($viewdata as $item) {
					                     ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><?php echo $item->name; ?></td>
					  <td><?php echo $item->email; ?></td>
                      <td><?php echo $item->ads_name; ?></td>
                      <td><?php echo $item->city; ?></td>
					  <td><?php echo $item->state; ?></td>
                      <td><?php echo $item->mobile; ?></td>
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
 <?php $filename = "Send_Ads_Inquiry_" . date('Ymd') . ".xls"; 
 		header("Content-Disposition: attachment; filename=\"$filename\"");
 		header("Content-Type: application/vnd.ms-excel");
  ?>