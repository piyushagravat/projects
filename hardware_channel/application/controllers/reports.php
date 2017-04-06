<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	private $limit = 100;
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
		$this->load->model("reportsModel");	
		$this->load->model("ManufacturerModel");
                $this->load->model("adsModel");
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
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->reportsModel->get_paged_list($this->limit, $offset)->result();
		$data['inquirycount'] = $this->reportsModel->get_chart_data();
        
                $data["viewdata"] = $viewdata;
		$data['title'] = 'Manucaturer Reports';
		$data['action'] = "All Record";
			
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."reports/index/";
		$config['total_rows'] = $this->reportsModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('reports/manufreport',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'reports/manufreport', 'refresh');
		} 
	}
	public function downloadmanufacture($txtstartdate, $txtenddate,$selmanufacture)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
		
               $viewdata = $this->reportsModel->get_chart_data($txtstartdate, $txtenddate,$selmanufacture);
		$data["viewdata"] = $viewdata;
                $data['title'] = 'Manucaturer Reports';
		$data['action'] = "All Record";
				
		//$this->load->view('header',$data);
		$this->load->view('reports/downloadmanufacreport',$data);
	}
    
	public function manufactureinquiry()
	{
               $session_data = $this->session->userdata('logged_in');		
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;	
                $data['title'] = 'Manufacturer Inquiry';
               
		$viewdata = $this->reportsModel->get_paged_list()->result();
		 $data["viewdata"] = $viewdata;
		 //   echo $this->db->last_query(); exit;
               // print_r($_POST);
              //  print_r($viewdata);
                
		$this->load->view('header',$data);
		$this->load->view('reports/manufacturelist',$data);
		$this->load->view('footer');
	        
	}
	public function viewmanufactureinquiry()
	{
                $this->form_validation->set_rules('txtstartdate', 'Start Date', 'required');
                $this->form_validation->set_rules('txtenddate', 'End Date', 'required');		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->manufactureinquiry();
		}	
		else
		{    
                    $session_data = $this->session->userdata('logged_in');		
                    $data['email'] = $session_data['email'];
                    $data['session_data'] = $session_data;	
                    $data['title'] = 'Manufacturer Inquiry';
                    $viewdata = $this->reportsModel->get_chart_data($_POST['txtstartdate'], $_POST['txtenddate'],$_POST['selmanufacture']);
					
                    $data["txtstartdate"] = $_POST['txtstartdate'];
                    $data["txtenddate"] = $_POST['txtenddate'];
                    $data["selmanufacture"] = $_POST['selmanufacture'];
                    $data["viewdata"] = $viewdata;
                    $this->load->view('header',$data);
                    $this->load->view('reports/manufreportwithdate',$data);
                    $this->load->view('footer');

            }    
	        
	}
	
	
	public function adsselectinquiry()
	{
        $session_data = $this->session->userdata('logged_in');		
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;	
                $data['title'] = 'Ads Inquiry';
               
		$viewdata = $this->reportsModel->get_ads_list()->result();
	
		 $data["viewdata"] = $viewdata;
		   
          
        
				     
		$this->load->view('header',$data);
		$this->load->view('reports/adsmanufalist',$data);
		$this->load->view('footer');
	        
	}
	
	public function viewadsinquiry()
	{
		$this->form_validation->set_rules('txtstartdate', 'Start Date', 'required');
		$this->form_validation->set_rules('txtenddate', 'End Date', 'required');		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->adsselectinquiry();
		}	
		else
		{    
                    $session_data = $this->session->userdata('logged_in');		
                    $data['email'] = $session_data['email'];
                    $data['session_data'] = $session_data;	
                    $data['title'] = 'Ads Inquiry';
                    $viewdata = $this->reportsModel->get_ads_data($_POST['txtstartdate'], $_POST['txtenddate'],$_POST['selads']);
                    $data["txtstartdate"] = $_POST['txtstartdate'];
                    $data["txtenddate"] = $_POST['txtenddate'];
                    $data["selads"] = $_POST['selads'];
                    $data["viewdata"] = $viewdata;
					
                    $this->load->view('header',$data);
                    $this->load->view('reports/adsinquiryreport',$data);
                    $this->load->view('footer');

            }    
	        
	}
	
	
	public function adsinquiry()
	{ 	   
            
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin") { 
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->inquiryModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
	
		$data['title'] = 'Ads Inquiry';
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
				
		$this->load->view('header',$data);
		$this->load->view('reports/adsinquiryreport',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'reports/adsinquiryreport', 'refresh');
		}
	}
	
	
	public function search_adsinquiry()
	{ 	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchads');
		
		$viewdata = $this->inquiryModel->get_search_adsinquiry_list($this->limit, $offset,$val)->result();
		
		
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Ads Inquiry';
		$data['action'] = "All Record";
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."inquiry/search_adsinquiry/";
		$config['total_rows'] = $this->inquiryModel->count_search_adsinquiry_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		
		$cat = $this->inquiryModel->get_search_list($this->limit, $offset,$val)->result();
	
		$this->load->view('header',$data);
		$this->load->view('reports/searchadsinquiry',$data);
		$this->load->view('footer');
	}
	public function downloadadsreport()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
		$viewdata = $this->inquiryModel->get_paged_list(10000, 0)->result();
               
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Advertisment Inquiry Reports';
		$data['action'] = "All Record";
				
		//$this->load->view('header',$data);
		$this->load->view('reports/downloadads',$data);
	}
      
	public function downloadadsreportwithdate($txtstartdate, $txtenddate,$selads)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
		
        $viewdata = $this->reportsModel->get_ads_data($txtstartdate, $txtenddate,$selads);
		$data["viewdata"] = $viewdata;
        $data['title'] = ' Advertisment Inquiry Reports With Date';
		$data['action'] = "All Record";
				
		//$this->load->view('header',$data);
		$this->load->view('reports/downloadads',$data);
	}
    
	public function selwhatsnewinquiry()
	{
               $session_data = $this->session->userdata('logged_in');		
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;	
                $data['title'] = 'Ads Inquiry';
               
		$viewdata = $this->reportsModel->get_whatsnew_list()->result();
	
		 $data["viewdata"] = $viewdata;
		   
              //  print_r($viewdata);
        
				     
		$this->load->view('header',$data);
		$this->load->view('reports/whatsnewlist',$data);
		$this->load->view('footer');
	        
	}  
	
	public function viewwhatsnewinquiry()
	{
        $this->form_validation->set_rules('txtstartdate', 'Start Date', 'required');
        $this->form_validation->set_rules('txtenddate', 'End Date', 'required');		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->selwhatsnewinquiry();
		}	
		else
		{    
                    $session_data = $this->session->userdata('logged_in');		
                    $data['email'] = $session_data['email'];
                    $data['session_data'] = $session_data;	
                    $data['title'] = 'Whats New Product Inquiry';
                    $viewdata = $this->reportsModel->get_wtsnew_data($_POST['txtstartdate'], $_POST['txtenddate'],$_POST['selwtsnewproduct']);
					
                    $data["txtstartdate"] = $_POST['txtstartdate'];
                    $data["txtenddate"] = $_POST['txtenddate'];
                    $data["selwtsnewproduct"] = $_POST['selwtsnewproduct'];
                    $data["viewdata"] = $viewdata;
					
					
                    $this->load->view('header',$data);
                    $this->load->view('reports/whatsnewinquiryreport',$data);
                    $this->load->view('footer');

            }    
	        
	}
	
	//Old Whats new inquiry function //
    public function whatsnewinquiry()
	{ 	
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin") { 
                $uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->inquiryModel->get_paged_list_whatsnew_product($this->limit, $offset, $session_data['id'])->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Product Inquiry';
		$data['action'] = "All Record";
		$data["client"] = $this->inquiryModel->get_client_by_whatsnew($session_data['id'])->row();		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."reports/index/";
		$config['total_rows'] = $this->inquiryModel->count_all_client($session_data['id']);
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('reports/whatsnewinquiryreport',$data);
		$this->load->view('footer');  
                } else {
		redirect(base_url().'reports/whatsnewinquiryreport', 'refresh');
		}
	}
	
	
	public function search_wtsinquiry()
	{ 	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchwtsnew');
		
		$viewdata = $this->inquiryModel->get_search_wtsnewinquiry_list($this->limit, $offset,$val)->result();
		
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Ads Inquiry';
		$data['action'] = "All Record";
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."inquiry/search_wtsinquiry/";
		$config['total_rows'] = $this->inquiryModel->count_search_wtsnewinquiry_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		
		$cat = $this->inquiryModel->get_wtsnewsearch_list($this->limit, $offset,$val)->result();
	//print_r($this->db->last_query());
		$this->load->view('header',$data);
		$this->load->view('reports/searchwhatsnewinquiry',$data);
		$this->load->view('footer');
		
	}
	
	
    public function downloadwhatsnewreport()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
		
                $viewdata = $this->inquiryModel->get_paged_list_whatsnew_product(10000, 0, $session_data['id'])->result();
	        $data["client"] = $this->inquiryModel->get_client_by_whatsnew($session_data['id'])->row();		
                $data["viewdata"] = $viewdata;
		$data['title'] = 'Advertisment Inquiry Reports';
		$data['action'] = "All Record";
				
		//$this->load->view('header',$data);
		$this->load->view('reports/downloadwtsnew',$data);
	}
	
	public function downloadwhatsnewreportwithdate($txtstartdate, $txtenddate,$selwtsnewproduct)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
	
	    $viewdata = $this->reportsModel->get_wtsnew_data($txtstartdate, $txtenddate,$selwtsnewproduct);
		$data["viewdata"] = $viewdata;
        $data['title'] = ' Whats New Inquiry Reports With Date';
		$data['action'] = "All Record";
				
		//$this->load->view('header',$data);
		$this->load->view('reports/downloadwtsnew',$data);
	}
	
        public function customerlocation()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
                $data['title'] = 'Customer With Loaction';
		
                $data['location'] = $this->inquiryModel->get_user_list_with_location()->result();	
	        $this->load->view('header',$data);
		$this->load->view('reports/customerlist',$data);
		$this->load->view('footer');
	}
        public function viewcustomerdata()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
                $data['title'] = 'Customer With Loaction';
		if($session_data["role"] == "Admin") { 
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->inquiryModel->get_user_list_with_location_byid($_POST['sellocation'])->result();
		//print_r($_POST);exit;
                //echo '<pre>';print_r($viewdata);exit;
                $data["sellocation"] = $_POST['sellocation'];
                $data["viewdata"] = $viewdata;
		$data['title'] = 'Customer Data';
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
		
		$this->load->view('header',$data);
		$this->load->view('reports/viewcustomerlist',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'reports/viewcustomerlist', 'refresh');
		}
                
                
	} 
        
          public function downloadcustdata($sellocation)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
		
                $viewdata = $this->inquiryModel->get_user_list_with_location_byid($sellocation)->result();
	        $data["viewdata"] = $viewdata;
		$data['title'] = 'Customer Data';
		
		$this->load->view('reports/downloadcusomerdata',$data);
	}
	public function view($aid)
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->reportsModel->get_paged_list($this->limit, $offset, $aid)->result();
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Advertisements Reports';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."reports/view/".$aid."/";
		$config['total_rows'] = $this->reportsModel->count_all($aid);
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["adsaid"] = $aid;	
		$this->load->view('header',$data);
		$this->load->view('reports/adsreport',$data);
		$this->load->view('footer');
	}
		
	public function download($aid)
	{
		if($aid != "") { 
		
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
		$viewdata = $this->reportsModel->get_paged_list(10000, 0, $aid)->result();
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Advertisements Reports';
		$data['action'] = "All Record";
				
		$data["adsaid"] = $aid;	
		//$this->load->view('header',$data);
		$this->load->view('reports/downloadreport',$data);
		$this->load->view('footer');
		}
		else {
		echo "Sorry!! You are on wrong page. Go Back! ";
		}
	}
	
	
}