<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hardware Channel</title>
<link rel="Shortcut Icon" href="<?php echo base_url(); ?>images/fevicon.ico" type="image/x-icon" />
</head>
<body> 
  <div style="float:none; margin:0 auto;width:600px;">
    	 <!---Header Start--->
    	<div style="float:left;background: #f6f6f6; padding:10px; width:100%;">
        	<div style="float:left;width:580px; background:#fff; padding:10px;">
            	<div style="float:left;"><img src="<?php echo base_url(); ?>images/logo.png" /></div>                
            </div>
            <!---Header End--->
          <div style="float:left; width:580px; background:#fff; margin-top:5px;padding:10px; font-family:Arial, Helvetica, sans-serif;" >
           <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;"> Dear <?php echo $name; ?>,</p>
           
            	<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">We have received your request for retriving new password.</p> 
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">Your registered email address is : <strong><?php echo $email_to; ?></strong></p> <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">Please find below temparory new password. Kindly change the password on next login.</p> <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">New Password : <strong><?php echo $password; ?></strong></p><p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;">If you face any difficulties feel free to mail us.</p> <p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#505050;"><strong>Note</strong> : This is an auto generated message and kindly do not reply to this mail.</p>
          </div>
           <!---Content End--->
          <div style="float:left;width:580px; background:#fff; padding:10px; margin-top:5px;">
               <div style="float:none; margin:0 auto; width: 490px;">
             </div>
          </div>
        </div>
    </div>
 
 
</body>
</html>    