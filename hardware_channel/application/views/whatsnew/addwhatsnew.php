<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Whats New Products
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>product">Manage Products</a></li>
            <li class="active">Add Whats New Product</li>
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
                  <h3 class="box-title">Add Whats New Products</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."whatsnew/addrecord"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                   <input type="hidden" name="manufacture_id" value="<?php echo $Manufacture->manufacture_id; ?>"  /> 
                    <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtproductname" placeholder="Enter Product Name" value="<?php echo set_value('txtproductname')?>">
                      <?php if(form_error('txtproductname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtproductname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Product Banner Image</label>
                      <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                      <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Product Full Screen Image</label>
                      <input type="file" class="form-control" name="userfile2" id="userfile2" size="20" />  
                      <?php if(form_error('userfile2') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile2'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Start Date</label>
                      <input type="text" class="form-control" id="seldate"  name="txtstartdate" placeholder="Start Date" value="<?php echo set_value('txtstartdate')?>">
                      <?php if(form_error('txtstartdate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtstartdate'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product End Date</label>
                      <input type="text" class="form-control" id="joindate"  name="txtenddate" placeholder="End Date" value="<?php echo set_value('txtenddate')?>">
                      <?php if(form_error('txtenddate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtenddate'); ?></div><?php } ?>
                    </div>  
                    <div class="form-group">
                      <label>Select Manufacture</label>
                      <select name="selclient" id="selclient" class="form-control">
                      <option value="0">Please Select One Manufacture</option>
                      <?php   foreach($Manufacture as $item){ ?>
                        <option value="<?php echo $item->id; ?>"><?php echo $item->company_name; ?></option>
                        <?php } ?>
                      <option value="----">None</option> 
                      </select>
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
            
                                      