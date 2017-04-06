<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry extends CI_Controller {
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
		$this->load->model("inquiryModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin") { 
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->inquiryModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		
		$data['title'] = 'Inquiry';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."inquiry/index/";
		$config['total_rows'] = $this->inquiryModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["offset"]= $offset;	
		$data["num"] = $this->uri->segment(3);		
		$this->load->view('header',$data);
		$this->load->view('inquiry/adsinquiry',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'inquiry/', 'refresh');
		}
	}
	
	
	
	
	public function productinquiry()
	{ 	
                
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin") { 
                $uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->inquiryModel->get_paged_list_product($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Product Inquiry';
		$data['action'] = "All Record";
		$data["client"] = $this->inquiryModel->get_client_by_id($session_data['id'])->row();		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."inquiry/productinquiry/";
		$config['total_rows'] = $this->inquiryModel->count_all_product_inquiry();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["offset"]= $offset;
		$data["num"] = $this->uri->segment(3);		
		$this->load->view('header',$data);
		$this->load->view('inquiry/productinquiry',$data);
		$this->load->view('footer');  
                } else {
		redirect(base_url().'inquiry/', 'refresh');
		}
	}
	
	public function whatsnewinquiry()
	{ 	
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin") { 
        $uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->inquiryModel->get_paged_list_whatsnew_product($this->limit, $offset, $session_data['id'])->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Whatsnew Inquiry';
		$data['action'] = "All Record";
		$data["client"] = $this->inquiryModel->get_client_by_whatsnew($session_data['id'])->row();		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."inquiry/whatsnewinquiry/";
		$config['total_rows'] = $this->inquiryModel->count_all_whatsnew_product_inquiry();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["offset"]= $offset;	
		$data["num"] = $this->uri->segment(3);		
		$this->load->view('header',$data);
		$this->load->view('inquiry/whatsnewinquiry',$data);
		$this->load->view('footer');  
                } else {
		redirect(base_url().'inquiry/whatsnewinquiry', 'refresh');
		}
	}
	
	public function dealerinquiry()
	{ 	
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin") { 
                $uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->inquiryModel->get_paged_list_dealer($this->limit, $offset)->result();
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Dealer Inquiry';
		$data['action'] = "All Record";
		//$data["client"] = $this->inquiryModel->get_client_by_id($session_data['id'])->row();		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."inquiry/dealerinquiry/";
		$config['total_rows'] = $this->inquiryModel->count_all_dealer();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');
		$data["num"] = $this->uri->segment(3);		
		$data["offset"]= $offset;	
		$this->load->view('header',$data);
		$this->load->view('inquiry/dealerinquiry',$data);
		$this->load->view('footer');  
                } else {
		redirect(base_url().'inquiry/', 'refresh');
		}
	}
	
	public function manufeinquiry()
	{ 	
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin") { 
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
        $viewdata = $this->inquiryModel->get_paged_list_manufa_inquiry($this->limit, $offset)->result();		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Manufacturer Enquiry';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."inquiry/manufeinquiry/";
		$config['total_rows'] = $this->inquiryModel->count_all_manufa();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);
		$data["offset"]= $offset;
	
		$this->load->view('header',$data);
		$this->load->view('inquiry/manufenquiry',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'inquiry/', 'refresh');
		}
	}
	public function deletewtsnew($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->inquiryModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('inquiry/whatsnewinquiry/'.$offset,'refresh');
	}
	public function deletedealerinq($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->inquiryModel->deletedealer($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('inquiry/dealerinquiry/'.$offset,'refresh');
	}
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->inquiryModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('inquiry/productinquiry/'.$offset,'refresh');
	}
	public function delete_ads($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->inquiryModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('inquiry/index/'.$offset,'refresh');
	}
	public function delete_manuf($id)
	{
		
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->inquiryModel->delete_manufa_inquiry($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('inquiry/manufeinquiry/'.$offset,'refresh');
	}	
	
	
}