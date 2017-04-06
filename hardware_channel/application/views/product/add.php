<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Products
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>product">Manage Products</a></li>
            <li class="active">Add New Product</li>
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
                  <h3 class="box-title">Add New Products</h3>
                </div><!-- /.box-header -->
                
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."product/addrecord"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtproductname" placeholder="Enter Product Name" value="<?php echo set_value('txtproductname')?>">
                      <?php if(form_error('txtproductname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtproductname'); ?></div><?php } ?>
                     </div>
                      <?php if($list->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="txtcategories" onchange="selectSubcategories(this.options[this.selectedIndex].value)">
                              <option value="">Select Categories</option>
                              <?php
                              foreach($list->result() as $listElement){
                                      ?>
                                      <option value="<?php echo $listElement->cid?>"><?php echo $listElement->cname?></option>
                                      <?php
                              }
                              ?>
                              <?php if(form_error('txtcategories') != ''){ ?><div class="alert-danger"><?php echo form_error('txtcategories'); ?></div><?php } ?>
                        </select>
                      </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category</label>
                      <select class="form-control" name="txtsubcategories" id="state_dropdown" onchange="selectSubsubcategories(this.options[this.selectedIndex].value)">
                            <option value="">Select Sub-Categories</option>
                      </select>
                      <?php if(form_error('txtsubcategories') != ''){ ?><div class="alert-danger"><?php echo form_error('txtsubcategories'); ?></div><?php } ?>
                    <span id="state_loader"></span>
                     
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub-Sub-Category</label>
                      <select class="form-control" name="txtsubsubcategories" id="city_dropdown">
                                <option value="">Select Sub-Sub-Categories</option>
                        </select>
                      
                        <span id="city_loader"></span>
                   
                       
                    </div>
                    <?php } else { echo 'No Categories Found'; } ?>  
                    
					 <?php  if($manufacturelist->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Manufacture</label>
                        <select class="form-control" name="selclient" onchange="selectBrand(options[this.selectedIndex].value)">
                              <option value="-1">Please Select One Manufacture</option>
                              <?php
                              foreach($manufacturelist->result() as $listElement){
                                      ?>
                                      <option value="<?php echo $listElement->id?>"><?php echo $listElement->company_name?></option>
                                      <?php
                              }
                              ?>
                        </select>
                        
                      </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Select Brand</label>
                      <select class="form-control" name="selbrand" id="brand_dropdown">
                            <option value="0">Please Select One Brand</option>
                      </select>
                    <span id="brand_loader"></span>
                    </div> 
                    <?php } else { echo 'No Data Found'; } ?> 
					
                    <div class="form-group">
                      <label for="exampleInputFile">Product Image (Min 800 x 400)</label>
                      <input type="file" class="form-control" name="userfile2" id="userfile2" size="20" />  
                      <?php if(form_error('userfile2') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile2'); ?></div><?php } ?>
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail1">Product Short Description</label>
                        <textarea class="form-control" id="txtdescription" name="txtshortdesc" placeholder="Enter Short Description" ><?php echo set_value('txtshortdesc');  ?></textarea>
                        <?php if(form_error('txtshortdesc') != ''){ ?><div class="alert-danger"><?php echo form_error('txtshortdesc'); ?></div><?php } ?>
                    </div>
                    
                    <!--                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="seltoaddprod" value="1" > Add Product in What's New Section
                      </label>
                    </div>-->
                    
                    
                    
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
            
                                      