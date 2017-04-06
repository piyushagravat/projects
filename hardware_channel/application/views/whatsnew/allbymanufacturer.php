<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>What's New Products</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>whatsnew">What's New Products </a></li>
            <li class="active">List of What's New Product</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Whats New Products</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                   <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>whatsnew/add"> <button class="btn btn-block btn-primary btn-sm">Add New Products</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Product ID</th>
                      <th>What's New Product</th>
                      <th>Manufacturer Name</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                     <?php $i=0; foreach($viewdata as $item) { 
                            $cat = $this->WhatsnewModel->get_categories_list($item->id)->row();
                            $clientinfo = $this->WhatsnewModel->get_user_by_id($item->manufacture_id)->row();
		     ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><?php echo $item->pname; ?></td>
                       <td><?php if(count($clientinfo) == 0) { ?><?php echo "-------" ?><?php }else {  echo $clientinfo->company_name; }   ?></td>
                      <td><?php echo $item->startdate; ?></td>
                      <td><?php echo $item->enddate; ?></td>
                      <td><span class="label label-primary"><?php echo $item->status; ?></span></td>
                      <th><?php if($item->status == "Disable") { ?> <a href="<?php echo base_url(); ?>whatsnew/action1/<?php echo $item->id; ?>/Enable"><span class="label label-success">Enable Product ?</span></a><?php } else { ?><a href="<?php echo base_url(); ?>whatsnew/action1/<?php echo $item->id; ?>/Disable"><span class="label label-success">Disable Product ?</span></a><?php } ?> &nbsp; <a href="<?php echo base_url(); ?>whatsnew/deletebymid/<?php echo $item->id; ?>/<?php echo $item->manufacture_id; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to remove products from what's new?')"><span class="label label-danger">Delete</span></a>&nbsp; <a href="<?php echo base_url(); ?>whatsnew/editbyid/<?php echo $item->id; ?>/<?php echo $item->manufacture_id; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
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