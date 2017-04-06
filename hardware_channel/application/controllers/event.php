<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {
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
		$this->load->model("eventModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->eventModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Event';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."event/index/";
		$config['total_rows'] = $this->eventModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(4);
		$data["offset"]= $offset;			
		$this->load->view('header',$data);
		$this->load->view('event/all',$data);
		$this->load->view('footer');
	}
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Event';
		$data['action'] = "Add Event";
				
	 	$this->load->view('header',$data);
		$this->load->view('event/add',$data);
		$this->load->view('footer');
	}
	public function addrecord()
	{
		$this->form_validation->set_rules('event_title', 'Title', 'required');		
		$this->form_validation->set_rules('detail', 'Detail', 'required');		
                
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
				$config1['upload_path'] = "./images/events/";
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
                    
			$data = array(
                                        'event_title' => $this->input->post('event_title'),
                                        'detail' => $this->input->post('detail'),
                                        'event_image' => $file1,
                                        'created_date' => date("Y-m-d H:i:s")
                            );   	
			
                        
			$id = $this->eventModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 
			
			$this->pushmsgevent();
			
			redirect('event/','refresh');	
		}
	}
	
	public function pushmsgevent()
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
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "channel": "whatsnew","data": { "alert": "New Event Added in Whats New Events Section.!" } }');
			 
			curl_exec($ch);
			curl_close($ch);
			
			
	}
	
	public function delete($id)
	{
		$this->eventModel->delete($id);		
		$this->session->set_flashdata("message", "Event Deleted Successfully..."); 			
		redirect('event/','refresh');
	}
	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->eventModel->get_by_id($id)->row();
									
		$data['title'] = 'Event';
		$data['action'] = "Edit Record";
					
		$this->load->view('header',$data);
		$this->load->view('event/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('event_title', 'Title', 'required');
                $this->form_validation->set_rules('detail', 'Title', 'required');
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
								
				$config1['upload_path'] = "./images/events/";
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
                    
				$data = array(
                                                'event_title' => $this->input->post('event_title'),
                                                'event_image' => $file1,
                                                'detail' => $this->input->post('detail'),
                                              );  	
			
			$id = $this->input->post('id');	
			$pageid = $this->input->post('pageid');				
			$this->eventModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('event/index/'.$pageid,'refresh');	
		}				
	}
	
	public function viewimages($eid)
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data["event"] = $this->eventModel->get_by_id($eid)->row();
		$viewdata = $this->eventModel->get_images_list($eid)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Event Images';
		$data['action'] = "All Record";
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('event/allimages',$data);
		$this->load->view('footer');
	}
	
	public function add_images($eid)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Event Gallery';
		$data['action'] = "Add Record";
		$data["event"] = $this->eventModel->get_by_id($eid)->row();
				
	 	$this->load->view('header',$data);
		$this->load->view('event/addimages',$data);
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
							
				$data = array('eid' => $this->input->post('eid'), 'img' => $file);   	
			
				$id = $this->eventModel->save_image($data);				 					
				
			}
			
		}	
		
		$eid = $this->input->post('eid');
		$this->session->set_flashdata("message", "Images Uploaded Successfully...");
		redirect('event/viewimages/'.$eid,'refresh');		
	}	

	private function set_upload_options()
	{   
		//upload an image options
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
		$curenttimestamp = time();
		$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
						
		$config = array();
		$config['upload_path'] = './images/events/';
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
		$config['file_name'] = $code1;	
	
		return $config;
	}
	
	public function delete_image($id,$eid)
	{
		$this->eventModel->delete_image($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('event/viewimages/'.$eid,'refresh');
	}
}