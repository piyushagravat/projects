<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Sub-Categories
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>subcategories">Manage Sub-Categories</a></li>
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
               <form role="form" method="post" action="<?php echo base_url()."subcategories/updaterecord"; ?>"  enctype="multipart/form-data">
                    <input type="hidden" name="subcat_id" value="<?php echo $editdata->subcat_id; ?>" /> 
                   <input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
				   <div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtsubcatname" placeholder="Enter Categories Name" value="<?php echo $editdata->subcat_name; ?>">
                      <?php if(form_error('txtsubcatname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtsubcatname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Parent Category</label>
                      <select name="txtcategories" class="form-control" >
                       <?php foreach($categories as $item) { ?>
                        <option value="<?php echo $item->cid; ?>" <?php if($editdata->cid == $item->cid) { ?> selected="selected" <?php } ?>><?php echo $item->cname; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Image</label>
                     <input type="hidden" name="userfile1old" value="<?php echo $editdata->subcat_img;  ?>"  />
                     <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                     <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                     <strong>Image :</strong><br /><img src="<?php echo base_url(); ?>images/products/<?php echo $editdata->subcat_img; ?>" width="150px">	
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
 