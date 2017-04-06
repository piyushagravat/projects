<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Sub-Sub-Categories Images</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>subsubcategories">Manage Sub-Sub-Categories Images</a></li>
            <li class="active"><?php  echo $subsubcategories->ssname; ?> - List of Sub-Sub-Categories Images</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $subsubcategories->ssname; ?> - List of Sub-Sub-Categories Images</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>subsubcategories/add_images/<?php echo $subsubcategories->sscat_id; ?>"> <button class="btn btn-block btn-primary btn-sm">Add New Sub-Sub-Categories Images</button></a>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Sub-Sub-Categories Images</th>
                      <th>Action</th>
                    </tr>
                    <?php $i = 0; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <th><img src="<?php echo base_url(); ?>images/categories/<?php echo $item->images; ?>" width="100px"  /></th>
                      <th><a href="<?php echo base_url(); ?>subsubcategories/delete_image/<?php echo $item->id; ?>/<?php echo $subsubcategories->sscat_id; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>
                      
                    </tr>
                    <?php $i++; } ?>
                   
                    <tr>
                    
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>