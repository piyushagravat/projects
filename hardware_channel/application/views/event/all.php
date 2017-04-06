<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Whats New Event</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>event">Whats New Event</a></li>
            <li class="active">List of Whats New Event</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Whats New Event</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                   <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>event/add"> <button class="btn btn-block btn-primary btn-sm">Add New Event</button></a>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>No</th>
                      <th>Event Name</th>
                      <th>Event Detail</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                     <?php $i=1; foreach($viewdata as $item) { 
		     ?>
                    <tr>
                      <td><?php echo $i+$num; ?></td>
                      <td><?php echo $item->event_title; ?></td>
                      <td><?php echo $item->detail; ?></td>
                      <td><?php echo $item->created_date; ?></td>
                      <th><a href="<?php echo base_url(); ?>event/viewimages/<?php echo $item->id; ?>"><span class="label label-primary">View Images</span></a></th>
                    <th><a href="<?php echo base_url(); ?>event/edit/<?php echo $item->id; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a> &nbsp; <a href="<?php echo base_url(); ?>event/delete/<?php echo $item->id; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>
                      
                    </tr>
                    <?php $i++; } ?>
                   
                    <tr>
                    <td colspan="7">
                        <div class="box-tools">
                            <div class="input-group">
                                <div class="box-tools">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                      <?php echo $pagination; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>