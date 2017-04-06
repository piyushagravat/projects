<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Advertisements Reports</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>ads">Advertisements Reports</a></li>
            <li class="active">List of Advertisements</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Advertisements</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                                           
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Ads Name</th>
                      <th>Ads Details</th>
                      <th>Clients</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    <?php foreach($viewdata as $item) {
					$clientinfo = $this->adsModel->get_user_by_id($item->clientid)->row();
					 ?>
                    <tr>
                      <td><?php echo $item->aid; ?></td>
                      <td><?php echo $item->ads_name; ?></td>                      
                      <td><?php echo $item->details; ?></td>
                      <td><span class="label label-default"><?php echo $clientinfo->company_name; ?></span></td>
                      <td><span class="label label-primary"><?php echo $item->status; ?></span></td>
					  <th><a href="<?php echo base_url(); ?>reports/view/<?php echo $item->aid; ?>"><span class="label label-success">View Ads Click Reports</span></a></th>
                      
                    </tr>
                    <?php } ?>
                   
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