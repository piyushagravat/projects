<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manage Products</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>product">Manage Products</a></li>
            <li class="active">List of Product</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Products</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>product/add"> <button class="btn btn-block btn-primary btn-sm">Add New Products</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th width="5%">No</th>
<!--                      <th>Products Code</th>-->
                      <th width="12%">Product Name</th>
                      <th width="12%">Category</th>
                      <th width="12%">Sub-Category</th>
                      <th width="12%">Sub-Sub-Category</th>
                      <th width="15%">Detail</th>
                      <th width="12%">Product Images</th>
                      <th width="12%">Action</th>
                    </tr>
                     <?php $i=1; foreach($viewdata as $item) { 
					        $cat = $this->ProductModel->get_cat_by_id($item->cid)->row();
                            $subcat = $this->ProductModel->get_subcategories_list_by_id($item->subcat_id)->row();
                            $sscat = $this->ProductModel->get_subsubcategories_list_by_id($item->sscat_id)->row();
                            $clientinfo = $this->ProductModel->get_user_by_id($item->manufacture_id)->row();
		     ?>
                    <tr>
                      <td><?php echo $i+$num; ?></td>
                      <td><?php echo $item->pname; ?></td>
                      <td><?php if(count($cat) == 0) { ?><?php echo "-------" ?><?php }else {  echo $cat->cname;}   ?></td>
					  <td><?php if(count($subcat) == 0) { ?><?php echo "-------" ?><?php }else {  echo $subcat->subcat_name;}   ?></td>
                      <td><?php if(count($sscat) == 0) { ?><?php echo "-------" ?><?php }else { echo $sscat->ssname;}   ?></td>
                      <td><?php echo $item->pdetail; ?></td>
                      <th><a href="<?php echo base_url(); ?>product/viewimages/<?php echo $item->pid; ?>"><span class="label label-primary">View Product Images</span></a></th>
                      <th><a href="<?php echo base_url(); ?>product/deletebymid/<?php echo $item->pid; ?>/<?php echo $item->manufacture_id; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a> &nbsp; <a href="<?php echo base_url(); ?>product/editbymid/<?php echo $item->pid; ?>/<?php echo $item->manufacture_id; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
                    </tr>
                    <?php $i++; } ?>
                   
                    <tr>
                    <td colspan="7">
                        <div class="box-tools">
                            <div class="input-group">
                                <div class="box-tools">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                      <?php echo $pagination; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>