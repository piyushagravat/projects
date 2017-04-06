<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	private $limit = 15;
	function __construct()
	{
		parent::__construct();	
		
	    if($this->session->userdata('logged_in'))
		   {
			 $session_data = $this->session->userdata('logged_in');
			 $data['email'] = $session_data['email'];
			 $data['session_data'] = $session_data;
		   }
		else
		   {
				 redirect(base_url().'login', 'refresh');
		   }		
		$this->load->model("userModel");
		$this->load->model("ManufacturerModel");		
		
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
	
		// load data		
		$viewdata = $this->userModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Employees';
		$data['action'] = "All Record";
		$data["userlist"] = $this->userModel->get_user_list()->result();
		
		$data["manufacture"] = $this->ManufacturerModel->get_paged_list(1000, 0)->result();
		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."users/index/";
		$config['total_rows'] = $this->userModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);	
		$data["offset"]= $offset;
	
		$this->load->view('header',$data);
		$this->load->view('users/all',$data);
		$this->load->view('footer');
	}
	
	
	public function search_user()
	{ 	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchuser');
		$viewdata = $this->userModel->get_search_user_list(1000, 0,$val)->result();
		
		$data["userlist"] = $this->userModel->get_user_list()->result();
		$data["viewdata"] = $viewdata;		
		$data['title'] = 'Users';
		$data['action'] = "All Record";
		$data["userlist"] = $this->userModel->get_user_list(1000, 0)->result();	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."users/search_user/";
		$config['total_rows'] = $this->userModel->count_search_user_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
	
		$user = $this->userModel->get_search_list($this->limit, $offset,$val)->result();


		$this->load->view('header',$data);
		$this->load->view('users/search_user',$data);
		$this->load->view('footer');
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->userModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('users/index/'.$offset,'refresh');
	}
	
	
}