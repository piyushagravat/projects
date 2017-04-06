<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	   
	   $this->load->model('user','',TRUE);
	   
	 }
	
	 function index()
	 {
	   $this->load->view('login_view');
	 }
	 
	  public function send_pass_to_admin()
	{ 		
			$alpha_numeric = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789';
			$newpass = substr(str_shuffle($alpha_numeric), 0, 10);
			$data = array('password' => $newpass);
			$id = 1;
			$val = $this->user->update_password($id,$data);	
			
			/* MAIL START */ 
			$this->load->library('email');
			$config['mailtype'] = 'html';
	        $this->email->initialize($config);
			
			$email_from = "headwayappworld@gmail.com";
			$examil_to =  "headwayappworld@gmail.com";					
			$data['newpass'] = $newpass;
			
			$this->email->from($email_from, "Hardware Channel");
			$this->email->to($examil_to); 
			$this->email->subject('Hardware Channel New Password');
			$this->email->message($this->load->view("passnotification",$data,true));	
			
			$this->email->send();
			/* MAIL END */	
           
		   	redirect('login/?status=success', 'refresh');
			
			
	}
	 
	 function forgotpass() {
	 
	   $this->load->view('forgotpass');
	 
	 }
	 
	 function emailcheck(){
	 
	 	 $this->load->library('form_validation');

	     $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_check_email');
		 
		 if($this->form_validation->run() == FALSE)
	     {
		 	$this->forgotpass();
	     }
	     else
	     {
		 		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	            echo $code = substr(str_shuffle($alpha_numeric), 0, 8);
				$email = $this->input->post('email');
				$pass = array('password' => $code);
				$this->load->model("homeModel");
				$this->homeModel->updatepassword($email,$pass);
				
				/* Email code start here */
				 
				/* Email code end here */ 
				
				redirect('login/success', 'refresh');
	     }
		  		 
	 }
	 
	 function check_email($email)
 	 {
		$result = $this->user->forgotpassword($email);
	 
	    if($result) {		 
		 	return TRUE;
	   	}
	    else
	    {
		 	$this->form_validation->set_message('check_email', 'Email address not available, Please enter correct Email');
		 	return false;
	    }
 	 }
	 
	 function success()
 	 {
 		$this->load->view('success');
	 }
}

?>