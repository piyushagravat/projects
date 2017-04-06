<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends CI_Controller {
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
	
		$this->load->model("brandModel");
		$this->load->model("adsModel");		
		
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	 
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
                   
        // load data		
		$viewdata = $this->brandModel->get_paged_list($this->limit, $offset)->result();		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Brand Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."brand/index/";
		$config['total_rows'] = $this->brandModel->count_brands();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);	
		$data["offset"]= $offset; 	
		$data["brands"] = $this->brandModel->get_paged_list(1000, 0)->result();
		$this->load->view('header',$data);
		$this->load->view('brand/all',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'brand', 'refresh');
		}
	}
	
	public function search_brand()
	{ 	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchbrand');
		$viewdata = $this->brandModel->get_search_brand_list($this->limit, $offset,$val)->result();
		$data["brand"] = $this->brandModel->get_paged_list(1000, 0)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Brand';
		$data['action'] = "All Record";
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."brand/search_brand/";
		$config['total_rows'] = $this->brandModel->count_search_brand_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		
		$cat = $this->brandModel->get_search_list($this->limit, $offset,$val)->result();
	
		$this->load->view('header',$data);
		$this->load->view('brand/search_brand',$data);
		$this->load->view('footer');
	}
	public function brandbymanufacturers($id)
	{ 	   
              
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
                // load data		
		$viewdata = $this->brandModel->get_paged_list_id($id,$this->limit, $offset)->result();
               $data["manufacture"] = $this->brandModel->get_user_by_id($id)->row();
     
			
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Brand Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."brand/brandbymanufacturers/".$id."/";
		$config['total_rows'] = $this->brandModel->count_all_brands_by_id($id);
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(4);			$data["offset"]= $offset;				
		$this->load->view('header',$data);
		$this->load->view('brand/brandbymanufacturer',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'brand', 'refresh');
		}
	}
	

	
	public function add($error = "")
	{
		
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['title'] = 'Brand Add';
		$data['action'] = "Add Record";
		$data['brand'] = $this->brandModel->get_user_role_list()->result();
        $data['Manufacture'] = $this->adsModel->get_user_list()->result();
		$data['error'] = $error;
		
        $this->load->view('header',$data);
		$this->load->view('brand/add',$data);
		$this->load->view('footer');
	}
	
	
	public function addrecord()
	{       
              
			   $this->form_validation->set_rules('txtbrandname', 'Brand Name', 'required');
               $this->form_validation->set_rules('selclient', 'Manufacturer Name', 'required');     

		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{		   $this->load->library('upload');				
		           $file1 = "";
                    
                    if (!empty($_FILES['userfile1']['name']))
                    {	
                            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            $curenttimestamp = time();
                            $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                            $config1['upload_path'] = "./doc/";
                            $config1['allowed_types'] = 'pdf';
                            $config1['max_size']	= '100000';				
                            $config1['file_name'] = $code1;		
                            $this->upload->initialize($config1);		
                         
							if (!$this->upload->do_upload('userfile1'))
                            {	
                                    $error = $this->upload->display_errors();
                                    $this->add($error);
									
									
                            }
                            else
                            {
                                    $val1 = array('upload_data' => $this->upload->data());				
                                    $file1 = $val1["upload_data"]["orig_name"];
                            }
                    
				 }
		                $data = array(          
                                  'brandname' => $this->input->post('txtbrandname'),
								  'mid' => $this->input->post('selclient'),
								  'catalogue' => $file1,
                                    );   	
               
                   
                        $id = $this->brandModel->save($data);
            
                    
					
			$this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('brand/index/','refresh');	
		}
            
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->brandModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('brand/index/'.$offset,'refresh');
                
	}
		public function deletebymid($id)
	{
		$uri_segment = 4;		$uri_segment1 = 5;		$offset = $this->uri->segment($uri_segment);		$offset1 = $this->uri->segment($uri_segment1);
		$this->brandModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('brand/brandbymanufacturers/'.$offset.'/'.$offset1,'refresh');
                
	}


	public function editbymid($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->brandModel->get_by_id($id)->row();
									
		$data['title'] = 'Brand';
		$data['action'] = "Edit Record";
		 $data['Manufacture'] = $this->adsModel->get_user_list()->result();			
		$this->load->view('header',$data);
		$this->load->view('brand/editbymid',$data);
		$this->load->view('footer');
	}
	public function updaterecordbymid()
	{
		$this->form_validation->set_rules('txtbrandname', 'Brand Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
		
			$this->load->library('upload');	
			$file1 = "";
           
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./doc/";
				$config1['allowed_types'] = 'pdf';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1;		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file1 = $val2["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file1 = $this->input->post('userfile1old');
			}			
			$data = array(
								'brandname' => $this->input->post('txtbrandname'),
								'mid' => $this->input->post('selclient'),
								'catalogue' => $file1,
                         );   	
		
			$id = $this->input->post('id');	
			$pageid = $this->input->post('pageid');				
			$this->brandModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('brand/brandbymanufacturers/'.$pageid,'refresh');	
		}				
	}
	
	
	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->brandModel->get_by_id($id)->row();
									
		$data['title'] = 'Brand';
		$data['action'] = "Edit Record";
		 $data['Manufacture'] = $this->adsModel->get_user_list()->result();			
		$this->load->view('header',$data);
		$this->load->view('brand/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtbrandname', 'Brand Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
		
			$this->load->library('upload');	
			$file1 = "";
           
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./doc/";
				$config1['allowed_types'] = 'pdf';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1;		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file1 = $val2["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file1 = $this->input->post('userfile1old');
			}			
			$data = array(
								'brandname' => $this->input->post('txtbrandname'),
								'mid' => $this->input->post('selclient'),
								'catalogue' => $file1,
                         );   	
		
			$id = $this->input->post('id');	
			$pageid = $this->input->post('pageid');				
			$this->brandModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('brand/index/'.$pageid,'refresh');	
		}				
	}
	
	function action($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->brandModel->changestatus($id,$status);
			
				redirect(base_url().'brand','refresh');
		}
	
	
}