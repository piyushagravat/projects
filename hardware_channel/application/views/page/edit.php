
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
		 <?php if($editdata->id == 5 ){?>	
			<h1> Manage Aboutus</h1>
		 <?php }else if($editdata->id == 6 ){?>
			<h1> Manage Contact Us</h1>
		 <?php }else if($editdata->id == 7 ){?>
			<h1> Manage Subscription</h1>
		 <?php }else if($editdata->id == 8 ){?>
			<h1> Manage Terms & Condition</h1>
		 <?php } ?> 
          
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			 <?php if($editdata->id == 5 ){?>	
				<li><a href="<?php echo base_url(); ?>">Manage Aboutus</a></li>
				<li class="active">Edit Aboutus Details</li>
			 <?php }else if($editdata->id == 6 ){?>
					<li><a href="<?php echo base_url(); ?>">Manage Contact Us</a></li>
					<li class="active">Edit Contact Us Details</li>
			 <?php }else if($editdata->id == 7 ){?>
					<li><a href="<?php echo base_url(); ?>">Manage Subscription</a></li>
					<li class="active">Edit Subscription Details</li>
			 <?php }else if($editdata->id == 8 ){?>
					<li><a href="<?php echo base_url(); ?>">Manage Terms & Condition</a></li>
					<li class="active">Edit Terms & Condition Details</li>
			 <?php } ?> 
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
				<?php if($editdata->id == 5 ){?>	
					<h3 class="box-title">Edit About us</h3>
				 <?php }else if($editdata->id == 6 ){?>
					<h3 class="box-title">Edit Contact Us</h3>
				 <?php }else if($editdata->id == 7 ){?>
					<h3 class="box-title">Edit Subscription</h3>
				 <?php }else if($editdata->id == 8 ){?>
					<h3 class="box-title">Edit Terms & Condition</h3>
				 <?php } ?> 
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."page/updaterecord"; ?>"  enctype="multipart/form-data"  novalidate onsubmit="return check();">
                  <input type="hidden" name="id" value="<?php echo $editdata->id; ?>" />  
                   <div class="form-group">
				  
                      <textarea class="form-control" id="txtdetails" name="txtdetails" placeholder="Enter email">
                      <?php echo $editdata->page_contant; ?>
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
            
                                      										 