<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Manufacturers</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>users">Manage Manufacturers</a></li>
            <li class="active">List of Manufacturers</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Manufacturers</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>manufacturer/add"> <button class="btn btn-block btn-primary btn-sm">Add New Manufacturer</button></a>
                      
                    </div>
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
<!--                      <th>Role</th>-->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    <?php $i=0; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><?php echo $item->first_name." ".$item->last_name; ?></td>
                      <td><?php echo $item->email; ?></td>
                      <td><?php echo $item->company_name; ?></td>
                      <td><?php echo $item->contact; ?></td>
                      <th><?php if($item->status == "Inactive") { ?> <a href="<?php echo base_url(); ?>manufacturer/action/<?php echo $item->id; ?>/Active"><span class="label label-success">Active</span></a><?php } else { ?><a href="<?php echo base_url(); ?>manufacturer/action/<?php echo $item->id; ?>/Inactive"><span class="label label-danger">Inactive</span></a><?php } ?></span></a></th>
                      <th><a href="<?php echo base_url(); ?>manufacturer/delete/<?php echo $item->id; ?>" onclick="return confirm('Are you sure? All related data will be permanently removed.')"><span class="label label-danger">Delete</span></a> &nbsp; <a href="<?php echo base_url(); ?>manufacturer/edit/<?php echo $item->id; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
                    </tr>
                    <?php $i++;} ?>
                   
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