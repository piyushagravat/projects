<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
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
		$this->load->model("CategoriesModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
                
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin" || $session_data["role"] == "Manufacture"){ 
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
	             
                // load data		
		$viewdata = $this->CategoriesModel->get_paged_list($this->limit, $offset)->result();
		$data["cat"] = $this->CategoriesModel->get_paged_list(10000,0)->result();
			//print_r($viewdata);
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Categories Details';
		$data['action'] = "All Categories";
		
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."categories/index/";
		$config['total_rows'] = $this->CategoriesModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);	
		$data["offset"]= $offset;			
		$this->load->view('header',$data);
		$this->load->view('categories/all',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'categories', 'refresh');
		}
	}
	
	public function searchcat()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchcategories');
		$viewdata = $this->CategoriesModel->get_search_cat_list(10000,0,$val)->result();
		$data["cat"] = $this->CategoriesModel->get_paged_list(10000,0)->result();
		$data["viewdata"] = $viewdata;
		//$data["cat"] = $this->CategoriesModel->get_search_cat_list(10000,0,$val)->result();
		$data['title'] = 'Categorie';
		$data['action'] = "All Record";
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."categories/searchcat/";
		$config['total_rows'] = $this->CategoriesModel->count_search_cat_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		
		$cat = $this->CategoriesModel->get_search_list($this->limit, $offset,$val)->result();
	
		$this->load->view('header',$data);
		$this->load->view('categories/searchcat',$data);
		$this->load->view('footer');
	}
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Categories Add';
		$data['action'] = "Add Categorie";
		$data['categories'] = $this->CategoriesModel->get_user_role_list()->result();		
	 	$this->load->view('header',$data);
		$this->load->view('categories/add',$data);
		$this->load->view('footer');
	}
	public function addrecord()
	{
        $this->form_validation->set_rules('txtcatname', 'Categories Name', 'required');
                
               
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{				
		     $this->load->library('upload');				
		    $file1 = "";
                    
                    $session_data = $this->session->userdata('logged_in');
                    $data['id'] = $session_data['id'];
                    if (!empty($_FILES['userfile1']['name']))
                    {	
                            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            $curenttimestamp = time();
                            $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                            $config1['upload_path'] = "./images/products/";
                            $config1['allowed_types'] = '*';
                            $config1['max_size']	= '100000';				
                            $config1['file_name'] = $code1;		
                            $this->upload->initialize($config1);		
                            if (!$this->upload->do_upload('userfile1'))
                            {	
                                    $error = $this->upload->display_errors();
                                    //print_r($error);
                                    $this->add($error);
                            }
                            else
                            {
                                    $val1 = array('upload_data' => $this->upload->data());				
                                    $file1 = $val1["upload_data"]["orig_name"];
                            }
                    }
                    $data = array(          'cname' => $this->input->post('txtcatname'),
                                            'cat_img' => $file1,
					     );   	
			$id = $this->CategoriesModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('categories/','refresh');	
		}
            
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->CategoriesModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('categories/index/'.$offset,'refresh');
	}
	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->CategoriesModel->get_by_id($id)->row();
									
		$data['title'] = 'Categories';
		$data['action'] = "Edit Categories";
		$data['clients'] = $this->CategoriesModel->get_paged_list()->result();				
		$this->load->view('header',$data);
		$this->load->view('categories/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtcatname', 'Categories Name', 'required');
        
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('cid'));
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
								
				$config1['upload_path'] = "./images/products/";
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
					$val2 = array('upload_data' => $this->upload->data());				
					$file1 = $val2["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file1 = $this->input->post('userfile1old');
			}
                            $data = array(
                            'cname' => $this->input->post('txtcatname'),
                            'cat_img' => $file1,
			                );   	
			
			$id = $this->input->post('cid');
			$pageid = $this->input->post('pageid');			
			$this->CategoriesModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('categories/index/'.$pageid,'refresh');	
		}				
	}
	
	function action($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->CategoriesModel->changestatus($id,$status);
			
				redirect(base_url().'categories','refresh');
		}
		 public function add_images($id)
	{
             
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Categories Images';
		$data['action'] = "Add Record";
                
		$data["categories"] = $this->CategoriesModel->get_by_id($id)->row();
				
	 	$this->load->view('header',$data);
		$this->load->view('categories/addcategoriesimages',$data);
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
							
				$data = array('cid' => $this->input->post('cid'), 'images' => $file);   	
			
				$id = $this->CategoriesModel->save_image($data);
                              
				
			}
			
		}	
		
		$cid = $this->input->post('cid');
		$this->session->set_flashdata("message", "Images Uploaded Successfully...");
		redirect('categories/viewimages/'.$cid,'refresh');		
	}	

	private function set_upload_options()
	{   
		//upload an image options
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
		$curenttimestamp = time();
		$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
						
		$config = array();
		$config['upload_path'] = './images/categories/';
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
		$config['file_name'] = $code1;	
	
		return $config;
	}
        
        public function viewimages($id)
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data["categories"] = $this->CategoriesModel->get_by_id($id)->row();
                $viewdata = $this->CategoriesModel->get_categories_images_list($id)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Categories Images';
		$data['action'] = "All Record";
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('categories/allcategoriesimages',$data);
		$this->load->view('footer');
	}
        public function delete_image($id,$cid)
	{
		$this->CategoriesModel->delete_image($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('categories/viewimages/'.$cid,'refresh');
	}
	
}