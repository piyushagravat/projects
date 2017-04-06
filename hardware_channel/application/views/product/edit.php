<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Product
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>product">Manage Product</a></li>
            <li class="active">Edit Product Details</li>
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
                  <h3 class="box-title">Edit Product</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."product/updaterecord"; ?>"  enctype="multipart/form-data">
                    <input type="hidden" name="pid" value="<?php echo $editdata->pid; ?>" /> 
                    <input type="hidden" name="subcat_id" value="<?php echo $editdata->subcat_id; ?>" /> 
					<input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
                   <div class="box-body">
                       <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtproductname" placeholder="Enter Product Name" value="<?php echo $editdata->pname; ?>">
                      <?php if(form_error('txtproductname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtproductname'); ?></div><?php } ?>
                    </div>
                     <?php if($list->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="txtcategories" onchange="selectSubcategoriesEditPro(this.options[this.selectedIndex].value)">
                              <option value="0">Select Categories</option>
                              <?php
                              foreach($list->result() as $listElement){
                                      ?>
                                      <option value="<?php echo $listElement->cid?>" <?php if($listElement->cid == $editdata->cid ) { ?> selected="selected" <?php } ?>><?php echo $listElement->cname; ?></option>
                                      <?php
                              }
                              ?>
                        </select>
                        
                      </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category</label>
                      <?php 
					  $this->load->model("ProductModel");	
					  $subcat = $this->ProductModel->get_subcat_by_cid($editdata->cid)->result();  	?>
                      
                      <select class="form-control" name="txtsubcategories" id="subcat_dropdown" onchange="selectSubsubcategoriesEditPro(this.options[this.selectedIndex].value)">
                            <option value="0">Select Sub-Categories</option>
                            <?php foreach($subcat as $item){  ?>
                            <option value="<?php echo $item->subcat_id?>" <?php if($item->subcat_id == $editdata->subcat_id ) { ?> selected="selected" <?php } ?>><?php echo $item->subcat_name; ?></option>
                            <?php } ?>
                      </select>
                    <span id="subcat_loader"></span>
                     
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub-Sub-Category</label>
                      
                      <?php 
					  $this->load->model("ProductModel");	
					  $subsubcat = $this->ProductModel->get_subsubcat_by_scid($editdata->cid, $editdata->subcat_id)->result();  	?>
                      
                      <select class="form-control" name="txtsubsubcategories" id="subsubcat_dropdown">
                                <option value="0">Select Sub-Sub-Categories</option>
                                <?php foreach($subsubcat as $item){  ?>
                                <option value="<?php echo $item->sscat_id?>" <?php if($item->sscat_id == $editdata->sscat_id ) { ?> selected="selected" <?php } ?>><?php echo $item->ssname; ?></option>
                                <?php } ?>
                        </select>
                        <span id="subsubcat_loader"></span>
                   
                       
                    </div>
                    <?php } else { echo 'No Categories Found'; } ?>   
                    
					
					
					 <?php if($manufacturelist->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Manufacture</label>
                        <select class="form-control" name="selclient" onchange="selectBrandFromEdit(this.options[this.selectedIndex].value)">
                              <option value="-1">Please Select One Manufacture</option>
                              <?php
                              foreach($manufacturelist->result() as $listElement){
                                      ?>
                                      <option value="<?php echo $listElement->id?>" <?php if($listElement->id == $editdata->manufacture_id ) { ?> selected="selected" <?php } ?>><?php echo $listElement->company_name; ?></option>
									   
                                      <?php
                              }
                              ?>
                        </select>
                      </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Select Brand</label>
					  <?php 
					  $this->load->model("brandModel");	
					  $brand = $this->brandModel->get_by_id($editdata->brand_id)->result(); 
					  ?>
                     
                      <select class="form-control" name="selbrand" id="brand_dropdown">
					   <?php foreach($brand as $item){  ?>
                            <option value="<?php echo $item->id?>" <?php if($item->mid == $editdata->brand_id ) { ?> selected="selected" <?php } ?>><?php echo $item->brandname; ?></option>
                       <?php } ?>
					  </select>
                    <span id="brand_loader"></span>
                    </div> 
                    <?php } else { echo 'No Data Found'; } ?> 
					
					
					
                    <div class="form-group">
                      <label for="exampleInputFile">Product Image</label>
                     <input type="hidden" name="userfile1old" value="<?php echo $editdata->product_img;  ?>"  />
                     <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                     <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                     <strong>Image :</strong><br /><img src="<?php echo base_url(); ?>images/products/<?php echo $editdata->product_img; ?>" width="150px">	
                    </div>   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Short Description</label>
                        <textarea class="form-control" id="txtdescription" name="txtshortdesc" placeholder="Enter Short Description" ><?php echo $editdata->pdetail; ?></textarea>
                        <?php if(form_error('txtshortdesc') != ''){ ?><div class="alert-danger"><?php echo form_error('txtshortdesc'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Note</label>
                        <textarea class="form-control" id="txtdescription" name="txtnote" placeholder="Enter Note" ><?php echo $editdata->note; ?></textarea>
                        <?php if(form_error('txtnote') != ''){ ?><div class="alert-danger"><?php echo form_error('txtnote'); ?></div><?php } ?>
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
 