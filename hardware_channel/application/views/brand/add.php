
<script type="text/javascript">
function check1()
{
	var validate2;
	
	var fup2 = document.getElementById('userfile1');	
	if(document.getElementById('userfile1').value != '')
	{
		var fileName2 = fup2.value;
		var ext2 = fileName2.substring(fileName2.lastIndexOf('.') + 1);
		var size2 = fup2.files[0].size/1024/1024;
		
		if(ext2 == "pdf")
		{
			validate2 = true;
		}
		else
		{
			alert("Upload Pdf File only");
			validate2 = false;
			return false;
		}
		
		if(size1 > 1.0) { 
			alert("File size must be below 1 MB");
		}
	}
	else {
			alert("Please Select Your Catalogue File");
			//fup2.focus();
			validate2 = false;
			return false;
	}
	
	
	
	if(validate2 == true) {
		return true;
	}
	else {
		return false;
	}
}

</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Brand
	    </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>brand">Manage Brand</a></li>
            <li class="active">Add New Brand</li>
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
                  <h3 class="box-title">Add New Brand</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."brand/addrecord"; ?>"  enctype="multipart/form-data" novalidate onsubmit="return check();">
                   <div class="box-body">
              <?php print_r($error); ?>
                       
					<div class="form-group">
                      <label for="exampleInputEmail1">Brand Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtbrandname" placeholder="Enter Brand Name" value="<?php echo set_value('txtbrandname')?>">
                      <?php if(form_error('txtbrandname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtbrandname'); ?></div><?php } ?>
                    </div>
					
                    <div class="form-group">
                      <label>Select Manufacture</label>
                      <select name="selclient" id="selclient" class="form-control">
                      <option value="0">Please Select Manufacture</option>
                      <?php   foreach($Manufacture as $item){ ?>
                        <option value="<?php echo $item->id; ?>"><?php echo $item->company_name; ?></option>
                        <?php } ?>
                      <option value="----">None</option> 
                      </select>
                    </div> 
					 <div class="form-group">
                      <label for="exampleInputFile">Upload Catalogue File(PDF)</label>
                      <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" />  
                      <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1');?></div><?php }  ?>
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
            
                                      