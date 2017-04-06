<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	 function __construct()
	 {
	   	parent::__construct();	
	    if(!$this->session->userdata('logged_in'))
	    {			
	    	 redirect(base_url().'login', 'refresh');
 	    }			
		$this->load->model("user");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
	 }
	
	 function index()
	 {
		  $data['title'] = 'Setting';
	      $data['action'] = "Change Password";
		  if($this->session->flashdata('message') == ''){ $data['message'] = ""; }
		  else { $data['message'] = $this->session->flashdata('message'); }
		  $session_data = $this->session->userdata('logged_in');
		  $data['email'] = $session_data['email'];
		  $data['session_data'] = $session_data;	
		  $this->load->view('header',$data);
		  $this->load->view('changepassword',$data);
		  $this->load->view('footer');
	 }
	
	 function check_password()
	 {
	 	    $this->form_validation->set_rules('txtOldPassword', 'Old Password', 'required');		
			$this->form_validation->set_rules('txtNewPassword', 'New Password', 'required');		
			$this->form_validation->set_rules('txtRetypeNewPassword', 'Retype Password', 'required|matches[txtNewPassword]');						
			if ($this->form_validation->run() == FALSE)
			{
				$this->index();
			}	
			else
			{				
				  $session_data = $this->session->userdata('logged_in');
				  $email = $session_data['email'];
				  $password = $this->input->post('txtOldPassword');
				  $result = $this->user->check_oldpassword($email,$password);
				   
				  if($result)
				  {
				  	  	$data = array('Password' => mysql_real_escape_string($this->input->post('txtNewPassword')));
						$session_data = $this->session->userdata('logged_in');
						$email = $session_data['email'];			 						
						$oldpassword = $this->input->post('txtOldPassword');
						$this->user->updatepassword($email,$oldpassword,$data);
						$this->session->set_flashdata("message", "Password Change Successfully..."); 
					    redirect('setting/index/','refresh');
				  }
				  else	
				  {
				  	  $data['title'] = 'Setting';
					  $data['action'] = "Change Password";
					  $data['message'] = "Password Not Match With Current Password";
					  $session_data = $this->session->userdata('logged_in');
					  $data['email'] = $session_data['email'];
					  $data['session_data'] = $session_data;	
					  $this->form_validation->set_rules('txtOldPassword', 'Old Password Is Not Match ', 'required');		
					  $this->load->view('header',$data);
					  $this->load->view('changepassword',$data);
					  $this->load->view('footer');					 
					  //redirect('setting/','refresh');
				  }
				//$id = $this->magazineModel->save($data);	
				//$this->session->set_flashdata("message", "Record Added Successfully..."); 				
				//redirect('admin/magazine/','refresh');	
			}	   
	   
	 }
}
?>