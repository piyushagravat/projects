<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Dealer
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>dealer">Manage Dealer</a></li>
            <li class="active">Add New Dealer</li>
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
                  <h3 class="box-title">Add New Dealer</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."dealer/addrecord"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                   <div class="box-body">
              
					<div class="form-group">
                      <label for="exampleInputEmail1">Firm Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtfirmname" placeholder="Enter Firm Name" value="<?php echo set_value('txtfirmname')?>">
                      <?php if(form_error('txtfirmname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtfirmname'); ?></div><?php } ?>
                    </div>
                    
					<?php  if($manufacturelist->num_rows > 0){ ?>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Manufacture</label>
                        <select class="form-control" name="selclient" onchange="selectBrand(this.options[this.selectedIndex].value)">
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
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="txtemail" placeholder="Enter email" value="<?php echo set_value('txtemail')?>">
                      <?php if(form_error('txtemail') != ''){ ?><div class="alert-danger"><?php echo form_error('txtemail'); ?></div><?php } ?>
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact No.</label>
                      <input type="number" class="form-control" id="txtcontactno" name="txtcontactno" placeholder="Contact No." >
                      <?php if(form_error('txtcontactno') != ''){ ?><div class="alert alert-danger"><?php echo form_error('txtcontactno'); ?></div><?php } ?>
                    </div>
                        
                     <div class="form-group">
                      <label for="exampleInputEmail1">Address 1</label>
                      <input type="text" class="form-control" id="txtcontactno" name="txtaddressone" placeholder="Address 1." >
                      <?php if(form_error('txtaddressone') != ''){ ?><div class="alert alert-danger"><?php echo form_error('txtaddressone'); ?></div><?php } ?>
                    </div>   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address 2</label>
                      <input type="text" class="form-control" id="txtcontactno" name="txtaddresstwo" placeholder="Address 2" >
                      <?php if(form_error('txtaddresstwo') != ''){ ?><div class="alert alert-danger"><?php echo form_error('txtaddresstwo'); ?></div><?php } ?>
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
                        <span id="city_loader"></span>
                   
                       
                    </div>
                    <?php } else { echo 'No Categories Found'; } ?>  
					
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
            
                                      