<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Whats New Products
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>ads"> Manage Whats New Products</a></li>
            <li class="active">Edit Whats New Products</li>
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
                  <h3 class="box-title">Edit Whats New Products</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."whatsnew/updaterecordbyid"; ?>"  enctype="multipart/form-data">
                   <input type="hidden" name="id" value="<?php echo $editdata->id; ?>" />
					<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />				   
                   <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtproductname" placeholder="Enter Product Name" value="<?php echo $editdata->pname; ?>">
                      <?php if(form_error('txtproductname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtproductname'); ?></div><?php } ?>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Ads Banner Image (300 x 300)</label>
                     <input type="hidden" name="userfile1old" value="<?php echo $editdata->product_image1;  ?>"  />
                     <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                     <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                     <strong>Image :</strong><br /><img src="<?php echo base_url(); ?>images/whatsnewproduct/<?php echo $editdata->product_image1; ?>" width="150px">	
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Ads Full Screen Image (600 x 240)</label>
                     <input type="hidden" name="userfile2old" value="<?php echo $editdata->product_image2;  ?>"  />
                     <input type="file" class="form-control" name="userfile2" id="userfile2" size="20" />  
                     <?php if(form_error('userfile2') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile2'); ?></div><?php } ?>
                     <strong>Image :</strong><br /><img src="<?php echo base_url(); ?>images/whatsnewproduct/<?php echo $editdata->product_image2; ?>" width="150px">	
                    </div>   
                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Start Date</label>
                      <input type="text" class="form-control" id="seldate"  name="txtstartdate" placeholder="Start Date" value="<?php echo $editdata->startdate; ?>">
                      <?php if(form_error('txtstartdate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtstartdate'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product End Date</label>
                      <input type="text" class="form-control" id="joindate"  name="txtenddate" placeholder="End Date" value="<?php echo $editdata->enddate; ?>">
                      <?php if(form_error('txtenddate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtenddate'); ?></div><?php } ?>
                    </div>  
                    <div class="form-group">
                      <label>Select Manufacture</label>
                      <select name="selclient" class="form-control">
                      	<?php if($editdata->clientid == 0) { ?>
                        <option value="0">Please Select One Manufacture</option>
                        <?php } ?>
                        <?php foreach($Manufacture as $item){ ?>
                        
                        <option value="<?php echo $item->id; ?>" <?php if($editdata->manufacture_id == $item->id) { ?> selected="selected" <?php } ?> ><?php echo $item->company_name; ?></option>
                        <?php } ?>
                      </select>
                    </div> 
					 <div class="form-group">
                      <label for="exampleInputEmail1">Detail</label>
                        <textarea class="form-control" id="txtdetail" name="txtdetail" placeholder="Enter Detail" ><?php echo $editdata->detail; ?></textarea>
                        <?php if(form_error('txtdetail') != ''){ ?><div class="alert-danger"><?php echo form_error('txtdetail'); ?></div><?php } ?>
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
            
                                      										 