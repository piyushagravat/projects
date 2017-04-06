<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
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
		$this->load->model("PageModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
       
	}
	
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Add Aboutus';
		$data['action'] = "Add Record";
			 	$this->load->view('header',$data);
		$this->load->view('page/addaboutus',$data);
		$this->load->view('footer');
	}
	public function addrecord()
	{
                  
                    $data = array(          
									'aboutus' => $this->input->post('txtdetails')
							);   	
			$id = $this->PageModel->update($data);
                      
                        $this->session->set_flashdata("message", "Record Added Successfully..."); 				
			redirect('page/add','refresh');	
	}
	
	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$data["editdata"] = $this->PageModel->get_by_id($id)->row();
									
		$data['title'] = 'About Us';
		$data['action'] = "Edit Record";
		
			
		$this->load->view('header',$data);
		$this->load->view('page/edit',$data);
		$this->load->view('footer');
	}
	public function updaterecord()
	{
			
	
			$this->load->library('upload');	
			
			$data = array(
                             'page_contant' => $this->input->post('txtdetails')
                        );   	
			
			$id = $this->input->post('id');			
			$this->PageModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('','refresh');	
					
	}
	
	public function editcontact($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$data["editdata"] = $this->PageModel->get_by_id($id)->row();
									
		$data['title'] = 'Contact Us';
		$data['action'] = "Edit Record";
		
			
		$this->load->view('header',$data);
		$this->load->view('page/contactus',$data);
		$this->load->view('footer');
	}
	public function updatecontact()
	{
			
	
			$this->load->library('upload');	
			
			$data = array(
                             'contactus' => $this->input->post('txtdetails')
                        );   	
			
			$id = $this->input->post('id');			
			$this->PageModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('','refresh');	
					
	}
	
	public function editsubscrip($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$data["editdata"] = $this->PageModel->get_by_id($id)->row();
									
		$data['title'] = 'Subscription';
		$data['action'] = "Edit Record";
		
			
		$this->load->view('header',$data);
		$this->load->view('page/subscrip',$data);
		$this->load->view('footer');
	}
	public function updatesubscription()
	{
			
	
			$this->load->library('upload');	
			
			$data = array(
                             'subscript' => $this->input->post('txtdetails')
                        );   	
			
			$id = $this->input->post('id');			
			$this->PageModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('','refresh');	
					
	}
           
	public function editterms($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$data["editdata"] = $this->PageModel->get_by_id($id)->row();
									
		$data['title'] = 'Terms';
		$data['action'] = "Edit Record";
		
			
		$this->load->view('header',$data);
		$this->load->view('page/terms',$data);
		$this->load->view('footer');
	}
	public function updateterms()
	{
			
	
			$this->load->library('upload');	
			
			$data = array(
                             'terms' => $this->input->post('txtdetails')
                        );   	
			
			$id = $this->input->post('id');			
			$this->PageModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('','refresh');	
					
	}	

		
}
