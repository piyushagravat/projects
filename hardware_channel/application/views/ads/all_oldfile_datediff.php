<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Advertisements</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>ads">Manage Advertisements</a></li>
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
                  
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Ad's Name</th>
                      <th>Manufacture(Comapany Name)</th>
											<th>Ads Status</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Action</th>
                    </tr>
                    <?php echo count($viewdata); $i=1; $date = date('d');  foreach($viewdata as $item) {
					$clientinfo = $this->adsModel->get_user_by_id($item->clientid)->row();
	//$adsdata = $this->adsModel->date_verification($item->clientid)->row();
	
					?>
					<?php if ($item->DiffDate > 0){?>
                    <tr <?php if($item->aid == ($date*2) || $item->aid == ($date*2)-1) { ?>style="background-color:#FFC6C6"<?php } ?>>
                      <td><?php echo $i+$num; ?></td>
                      <td><?php echo $item->ads_name; ?></td>
					  <td><?php if(count($clientinfo) == 0) { ?><?php echo "-------" ?><?php }else {  echo $clientinfo->company_name;}   ?></td>
                      <td><?php echo $item->DiffDate; ?> Days Left</td>
					  <td><?php echo $item->startdate; ?></td>
                      <td><?php echo $item->enddate; ?></td>
                      <th><?php if($item->status == "Disable") { ?> <a href="<?php echo base_url(); ?>ads/action/<?php echo $item->aid; ?>/Enable"><span class="label label-danger">Enable Ads ?</span></a><?php } else { ?><a href="<?php echo base_url(); ?>ads/action/<?php echo $item->aid; ?>/Disable"><span class="label label-success">Disable Ads ?</span></a><?php } ?> &nbsp; <a href="<?php echo base_url(); ?>ads/delete/<?php echo $item->aid; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger"></span></a> &nbsp; <a href="<?php echo base_url(); ?>ads/edit/<?php echo $item->aid; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
                      
                    </tr>
					<?php $i++;} ?>
					
                    <?php } ?>
					 <?php   foreach($viewdata as $item) {
					$clientinfo = $this->adsModel->get_user_by_id($item->clientid)->row();
	//$adsdata = $this->adsModel->date_verification($item->clientid)->row();
	//print_r($this->db->last_query());
	//print_r($adsdata);die;
					?>
					<?php if ($item->DiffDate < 0){?>
                    <tr <?php if($item->aid == ($date*2) || $item->aid == ($date*2)-1) { ?>style="background-color:#FFC6C6"<?php } ?>>
                      <td><?php echo $i+$num; ?></td>
                      <td><?php echo $item->ads_name; ?></td>
					  <td><?php if(count($clientinfo) == 0) { ?><?php echo "-------" ?><?php }else {  echo $clientinfo->company_name;}   ?></td>
                      <td><span class="label label-danger">Expired</span></td>
					  <td><?php echo $item->startdate; ?></td>
                      <td><?php echo $item->enddate; ?></td>
                      <th><?php if($item->status == "Disable") { ?> <a href="<?php echo base_url(); ?>ads/action/<?php echo $item->aid; ?>/Enable"><span class="label label-danger">Enable Ads ?</span></a><?php } else { ?><a href="<?php echo base_url(); ?>ads/action/<?php echo $item->aid; ?>/Disable"><span class="label label-success">Disable Ads ?</span></a><?php } ?> &nbsp; <a href="<?php echo base_url(); ?>ads/delete/<?php echo $item->aid; ?>/<?php echo $offset; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger"></span></a> &nbsp; <a href="<?php echo base_url(); ?>ads/edit/<?php echo $item->aid; ?>/<?php echo $offset; ?>"><span class="label label-warning">Edit</span></a></th>
                      
                    </tr>
					<?php $i++;} ?>
					
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