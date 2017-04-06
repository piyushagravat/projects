<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Event
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>event">Manage Event</a></li>
            <li class="active">Edit Event Details</li>
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
                  <h3 class="box-title">Edit Event</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" method="post" action="<?php echo base_url()."event/updaterecord"; ?>"  enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $editdata->id; ?>" /> 
				  <input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />				  
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Event Title</label>
                      <input type="text" class="form-control" id="exampleInputName" name="event_title" value="<?php echo $editdata->event_title; ?>" placeholder="Enter Event Title" >
                      <?php if(form_error('event_title') != ''){ ?><div class="alert-danger"><?php echo form_error('event_title'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Event Detail</label>
                      <input type="text" class="form-control" id="exampleInputName" name="detail" value="<?php echo $editdata->detail; ?>" placeholder="Enter Event Title" >
                      <?php if(form_error('detail') != ''){ ?><div class="alert-danger"><?php echo form_error('detail'); ?></div><?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Event Image</label>
                     <input type="hidden" name="userfile1old" value="<?php echo $editdata->event_image;  ?>"  />
                     <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                     <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                     <strong>Image :</strong><br /><img src="<?php echo base_url(); ?>images/events/<?php echo $editdata->event_image; ?>" width="150px">	
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
            
                                      										 