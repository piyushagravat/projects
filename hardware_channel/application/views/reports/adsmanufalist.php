<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Advertisement Enquiries Reports
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Advertisement Enquiries Reports</a></li>
            <li class="active">List of Advertisement Enquiries  </li>
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
                  <h3 class="box-title">Advertisement Enquiries Reports</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			                                 
            
              	<form role="form" method="post" action="<?php echo base_url()."reports/viewadsinquiry"; ?>" >
                  <div class="box-body">                                                         
                
                    <div class="form-group">
                      <label>Ads Name</label>
                      <select name="selads" id="selads" class="form-control">
                      <option value="0">Please Select Ads Name</option>
                        <?php foreach($viewdata as $item){ ?>
                            <option value="<?php echo $item->aid; ?>"><?php echo $item->aid." - ".$item->ads_name; ?></option>  
                        <?php } ?>
                      </select>
                    </div> 
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">From Date</label>
                      <input type="text" class="form-control" id="txtstartdate" name="txtstartdate" placeholder="Select Start Date" value="<?php echo set_value('txtstartdate')?>">
                      <?php if(form_error('txtstartdate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtstartdate'); ?></div><?php } ?>
                    </div>
                    
                   <div class="form-group">
                      <label for="exampleInputEmail1">To Date</label>
                      <input type="text" class="form-control" id="txtenddate" name="txtenddate" placeholder="Select To Date" value="<?php echo set_value('txtenddate')?>">
                      <?php if(form_error('txtenddate') != ''){ ?><div class="alert-danger"><?php echo form_error('txtenddate'); ?></div><?php } ?>
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