<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Dealer Enquiries</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Dealer Enquiries</a></li>
            <li class="active">List of Dealer Enquiries</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Dealer Enquiries</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Dealer Name</th>
					  <th>Email</th>
					  <th>Brand Name</th>
					  <th>Manufacturer Name</th>
                      <th>Location</th>
					  <th>State</th>
                      <th>Mobile No.</th>
                      <th>Enquiry Date</th>
                      <th>Details</th>
                      <th>Action</th>
                    </tr>
                    <?php $i=1; foreach($viewdata as $item) {
						$dealer = $this->inquiryModel->get_dealer_by_id($item->did)->row();
						
						$brand = $this->inquiryModel->get_brand_by_id($dealer->brand_id)->row();
						$dealerfirmname = $this->inquiryModel->get_dealer_by_id($brand->id)->row();
						
						$clientinfo = $this->inquiryModel->get_user_by_id($item->mid)->row();
					
					?>
                    <tr>
                      <td><?php echo $i+ $num; ?></td>
					  <td><?php if(count($dealer) == 0) { ?><?php echo "-------" ?><?php }else {  echo $dealer->firmname; }   ?></td>
                      <td><?php echo $item->email; ?></td>
					  <td><?php if(count($brand) == 0) { ?><?php echo "-------" ?><?php }else {  echo $brand->brandname; }   ?></td>
					  <td><?php if(count($clientinfo) == 0) { ?><?php echo "-------" ?><?php }else {  echo $clientinfo->company_name; }   ?></td>
					  <td><?php echo $item->city; ?></td>
					  <td><?php echo $item->state; ?></td>
                      <td><?php echo $item->mobile; ?></td>
                      <td><?php echo $item->inquirydate; ?></td>
                      <td><?php echo $item->details; ?></td>                      
                      <th><a href="<?php echo base_url(); ?>inquiry/deletedealerinq/<?php echo $item->id; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Remove Enquiries</span></a></th>
                      
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