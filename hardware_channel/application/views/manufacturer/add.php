<script type="text/javascript">
function check()
{
	var validate1;
	
	var fup1 = document.getElementById('userfile1');	
	if(document.getElementById('userfile1').value != '')
	{
		var fileName1 = fup1.value;
		var ext1 = fileName1.substring(fileName1.lastIndexOf('.') + 1);
		var size1 = fup1.files[0].size/1024/1024;
		
		if(ext1 == "jpg" || ext1 == "gif" || ext1 == "png" || ext1 == "jpeg" || ext1 == "JPG")
		{
			validate1 = true;
		}
		else
		{
			alert("Upload Logo Jpg Or Png Format only");
			//fup1.focus();
			validate1 = false;
		}
		
		if(size1 > 1.0) { 
			alert("File size must be below 1 MB");
		}
	}
	else {
		    alert("Please Select Your Company Logo(JPG/PNG)");
			//fup1.focus();
			validate1 = false;
	}
	
	
	
	
	if(validate1 == true) {
		return true;
	
	}
	else {
		return false;
	}
}
</script>

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
                <form role="form" method="post" action="<?php echo base_url()."manufacturer/addrecord"; ?>"  enctype="multipart/form-data" name="pro" novalidate onsubmit="return check();">
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
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtaddress" placeholder="Enter Address" value="<?php echo set_value('txtaddress')?>">
                      <?php if(form_error('txtaddress') != ''){ ?><div class="alert-danger"><?php echo form_error('txtaddress'); ?></div><?php } ?>
                    </div>
					
					<?php if($list->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Country</label>
                        <select class="form-control" name="txtcountry" onchange="selectState(this.options[this.selectedIndex].value)">
                              <option value="0">Select Country</option>
                              <?php
                              foreach($list->result() as $listElement){
                                      ?>
									  <option value="<?php echo $listElement->id?>"><?php echo $listElement->country_name?></option>
                                      <?php
                              }
                              ?>
                        </select>
                      </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">State</label>
                      <select class="form-control" name="txtstate" id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)">
                            <option value="0">Select State</option>
                      </select>
                    <span id="state_loader"></span>
                     
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">City</label>
                      <select class="form-control" name="txtcity" id="city_dropdown">
                                <option value="0">Select City</option>
                        </select>
                        <span id="state_loader"></span>
                   
                       
                    </div>
                    <?php } else { echo 'No Categories Found'; } ?>  
				
					
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact No.</label>
                      <input type="number" class="form-control" id="txtcontactno" name="txtcontactno" placeholder="Contact No." >
                      <?php if(form_error('txtcontactno') != ''){ ?><div class="alert alert-danger"><?php echo form_error('txtcontactno'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Enter email" value="<?php echo set_value('txtemail')?>">
                      <?php if(form_error('txtemail') != ''){ ?><div class="alert-danger"><?php echo form_error('txtemail'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Confirm Email address</label>
					<input type="email" name="confemail" class="form-control" type="text" id="confemail"  placeholder="Enter Confirm email" value="<?php echo set_value('confemail')?>""/>                     
					  <?php if(form_error('confemail') != ''){ ?><div class="alert-danger"><?php echo form_error('confemail'); ?></div><?php } ?>
                    </div>
					<div id="error"></div>
					<div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" class="form-control" name="txtpassword" id="exampleInputPassword1" placeholder="Password">
                      <?php if(form_error('txtpassword') != ''){ ?><div class="alert alert-danger"><?php echo form_error('txtpassword'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Company Logo(JPG/PNG)</label>
                      <input type="file" class="upload" name="userfile1" id="userfile1" size="20" />  
                      <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail1">I’m a &nbsp;</label> <br>
                      <input type="radio" name="rdotickbox" value="Manufacturer" checked="checked"  /> Manufacturer &nbsp; <input type="radio" name="rdotickbox" value="Importer"  /> Importer  &nbsp; <input type="radio" name="rdotickbox" value="Both"  />Both 
                    </div>
					 <div class="form-group">
                      <label for="exampleInputEmail1">About Manufacturer</label>
                      
                      <textarea class="form-control" id="txtdetails" name="txtdetails" placeholder="Enter email">
                      <?php echo set_value('txtabout')?>
                      </textarea>
                      <?php if(form_error('txtdetails') != ''){ ?><div class="alert-danger"><?php echo form_error('txtdetails'); ?></div><?php } ?>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" >
                  </div>
                </form>
              </div><!-- /.box -->         

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
            
                                      