<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Whatsnew Product Full Screen Images</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>whatsnew">Manage Whatsnew Images</a></li>
            <li class="active"><?php  echo $whatsnew->pname; ?> - List of Whatsnew Product Full Screen Images</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $whatsnew->pname; ?> - List of Whatsnew Product Full Screen Images</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>whatsnew/add_images/<?php echo $whatsnew->id; ?>"> <button class="btn btn-block btn-primary btn-sm">Add New Full Screen Images</button></a>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Product Full Screen Images</th>
                      <th>Action</th>
                    </tr>
                    <?php $i = 0; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <th><img src="<?php echo base_url(); ?>images/whatsnewproduct/<?php echo $item->img_name; ?>" width="100px"  /></th>
                      <th><a href="<?php echo base_url(); ?>whatsnew/delete_image/<?php echo $item->id; ?>/<?php echo $whatsnew->id; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>
                      
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