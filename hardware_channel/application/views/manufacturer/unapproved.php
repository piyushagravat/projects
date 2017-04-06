<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>New Sign Ups</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>manufacturer">New Sign Ups</a></li>
            <li class="active">List of New Sign Ups</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of New Sign Ups</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
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
                      <th><a href="<?php echo base_url(); ?>manufacturer/deleteinactive/<?php echo $item->id; ?>/<?php echo $num; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th> </tr>
                    <?php $i++;} ?>
                   
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