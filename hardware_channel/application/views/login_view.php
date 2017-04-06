<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hardware | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
          <img src="<?php echo base_url(); ?>images/avatar1.png" class="user-image" width="70px" height="70px" alt="User Image"/>
        <a href="../../index2.html"><b>Hardware </b>Channel</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
                        <form role="form" method="post" action="<?php echo base_url().'verifylogin'; ?>">
        				<span style="color:#FF0000"> <?php if(validation_errors()){ echo validation_errors(); } ?></span>
						<span style="color:#FF0000"> <?php if(isset($_REQUEST["status"]) && $_REQUEST["status"] == "success"){ echo "We have sent new password to your email id <strong>headwayappworld@gmail.com</strong>"; } ?></span>
                        <div class="form-group has-feedback">
                                    <input class="form-control" placeholder="E-mail" name="email" type="text" autofocus>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
          				<div class="form-group has-feedback">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          				</div>
                        <div class="row">
                        <div class="col-xs-8">    
                              <div class="checkbox icheck">
                                <label>
                                  <input type="checkbox"> Remember Me
                                </label>
                              </div>                        
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                            	<input type="submit"  class="btn btn-primary btn-block btn-flat" value="Login">
                            </div><!-- /.col -->
                         </div>
                       
                            <input type="hidden" name="do" value="Login" />
                        </form>
                        
                         <a href="<?php echo base_url(); ?>login/send_pass_to_admin">I forgot my password</a><br>
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
						