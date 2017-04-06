<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Whatsnew extends CI_Controller {
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
		$this->load->model("WhatsnewModel");
		$this->load->model("ProductModel");
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
		$viewdata = $this->WhatsnewModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Whats New Products';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."whatsnew/index/";
		$config['total_rows'] = $this->WhatsnewModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);
		$data["offset"]= $offset;	

			
		$this->load->view('header',$data);
		$this->load->view('whatsnew/all',$data);
		$this->load->view('footer');
		} else {
                    redirect(base_url().'whatsnew', 'refresh');
		}
	}
	
	 public function productbymanufacturers($id)
	{ 	   
                
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
                 
                // load data		
		$viewdata = $this->WhatsnewModel->get_by_manufacture_id($id)->result();
		
        $data["viewdata"] = $viewdata;
		$data['title'] = 'Whats New Products';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."whatsnew/productbymanufacturers/".$id."/";
		$config['total_rows'] = $this->WhatsnewModel->count_all_by_manufacture_id();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["offset"]= $offset;		
		$this->load->view('header',$data);
		$this->load->view('whatsnew/allbymanufacturer',$data);
		$this->load->view('footer');
		
	}
	
    public function addwhatsnew()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Mark Whatsnew Product';
		$data['action'] = "Add Record";
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$viewdata = $this->WhatsnewModel->get_all_product_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['admin'] = $this->WhatsnewModel->get_user_role_list()->result();
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');
		$data['dealer'] = $this->ProductModel->get_user_role_list()->result();
		$data["categories"] = $this->ProductModel->get_categories_list()->result();
		$data["subcategories"] = $this->ProductModel->get_subcategories_list()->result();
		$data['Manufacture'] = $this->adsModel->get_user_list()->result();
		$this->load->model('ProductModel');
		$data['list']=$this->ProductModel->getCategories();
		$this->load->view('header',$data);
		$this->load->view('whatsnew/addwhatsnew',$data);
		$this->load->view('footer');
	}
        
     
	public function addrecordwhatsnew()
	{
		$this->form_validation->set_rules('txtproductname', 'Product Name', 'required');
		$this->form_validation->set_rules('txtstartdate', 'Start Date', 'required|callback_compareDate');		
		$this->form_validation->set_rules('txtenddate', 'End Date', 'required|callback_compareDate');
		$this->form_validation->set_rules('selclient', 'Select One Manufacture', 'required|callback_select_validate');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{				
		   $this->load->library('upload');				
			$file1 = "";
                        $file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1;		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					print_r($error);
					$this->add($error);
				}
				else
				{
					$val1 = array('upload_data' => $this->upload->data());				
					$file1 = $val1["upload_data"]["orig_name"];
				}
			}
			
                        if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1;		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					print_r($error);
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file2 = $val2["upload_data"]["orig_name"];
				}
			}
                      
                    $data = array(      'pname' => $this->input->post('txtproductname'), 
                                        'product_image1' => $file1,
                                        'product_image2' => $file2,
                                        'manufacture_id' => $this->input->post('selclient'), 
                                        'startdate' => $this->input->post('txtstartdate'),
										'enddate' => $this->input->post('txtenddate'),
                                        'status' => "Disable"
                            	);   	
			$id = $this->WhatsnewModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 	
			
			
						
			redirect('whatsnew/productbyfacturers','refresh');	
		}
            
	}
    public function event()
	{ 	   
                
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
                   
                // load data		
		$viewdata = $this->WhatsnewModel->get_mark_product_list($this->limit, $offset)->result();
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Whats New Products';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."whatsnew/index/";
		$config['total_rows'] = $this->WhatsnewModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data["num"] = $this->uri->segment(4);	
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('whatsnew/event',$data);
		$this->load->view('footer');
		} else {
                    redirect(base_url().'whatsnew', 'refresh');
		}
	}
	  public function loadData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('ProductModel');
		$result=$this->ProductModel->getData($loadType,$loadId);
		$HTML="";
		
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}
	
	
	// What's New Products Add/Delete/Edit......
        
	public function add()
	{
			$session_data = $this->session->userdata('logged_in');
			$data['email'] = $session_data['email'];
			$data['session_data'] = $session_data;
			$data['title'] = 'Mark Whatsnew Product';
			$data['action'] = "Add Record";
			$uri_segment = 4;
			$offset = $this->uri->segment($uri_segment);
			$viewdata = $this->WhatsnewModel->get_all_product_list($this->limit, $offset)->result();
			$data["viewdata"] = $viewdata;
			$data['admin'] = $this->WhatsnewModel->get_user_role_list()->result();
			$data['pagination'] = $this->pagination->create_links();
			$data['message'] = $this->session->flashdata('message');
			$data['dealer'] = $this->ProductModel->get_user_role_list()->result();
			$data["categories"] = $this->ProductModel->get_categories_list()->result();
			$data["subcategories"] = $this->ProductModel->get_subcategories_list()->result();
			$data['Manufacture'] = $this->adsModel->get_user_list()->result();
			$this->load->model('ProductModel');
			$data['list']=$this->ProductModel->getCategories();
			$this->load->view('header',$data);
			$this->load->view('whatsnew/add',$data);
			$this->load->view('footer');
	}
        
     
	public function addrecord()
	{
			$this->form_validation->set_rules('txtproductname', 'Product Name', 'required');
			$this->form_validation->set_rules('txtstartdate', 'Start Date', 'required|callback_compareDate');		
			$this->form_validation->set_rules('txtenddate', 'End Date', 'required|callback_compareDate');
			$this->form_validation->set_rules('selclient', 'Select One Manufacture', 'required|callback_select_validate');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{				
		   $this->load->library('upload');				
			$file1 = "";
                        $file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1;		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					print_r($error);
					$this->add($error);
				}
				else
				{
					$val1 = array('upload_data' => $this->upload->data());				
					$file1 = $val1["upload_data"]["orig_name"];
				}
			}
			
            if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1;		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					print_r($error);
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file2 = $val2["upload_data"]["orig_name"];
				}
			}
                                           
				$data = array(      'pname' => $this->input->post('txtproductname'), 
									'product_image1' => $file1,
									'product_image2' => $file2,
									'manufacture_id' => $this->input->post('selclient'), 
									'startdate' => $this->input->post('txtstartdate'),
									'enddate' => $this->input->post('txtenddate'),
									'detail' => $this->input->post('txtdetail'),
									'status' => "Disable"
							);   	
			$id = $this->WhatsnewModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 		
			
			$this->pushmsgprod();
			
			redirect('whatsnew/','refresh');	
		}
            
	}
	
	public function pushmsgprod()
	{
		// Push Notification for Mobile App
			$ch = curl_init(); 
 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			$arr = array();
			array_push($arr, "X-Parse-Application-Id: 5cCm4gfMfvzkwpbipAGgOGFQms3ZiFNnhhMyd1VX");
			array_push($arr, "X-Parse-REST-API-Key: RQr2sal4L4XGXqAmO1IrsCNjgX8mBII8wGdNZxa0");
			array_push($arr, "Content-Type: application/json");
			 
			curl_setopt($ch, CURLOPT_HTTPHEADER, $arr);
			curl_setopt($ch, CURLOPT_URL, 'https://api.parse.com/1/push');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "channel": "whatsnew","data": { "alert": "New Product Added in Whats New Products Section.!" } }');
			 
			curl_exec($ch);
			curl_close($ch);
			
			
	}
	
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->WhatsnewModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('whatsnew/index/'.$offset,'refresh');
	}
	
	
	public function deletebymid($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->WhatsnewModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('whatsnew/productbymanufacturers/'.$offset,'refresh');
	}
	
	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->WhatsnewModel->get_by_id($id)->row();
									
		$data['title'] = 'Dealer';
		$data['action'] = "Edit Record";
		$data['Manufacture'] = $this->adsModel->get_user_list()->result();
	
        			
		
        $this->load->view('header',$data);
		$this->load->view('whatsnew/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtproductname', 'Product Name', 'required');
                $this->form_validation->set_rules('txtstartdate', 'Start Date', 'required|callback_compareDate');		
		$this->form_validation->set_rules('txtenddate', 'End Date', 'required|callback_compareDate');
                $this->form_validation->set_rules('selclient', 'Select One Manufacture', 'required|callback_select_validate');
		  
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	$this->load->library('upload');	
			$file1 = "";
                        $file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	
                            
                          
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
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
					$val1 = array('upload_data' => $this->upload->data());				
					$file1 = $val1["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file1 = $this->input->post('userfile1old');
			}
			
                        if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1;		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file2 = $val2["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file2 = $this->input->post('userfile2old');
			}
                    
                    
			if($this->input->post('seltoaddprod')) { $whatsnew = 1; } else { $whatsnew  = 0; }
                    
                        $data = array(
                                        'pname' => $this->input->post('txtproductname'), 
                                        'product_image1' => $file1,
                                        'product_image2' => $file2,
                                        'manufacture_id' => $this->input->post('selclient'), 
                                        'startdate' => $this->input->post('txtstartdate'),
										'enddate' => $this->input->post('txtenddate'),
										'detail' => $this->input->post('txtdetail'),
                                      );   	
                      
			$id = $this->input->post('id');
			$pageid = $this->input->post('pageid');				
			$this->WhatsnewModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('whatsnew/index/'.$pageid,'refresh');	
		}				
	}
	
	
	public function editbyid($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->WhatsnewModel->get_by_id($id)->row();
									
		$data['title'] = 'Dealer';
		$data['action'] = "Edit Record";
		$data['Manufacture'] = $this->adsModel->get_user_list()->result();
	
        			
		
        $this->load->view('header',$data);
		$this->load->view('whatsnew/editbyid',$data);
		$this->load->view('footer');
	}
	public function updaterecordbyid()
	{
		$this->form_validation->set_rules('txtproductname', 'Product Name', 'required');
                $this->form_validation->set_rules('txtstartdate', 'Start Date', 'required|callback_compareDate');		
		$this->form_validation->set_rules('txtenddate', 'End Date', 'required|callback_compareDate');
                $this->form_validation->set_rules('selclient', 'Select One Manufacture', 'required|callback_select_validate');
		  
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	$this->load->library('upload');	
			$file1 = "";
                        $file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	
                            
                          
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
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
					$val1 = array('upload_data' => $this->upload->data());				
					$file1 = $val1["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file1 = $this->input->post('userfile1old');
			}
			
                        if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./images/whatsnewproduct/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1;		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file2 = $val2["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file2 = $this->input->post('userfile2old');
			}
                    
                    
			if($this->input->post('seltoaddprod')) { $whatsnew = 1; } else { $whatsnew  = 0; }
                    
                        $data = array(
                                        'pname' => $this->input->post('txtproductname'), 
                                        'product_image1' => $file1,
                                        'product_image2' => $file2,
                                        'manufacture_id' => $this->input->post('selclient'), 
                                        'startdate' => $this->input->post('txtstartdate'),
										'enddate' => $this->input->post('txtenddate'),
										'detail' => $this->input->post('txtdetail'),
                                      );   	
                      
			$id = $this->input->post('id');
			$pageid = $this->input->post('pageid');				
			$this->WhatsnewModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('whatsnew/productbymanufacturers/'.$pageid,'refresh');	
		}				
	}
	
	
	
	function action($id)
		{
				// save data				
				$status = array('status' => 0);
				$this->ProductModel->removeprod($id,$status);
			
				redirect(base_url().'whatsnew','refresh');
		}
	function action1($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->WhatsnewModel->changestatus($id,$status);
			
				redirect(base_url().'whatsnew','refresh');
		}
	          
         public function add_images($id)
	{
             $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Whatsnew Images';
		$data['action'] = "Add Record";
                
		$data["whatsnew"] = $this->WhatsnewModel->get_by_id($id)->row();
				
	 	$this->load->view('header',$data);
		$this->load->view('whatsnew/addwhatsnewimages',$data);
		$this->load->view('footer');
	}
        
    public function addrecord_images()
	{
        
		$this->load->library('upload');
	
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    
	
			$this->upload->initialize($this->set_upload_options());
			if($this->upload->do_upload()) { 
				$val = array('upload_data' => $this->upload->data());				
				$file = $val["upload_data"]["orig_name"];
							
				$data = array('pid' => $this->input->post('pid'), 'img_name' => $file);   	
			
				$id = $this->WhatsnewModel->save_image($data);
                              
				
			}
			
		}
                
                
		$pid = $this->input->post('pid');
               
		$this->session->set_flashdata("message", "Images Uploaded Successfully...");
		redirect('whatsnew/viewimages/'.$pid,'refresh');		
	}	

	private function set_upload_options()
	{   
		//upload an image options
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
		$curenttimestamp = time();
		$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
						
		$config = array();
		$config['upload_path'] = './images/whatsnewproduct/';
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
		$config['file_name'] = $code1;	
	
		return $config;
	}
        
        public function viewimages($pid)
	{            
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data["whatsnew"] = $this->WhatsnewModel->get_by_id($pid)->row();
                $viewdata = $this->WhatsnewModel->get_whatsnew_images_list($pid)->result();
                //print_r($viewdata);die;
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Categories Images';
		$data['action'] = "All Record";
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('whatsnew/allwhatsnewimages',$data);
		$this->load->view('footer');
	}
        public function delete_image($id,$pid)
	{
		$this->WhatsnewModel->delete_image($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('whatsnew/viewimages/'.$pid,'refresh');
	} 
}