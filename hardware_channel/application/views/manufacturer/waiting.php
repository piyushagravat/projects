<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Waiting For Approval</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>waiting">Waiting For Approval</a></li>
            <li class="active">List of Waiting for approval</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Waiting for approval</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Company Name</th>
					  <th>Contact No</th>
                      <th>Created Date</th>
                      <th>Status</th>
					  <th>View</th>
                      <th>Action</th>
                    </tr>
                    <?php $i =1; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i+$num; ?></td>
                      <td><?php echo $item->first_name." ".$item->last_name; ?></td>
                      <td><?php echo $item->email; ?></td>
                      <td><?php echo $item->company_name; ?></td>
                      <td><?php echo $item->contact; ?></td>
                      <td><?php echo $item->created_date; ?></td>
					  <th><?php  if($item->phase == "new_signup" ) { ?> <a href="<?php echo base_url(); ?>manufacturer/actiontwo/<?php echo $item->id; ?>/Approve" onclick="return confirm('Are you sure you want to Approved Manufacture?')"><span class="label label-success">Approve ?</span></a><?php } else { ?><a href="<?php echo base_url(); ?>manufacturer/actiontwo/<?php echo $item->id; ?>/Inapprove"><span class="label label-danger">Inapprove ?</span></a><?php } ?></span></a></th>
                      <th><a href="<?php echo base_url(); ?>product/productsmanufacturers/<?php echo $item->id;?>"><span class="label label-primary">View Products</a>
					   <a href="<?php echo base_url(); ?>dealer/dealerbymanufacturers/<?php echo $item->id;?>"><span class="label label-primary">View Dealer</span></a>
					  <a href="<?php echo base_url(); ?>brand/brandbymanufacturers/<?php echo $item->id;?>"><span class="label label-primary">View Brand</span></a>
                       <a href="<?php echo base_url();?>whatsnew/productbymanufacturers/<?php echo $item->id;?>"><span class="label label-primary">What's New Product</span></a></th>
                      <th><a href="<?php echo base_url(); ?>manufacturer/deletewaiting/<?php echo $item->id; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a> &nbsp; <a href="<?php echo base_url(); ?>manufacturer/editwaiting/<?php echo $item->id; ?>"><span class="label label-warning">Edit</span></a></th>  </tr>
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