<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Manufacturers
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>users">Manage Manufacturers</a></li>
            <li class="active">Add New Manufacturer</li>
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
                  <h3 class="box-title">Add New Manufacturer</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."manufacturer/addrecord"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                  <div class="box-body">
                  	<div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtfname" placeholder="Enter First Name" value="<?php echo set_value('txtfname')?>">
                      <?php if(form_error('txtfname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtfname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtlname" placeholder="Enter Last Name" value="<?php echo set_value('txtlname')?>">
                      <?php if(form_error('txtlname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtlname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Company Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtcompanyname" placeholder="Enter Company Name" value="<?php echo set_value('txtcompanyname')?>">
                      <?php if(form_error('txtcompanyname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtcompanyname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Brand Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtbrandname" placeholder="Enter Brand Name" value="<?php echo set_value('txtbrandname')?>">
                      <?php if(form_error('txtbrandname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtbrandname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtaddress" placeholder="Enter Address" value="<?php echo set_value('txtaddress')?>">
                      <?php if(form_error('txtaddress') != ''){ ?><div class="alert-danger"><?php echo form_error('txtaddress'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact No.</label>
                      <input type="number" class="form-control" id="txtcontactno" name="txtcontactno" placeholder="Contact No." >
                      <?php if(form_error('txtcontactno') != ''){ ?><div class="alert alert-danger"><?php echo form_error('txtcontactno'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="txtemail" placeholder="Enter email" value="<?php echo set_value('txtemail')?>">
                      <?php if(form_error('txtemail') != ''){ ?><div class="alert-danger"><?php echo form_error('txtemail'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" class="form-control" name="txtpassword" id="exampleInputPassword1" placeholder="Password">
                      <?php if(form_error('txtpassword') != ''){ ?><div class="alert alert-danger"><?php echo form_error('txtpassword'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Company Logo(JPG/PNG)</label>
                      <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                      <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1');?></div><?php }  ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Catalog File(PDF)</label>
                      <input type="file" class="form-control" name="userfile2" id="userfile2" size="20" />  
                      <?php if(form_error('userfile2') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile2'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">I’m a &nbsp;</label> <br>
                      <input type="radio" name="rdotickbox" value="Manufacturer" checked="checked"  /> Manufacturer &nbsp; <input type="radio" name="rdotickbox" value="Importer"  /> Importer  &nbsp; <input type="radio" name="rdotickbox" value="Both"  />Both 
                      
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
            
                                      