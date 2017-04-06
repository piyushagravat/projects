<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Product Images</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>product">Manage Products Images</a></li>
            <li class="active"><?php  echo $product->pname; ?> - List of Prodcut Images</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $product->pname; ?> - List of Product Images</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  
				  <?php 
					if (count($viewdata) < 5) { ?> <div class="box-tools"> <div class="input-group"> <a href="<?php echo base_url(); ?>product/add_images/<?php echo $product->pid; ?>"> <button class="btn btn-block btn-primary btn-sm">Add New Product Images</button></a> </div> </div> <?php } else { ?> <?php } ?> 
				  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Product Images</th>
                      <th>Action</th>
                    </tr>
                    <?php $i = 0; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i+1;; ?></td>
                      <th><img src="<?php echo base_url(); ?>images/products/<?php echo $item->img; ?>" width="100px"  /></th>
                      <th><a href="<?php echo base_url(); ?>product/delete_image/<?php echo $item->id; ?>/<?php echo $product->pid; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>
                      
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