<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
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
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);		   
		$this->load->model("ProductModel");
        $this->load->model("adsModel");
		$this->load->model("brandModel");
				
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
		$viewdata = $this->ProductModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data["prod"] = $this->ProductModel->get_paged_list(10000,0)->result();
		$data['title'] = 'Manufacturer Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."product/index/";
		$config['total_rows'] = $this->ProductModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);
		$data["offset"]= $offset;		
		$this->load->view('header',$data);
		$this->load->view('product/all',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'product', 'refresh');
		}
	}
	
	public function search_product()
	{ 
		
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchproduct');
		$viewdata = $this->ProductModel->get_search_product_list($val)->result();
		$data["prod"] = $this->ProductModel->get_paged_list(10000,0)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Product';
		$data['action'] = "All Record";
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."product/search_product/";
		$config['total_rows'] = $this->ProductModel->count_search_product_all($val);
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
	
		$prod = $this->ProductModel->get_search_list($this->limit, $offset,$val)->result();
		$this->load->view('header',$data);
		$this->load->view('product/search_product',$data);
		$this->load->view('footer');
	}
	
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
                $data['title'] = 'Product Add';
		$data['action'] = "Add Record";
		$data['dealer'] = $this->ProductModel->get_user_role_list()->result();
        $data["categories"] = $this->ProductModel->get_categories_list()->result();
        $data["subcategories"] = $this->ProductModel->get_subcategories_list()->result();
        $data['Manufacture'] = $this->adsModel->get_user_list()->result();	
		//print_r($this->db->last_query());die;
		$data['Brand'] = $this->brandModel->get_paged_list()->result();	
				 
	 	$this->load->model('ProductModel');
		$data['list']=$this->ProductModel->getCategories();
		$data['manufacturelist']=$this->ProductModel->get_user_list();
	
	
		$this->load->view('header',$data);
		$this->load->view('product/add',$data);
		$this->load->view('footer');
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
	
	 public function loadDataPro()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('ProductModel');
		$result=$this->ProductModel->getDataPro($loadType,$loadId);
		$HTML="";
		
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}

	public function loadBrand()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('ProductModel');
		$result=$this->ProductModel->getBrandData($loadType,$loadId);
		
		$HTML="";
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}
	public function loadBrandFromEdit()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('ProductModel');
		$result=$this->ProductModel->getBrandData($loadType,$loadId);
		
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
                $this->form_validation->set_rules('txtproductname', 'Product Name', 'required');
                $this->form_validation->set_rules('txtshortdesc', 'Description', 'required');
				$this->form_validation->set_rules('txtcategories', 'Categories', 'required');	
				$this->form_validation->set_rules('txtsubcategories', 'Sub-Categories', 'required');	
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{				
		    $this->load->library('upload');				
		    $file2 = "";
                    $whatsnew = "";       
                    $session_data = $this->session->userdata('logged_in');
                    $data['id'] = $session_data['id'];
                    if (!empty($_FILES['userfile2']['name']))
                    {	
                            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            $curenttimestamp = time();
                            $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                            $config1['upload_path'] = "./images/products/";
                            $config1['allowed_types'] = '*';
                            $config1['max_size']	= '100000';				
                            $config1['file_name'] = $code1;		
                            $this->upload->initialize($config1);		
                            if (!$this->upload->do_upload('userfile2'))
                            {	
                                    $error = $this->upload->display_errors();
                                    //print_r($error);
                                    $this->add($error);
                            }
                            else
                            {
                                    $val1 = array('upload_data' => $this->upload->data());				
                                    $file2 = $val1["upload_data"]["orig_name"];
                            }
                    }
                    
                    
                 	//if($this->input->post('seltoaddprod')) { $whatsnew = 1; } else { $whatsnew  = 0; }
					
                    $productcode = rand('111111','999999');
                    
                    $data = array(          'cid' => $this->input->post('txtcategories'),
                                            'subcat_id' => $this->input->post('txtsubcategories'),
                                            'sscat_id' => $this->input->post('txtsubsubcategories'),
                                            'manufacture_id' => $this->input->post('selclient'),
											'brand_id' => $this->input->post('selbrand'),
                                            'pcode' => $productcode,
                                            'pname' => $this->input->post('txtproductname'),
                                            'product_img' => $file2,
                                            'pdetail' => $this->input->post('txtshortdesc'),
											'whats_new' => $whatsnew,
                                            'order_date' => date('Y-m-d H:i:s'),
                                            'status' => "Enable"
                            	);   	
								//print_r($data);
								//print_r($_POST);die;
			$id = $this->ProductModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('product/','refresh');	
		}
            
	}
	
        public function add_images($pid)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Product Images';
		$data['action'] = "Add Record";
		$data["product"] = $this->ProductModel->get_list_by_id($pid)->row();
		$data['message'] = $this->session->flashdata('message');			
	 	$this->load->view('header',$data);
		$this->load->view('product/addproductimages',$data);
		$this->load->view('footer');
	}
        
        public function addrecord_images()
	{
		
		$this->load->library('upload');
	
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		if ( $cpt < 5)
		{
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
								
					$data = array('pid' => $this->input->post('pid'), 'img' => $file);   	
				
					$id = $this->ProductModel->save_image($data);
								  
					
				}
				
			}	
		}        
        else
		{
			$pid = $this->input->post('pid');
			$this->session->set_flashdata("message", "Add Maximum 4 Images");
			redirect('product/add_images/'.$pid,'refresh');
		}	
		$pid = $this->input->post('pid');
		$this->session->set_flashdata("message", "Images Uploaded Successfully...");
		redirect('product/viewimages/'.$pid,'refresh');		
	}	

	private function set_upload_options()
	{   
		//upload an image options
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
		$curenttimestamp = time();
		$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
						
		$config = array();
		$config['upload_path'] = './images/products/';
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
		$data["product"] = $this->ProductModel->get_list_by_id($pid)->row();
		$viewdata = $this->ProductModel->get_product_images_list($pid)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Product Images';
		$data['action'] = "All Record";
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('product/allproductimages',$data);
		$this->load->view('footer');
	}
        public function delete_image($id,$pid)
	{
		$this->ProductModel->delete_image($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('product/viewimages/'.$pid,'refresh');
	}
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		$this->ProductModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('product/index/'.$offset,'refresh');
	}
	
	public function deletebymid($id)
	{
		
		$uri_segment = 4;
		$uri_segment1 = 5;
		$offset = $this->uri->segment($uri_segment);
		$offset1 = $this->uri->segment($uri_segment1);

		$this->ProductModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('product/productsmanufacturers/'.$offset.'/'.$offset1,'refresh');
	}
	

	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data["editdata"] = $this->ProductModel->get_by_id($id)->row();
		$data['pageid'] = $pageid;							
		$data['title'] = 'Dealer';
		$data['action'] = "Edit Record";
		$data['Manufac'] = $this->ProductModel->get_user_list()->result();
		$data['Manufacture'] = $this->ProductModel->get_paged_list()->result();				
		$data["categories"] = $this->ProductModel->get_categories_list()->result();
		$data['subcategories'] = $this->ProductModel->get_subcategories_list()->result();
		$data['Brand'] = $this->brandModel->get_paged_list()->result();
        $this->load->model('ProductModel');
		$data['list']=$this->ProductModel->getCategories();
		$data['manufacturelist']=$this->ProductModel->get_user_list();
		
		$brand = $this->brandModel->get_paged_list()->result();	
		
        $this->load->view('header',$data);
		$this->load->view('product/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
		$this->form_validation->set_rules('txtproductname', 'Product Name', 'required');
        $this->form_validation->set_rules('txtshortdesc', 'Description', 'required');
		$this->form_validation->set_rules('txtcategories', 'Categories', 'required');	
		$this->form_validation->set_rules('txtsubcategories', 'Sub-Categories', 'required');
                
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
		
			$this->load->library('upload');	
			$file2 = "";
                        $whatsnew = "";       
                    
                        
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
                                        'pname' => $this->input->post('txtproductname'),
                                        'cid' => $this->input->post('txtcategories'),
                                        'subcat_id' => $this->input->post('txtsubcategories'),
										'sscat_id' => $this->input->post('txtsubsubcategories'),
                                        'manufacture_id' => $this->input->post('selclient'),
										'brand_id' => $this->input->post('selbrand'),
                                        'product_img' => $file2,
                                        'pdetail' => $this->input->post('txtshortdesc'),
										'order_date' => date('Y-m-d H:i:s')

                                      );   	
            $id = $this->input->post('pid');
			$pageid = $this->input->post('pageid');				
			$this->ProductModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('product/index/'.$pageid,'refresh');	
		}				
	}
	
	
	public function editbymid($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data["editdata"] = $this->ProductModel->get_by_id($id)->row();
		$data['pageid'] = $pageid;							
		$data['title'] = 'Dealer';
		$data['action'] = "Edit Record";
		$data['Manufac'] = $this->ProductModel->get_user_list()->result();
		$data['Manufacture'] = $this->ProductModel->get_paged_list()->result();				
		$data["categories"] = $this->ProductModel->get_categories_list()->result();
		$data['subcategories'] = $this->ProductModel->get_subcategories_list()->result();
		$data['Brand'] = $this->brandModel->get_paged_list()->result();
        $this->load->model('ProductModel');
		$data['list']=$this->ProductModel->getCategories();
		$data['manufacturelist']=$this->ProductModel->get_user_list();
		
		$brand = $this->brandModel->get_paged_list()->result();	
		
        $this->load->view('header',$data);
		$this->load->view('product/editbymid',$data);
		$this->load->view('footer');
	}
	public function updaterecordbymid()
	{
		$this->form_validation->set_rules('txtproductname', 'Product Name', 'required');
        $this->form_validation->set_rules('txtshortdesc', 'Description', 'required');
        $this->form_validation->set_rules('txtnote', 'Note', 'required');	
                
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
		
			$this->load->library('upload');	
			$file2 = "";
                        $whatsnew = "";       
                    
                        
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
                                        'pname' => $this->input->post('txtproductname'),
                                        'cid' => $this->input->post('txtcategories'),
                                        'subcat_id' => $this->input->post('txtsubcategories'),
										'sscat_id' => $this->input->post('txtsubsubcategories'),
                                        'manufacture_id' => $this->input->post('selclient'),
										'brand_id' => $this->input->post('selbrand'),
                                        'product_img' => $file2,
                                        'pdetail' => $this->input->post('txtshortdesc'),
                                        'note' => $this->input->post('txtnote'),
										'order_date' => date('Y-m-d H:i:s')

                                      );   	
            $id = $this->input->post('pid');
			$pageid = $this->input->post('pageid');				
			$this->ProductModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('product/productsmanufacturers/'.$pageid,'refresh');	
			
		}				
	}
	
        
	function action($id,$stat)
	{
			// save data
			
			$status = array('status' => $stat);
			$this->ProductModel->changestatus($id,$status);
		
			redirect(base_url().'product','refresh');
	}
	
	public function productsmanufacturers($id)
	{ 	   
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
                   
                // load data		
                $viewdata = $this->ProductModel->get_product_list_by_id($id,$this->limit, $offset)->result();
                $data["manufacture"] = $this->ProductModel->get_by_manufacture_id($id)->row();
              //  $data["bookorder"] = $this->analysisModel->get_bookorder_id($id)->row();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Manufacture Products Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."product/productsmanufacturers/".$id."/";
		$config['total_rows'] = $this->ProductModel->count_all_prod_list($id);
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');
		$data["num"] = $this->uri->segment(4);		
		$data["offset"]= $offset;			
		$this->load->view('header',$data);
		$this->load->view('product/productbymanufacturer',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'product', 'refresh');
		}
	}
	
}