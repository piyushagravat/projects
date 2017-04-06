<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $limit = 5;
	function __construct()
	{
		parent::__construct();
			date_default_timezone_set('Asia/Kolkata');
			$this->load->model('user','',TRUE);
			$this->load->model("reportsModel");	
			$this->load->model("adsModel");	
			$this->load->model("ManufacturerModel");
			$this->load->model("inquiryModel");
			$this->load->model("subscriptionModel");
	}
	
	public function index()
	{
		$this->load->view('home');
	}
	public function privacy_policy()
	{
			$this->load->view('privacypolicy');
					
	}	
	public function dashboard()
	{ 
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
                   
                // load data		
		$viewdata = $this->ManufacturerModel->get_inactive_paged_list($this->limit, $offset);
		$countmanufacture=$this->ManufacturerModel->count_inactivemanufacture();
		$data['countinactive']=$countmanufacture[0]['count(*)'];
		$countwaiting=$this->ManufacturerModel->get_waiting_paged_list_count();		
		$data['waiting']= $countwaiting->num_rows();
		$countads=$this->inquiryModel->count_ads();
		$data['countads']=$countads[0]['count(*)'];
		$countproduct=$this->inquiryModel->count_product();
		$data['countproduct']=$countproduct[0]['count(*)'];
		$countwhatsnew=$this->inquiryModel->count_whatsnew();
		$data['countwhatsnew']=$countwhatsnew[0]['count(*)'];
		$data['subscriberscount']=count($this->subscriptionModel->get_daily_sub_by_date()->result());
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Manufacturer Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."index/";
		$config['total_rows'] = $this->ManufacturerModel->count_latest_ten();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('welcome_message',$data);
		$this->load->view('footer');
		} else {
		 redirect(base_url().'login', 'refresh');
		}
	
		
	}
	
	function logout()
	 {
	   $this->session->unset_userdata('logged_in');
	   redirect(base_url().'login', 'refresh');
	 }
	 
	 function settings(){
		 
		 $this->load->helper(array('form', 'url'));
		 
		 $session_data = $this->session->userdata('logged_in');
		 $data['username'] = $session_data['username'];
		 $data['password'] = $session_data['password'];
		 
		 $data['title'] = 'Settings';
		 $data['action'] = site_url('welcome/check');
		 $this->load->view('header',$data);
		 $this->load->view('welcome/sidebar',$data);
		 $this->load->view('settings',$data);
		 $this->load->view('footer'); 
	 }
	 
	 function check(){
	 
	 	 $this->load->library('form_validation');

	     $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_pass');
		 $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|xss_clean');
		 
		 if($this->form_validation->run() == FALSE)
	     {
		 	$this->settings();
	     }
	     else
	     {
		 	
				$session_data = $this->session->userdata('logged_in');
		        $id = $session_data['id'];
				$pass = array('password' => $this->input->post('newpassword'));
				$this->load->model("homeModel");
				$this->homeModel->updatepass($id,$pass);
				redirect('welcome', 'refresh');
	     }
		  		 
	 }
	 
	 function check_pass($password)
 	 {
	 	$session_data = $this->session->userdata('logged_in');
		$username = $session_data['username'];
	    $result = $this->user->login($username, $password);
	 
	    if($result) {		 
		 	return TRUE;
	   	}
	    else
	    {
		 	$this->form_validation->set_message('check_pass', 'Invalid password, Please enter correct password');
		 	return false;
	    }
 	 }
	 
	 function action($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->leavesModel->changestatus($id,$status);
			
				redirect(base_url().'welcome','refresh');
		}
	
	
}