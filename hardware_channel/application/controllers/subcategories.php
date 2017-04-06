<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategories extends CI_Controller {
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
		$this->load->model("SubcategoriesModel");	
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
		$viewdata = $this->SubcategoriesModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Subcategories Details';
		$data['action'] = "All Subcategories";
			
		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."subcategories/index/";
		$config['total_rows'] = $this->SubcategoriesModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);	
		$data["subcate"] = $this->SubcategoriesModel->get_paged_list(10000,0)->result();
		$data["offset"]= $offset;
		$this->load->view('header',$data);
		$this->load->view('subcategories/all',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'subcategories', 'refresh');
		}
	}
	
	
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Add Subcategories ';
		$data['action'] = "Add Subcategorie";
		$data['subcategories'] = $this->SubcategoriesModel->get_user_role_list()->result();
        $data["categories"] = $this->SubcategoriesModel->get_categories_list()->result();
	 	$this->load->view('header',$data);
		$this->load->view('subcategories/add',$data);
		$this->load->view('footer');
	}
	public function addrecord()
	{
                $this->form_validation->set_rules('txtsubcatname', 'Sub Categories Name', 'required');
               
        
                
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
                    $data = array(          
                                        'subcat_name' => $this->input->post('txtsubcatname'),
					'cid' => $this->input->post('txtcategories'),
                                        'subcat_img' => $file1,
                                 );   	
			$id = $this->SubcategoriesModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('subcategories/','refresh');	
		}
            
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->SubcategoriesModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('subcategories/index/'.$offset,'refresh');
	}
	
	public function edit($id)
	{			
		$data["editdata"] = $this->SubcategoriesModel->get_by_id($id)->row();	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;				
		$data['title'] = 'Sub-Categories';
		$data['action'] = "Edit Subcategories";
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data['roles'] = $this->SubcategoriesModel->get_user_role_list()->result();
        $data["categories"] = $this->SubcategoriesModel->get_categories_list()->result();
		$data['subcategories'] = $this->SubcategoriesModel->get_user_role_list()->result();	
		$this->load->view('header',$data);
		$this->load->view('subcategories/edit',$data);
		$this->load->view('footer');
            
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtsubcatname', 'Sub Categories Name', 'required');
               
        if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('subcat_id'));
		}	
			
		else
		{
                        $this->load->library('upload');	
			$file2 = "";
                              
                    
                        
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
					$file2 = $val2["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file2 = $this->input->post('userfile1old');
			}
                    
                        $data = array(      
                                        'subcat_name' => $this->input->post('txtsubcatname'),
					'cid' => $this->input->post('txtcategories'),
                                        'subcat_img' => $file2
                                     );  	
                                     
			$id = $this->input->post('subcat_id');
			$pageid = $this->input->post('pageid');	
            $this->SubcategoriesModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('subcategories/index/'.$pageid,'refresh');
                }
        }
        
        
	function action($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->SubcategoriesModel->changestatus($id,$status);
                                redirect(base_url().'subcategories','refresh');
		}
	public function add_images($id)
	{
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Subcategories Images';
		$data['action'] = "Add Record";
                
		$data["subcategories"] = $this->SubcategoriesModel->get_by_id($id)->row();
				
	 	$this->load->view('header',$data);
		$this->load->view('subcategories/addscatimages',$data);
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
							
				$data = array('sid' => $this->input->post('sid'), 'images' => $file);   	
                              
				$id = $this->SubcategoriesModel->save_image($data);
                              
				
			}
			
		}	
		$cid = $this->input->post('sid');
		$this->session->set_flashdata("message", "Images Uploaded Successfully...");
		redirect('subcategories/viewimages/'.$cid,'refresh');		
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
		$data["subcategories"] = $this->SubcategoriesModel->get_by_id($id)->row();
                $viewdata = $this->SubcategoriesModel->get_subcategories_images_list($id)->result();
                $data["viewdata"] = $viewdata;
		$data['title'] = 'Sub-Categories Images';
		$data['action'] = "All Record";
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('subcategories/allscatimages',$data);
		$this->load->view('footer');
	}
        public function delete_image($id,$cid)
	{
		
		
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->SubcategoriesModel->delete_image($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('subcategories/viewimages/'.$offset,'refresh');
	}

	public function searchsubcat()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchsubcategories');
		$viewdata = $this->SubcategoriesModel->get_search_subcat_list(10000,0,$val)->result();
	
		$data["viewdata"] = $viewdata;
		$data["subcate"] = $this->SubcategoriesModel->get_paged_list(10000,0)->result();
	//	$data["subcat"] = $this->SubcategoriesModel->get_search_subcat_list(10000,0,$val)->result();
		$data['title'] = 'Categorie';
		$data['action'] = "All Record";
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."subcategories/searchsubcat/";
		$config['total_rows'] = $this->SubcategoriesModel->count_search_subcat_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(4);	
		$subcat = $this->SubcategoriesModel->get_search_list($this->limit, $offset,$val)->result();
	
		$this->load->view('header',$data);
		$this->load->view('subcategories/searchsubcat',$data);
		$this->load->view('footer');
	}	
	
}