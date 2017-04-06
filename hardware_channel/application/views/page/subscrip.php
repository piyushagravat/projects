
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Subscription
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Manage Subscription</a></li>
            <li class="active">Edit Subscription Details</li>
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
                  <h3 class="box-title">Edit Subscription</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."page/updatesubscription"; ?>"  enctype="multipart/form-data"  novalidate onsubmit="return check();">
                  <input type="hidden" name="id" value="<?php echo $editdata->id; ?>" />  
                   <div class="form-group">
                     
                      
                      <textarea class="form-control" id="txtdetails" name="txtdetails" placeholder="Enter email">
                      <?php echo $editdata->subscript; ?>
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
            
                                      										 