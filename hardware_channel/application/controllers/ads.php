<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends CI_Controller {
	private $limit = 20;
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
		$this->load->model("adsModel");	
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
		$viewdata = $this->adsModel->get_paged_list($this->limit, $offset)->result();
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Advertisements';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."ads/index/";
		$config['total_rows'] = $this->adsModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["test"] = $this->adsModel->date_verification();	
		$data["num"] = $this->uri->segment($uri_segment);			
        $data["offset"]= $offset;    
		
		$this->load->view('header',$data);
		$this->load->view('ads/all',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'ads/add', 'refresh');
		}
	}
	
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Advertisements';
		$data['action'] = "Add Record";
		$data['Manufacture'] = $this->adsModel->get_user_list()->result();	
                $this->load->view('header',$data);
		$this->load->view('ads/add',$data);
		$this->load->view('footer');
	}
        
       
	public function addrecord()
	{
		$this->form_validation->set_rules('txtadsname', 'Advertisement Name', 'required');
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
				$config1['upload_path'] = "./images/ads/";
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
				$config1['upload_path'] = "./images/ads/";
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
                        
			$data = array(
                                        'ads_name' => $this->input->post('txtadsname'), 
                                        'clientid' => $this->input->post('selclient'), 
                                        'ads_image1' => $file1,
                                        'ads_image2' => $file2,
                                        'ads_type' => "Ads",
                                        'startdate' => $this->input->post('txtstartdate'),
					'enddate' => $this->input->post('txtenddate'),
                                        'status' => "Enable"
                                        
                            );   	
			
			$id = $this->adsModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 
			
			redirect('ads/','refresh');	
		}
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->adsModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('ads/index/'.$offset,'refresh');
	}
	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->adsModel->get_by_id($id)->row();
									
		$data['title'] = 'Advertisements';
		$data['action'] = "Edit Record";
		$data['Manufacture'] = $this->adsModel->get_user_list()->result();
		$this->load->view('header',$data);
		$this->load->view('ads/edit',$data);
		$this->load->view('footer');
	}
        
        
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtadsname', 'Advertisement Name', 'required');	
                
                if ($this->form_validation->run() == FALSE)
				{
						$this->edit($this->input->post('aid'));
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
								
				$config1['upload_path'] = "./images/ads/";
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
									
					$config1['upload_path'] = "./images/ads/";
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
                         
			$data = array(
							'ads_name' => $this->input->post('txtadsname'), 
							'clientid' => $this->input->post('selclient'), 
							'ads_image1' => $file1,
							'ads_image2' => $file2,
							'startdate' => $this->input->post('txtstartdate'),
							'enddate' => $this->input->post('txtenddate')
						  );  	
			
			$id = $this->input->post('aid');
			$pageid = $this->input->post('pageid');			
			$this->adsModel->update($id,$data);	
			
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('ads/index/'.$pageid,'refresh');	
		}				
	}
	
	function action($id,$stat)
		{
				$status = array('status' => $stat);
				$this->adsModel->changestatus($id,$status);
				redirect(base_url().'ads','refresh');
		}
		
	
	
}