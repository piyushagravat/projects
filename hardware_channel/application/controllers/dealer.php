<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealer extends CI_Controller {
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
		$this->load->model("DealerModel");
		$this->load->model("adsModel");	
		$this->load->model("brandModel");
		$this->load->model('ManufacturerModel');
		$this->load->model('ProductModel');
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
		$viewdata = $this->DealerModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data["dealer"] = $this->DealerModel->get_paged_list(1000, 0)->result();
		$data["autolistmanf"] = $this->DealerModel->get_auto_suggest_list_manf(1000, 0)->result();
		$data["autolistbrand"] = $this->DealerModel->get_auto_suggest_list_brand(1000, 0)->result();
		$data['title'] = 'Dealer Details';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."dealer/index/";
		$config['total_rows'] = $this->DealerModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(3);
		$data["offset"]= $offset; 		
		$this->load->view('header',$data);
		$this->load->view('dealer/all',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'dealer', 'refresh');
		}
	}
	public function dealerbymanufacturers($id)
	{ 	   
                
                $session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		if($session_data["role"] == "Admin"){ 
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
                   
                // load data		
		$viewdata = $this->DealerModel->get_paged_list_id($id,$this->limit, $offset)->result();
               $data["manufacture"] = $this->DealerModel->get_by_manufacture_id($id)->row();
              //  $data["bookorder"] = $this->analysisModel->get_bookorder_id($id)->row();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Dealer Details By Manufacturer ID';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."dealer/dealerbymanufacturers/".$id."/";
		$config['total_rows'] = $this->DealerModel->count_all_by_manufacture_id($id);
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["num"] = $this->uri->segment(4);	
		$data["offset"]= $offset;
		$this->load->view('header',$data);
		$this->load->view('dealer/dealerbymanufacturer',$data);
		$this->load->view('footer');
		} else {
		redirect(base_url().'dealer/dealerbymanufacturer', 'refresh');
		}
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
	
	
	public function loadData()
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
	public function search_dealer()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data	
		$val = 	$this->input->post('searchdealer');
		
		$viewdata = $this->DealerModel->get_search_dealer_list(100000, 0,$val)->result();
		
		$data["val"] = $val;
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Dealer';
		$data['action'] = "All Record";

		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."dealer/search_dealer/";
		$config['total_rows'] = $this->DealerModel->count_search_dealer_all($val);
		
		
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
		$data["offset"]= $offset; 
		$cat = $this->DealerModel->get_search_list($this->limit, $offset,$val)->result();
		$data["autolistmanf"] = $this->DealerModel->get_auto_suggest_list_manf(100000, 0)->result();
		$data["autolistbrand"] = $this->DealerModel->get_auto_suggest_list_brand(100000, 0)->result();
		$this->load->view('header',$data);
		$this->load->view('dealer/search_dealer',$data);
		$this->load->view('footer');
	}
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Dealer Add';
		$data['action'] = "Add Record";
		$data['dealer'] = $this->DealerModel->get_user_role_list()->result();
        $data['Manufacture'] = $this->adsModel->get_user_list()->result();
		$this->load->model('ManufacturerModel');
		$data['list']=$this->ManufacturerModel->getCountry();	 		 
	 
		$data['manufacturelist']=$this->ProductModel->getlist();
		$this->load->view('header',$data);
		$this->load->view('dealer/add',$data);
		$this->load->view('footer');
	}
	public function addrecord()
	{       
	
				$this->form_validation->set_rules('txtfirmname', 'Firm Name', 'required');
				$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');		
				$this->form_validation->set_rules('txtcontactno', 'Contact', 'required');		
				$this->form_validation->set_rules('txtaddressone', 'Address 1', 'required');		
				$this->form_validation->set_rules('txtaddresstwo', 'Address 2', 'required');
              
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
			
		}	
		else
		{	

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
                                   
                                    'firmname' => $this->input->post('txtfirmname'),
									'mid' => $this->input->post('selclient'),
									'brand_id' => $this->input->post('selbrand'),
                                    'email' => $this->input->post('txtemail'),
                                    'mobileno' => $this->input->post('txtcontactno'),
                                    'address1' => $this->input->post('txtaddressone'),
                                    'address2' => $this->input->post('txtaddresstwo'),
                                    'country' => $countryrow->country_name,
									'state' => $staterow->state_name,
									'city' => $row->city_name,
                                    'created_date' => date('Y-m-d H:i:s')
                        );
			
            $id = $this->DealerModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('dealer/','refresh');	
		}
            
	}
	
	public function delete($id)
	{
		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		$this->DealerModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('dealer/index/'.$offset,'refresh');
                
	}
	public function deletebymid($id)
	{
		$uri_segment = 4;
		$uri_segment1 = 5;
		$offset = $this->uri->segment($uri_segment);
		$offset1 = $this->uri->segment($uri_segment1);


		$this->DealerModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('dealer/dealerbymanufacturers/'.$offset.'/'.$offset1,'refresh');
                
	}
	
	public function delete1($id)
	{
		$this->DealerModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('dealer','refresh');
                
	}
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->DealerModel->get_by_id($id)->row();
									
		$data['title'] = 'Dealer';
		$data['action'] = "Edit Record";
		$data['Manufacture'] = $this->adsModel->get_user_list()->result();	
        $this->load->model('ProductModel');
		$data['manufacturelist']=$this->ProductModel->getlist();	
		$data['list']=$this->ManufacturerModel->getCountry();	
	
		$this->load->view('header',$data);
		$this->load->view('dealer/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
		
		$this->form_validation->set_rules('txtfirmname', 'Firm Name', 'required');
        $this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');		
		$this->form_validation->set_rules('txtcontactno', 'Contact', 'required');		
		$this->form_validation->set_rules('txtaddressone', 'Address 1', 'required');		
		$this->form_validation->set_rules('txtaddresstwo', 'Address 2', 'required');
       
        
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
		
			$this->load->library('upload');	
			
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
                                     
                                        'firmname' => $this->input->post('txtfirmname'),
										'mid' => $this->input->post('selclient'),
										'brand_id' => $this->input->post('selbrand'),
                                        'email' => $this->input->post('txtemail'),
                                        'mobileno' => $this->input->post('txtcontactno'),
                                        'address1' => $this->input->post('txtaddressone'),
                                        'address2' => $this->input->post('txtaddresstwo'),
                                        'country' => $countryrow->country_name,
										'state' => $staterow->state_name,
										'city' => $row->city_name,
                                        'created_date' => date('Y-m-d H:i:s')
                        );   	
			
			$id = $this->input->post('id');	
			$pageid = $this->input->post('pageid');			
			$this->DealerModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('dealer/index/'.$pageid,'refresh');	
		}				
	}
	
	public function editbymid($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 4;
		$pageid = $this->uri->segment($uri_segment);
		
		$data['pageid'] = $pageid;
		$data["editdata"] = $this->DealerModel->get_by_id($id)->row();
									
		$data['title'] = 'Dealer';
		$data['action'] = "Edit Record";
		$data['Manufacture'] = $this->adsModel->get_user_list()->result();	
        $this->load->model('ProductModel');
		$data['manufacturelist']=$this->ProductModel->getlist();	
		$data['list']=$this->ManufacturerModel->getCountry();	
	
		$this->load->view('header',$data);
		$this->load->view('dealer/editbyid',$data);
		$this->load->view('footer');
	}
	public function updaterecordbyid()
	{
		
		$this->form_validation->set_rules('txtfirmname', 'Firm Name', 'required');
        $this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email');		
		$this->form_validation->set_rules('txtcontactno', 'Contact', 'required');		
		$this->form_validation->set_rules('txtaddressone', 'Address 1', 'required');		
		$this->form_validation->set_rules('txtaddresstwo', 'Address 2', 'required');
       
        
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
		
			$this->load->library('upload');	
			
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
                                     
                                        'firmname' => $this->input->post('txtfirmname'),
										'mid' => $this->input->post('selclient'),
										'brand_id' => $this->input->post('selbrand'),
                                        'email' => $this->input->post('txtemail'),
                                        'mobileno' => $this->input->post('txtcontactno'),
                                        'address1' => $this->input->post('txtaddressone'),
                                        'address2' => $this->input->post('txtaddresstwo'),
                                        'country' => $countryrow->country_name,
										'state' => $staterow->state_name,
										'city' => $row->city_name,
                                        'created_date' => date('Y-m-d H:i:s')
                        );   	
			
			$id = $this->input->post('id');	
			$pageid = $this->input->post('pageid');			
			$this->DealerModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('dealer/dealerbymanufacturers/'.$pageid,'refresh');	
		}				
	}
	
	function action($id,$stat)
		{
				// save data
				
				$status = array('status' => $stat);
				$this->DealerModel->changestatus($id,$status);
			
				redirect(base_url().'dealar','refresh');
		}
	
	
}