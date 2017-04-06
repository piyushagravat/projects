
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
            <li><a href="<?php echo base_url(); ?>dealer">Manage Brand</a></li>
            <li class="active">Edit Brand</li>
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
                  <h3 class="box-title">Edit Brand</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()."brand/updaterecord"; ?>"  enctype="multipart/form-data" novalidate onsubmit="return check();">
                   <input type="hidden" name="id" value="<?php echo $editdata->id; ?>" /> 
				    <input type="hidden" name="pageid" value="<?php echo $pageid; ?>" />
                   <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Brand Name</label>
                      <input type="text" class="form-control" id="exampleInputName" name="txtbrandname" placeholder="Enter Firm Name" value="<?php echo $editdata->brandname; ?>">
                      <?php if(form_error('txtbrandname') != ''){ ?><div class="alert-danger"><?php echo form_error('txtbrandname'); ?></div><?php } ?>
                    </div>
					
                    <div class="form-group">
                      <label>Select Manufacture</label>
                      <select name="selclient" class="form-control">
                      	<?php if($editdata->mid == 0) { ?>
                        <option value="0">Please Select One Manufacture</option>
                        <?php } ?>
                        <?php foreach($Manufacture as $item){ ?>
                        
                        <option value="<?php echo $item->id; ?>" <?php if($editdata->mid == $item->id) { ?> selected="selected" <?php } ?> ><?php echo $item->company_name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Catalog File(PDF)</label>
                      <input type="hidden" name="userfile1old" value="<?php echo $editdata->catalogue;  ?>"  />
                      <input type="file" class="form-control" name="userfile1" id="userfile1" size="20" /> 
					  <label >Old File : <?php echo $editdata->catalogue;  ?></label>
					  <a href="<?php echo base_url(); ?>doc/<?php echo $editdata->catalogue; ?>"><span class="label label-danger">Open PDF</span></a>
					  <?php if(form_error('userfile1') != ''){ ?><div class="alert alert-danger"><?php echo form_error('userfile1'); ?></div><?php } ?>
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
            
                                      