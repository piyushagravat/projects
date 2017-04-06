<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Sub-Sub-Categories
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>subsubcategories">Manage Sub-Sub-Categories</a></li>
            <li class="active">Add New Sub-Sub-Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Sub-Sub-Categories</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."subsubcategories/addrecord"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                  
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtsubsubcatname" placeholder="Enter Categories Name" value="<?php echo set_value('txtsubsubcatname')?>">
                      <?php if(form_error('txtsubsubcatname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtsubsubcatname'); ?></div><?php } ?>
                    </div>
                   <?php if($list->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="txtcategories" onchange="selectSubcategories(this.options[this.selectedIndex].value)">
                              <option value="-1">Select Categories</option>
                              <?php
                              foreach($list->result() as $listElement){
                                      ?>
                                      <option value="<?php echo $listElement->cid?>"><?php echo $listElement->cname?></option>
                                      <?php
                              }
                              ?>
                        </select>
                      </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category</label>
                      <select class="form-control" name="txtsubcategories" id="state_dropdown" onchange="selectSubsubcategories(this.options[this.selectedIndex].value)">
                            <option value="0">Select Sub-Categories</option>
                      </select>
                    <span id="state_loader"></span>
                    </div> 
                    <?php } else { echo 'No Categories Found'; } ?> 
                     <div class="form-group">
                      <label for="exampleInputFile">Upload Image(Max 500 x 500px)</label>
                      <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                      <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                    </div> 
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->         

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
            
                                      