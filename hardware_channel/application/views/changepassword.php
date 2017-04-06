<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>setting">Settings</a></li>
            <li class="active">Change Password</li>
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
                  <h3 class="box-title">Change Password &nbsp; <?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			                                 
            
              	<form role="form" method="post" action="<?php echo base_url()."setting/check_password"; ?>" >
                  <div class="box-body">                                                         
                <div class="form-group">
                    <label>Old Password:</label>
                     <input type="password" class="form-control" name="txtOldPassword">
                       <?php if(form_error('txtOldPassword') != ''){ ?><div class="alert-danger"><?php echo form_error('txtOldPassword'); ?></div><?php } ?> 
                </div>
                
                 <div class="form-group">
                    <label>New Password:</label>
                    <input type="password" class="form-control" name="txtNewPassword" >
                     <?php if(form_error('txtNewPassword') != ''){ ?><div class="alert-danger"><?php echo form_error('txtNewPassword'); ?></div><?php } ?>
                </div>
                                                        
                <div class="form-group">
                    <label>Re-Type New Password:</label>
                    <input type="password" class="form-control" name="txtRetypeNewPassword" >
                     <?php if(form_error('txtRetypeNewPassword') != ''){ ?><div class="alert-danger"><?php echo form_error('txtRetypeNewPassword'); ?></div><?php } ?>
                 </div>
                 </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
 </form>
              </div><!-- /.box -->         

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>