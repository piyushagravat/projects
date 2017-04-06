<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Advertisement
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>ads">Manage Advertisement</a></li>
            <li class="active">Add New Advertisement</li>
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
                  <h3 class="box-title">Add New Advertisement</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."ads/addrecord"; ?>"  enctype="multipart/form-data" onSubmit="return check()">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ads Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtadsname" placeholder="Enter Ads Name" value="<?php echo set_value('txtadsname')?>">
                      <?php if(form_error('txtadsname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtadsname'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Ads Banner Image (600w x 240h)</label>
                      <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                      <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Ads Full Screen Image (320w x 800h)</label>
                      <input type="file" class="form-control" name="userfile2" id="userfile2" size="20" />  
                      <?php if(form_error('userfile2') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile2'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ads Start Date</label>
                      <input type="text" class="form-control" id="seldate"  name="txtstartdate" placeholder="Start Date" value="<?php echo set_value('txtstartdate')?>">
                      <?php if(form_error('txtstartdate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtstartdate'); ?></div><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ads End Date</label>
                      <input type="text" class="form-control" id="joindate"  name="txtenddate" placeholder="End Date" value="<?php echo set_value('txtenddate')?>">
                      <?php if(form_error('txtenddate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtenddate'); ?></div><?php } ?>
                    </div>  
                    <div class="form-group">
                      <label>Select Manufacture</label>
                      <select name="selclient" id="selclient" class="form-control">
                      <option value="0">Please Select One Manufacture</option>
                        <?php   foreach($Manufacture as $item){ ?>
                        <option value="<?php echo $item->id; ?>"><?php echo $item->company_name; ?></option>
                        <?php } ?>
                      </select>
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
            
                                      