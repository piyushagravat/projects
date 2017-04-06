<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Sub-Categories
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>categories">Manage Sub-Categories</a></li>
            <li class="active">Edit Sub-Categories Details</li>
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
                  <h3 class="box-title">Edit Sub-Categories</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."product/updaterecord"; ?>"  enctype="multipart/form-data">
                    <input type="hidden" name="pid" value="<?php echo $editdata->pid; ?>" /> 
                    <input type="hidden" name="subcat_id" value="<?php echo $editdata->subcat_id; ?>" /> 
                   <div class="box-body">
                       <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtproductname" placeholder="Enter Product Name" value="<?php echo $editdata->pname; ?>">
                      <?php if(form_error('txtproductname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtproductname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <select name="txtcategories" class="form-control" >
                      <option>Select</option>
                      <?php foreach($categories as $item) { ?>
                      <option value="<?php echo $item->cid; ?>" <?php if($editdata->subcat_id == $item->cid) { ?> selected="selected" <?php } ?>><?php echo $item->cname; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category</label>
                      <select name="txtsubcategories" class="form-control" >
                      <option>Select</option>
                      <?php foreach($subcategories as $item) { ?>
                       <option value="<?php echo $item->subcat_id; ?>" <?php if($editdata->pid == $item->subcat_id) { ?> selected="selected" <?php } ?>><?php echo $item->subcat_name; ?></option>      
                      <?php } ?>
                      </select> 
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub-Sub-Category</label>
                      <select name="txtsubsubcategories" class="form-control" >
                      <option>Select</option>
                      <?php foreach($subsubcategories as $item) { ?>
                       <option value="<?php echo $item->sscat_id; ?>" <?php if($editdata->pid == $item->sscat_id) { ?> selected="selected" <?php } ?>><?php echo $item->subcat_name; ?></option>      
                      <?php } ?>
                      </select> 
                    </div>  
                       
                    <div class="form-group">
                      <label for="exampleInputFile">Company Brochure</label>
                      <input type="file" class="form-control" name="userfile2" id="userfile2" size="20" />  
                      <?php if(form_error('userfile2') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile2'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cost (Rs)</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtcost" placeholder="Enter Cost of Product" value="<?php echo $editdata->cost; ?>">
                      <?php if(form_error('txtcost') != ''){ ?><div class="alert-danger"><?php echo form_error('txtcost'); ?></div><?php } ?>
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
                
                <div class="checkbox">
                      <label>
                        <input type="checkbox" name="seltoaddprod" value="1" <?php if($editdata->whats_new == 1) {  ?> checked="checked" <?php } ?> > Add Product in What's New Section
                      </label>
                    </div>
                    
              </div><!-- /.box -->         

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
 