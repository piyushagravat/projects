<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Registered Customer List With Loacation 
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Registered Customer List</a></li>
            <li class="active">Registered Customer List With Location</li>
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
                  <h3 class="box-title">Registered Customer with loaction</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			                                 
            
              	<form role="form" method="post" action="<?php echo base_url()."reports/viewcustomerdata"; ?>" >
                  <div class="box-body">                                                         
                
                    <div class="form-group">
                      <label>Select Location</label>
                      <select name="sellocation" id="sellocation" class="form-control">
                      <option value="0">Please Select One Location</option>
                        <?php foreach($location as $item){ ?>
                        <option value="<?php echo $item->city; ?>"><?php echo $item->city; ?></option>
                        <?php } ?>
                      </select>
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