<style type="text/css">
.bootstrap-timepicker{position:relative}.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu{left:auto;right:0}.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu:before{left:auto;right:12px}.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu:after{left:auto;right:13px}.bootstrap-timepicker .add-on{cursor:pointer}.bootstrap-timepicker .add-on i{display:inline-block;width:16px;height:16px}.bootstrap-timepicker-widget.dropdown-menu{padding:2px 3px 2px 2px}.bootstrap-timepicker-widget.dropdown-menu.open{display:inline-block}.bootstrap-timepicker-widget.dropdown-menu:before{border-bottom:7px solid rgba(0,0,0,0.2);border-left:7px solid transparent;border-right:7px solid transparent;content:"";display:inline-block;left:9px;position:absolute;top:-7px}.bootstrap-timepicker-widget.dropdown-menu:after{border-bottom:6px solid #fff;border-left:6px solid transparent;border-right:6px solid transparent;content:"";display:inline-block;left:10px;position:absolute;top:-6px}.bootstrap-timepicker-widget a.btn,.bootstrap-timepicker-widget input{border-radius:4px}.bootstrap-timepicker-widget table{width:100%;margin:0}.bootstrap-timepicker-widget table td{text-align:center;height:30px;margin:0;padding:2px}.bootstrap-timepicker-widget table td:not(.separator){min-width:30px}.bootstrap-timepicker-widget table td span{width:100%}.bootstrap-timepicker-widget table td a{border:1px transparent solid;width:100%;display:inline-block;margin:0;padding:8px 0;outline:0;color:#333}.bootstrap-timepicker-widget table td a:hover{text-decoration:none;background-color:#eee;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;border-color:#ddd}.bootstrap-timepicker-widget table td a i{margin-top:2px}.bootstrap-timepicker-widget table td input{width:25px;margin:0;text-align:center}.bootstrap-timepicker-widget .modal-content{padding:4px}@media(min-width:767px){.bootstrap-timepicker-widget.modal{width:200px;margin-left:-100px}}@media(max-width:767px){.bootstrap-timepicker{width:100%}.bootstrap-timepicker .dropdown-menu{width:100%}}
 
.bs-example{

	position: relative;
	margin: 100px;
}
.typeahead, .tt-query, .tt-hint {
	width:100%;
}
.twitter-typeahead { width: 100%; } 
.tt-hint {
	color: #fff;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 5px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {

	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
</style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Approved Manufacturers</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>manufacturer">Approved Manufacturers</a></li>
            <li class="active">List of Approved Manufacturers</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
				<div class="box-header" style="width:50%">
                  <form name="manuf" action="<?php echo base_url(); ?>manufacturer/search_manufa" method="post" onsubmit="return validation(this)">
                    <div class="input-group">
                      <input type="text" name="searchmanufacturer" placeholder="Search by Manufacturer Company Name" class="typeahead form-control"  autocomplete="off" spellcheck="false" required="required" />
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-block btn-primary btn-sm">Search Manufacturer</button>
                      </span>
                    </div>
                  </form>
                </div>		
                <div class="box-header">
                  <h3 class="box-title">List of Approved Manufacturers</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>manufacturer/add"> <button class="btn btn-block btn-primary btn-sm">Add New Manufacturer</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
					  <th>Company Name</th>
                      <th>Contact No</th>
                      <th>Created Date</th>
                      <th>Approved Date</th>
                      <th>Status</th>
                      <th>View</th>
                      <th>Action</th>
                    </tr>
                    <?php $i=1; foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $i+$num; ?></td>
                      <td><?php echo $item->first_name." ".$item->last_name; ?></td>
                      <td><?php echo $item->email; ?></td>
					  <td><?php echo $item->company_name; ?></td>
					  <td><?php echo $item->contact; ?></td>
                      <td><?php echo $item->created_date; ?></td>
                      <td><?php echo $item->approved_date; ?></td>
                      <th><?php if($item->status == "Inactive") { ?> <a href="<?php echo base_url(); ?>manufacturer/action/<?php echo $item->id; ?>/Active" ><span class="label label-success">Active ?</span></a><?php } else { ?><a href="<?php echo base_url(); ?>manufacturer/action/<?php echo $item->id; ?>/Inactive" onclick="return confirm('Are you sure you want to Inactive Manufacturer?')"><span class="label label-danger">Inactive ?</span></a><?php } ?></span></a></th>
                      <th><a href="<?php echo base_url(); ?>product/productsmanufacturers/<?php echo $item->id;?>"><span class="label label-primary">View Products</span></a>
                      <a href="<?php echo base_url(); ?>dealer/dealerbymanufacturers/<?php echo $item->id;?>"><span class="label label-primary">View Dealer</span></a>
					  <a href="<?php echo base_url(); ?>brand/brandbymanufacturers/<?php echo $item->id;?>"><span class="label label-primary">View Brand</span></a>
                       <a href="<?php echo base_url();?>whatsnew/productbymanufacturers/<?php echo $item->id;?>"><span class="label label-primary">What's New Product</span></a></th></th>
					  <th><a href="<?php echo base_url(); ?>manufacturer/delete/<?php echo $item->id; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a> &nbsp; <a href="<?php echo base_url(); ?>manufacturer/edit/<?php echo $item->id; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
                    </tr>
                    <?php $i++; } ?>
                   
                    <tr>
                    <td colspan="7"><div class="box-tools">
                    <div class="input-group">
                      
                      <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                      <?php echo $pagination; ?>
                    </ul>
                  </div>
                    </div>
                  </div></td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
     </section><!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('input.typeahead').typeahead({
            name: 'Manufacturer',
			items: '20',
            local: [<?php foreach($manufacture as $item) { ?> '<?php echo $item->company_name; ?>', <?php } ?>]
        });
    });  
</script>