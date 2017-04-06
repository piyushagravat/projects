<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends CI_Controller {
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
		$this->load->model("ManufacturerModel");	
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
		$viewdata = $this->ManufacturerModel->get_paged_list($this->limit, $offset)->result();
		$data["manufacture"] = $this->ManufacturerModel->get_paged_list(1000, 0)->result();

		$data['title'] = 'Manufacturer Details';
		$data['action'] = "All Record";
		$result['list']=$this->ManufacturerModel->getCountry();
		$data["viewdata"] = $viewdata;	
		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."manufacturer/index/";
		$config['total_rows'] = $this->ManufacturerModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);	
		$data["offset"]= $offset;			
		$this->load->view('header',$data);
		$this->load->view('manufacturer/approved',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'manufacturer', 'refresh');
		}
	}
	
	public function search_manufa()
	{ 	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchmanufacturer');
		$viewdata = $this->ManufacturerModel->get_search_manf_list($val)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Manufacturer';
		$data['action'] = "All Record";
		$data["manufacture"] = $this->ManufacturerModel->get_paged_list(1000, 0)->result();
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."manufacturer/search_manufa/";
		$config['total_rows'] = $this->ManufacturerModel->count_search_manf_all($val);
	
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
	
		$user = $this->ManufacturerModel->get_search_list($this->limit, $offset,$val)->result();

		$this->load->view('header',$data);
		$this->load->view('manufacturer/search_manufa',$data);
		$this->load->view('footer');
	}
	
	
	public function waiting()
	{ 	   
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
                   
                // load data		
		$viewdata = $this->ManufacturerModel->get_waiting_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Manufacturer Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."manufacturer/waiting/index/";
		$config['total_rows'] = $this->ManufacturerModel->count_waiting_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;		$data["num"] = $this->uri->segment(4);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('manufacturer/waiting',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'manufacturer/inactive', 'refresh');
		}
	}
	
	
    public function inactive()
	{ 	   
                
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
                   
                // load data		
		$viewdata = $this->ManufacturerModel->get_inactive_paged_list($this->limit, $offset);
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Manufacturer Details';
		$data['action'] = "All Record";
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."manufacturer/inactive/";
		$config['total_rows'] = $this->ManufacturerModel->count_inactive_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);			
		$this->load->view('header',$data);
		$this->load->view('manufacturer/unapproved',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'manufacturer/inactive', 'refresh');
		}
	}
	 public function inactivedash()
	{ 	   
                
        $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
                   
                // load data		
		$viewdata = $this->ManufacturerModel->get_inactive_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Manufacturer Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."manufacturer/inactivedash/index/";
		$config['total_rows'] = $this->ManufacturerModel->count_inactive_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('welcome_message',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'manufacturer/inactivedash', 'refresh');
		}
	}
	
        
        
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Manufacturer Add';
		$data['action'] = "Add Record";
		$data['manufacturer'] = $this->ManufacturerModel->get_user_role_list()->result();		
	 	$data['list']=$this->ManufacturerModel->getCountry();	
		$this->load->view('header',$data);
		$this->load->view('manufacturer/add',$data);
		$this->load->view('footer');
	}
	public function addrecord()
	{
                $this->form_validation->set_rules('txtfname', 'First Name', 'required');
                $this->form_validation->set_rules('txtlname', 'Last Name', 'required');
                $this->form_validation->set_rules('txtcompanyname', 'Company Name', 'required');
                $this->form_validation->set_rules('txtaddress', 'Address', 'required');
				$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email|matches[confemail]');
				$this->form_validation->set_rules('confemail', 'Confirm Email', 'required|valid_email');
				$this->form_validation->set_rules('txtpassword', 'Password', 'required');
                $this->form_validation->set_rules('txtcontactno', 'Contact', 'required');		
				if (empty($_FILES['userfile1']['name']))
                {
                    $this->form_validation->set_rules('userfile1', 'Upload Company Logo(JPG/PNG)', 'required');
                }
				
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
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
                            $config1['upload_path'] = "./images/manufacturer/";
                            $config1['allowed_types'] = 'jpg|png';
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
                    
		
					$country=$_POST['txtcountry'];
				    $countrydata = $this->ManufacturerModel->selcountry($country);
					$countryrow = $countrydata->first_row();
					
					$state=$_POST['txtstate'];
				    $statedata = $this->ManufacturerModel->selstate($state);
					$staterow = $statedata->first_row();
					
					$city=$_POST['txtcity'];
				    $citydata = $this->ManufacturerModel->selcity($city);
					$row = $citydata->first_row();
					
					//print_r($row->city_name);
					//print_r($this->db->last_query());die;
                    $data = array(          'first_name' => $this->input->post('txtfname'),
											'last_name' => $this->input->post('txtlname'),
                                            'role' => "Manufacture",
										    'company_name' => $this->input->post('txtcompanyname'),
                                            'address' => $this->input->post('txtaddress'),
											'country' => $countryrow->country_name,
											'state' => $staterow->state_name,
											'city' => $row->city_name,
											'email' => $this->input->post('txtemail'),
											'password' =>  $this->input->post('txtpassword'),						 
											'profile_img' => $file1,
                                            'contact' => $this->input->post('txtcontactno'),
											'about_manf' => $this->input->post('txtdetails'),
											'type' => $this->input->post('rdotickbox'),
                                            'created_date' => date('Y-m-d H:i:s'),
                                            'status' => "Inactive",
											'phase' => "new_signup"
							);   	
			//print_r($_POST);die;
			//print_r($data);die;			
			
			$id = $this->ManufacturerModel->save($data);
                      
                        $this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('manufacturer','refresh');	
		}
            
	}
	
	 public function loadCityData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('ManufacturerModel');
		$result=$this->ManufacturerModel->getData($loadType,$loadId);
		$HTML="";
		
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}
	 public function loadDataEdit()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('ManufacturerModel');
		$result=$this->ManufacturerModel->getData($loadType,$loadId);
		$HTML="";
		
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->ManufacturerModel->delete($id);		
		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect(base_url().'manufacturer/index/'.$offset, 'refresh'); 
	}
	public function deleteinactive($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
	    $this->ManufacturerModel->delete($id);	
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('manufacturer/inactive/'.$offset,'refresh');
	}		
	public function deletewaiting($id)	
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->ManufacturerModel->delete($id);
		$this->session->set_flashdata("message", "Record Deleted Successfully...");
		redirect(base_url().'manufacturer/waiting/'.$offset, 'refresh');
	}	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->ManufacturerModel->get_by_id($id)->row();
									
		$data['title'] = 'Manufacturer';
		$data['action'] = "Edit Record";
		$data['clients'] = $this->ManufacturerModel->get_paged_list()->result();	
		$data['list']=$this->ManufacturerModel->getCountry();	
	
		$this->load->view('header',$data);
		$this->load->view('manufacturer/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
				
				
				$this->form_validation->set_rules('txtfname', 'First Name', 'required');
                $this->form_validation->set_rules('txtlname', 'Last Name', 'required');
			    $this->form_validation->set_rules('txtcompanyname', 'Company Name', 'required');
                $this->form_validation->set_rules('txtcontactno', 'Contact', 'required');
				$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email|matches[confemail]');
				$this->form_validation->set_rules('confemail', 'Confirm Email', 'required|valid_email');
                $this->form_validation->set_rules('txtaddress', 'Address', 'required');
				$this->form_validation->set_rules('txtpassword', 'Password', 'required');
              
				
				if($this->input->post('txtpassword') == $this->input->post('txthiddenpassword')) {
					$pass = $this->input->post('txtpassword');
				}
				else { $pass = $this->input->post('txtpassword'); }
                
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
									$config1['upload_path'] = "./images/manufacturer/";
									$config1['allowed_types'] = '*';
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
							else { 
									$file1 = $this->input->post('userfile1old');	
							}
								   
						   
							$country=$_POST['txtcountry'];
							$countrydata = $this->ManufacturerModel->selcountry($country);
							$countryrow = $countrydata->first_row();
							
							$state=$_POST['txtstate'];
							$statedata = $this->ManufacturerModel->selstate($state);
							$staterow = $statedata->first_row();
							
							$city=$_POST['txtcity'];
							$citydata = $this->ManufacturerModel->selcity($city);
							$row = $citydata->first_row();
							$data = array(
													'first_name' => $this->input->post('txtfname'),
													'last_name' => $this->input->post('txtlname'),
													'company_name' => $this->input->post('txtcompanyname'),
													'address' => $this->input->post('txtaddress'),
													'country' => $countryrow->country_name,
													'state' => $staterow->state_name,
													'city' => $row->city_name,
													'email' => $this->input->post('txtemail'),
													'password' => $pass,						 
													'profile_img' => $file1,
													'contact' => $this->input->post('txtcontactno'),
													'about_manf' => $this->input->post('txtdetails'),
													'type' => $this->input->post('rdotickbox'),
											  );   	
					//	print_r($_POST);
					//	print_r($data);die;
					
					
					$id = $this->input->post('id');	
					$uri_segment = 4;
					$pageid = $this->uri->segment($uri_segment);					
					$pageid = $this->input->post('pageid');
					
					$this->ManufacturerModel->update($id,$data);	
					
					
					$this->session->set_flashdata("message", "Record Updated Successfully..."); 
					redirect(base_url().'manufacturer/index/'.$pageid, 'refresh'); 
						
				}				
	}
	
	
	
	
	public function editwaiting($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->ManufacturerModel->get_by_id($id)->row();
									
		$data['title'] = 'Manufacturer';
		$data['action'] = "Edit Record";
		$data['clients'] = $this->ManufacturerModel->get_paged_list()->result();	
		$data['list']=$this->ManufacturerModel->getCountry();	
	
		$this->load->view('header',$data);
		$this->load->view('manufacturer/editwaiting',$data);
		$this->load->view('footer');
	}
	public function updaterecordwaiting()
	{
				
				
				$this->form_validation->set_rules('txtfname', 'First Name', 'required');
                $this->form_validation->set_rules('txtlname', 'Last Name', 'required');
			    $this->form_validation->set_rules('txtcompanyname', 'Company Name', 'required');
                $this->form_validation->set_rules('txtcontactno', 'Contact', 'required');
				$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email|matches[confemail]');
				$this->form_validation->set_rules('confemail', 'Confirm Email', 'required|valid_email');
                $this->form_validation->set_rules('txtaddress', 'Address', 'required');
				$this->form_validation->set_rules('txtpassword', 'Password', 'required');
              
				
				if($this->input->post('txtpassword') == $this->input->post('txthiddenpassword')) {
					$pass = $this->input->post('txtpassword');
				}
				else { $pass = $this->input->post('txtpassword'); }
                
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
									$config1['upload_path'] = "./images/manufacturer/";
									$config1['allowed_types'] = '*';
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
							else { 
									$file1 = $this->input->post('userfile1old');	
							}
								   
						   
							$country=$_POST['txtcountry'];
							$countrydata = $this->ManufacturerModel->selcountry($country);
							$countryrow = $countrydata->first_row();
							
							$state=$_POST['txtstate'];
							$statedata = $this->ManufacturerModel->selstate($state);
							$staterow = $statedata->first_row();
							
							$city=$_POST['txtcity'];
							$citydata = $this->ManufacturerModel->selcity($city);
							$row = $citydata->first_row();
							$data = array(
													'first_name' => $this->input->post('txtfname'),
													'last_name' => $this->input->post('txtlname'),
													'company_name' => $this->input->post('txtcompanyname'),
													'address' => $this->input->post('txtaddress'),
													'country' => $countryrow->country_name,
													'state' => $staterow->state_name,
													'city' => $row->city_name,
													'email' => $this->input->post('txtemail'),
													'password' => $pass,						 
													'profile_img' => $file1,
													'contact' => $this->input->post('txtcontactno'),
													'about_manf' => $this->input->post('txtdetails'),
													'type' => $this->input->post('rdotickbox'),
											  );   	
					//	print_r($_POST);
					//	print_r($data);die;
					
					
					$id = $this->input->post('id');	
					$uri_segment = 4;
					$pageid = $this->uri->segment($uri_segment);					
					$pageid = $this->input->post('pageid');
					
					$this->ManufacturerModel->update($id,$data);	
					
					
					$this->session->set_flashdata("message", "Record Updated Successfully..."); 
					redirect(base_url().'manufacturer/waiting/index/'.$pageid, 'refresh'); 
						
				}				
	}
	
        function action($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->ManufacturerModel->changestatus($id,$status);
			
				redirect(base_url().'manufacturer/','refresh');
		}
        function actiontwo($id,$stat)
		{
				// save data
				
				$status = array('phase' => $stat);
				$this->ManufacturerModel->changestatus($id,$status);
                                $data = array(
                                        'approved_date' => date("Y-m-d H:i:s"),
										'status' => "Active"
                                  );   	
			
                   
                                $id = $this->ManufacturerModel->update($id,$data);
				redirect(base_url().'manufacturer/waiting','refresh');
		}
        function actiondash($id,$stat)
		{
				// save data
                               
				$status = array('status' => $stat);
				$this->ManufacturerModel->changestatus($id,$status);
                                $data = array(
                                        'approved_date' => date("Y-m-d H:i:s")
                                 );   	
			
                        
                                $id = $this->ManufacturerModel->update($id,$data);
                                redirect(base_url().'manufacturer/inactivedash','refresh');
		}
                public function deletedash($id)
                {
                        $this->ManufacturerModel->delete($id);		
                        $this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
                        redirect('welcome/','refresh');
                }
            
        public function editdash($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$data["editdata"] = $this->ManufacturerModel->get_by_id($id)->row();
									
		$data['title'] = 'Manufacturer';
		$data['action'] = "Edit Record";
		$data['clients'] = $this->ManufacturerModel->get_paged_list()->result();				
		$this->load->view('header',$data);
		$this->load->view('manufacturer/editdash',$data);
		$this->load->view('footer');
	}
	public function updaterecorddash()
	{
		$this->form_validation->set_rules('txtfname', 'First Name', 'required');
                $this->form_validation->set_rules('txtlname', 'Last Name', 'required');
                $this->form_validation->set_rules('txtcompanyname', 'Company Name', 'required');
                $this->form_validation->set_rules('txtcontactno', 'Contact', 'required');
                $this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('txtaddress', 'Address', 'required');
                $this->form_validation->set_rules('txtpassword', 'Password', 'required');
                	
		if($this->input->post('txtpassword') == $this->input->post('txthiddenpassword')) {
			$pass = $this->input->post('txtpassword');
		}
		else { $pass = $this->input->post('txtpassword'); }
                
                if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
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
                                $config1['upload_path'] = "./images/manufacturer/";
                                $config1['allowed_types'] = '*';
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
                        if (!empty($_FILES['userfile2']['name']))
                        {	
                                $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                                $curenttimestamp = time();
                                $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                                $config1['upload_path'] = "./images/manufacturer/";
                                $config1['allowed_types'] = '*';
                                $config1['max_size']	= '100000';				
                                $config1['file_name'] = $code1;		
                                $this->upload->initialize($config1);		
                                if (!$this->upload->do_upload('userfile2'))
                                {	
                                        $error = $this->upload->display_errors();
                                        $this->add($error);
                                }
                                else
                                {
                                        $val1 = array('upload_data' => $this->upload->data());				
                                        $file2 = $val1["upload_data"]["orig_name"];
                                }
                        }	
			
			$data = array(
                                            'first_name' => $this->input->post('txtfname'),
					    'last_name' => $this->input->post('txtlname'),
                                            'company_name' => $this->input->post('txtcompanyname'),
                                            'contact' => $this->input->post('txtcontactno'),
                                            'address' => $this->input->post('txtaddress'),
                                            'email' => $this->input->post('txtemail'),
					    'password' => $pass,						 
					    'profile_img' => $file1,
                                            'brochar_img' => $file2,
                                      );   	
			
			$id = $this->input->post('id');			
			$this->ManufacturerModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('welcome/','refresh');	
		}				
	}
	
}