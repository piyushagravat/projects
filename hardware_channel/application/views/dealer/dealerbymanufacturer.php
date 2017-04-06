<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Dealer</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>dealer">Manage Dealer</a></li>
            <li class="active">List of Dealer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Dealer</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>dealer/add"> <button class="btn btn-block btn-primary btn-sm">Add New Dealer</button></a>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Firm Name</th>
                      <th>Email</th>
                      <th>Contact No</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>Action</th>
                    </tr>
                    <?php $i=1; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo  $i+$num; ?></td>
                      <td><?php echo $item->firmname; ?></td>
                      <td><?php echo $item->email; ?></td>
                      <td><?php echo $item->mobileno; ?></td>
                      <td><?php echo $item->address1." ".$item->address2; ?></td>
                      <td><?php echo $item->city; ?></td>
                      <th><a href="<?php echo base_url(); ?>dealer/deletebymid/<?php echo $item->id; ?>/<?php echo $item->mid; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a> &nbsp; <a href="<?php echo base_url(); ?>dealer/editbymid/<?php echo $item->id; ?>/<?php echo $item->mid; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
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