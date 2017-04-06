<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subsubcategories extends CI_Controller {
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
		$this->load->model("SubsubcategoriesModel");	
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
		$viewdata = $this->SubsubcategoriesModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Subcategories Details';
		$data['action'] = "All Subcategories";
		$data["sscat"] = $this->SubsubcategoriesModel->get_paged_list(10000,0)->result();		
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."subsubcategories/index/";
		$config['total_rows'] = $this->SubsubcategoriesModel->count_all();
                
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);
		$data["offset"]= $offset;		
		$this->load->view('header',$data);
		$this->load->view('subsubcategories/all',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'subsubcategories', 'refresh');
		}
	}
	
	
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Add Sub-Subcategories ';
		$data['action'] = "Add Sub-Subcategorie";
		$data['subsubcategories'] = $this->SubsubcategoriesModel->get_user_role_list()->result();
                $data["categories"] = $this->SubsubcategoriesModel->get_categories_list()->result();
                $data["subcategories"] = $this->SubsubcategoriesModel->get_subcategories_list()->result();
	 	$this->load->model('SubsubcategoriesModel');
		$data['list']=$this->SubsubcategoriesModel->getCategories();
                $this->load->view('header',$data);
		$this->load->view('subsubcategories/add',$data);
		$this->load->view('footer');
                
                
	}
        public function loadData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('SubsubcategoriesModel');
		$result=$this->SubsubcategoriesModel->getData($loadType,$loadId);
		$HTML="";
		
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}
	public function addrecord()
	{
                $this->form_validation->set_rules('txtsubsubcatname', 'Sub-Sub-Categories Name', 'required');
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
                    
                    $data = array(      'cid' => $this->input->post('txtcategories'),
                                        'subcat_id' => $this->input->post('txtsubcategories'),
        				'ssname' => $this->input->post('txtsubsubcatname'),
                                        'sub_sub_img' => $file1
                                       
                                 );   
                    
                   
                    
                    $id = $this->SubsubcategoriesModel->save($data);	
		    $this->session->set_flashdata("message", "Record Added Successfully..."); 				
		    redirect('subsubcategories/','refresh');	
		}
            
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->SubsubcategoriesModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('subsubcategories/index/'.$offset,'refresh');
	}
	
	public function edit($id)
	{			
		$data["editdata"] = $this->SubsubcategoriesModel->get_by_id($id)->row();	
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;	
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;		
		$data['title'] = 'Sub-Categories';
		$data['action'] = "Edit Subcategories";
		$data['roles'] = $this->SubsubcategoriesModel->get_user_role_list()->result();
        $data["categories"] = $this->SubsubcategoriesModel->get_categories_list()->result();
		$data['subcategories'] = $this->SubsubcategoriesModel->get_user_role_list()->result();
        $this->load->model('SubsubcategoriesModel');
		$data['list']=$this->SubsubcategoriesModel->getCategories();
		$this->load->view('header',$data);
		$this->load->view('subsubcategories/edit',$data);
		$this->load->view('footer');
            
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtsubsubcatname', 'Sub Categories Name', 'required');
               
                if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('sscat_id'));
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
					$file1= $val2["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file1 = $this->input->post('userfile1old');
			}
                    
                        $data = array(      
                                        'cid' => $this->input->post('txtcategories'),
                                        'subcat_id' => $this->input->post('txtsubcategories'),
        				'ssname' => $this->input->post('txtsubsubcatname'),
                                        'sub_sub_img' => $file1
                                     );  	
                                     
			$id = $this->input->post('sscat_id');
            $pageid = $this->input->post('pageid');	
			$this->SubsubcategoriesModel->update($id,$data);
            $this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('subsubcategories/index/'.$pageid,'refresh');
                }
        }
        
        
	function action($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->SubsubcategoriesModel->changestatus($id,$status);
                                redirect(base_url().'subcategories','refresh');
		}
		
	public function add_images($id)
	{
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Sub-Sub-categories Images';
		$data['action'] = "Add Record";
                
		$data["subsubcategories"] = $this->SubsubcategoriesModel->get_by_id($id)->row();
				
	 	$this->load->view('header',$data);
		$this->load->view('subsubcategories/addsscatimages',$data);
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
							
				$data = array('ssid' => $this->input->post('ssid'), 'images' => $file);   	
                              
				$id = $this->SubsubcategoriesModel->save_image($data);
                              
				
			}
			
		}	
		$cid = $this->input->post('ssid');
		$this->session->set_flashdata("message", "Images Uploaded Successfully...");
		redirect('subsubcategories/viewimages/'.$cid,'refresh');		
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
		$data["subsubcategories"] = $this->SubsubcategoriesModel->get_by_id($id)->row();
                $viewdata = $this->SubsubcategoriesModel->get_sscategories_images_list($id)->result();
                $data["viewdata"] = $viewdata;
		$data['title'] = 'Sub-Sub-Categories Images';
		$data['action'] = "All Record";
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('subsubcategories/allsscatimages',$data);
		$this->load->view('footer');
	}
    public function delete_image($id,$cid)
	{
		$this->SubsubcategoriesModel->delete_image($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('subsubcategories/viewimages/'.$cid,'refresh');
	}

	public function searchsscat()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchsubsubcategories');
		$viewdata = $this->SubsubcategoriesModel->get_search_sscat_list(10000,0,$val)->result();
	
		$data["viewdata"] = $viewdata;
		$data["sscat"] = $this->SubsubcategoriesModel->get_paged_list(10000,0)->result();		
		//$data["sscat"] = $this->SubsubcategoriesModel->get_search_sscat_list(10000,0,$val)->result();
		$data['title'] = 'Categorie';
		$data['action'] = "All Record";
	
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."subsubcategories/searchsscat/";
		$config['total_rows'] = $this->SubsubcategoriesModel->count_search_sscat_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(4);	
		$sscat = $this->SubsubcategoriesModel->get_search_list($this->limit, $offset,$val)->result();
	
		$this->load->view('header',$data);
		$this->load->view('subsubcategories/searchsscat',$data);
		$this->load->view('footer');
	}	
	
}