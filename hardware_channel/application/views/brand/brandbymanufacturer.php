<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Brand</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>brand">Manage Brand</a></li>
            <li class="active">List of Brand Name</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Brand</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                    <a href="<?php echo base_url(); ?>brand/add"> <button class="btn btn-block btn-primary btn-sm">Add New Brand</button></a>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Brand Name</th>
					  <th>Manufacturer</th>
					  <th>Action</th>
                    </tr>
                    <?php $i=1; foreach($viewdata as $item) { 
						 $clientinfo = $this->brandModel->get_user_by_id($item->mid)->row();
					?>
                    <tr>
                     <td><?php echo $i+$num; ?></td>
                      <td><?php echo $item->brandname; ?></td>
					  <td><?php echo $clientinfo->company_name; ?></td>
					  <th><a href="<?php echo base_url(); ?>brand/deletebymid/<?php echo $item->id; ?>/<?php echo $item->mid; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a> &nbsp; <a href="<?php echo base_url(); ?>brand/editbymid/<?php echo $item->id; ?>/<?php echo $item->mid; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
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