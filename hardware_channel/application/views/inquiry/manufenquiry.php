<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manufacturer Enquiries</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Manufacturer Enquiries</a></li>
            <li class="active">List of Manufacturer Enquiries</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Manufacturer Enquiries</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
					  <th>Manufacturer Company </th>
                      <th>User Name</th>
					  <th>Email</th>
                      <th>City</th>
					  <th>State</th>
                      <th>Country</th>
                      <th>Mobile No.</th>
					  <th>Enquiries Date</th>
                      <th>Details</th>
                      <th>Action</th>
                    </tr>
                    <?php $i = 1; 
					foreach($viewdata as $item) {
					      $clientinfo = $this->inquiryModel->get_user_by_id($item->mid)->row();
                    ?>
                    <tr>
                      <td><?php echo $i+$num;  ?></td>
					   <td><?php if(count($clientinfo) == 0) { ?><?php echo "-------" ?><?php }else {  echo $clientinfo->company_name; }   ?></td>
					  <td><?php echo $item->name; ?></td>
					  <td><?php echo $item->email; ?></td>
					  <td><?php echo $item->city; ?></td>
                      <td><?php echo $item->state; ?></td>
                      <td><?php echo $item->country; ?></td>
                      <td><?php echo $item->mobile; ?></td>
					  <td><?php echo $item->inquirydate; ?></td>
                      <td><?php echo $item->details; ?></td>                      
                      <th><a href="<?php echo base_url(); ?>inquiry/delete_manuf/<?php echo $item->id; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Remove Enquiry</span></a></th>
                      
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