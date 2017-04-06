<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends CI_Controller {
	private $limit = 10;
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
		$uri_segment = 2;
		$offset = $this->uri->segment($uri_segment);		   
		$this->load->model("SubscriptionModel");
		$this->load->helper(array('form', 'url'));

		
	}
	public function index()
	{ 	   
        $uri_segment = 2;
		$offset = $this->uri->segment($uri_segment);
                
                // load data		
		$viewdata = $this->SubscriptionModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Subscribed Users List';
		$data['action'] = "All Record";
		$data['session_data'] = $this->session->userdata('logged_in');
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."subscription/index/";
		$config['total_rows'] = $this->SubscriptionModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);
		$data["offset"]= $offset;		
		$this->load->view('header',$data);
		$this->load->view('subscription/all',$data);
		$this->load->view('footer');
		
	}

	public function delete($id)
	{
		$uri_segment = 2;
		$offset = $this->uri->segment($uri_segment);
		
		$this->SubscriptionModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('subscription/'.$offset,'refresh');
	}


	
}