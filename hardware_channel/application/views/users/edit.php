<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Users
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>users">Manage Users</a></li>
            <li class="active">Edit User Details</li>
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
                  <h3 class="box-title">Edit User</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."users/updaterecord"; ?>"  enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $editdata->id; ?>" />  
                  <input type="hidden" name="txthiddenpassword" value="<?php echo $editdata->password; ?>" /> 
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
                      <label>Select</label>
                      <select name="txtrole" class="form-control">
                        <?php foreach($roles as $role){ ?>
                        <option value="<?php echo $role->role; ?>" <?php if($editdata->role == $role->role) { ?> selected="selected" <?php } ?> ><?php echo $role->role; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="txtemail" value="<?php echo $editdata->email; ?>" placeholder="Enter email">
                      <?php if(form_error('txtemail') != ''){ ?><div class="alert-danger"><?php echo form_error('txtemail'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="txtpassword" value="<?php echo $editdata->password; ?>" id="exampleInputPassword1" placeholder="Password">
                      <?php if(form_error('txtpassword') != ''){ ?><div class="alert-danger"><?php echo form_error('txtpassword'); ?></div><?php } ?>
                    </div>
                                       
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ads Start Date</label>
                      <input type="text" class="form-control" id="seldate"  name="txtstartdate" placeholder="Start Date" value="<?php echo $editdata->startdate; ?>">
                      <?php if(form_error('txtstartdate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtstartdate'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ads End Date</label>
                      <input type="text" class="form-control" id="joindate"  name="txtenddate" placeholder="End Date" value="<?php echo $editdata->enddate; ?>">
                      <?php if(form_error('txtenddate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtenddate'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact No.</label>
                      <input type="text" class="form-control" id="txtcontactno" name="txtcontactno" placeholder="Contact No." value="<?php echo $editdata->contact; ?>">
                      
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
            
                                      										 