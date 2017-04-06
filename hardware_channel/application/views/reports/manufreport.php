<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Manufacturer Reports</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>">Manufacturer Reports</a></li>
            <li class="active">List of Manufacturer</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Manufacturer</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                        <a href="<?php echo base_url(); ?>reports/downloadmanufacture" target="_blank"> <button class="btn btn-block btn-primary btn-sm">Download Report</button></a>                                    
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Manufacture Name</th>
                      <th>Email</th>
                      <th>Company Name</th>
                      <th>No Of Inquiries</th>
                    </tr>
                    <?php $i=0; foreach($inquirycount as $item) {
					$clientinfo = $this->adsModel->get_user_by_id($item->id)->row();
                                       $inquirycount = $this->reportsModel->get_chart_data();
                                      //echo '<pre>'; print_r($inquirycount);exit;
					 ?>
                    <tr>
                      <td><?php echo $i+1; ?></td>
                      <td><span class="label label-default"><?php echo $clientinfo->company_name; ?></span></td>
                      <td><?php echo $item->email; ?></td>                      
                      <td><?php echo $item->company_name; ?></td>
                      <td><span class="label label-danger"><?php echo $inquirycount[$i]->INQUIRES; ?></span></td>
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
