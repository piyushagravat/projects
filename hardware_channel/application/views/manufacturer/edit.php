
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Manufacturers
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>users">Manage Manufacturers</a></li>
            <li class="active">Edit Manufacturers Details</li>
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
                  <h3 class="box-title">Edit Manufacturer</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."manufacturer/updaterecord"; ?> "  enctype="multipart/form-data"  novalidate onsubmit="return check();">
                  <input type="hidden" name="id" value="<?php echo $editdata->id; ?>" />  
                  <input type="hidden" name="txthiddenpassword" value="<?php echo $editdata->password; ?>" /> 
                   <input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
				  <div class="box-body">
                  	<div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtfname" value="<?php echo $editdata->first_name; ?>" placeholder="Enter First Name" >
                      <?php if(form_error('txtfname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtfname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtlname" value="<?php echo $editdata->last_name; ?>" placeholder="Enter Last Name">
                      <?php if(form_error('txtlname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtlname'); ?></div><?php } ?>
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Company Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtcompanyname" placeholder="Enter Company Name" value="<?php echo $editdata->company_name; ?>">
                      <?php if(form_error('txtlname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtcompanyname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtaddress" placeholder="Enter Address" value="<?php echo $editdata->address; ?>">
                      <?php if(form_error('txtaddress') != ''){ ?><div class="alert-danger"><?php echo form_error('txtaddress'); ?></div><?php } ?>
                    </div>  
					
					<?php if($list->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Country</label>
                        <select class="form-control" name="txtcountry" onchange="selectStateEdit(this.options[this.selectedIndex].value)">
                              <option value="0">Select Country</option>
                              <?php
                              foreach($list->result() as $listElement){
                                      ?>
									  
                                      <option value="<?php echo $listElement->id?>" <?php if($listElement->country_name == $editdata->country ) { ?> selected="selected" <?php } ?>><?php echo $listElement->country_name ?></option>
									  
									  <?php
                              }
                              ?>
                        </select>
                      </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">State</label>
					    <?php 
					  $this->load->model("ManufacturerModel");	
					  $state = $this->ManufacturerModel->getState($editdata->state)->result();
					
					  ?>
                   
                      <select class="form-control" name="txtstate" id="state_dropdown" onchange="selectCityedit(this.options[this.selectedIndex].value)">
                            <option value="0">Select State</option>
							 <?php foreach($state as $item){  ?>
						   <option value="<?php echo $item->id?>" <?php if($item->state_name == $editdata->state ) { ?> selected="selected" <?php } ?>><?php echo $item->state_name; ?></option>
						   <?php } ?>
                      </select>
                    <span id="state_loader"></span>
                     
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">City</label>
                       <?php 
					  $this->load->model("ManufacturerModel");	
					  $city = $this->ManufacturerModel->getCity($editdata->city)->result(); 
						//print_r($city);die;
					  ?>
                       <select class="form-control" name="txtcity" id="city_dropdown">
                                <option value="0">Select City</option>
								<?php foreach($city as $item){  ?>
                                <option value="<?php echo $item->id?>" <?php if($item->city_name == $editdata->city ) { ?> selected="selected" <?php } ?>><?php echo $item->city_name; ?></option>
                                <?php } ?>
                        </select>
                        <span id="city_loader"></span>
                   
                       
                    </div>
                    <?php } else { echo 'No Categories Found'; } ?>  
					
					
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact No.</label>
                      <input type="number" class="form-control" id="txtcontactno" name="txtcontactno" placeholder="Contact No." value="<?php echo $editdata->contact; ?>">
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email Address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="txtemail" value="<?php echo $editdata->email; ?>" placeholder="Enter email">
                      <?php if(form_error('txtemail') != ''){ ?><div class="alert-danger"><?php echo form_error('txtemail'); ?></div><?php } ?>
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Confirm Email address</label>
					<input type="email" name="confemail" class="form-control" type="text" id="confemail"  placeholder="Enter Confirm email" value="<?php echo $editdata->email; ?>"/>                     
					  <?php if(form_error('confemail') != ''){ ?><div class="alert-danger"><?php echo form_error('confemail'); ?></div><?php } ?>
                    </div>
					<div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" class="form-control" name="txtpassword" value="<?php echo $editdata->password; ?>" id="exampleInputPassword1" placeholder="Password">
                      <?php if(form_error('txtpassword') != ''){ ?><div class="alert-danger"><?php echo form_error('txtpassword'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Company Logo(JPG/PNG)</label>
                        <input type="hidden" name="userfile1old" value="<?php echo $editdata->profile_img;  ?>"  />
                                             <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                                        	 <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                                             <strong>Image :</strong><br /><img src="<?php echo base_url(); ?>images/manufacturer/<?php echo $editdata->profile_img; ?>" width="150px">	
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">I’m a &nbsp;</label> <br>
                      <input type="radio" name="rdotickbox" value="Manufacturer" <?php if($editdata->type == "Manufacturer") { ?>checked="checked" <?php } ?> /> Manufacturer &nbsp; <input type="radio" name="rdotickbox" value="Importer" <?php if($editdata->type == "Importer") { ?>checked="checked" <?php } ?>  /> Importer&nbsp; <input type="radio" name="rdotickbox" value="Both" <?php if($editdata->type == "Both") { ?>checked="checked" <?php } ?>  /> Both
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">About Manufacturer</label>
                      
                      <textarea class="form-control" id="txtdetails" name="txtdetails" placeholder="Enter email">
                      <?php echo $editdata->about_manf; ?>
                      </textarea>
                      <?php if(form_error('txtdetails') != ''){ ?><div class="alert-danger"><?php echo form_error('txtdetails'); ?></div><?php } ?>
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
            
                                      										 