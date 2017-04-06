<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Hardwareapi extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
           $this->load->model('user','',TRUE);
           $this->load->model("ManufacturerModel");
		   $this->load->model("ProductModel");	
		   $this->load->model("adsModel");	
		   $this->load->model("WhatsnewModel");	
		   $this->load->model("eventModel");	
		   $this->load->model("dealerModel");	
		   $this->load->model("InquiryModel");
		   $this->load->model("CategoriesModel");	
		   $this->load->model("SubcategoriesModel");
		   $this->load->model("SubsubcategoriesModel");
		   $this->load->model("BrandModel");
		   $this->load->model("PageModel");
		   $this->load->model("SubscriptionModel");
	 }
	  
	public function login($email="", $password="")
	{ 
		if($email == "") {
			
			$data = array("title"=>"Please Enter Email Id");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}
		
		if($password == "") {
			
			$data = array("title"=>"Please Enter Password");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}                
	
		$result = $this->user->login_member($email, $password);
		
		if($result)
		{
		  $sess_array = array();
		  foreach($result as $row)
		  {
			$sess_array = array(
			  		  'id' => $row->id,
					  'role' => $row->role,
					  'email' => $row->email,
					  'first_name' => $row->first_name,
					  'last_name' => $row->last_name,
					  'company_name' => $row->company_name,
					  'profile_img' => $row->profile_img,
					  'brochure_img' => $row->brochar_img,
					  'contact' => $row->contact,
					  'status' => $row->status
			);		  
		  }
			
			$data = $sess_array;
			$status = "success";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
		}
		else
		{
		  	$data = array("title"=>"Please Enter Correct Email and Password!");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}
            
	}
	
	public function check_email($email="")
	{ 
		if($email == "") {
			
			$data = array("title"=>"Please Enter Email Id To Change Your Password");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}
		
		$result = $this->user->check_email($email);
		
		if($result)
		{
		  $pass = array();
		  	$alpha_numeric = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789';
			$newpass = substr(str_shuffle($alpha_numeric), 0, 8);
			$id =  $result[0]->id; 
			$FName = $result[0]->first_name;
			$LName = $result[0]->last_name;
			$user_email = $result[0]->email;
			
		    foreach($result as $row)
		    {
		  	
			    $pass = array('password' => $newpass);
				$this->user->updatepass($id,$pass);
		  	}
			
			/* MAIL START */ 
			
			$this->load->library('email');
			$config['mailtype'] = 'html';
	        $this->email->initialize($config);
			
			$email_from = "headwayappworld@gmail.com";
			$examil_to = $user_email;		
			$data['email_to'] = $user_email;			
			$data['name'] = $FName." ".$LName;	
			$data['password'] = $newpass;	
			$this->email->from($email_from, "Hardware Channel");
			$this->email->to($examil_to); 
			$this->email->subject('Hardware Channel - New Password Request');
			$this->email->message($this->load->view("manufacturer/emailpassword",$data,true));	
			$this->email->send();
			/* MAIL END */	
			
			//echo $this->email->print_debugger();
			
			$data = "Password Reset. Please check your email for new password.";
			$status = "success";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
		}
		else
		{
		  	$data = array("title"=>"Please Enter Correct Email!");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}
            
	}
	
	public function add_manufracturer()
	{
		if(isset($_POST['first_name']) && isset($_POST['company_name']) && isset($_POST['email']) && isset($_POST['password']))
		{
		  	if($_POST['email'] == "" && $_POST['password'] == "") 
			{
				$data = array("title"=>"Please enter Email id and Password.");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			}	
			
					$this->load->library('upload');				
					$file1 = "";
                   
                    
                    if (!empty($_FILES['userfile1']['name']))
                    {	
                            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            $curenttimestamp = time();
                            $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                            $config1['upload_path'] = "./images/manufacturer/";
                            $config1['allowed_types'] = 'jpg|png|jpeg';
                            $config1['max_size']	= '100000';				
                            $config1['file_name'] = $code1;		
                            $this->upload->initialize($config1);		
                            if (!$this->upload->do_upload('userfile1'))
                            {	
                                    $error = $this->upload->display_errors();
                                    print_r($error);
                            }
                            else
                            {
                                    $val1 = array('upload_data' => $this->upload->data());				
                                    $file1 = $val1["upload_data"]["orig_name"];
                            }
                    }
                   
				$data = array('first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'role' => "Manufacture",
				'company_name' => $this->input->post('company_name'),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country'),
				'email' => $this->input->post('email'),
				'password' =>  $this->input->post('password'),						 
				'profile_img' => $file1,
				'contact' => $this->input->post('contact'),
				'about_manf' => $this->input->post('about_manf'),
				'created_date' => date('Y-m-d'),
				'type' => ucfirst($this->input->post('type')),
				'status' => "Inactive",
				'phase' => "new_signup"
					);   	
			$id = $this->ManufacturerModel->save($data);
			
			$mid = $this->db->insert_id();
						
			if($id) { 
			
				$status = "success";			
				$data = array("title"=>"Registered Successfully..!");
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
		  		return TRUE;
				
			} else {
			
				$data = array("title"=>"Something went wrong! Please register once again..!");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			
			}
		}
		else
		{
		  	$data = array("title"=>"No Post Data Found");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
	}

	
	
	public function add_inquiry()
	{
		// var_dump($this->InquiryModel->getCountrybyState($this->input->post('state')));
			
		if(isset($_POST['full_name']) && isset($_POST['mobile']) && isset($_POST['inquiry_type']))
		{
		  	if($_POST['full_name'] == "" || $_POST['mobile'] == "" || $_POST['inquiry_type'] == "") 
			{
				$data = array("title"=>"Please enter Full Name, Mobile and other details.");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			}	
			
				// in this add_inquiry get country from Inquirymodel's custom funcstion
				$country_name = $this->InquiryModel->getCountrybyState($this->input->post('state'));
								
				// 16-09-2016 (by Hitesh C)
				$pid = $this->input->post('prod_id');
				$mid2 = 0;
				if($pid !=0 && $pid != "") {
					$midRow = $this->InquiryModel->get_maufacturer_by_pid($pid);
					$mid2 = $midRow->manufacture_id;
				}
				if($mid2 == 0) {
					$mid2 = $this->input->post('man_id');
				}
				
			
				$data = array('mid' => $mid2,
				'pid' => $this->input->post('prod_id'),
				'aid' => $this->input->post('ads_id'),
				'did' => $this->input->post('did'),
				'wts_new' => $this->input->post('whts_newid'),
				'name' => $this->input->post('full_name'),
				'email' => $this->input->post('email'),
				'country' => $country_name,
				'state' => $this->input->post('state'),
				'city' =>  $this->input->post('city'),						 
				'inquiry_type' => $this->input->post('inquiry_type'),
				'mobile' => $this->input->post('mobile'),
				'details' => $this->input->post('details'),
				'inquirydate' => date('Y-m-d H:i:s')
					);   	
			$id = $this->ManufacturerModel->save_inquiry($data);
			
			$mid = $this->db->insert_id();
						
			if($id) { 
			
				if($_POST['inquiry_type'] == "Manufacturer" || $_POST['inquiry_type'] == "Ads" || $_POST['inquiry_type'] == "Whatsnew"  || $_POST['inquiry_type'] == "Dealer" || $_POST['inquiry_type'] == "Product") { 
				
				
				if($_POST['inquiry_type'] == "Dealer") {
				$dealer = $this->dealerModel->get_by_id($this->input->post('did'))->row();
				$manf = $this->ManufacturerModel->get_manf_by_id($this->input->post('man_id'))->row();
				}
				else if($_POST['inquiry_type'] == "Product") {
				$prod = $this->ProductModel->get_product_details_by_id($this->input->post('prod_id'))->row();
				$manfdetails = $this->ManufacturerModel->get_manf_by_id($prod->manufacture_id)->row();
				} else {
				$manf = $this->ManufacturerModel->get_manf_by_id($this->input->post('man_id'))->row();
				}				
						
				/* MAIL START */ 
				if($_POST['inquiry_type'] == "Manufacturer") {
				$inquiry = "Manufacturer";	
				} else if($_POST['inquiry_type'] == "Ads") {
				$inquiry = "Advertisement";	
				} else if($_POST['inquiry_type'] == "Whatsnew") {
				$inquiry = "What's New Product";	
				} else if($_POST['inquiry_type'] == "Dealer") {
				$inquiry = "Dealer";	
				} else if($_POST['inquiry_type'] == "Product") {
				$inquiry = "Product";	
				}
							
				$user_email = trim($this->input->post('email'));
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$name = $this->input->post('full_name');
				$email_from = "headwayappworld@gmail.com";
				if($_POST['inquiry_type'] == "Dealer") {
					$examil_to = $dealer->email.",".$manf->email;
				} else if($_POST['inquiry_type'] == "Product") {
					$examil_to = $manfdetails->email;
				} 
				else {
					$examil_to = $manf->email;									
				}
				$data['name'] = $name;	
				$data['senderemail'] = $user_email;
				$data['country'] = $country_name;
				$data['state'] = $this->input->post('state');
				$data['city'] = $this->input->post('city');
				$data['mobile'] = $this->input->post('mobile');
				$data['details'] = $this->input->post('details');
				$data['inquiry'] = $inquiry;
				
				if($_POST['inquiry_type'] == "Dealer") {
					$data['manfname'] = $dealer->firmname;
				} else if($_POST['inquiry_type'] == "Product") {
					$data['manfname'] = $manfdetails->first_name." ".$manfdetails->last_name;
				} 
				else {
					$data['manfname'] = $manf->first_name." ".$manf->last_name;								
				}				
				
				$this->email->from($email_from, "Hardware Channel");
				$this->email->to($examil_to); 
				$this->email->subject('Hardware Channel '.$inquiry.' Enquiry from -'.$name);
				$this->email->message($this->load->view("inquirynotification",$data,true));	
				
				$this->email->send();
				/* MAIL END */
				
				
				 //echo $this->email->print_debugger();exit;
				 }
			
				$status = "success";			
				$data = array("title"=>"Submitted Successfully..!");
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
		  		return TRUE;
				
			} else {
			
				$data = array("title"=>"Something went wrong! Please try once again..!");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			
			}
		}
		else
		{
		  	$data = array("title"=>"No Post Data Found");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
	}
	
	public function add_dealer()
	{
		
		if(isset($_POST['country']) && isset($_POST['state']) && isset($_POST['email']) && isset($_POST['city']))
		{
		
		  	if($_POST['city'] == "" || $_POST['mid'] == "") 
			{
				$data = array("title"=>"Please enter all required details.");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			}	
			
				$data = array('mid' => $this->input->post('mid'),
				'brand_id' => $this->input->post('brand_id'),
				'firmname' => $this->input->post('firm_name'),
				'email' => $this->input->post('email'),
				'mobileno' => $this->input->post('mobileno'),
				'address1' =>  $this->input->post('address1'),	
				'address2' => $this->input->post('address2'),
				'country' => $this->input->post('country'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'created_date' => date('Y-m-d')
					);   	
					
			$id = $this->dealerModel->save($data);
			
			$mid = $this->db->insert_id();
						
			if($id) { 
			
				$status = "success";			
				$data = array("title"=>"Added Successfully..!");
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
		  		return TRUE;
				
			} else {
			
				$data = array("title"=>"Something went wrong! Please register once again..!");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			
			}
		}
		else
		{
		  	$data = array("title"=>"No Post Data Found");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
	}
	
	public function add_subscriber()
	{		
		if(isset($_POST['txtemail']))
		{
			$date = date("Y-m-d");
			$data = array('email' => $this->input->post('txtemail'),'date' => $date);   	
					
			$id = $this->SubscriptionModel->save($data);			
			$mid = $this->db->insert_id();
						
			if($id) { 
			
				$status = "success";			
				$data = array("title"=>"Subscribed Successfully..!");
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
		  		return TRUE;
				
			} else {
			
				$data = array("title"=>"Something went wrong! Please submit once again..!");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			
			}
		}
		else
		{
		  	$data = array("title"=>"Please enter valid email id.");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
	}
	
	
	public function add_product()
	{
		if(isset($_POST['txtproductname']) && isset($_POST['catlevel1']) && isset($_POST['catlevel2']))
		{
		  	if($_POST['txtproductname'] == "" || $_POST['catlevel1'] == "") 
			{
				$data = array("title"=>"Please enter all required details.");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			}	
			
				$this->load->library('upload');				
		    	$file2 = "";
                
                    if (!empty($_FILES['userfile2']['name']))
                    {	
                            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            $curenttimestamp = time();
                            $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                            $config1['upload_path'] = "./images/products/";
                            $config1['allowed_types'] = 'jpg|png|jpeg';
                            $config1['max_size']	= '100000';				
                            $config1['file_name'] = $code1;		
                            $this->upload->initialize($config1);		
                            if (!$this->upload->do_upload('userfile2'))
                            {	
                                    $error = $this->upload->display_errors();
                                    $data["error"] = $error;
                            }
                            else
                            {
                                    $val1 = array('upload_data' => $this->upload->data());				
                                    $file2 = $val1["upload_data"]["orig_name"];
                            }
                    }
                    
                    					
                    $productcode = rand('111111','999999');
                    
                    $data = array(          'cid' => $this->input->post('catlevel1'),
                                            'subcat_id' => $this->input->post('catlevel2'),
                                            'sscat_id' => $this->input->post('catlevel3'),
                                            'manufacture_id' => $this->input->post('manf_id'),
											'brand_id' => $this->input->post('brand_id'),
                                            'pcode' => $productcode,
                                            'pname' => $this->input->post('txtproductname'),
                                            'product_img' => $file2,
                                            'pdetail' => $this->input->post('txtshortdesc'),
                                            'note' => $this->input->post('txtnote'),
                                            'order_date' => date('Y-m-d H:i:s'),
                                            'status' => "Enable"
                            	);   	
			
						$id = $this->ProductModel->save($data);				
						$mid = $this->db->insert_id();
						
					if($id) { 
					
						$status = "success";			
						$data = array("title"=>"Added Successfully..!");
						$val = array('data'=>$data, 'status' => $status);
						print json_encode($val);
						return TRUE;
						
					} else {
					
						$data = array("title"=>"Something went wrong! Please Add Product once again..!");
						$status = "fail";			
						
						$val = array('data'=>$data, 'status' => $status);
						print json_encode($val);
						return false;
					
					}
		}
		else
		{
		  	$data = array("title"=>"No Post Data Found");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
	}
	
	public function add_product_images()
	{
		if(isset($_POST['pid']) && isset($_FILES))
		{
			$this->load->library('upload');				
			$file1 = "";
                   
                    
                    if (!empty($_FILES['userfile']['name']))
                    {	
                            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            $curenttimestamp = time();
                            $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                            $config1['upload_path'] = "./images/products/";
                            $config1['allowed_types'] = 'jpg|png|jpeg';
                            $config1['max_size']	= '100000';				
                            $config1['file_name'] = $code1;		
                            $this->upload->initialize($config1);		
                            if (!$this->upload->do_upload('userfile'))
                            {	
                                    $error = $this->upload->display_errors();
                                  
                            }
                            else
                            {
                                    $val1 = array('upload_data' => $this->upload->data());				
                                    $file1 = $val1["upload_data"]["orig_name"];
                            }
                    }
								
					$data = array('pid' => $this->input->post('pid'), 'img' => $file1);   	
					
					$id = $this->ProductModel->save_image($data);								  
					
						
			$status = "success";			
			$data = array("title"=>"Added Successfully..!");
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return TRUE;
						
		}
		else
		{
		  	$data = array("title"=>"No Post Data Found");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
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
		$config['overwrite']     = TRUE;
		$config['file_name'] = $code1;	
	
		return $config;
	}
	
	
	public function advertisement()
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->adsModel->get_ads_list_with_date(1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
	}	
	
	public function advertisement_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->adsModel->get_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function advertisement_list_by_manfid($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->adsModel->get_paged_list_client(1000, 0, $id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function whats_new_products()
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->WhatsnewModel->get_whats_new_prod_list(1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
	}
	
	public function whats_new_products_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->WhatsnewModel->get_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function whats_new_products_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->WhatsnewModel->get_prod_list_by_manf_id($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
	}
	
	public function whats_new_events()
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->eventModel->get_paged_list(1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
	}
	
	public function whats_new_events_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->eventModel->get_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function products()
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_paged_list_api(1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function search_products($cid, $scid, $sccid)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_search_list_api($cid, $scid, $sccid, 1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function search_products_by_keywords($keywords, $desc="")
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_search_by_nameapi($keywords, $desc, 1000, 0)->result();
			$status = "success";			
			//echo $this->db->last_query(); 
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function search_products_by_keywords_list($keywords)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_search_by_nameapi_list($keywords, 1000, 0)->result();
			//echo $this->db->last_query();
			$status = "success";			
			$data = array();
			$i=0;foreach($viewdata as $item) { 
			
				if($item->status != 'Inactive'){ 
				$data[$i]= array('pid'=> $item->pid, 'cid'=> $item->cid, 'manufacture_id'=> $item->manufacture_id, 'pname'=> $item->pname, 'product_img'=> $item->product_img, 'pdetail'=> $item->pdetail, 'city'=> $item->city, 'state'=> $item->state, 'brandname'=> $item->brandname, 'company_name'=> $item->company_name, 'status'=> $item->status); 
				$i++;
				}
			}

			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function products_list_by_keywords($keywords)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_list_autosuggest($keywords, 1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	
	public function products_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_details_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function products_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_list_by_id($id, 1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function products_inquiry_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->InquiryModel->get_all_products_inquiry_by_manfid($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function manf_inquiry_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->InquiryModel->get_all_manf_inquiry_by_manfid_in_api($id)->result();
			$status = "success";			
			//echo $this->db->last_query();
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function ads_inquiry_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->InquiryModel->get_all_ads_inquiry_by_manfid($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function dealer_inquiry_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->InquiryModel->get_all_dealers_inquiry_by_manfid($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function whatsnew_prod_inquiry_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->InquiryModel->get_all_whatsnew_inquiry_by_manfid($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function manf_details_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ManufacturerModel->get_manf_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function update_manf_details_by_id()
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
			
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company_name' => $this->input->post('company_name'),
				'contact' => $this->input->post('contact'),
				'address' => $this->input->post('address'),
				'profile_img' => $file1,
				//'type' => $this->input->post('type'),
				'about_manf' => $this->input->post('about_manf')
					);   	
			
			$id = $this->input->post('mid');			
			$this->ManufacturerModel->update($id,$data);	
			
			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function dealers_details_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->dealerModel->get_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function dealers_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->dealerModel->get_dealers_by_manufacture_id($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function delete_dealer_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$val = $this->dealerModel->delete($id);

			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function update_dealer_by_id()
	{ 		
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'brandname' => $this->input->post('brandname'),
				'email' => $this->input->post('email'),
				'mobileno' => $this->input->post('mobileno'),
				'address1' =>  $this->input->post('address1'),	
				'address2' => $this->input->post('address2'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state')
					);   	
			
			$id = $this->input->post('did');			
			$this->DealerModel->update($id,$data);

			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function delete_product_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$val = $this->ProductModel->delete($id);

			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function update_product_by_id()
	{ 		
			$this->load->library('upload');	
			$file2 = "";
                                             
            if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
								
				$config1['upload_path'] = "./images/products/";
				$config1['allowed_types'] = 'jpg|png|jpeg';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1;		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					
					
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
				$data = array('cid' => $this->input->post('catlevel1'),
				'subcat_id' => $this->input->post('catlevel2'),
				'sscat_id' => $this->input->post('catlevel3'),
				'manufacture_id' => $this->input->post('manf_id'),
				'brand_id' => $this->input->post('brand_id'),
				'pname' => $this->input->post('txtproductname'),
				'product_img' => $file2,
				'pdetail' => $this->input->post('txtshortdesc'),
				'note' => $this->input->post('txtnote')
                            	);									     	
                      
			$id = $this->input->post('pid');			
			$this->ProductModel->update($id,$data);	

			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function products_images_list($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_images_list($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_cat_level1_name($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$cat_level1 = $this->ProductModel->get_categories_list_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$cat_level1, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_cat_level2_name($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$cat_level2 = $this->ProductModel->get_subcategories_list_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$cat_level2, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_cat_level3_name($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$cat_level3 = $this->ProductModel->get_subsubcategories_list_by_scid($id)->result();
			$status = "success";			
			
			$val = array('data'=>$cat_level3, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_cat_level1_list()
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$cat_level1 = $this->ProductModel->get_categories_list()->result();
			$status = "success";			
			
			$val = array('data'=>$cat_level1, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_cat_level2_list($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$cat_level2 = $this->ProductModel->get_subcat_by_cid($id)->result();;
			$status = "success";			
			
			$val = array('data'=>$cat_level2, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_categories_images($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->CategoriesModel->get_categories_images_list($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_subcategories_images($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->SubcategoriesModel->get_subcategories_images_list($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_subsubcategories_images($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->SubsubcategoriesModel->get_sscategories_images_list($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	
	public function get_product_manf_brands($keywords)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_product_search_by_nameapi_list(urldecode($keywords), 1000, 0)->result();
			//echo $this->db->last_query();
			$status = "success";			
			$data = array();
			$i=0;foreach($viewdata as $item) { 
			
				if($item->status != 'Inactive'){ 
				$data[$i]= array('pid'=> $item->pid, 'cid'=> $item->cid, 'manufacture_id'=> $item->manufacture_id, 'pname'=> $item->pname, 'product_img'=> $item->product_img, 'pdetail'=> $item->pdetail, 'city'=> $item->city, 'state'=> $item->state, 'brandname'=> $item->brandname, 'company_name'=> $item->company_name, 'status'=> $item->status); 
				$i++;
				}
			}

			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
			
			/*$products = $this->ProductModel->get_autosuggest_prod_list($key, 1000, 0)->result();
			$manf = $this->ManufacturerModel->get_auto_manf_list($key, 1000, 0)->result();
			$brands = $this->BrandModel->get_auto_brand_list($key, 1000, 0)->result();
			$status = "success";			
			$viewdata = array("Products"=>$products, "Manufacturers"=>$manf, "Brands"=>$brands);
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;*/
            
	}
	
	public function get_whatsnew_images($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->WhatsnewModel->get_whatsnew_images_list($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function add_manf_inquiry()
	{
		if(isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['mobile']))
		{
		  	if($_POST['full_name'] == "" || $_POST['mobile'] == "" || $_POST['email'] == "") 
			{
				$data = array("title"=>"Please enter Full Name, Email, Mobile and other details.");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			}	
			
				$data = array('mid' => $this->input->post('man_id'),
				'manf_company_name' => $this->input->post('company_name'),
				'name' => $this->input->post('full_name'),
				'email' => $this->input->post('email'),
				'city' =>  $this->input->post('city'),	
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country'),
				'mobile' => $this->input->post('mobile'),
				'details' => $this->input->post('details'),
				'inquirydate' => date('Y-m-d')
					);   	
			$id = $this->ManufacturerModel->save_manf_inquiry($data);
			
			$mid = $this->db->insert_id();
						
			if($id) { 
			
				$status = "success";			
				$data = array("title"=>"Submitted Successfully..!");
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
		  		return TRUE;
				
			} else {
			
				$data = array("title"=>"Something went wrong! Please try once again..!");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			
			}
		}
		else
		{
		  	$data = array("title"=>"No Post Data Found");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
	}
	
	public function get_brands_by_Manfid($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$brands = $this->BrandModel->get_paged_list_id($id, 1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$brands, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_all_brands_list()
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$brands = $this->BrandModel->get_paged_list(1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$brands, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function delete_brand_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$val = $this->BrandModel->delete($id);

			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_brands_details_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$brands = $this->BrandModel->get_by_id($id)->row();
			$status = "success";			
			
			$val = array('data'=>$brands, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function add_brands()
	{
		if(isset($_POST['txtbrandname']) && isset($_POST['selclient']))
		{
		  	if($_POST['txtbrandname'] == "") 
			{
				$data = array("title"=>"Please enter all required details.");
				$status = "fail";			
				
				$val = array('data'=>$data, 'status' => $status);
				print json_encode($val);
				return false;
			}	
			
				$this->load->library('upload');				
		           $file1 = "";
                    
                    if (!empty($_FILES['userfile1']['name']))
                    {	
                            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            $curenttimestamp = time();
                            $code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
                            $config1['upload_path'] = "./doc/";
                            $config1['allowed_types'] = '*';
                            $config1['max_size']	= '10240';				
                            $config1['file_name'] = $code1;		
                            $this->upload->initialize($config1);	
							
                            if (!$this->upload->do_upload('userfile1'))
                            {	
                                    $error = $this->upload->display_errors();
                                   
                                    $data = array("title"=>"Maximum upload file size is 10MB.");
									$status = "fail";			
									
									$val = array('data'=>$data, 'status' => $status);
									print json_encode($val);
									return false;
									
                            }
                            else
                            {
                                    $val1 = array('upload_data' => $this->upload->data());				
                                    $file1 = $val1["upload_data"]["orig_name"];
                            }
                    }
                    $data = array(          
                                  'brandname' => $this->input->post('txtbrandname'),
								  'mid' => $this->input->post('selclient'),
								  'catalogue' => $file1,
                                    );   	
               
                    
					$id = $this->BrandModel->save($data);			
											
					if($id) { 
					
						$status = "success";			
						$data = array("title"=>"Added Successfully..!");
						$val = array('data'=>$data, 'status' => $status);
						print json_encode($val);
						return TRUE;
						
					} else {
					
						$data = array("title"=>"Something went wrong! Please Add Brand once again..!");
						$status = "fail";			
						
						$val = array('data'=>$data, 'status' => $status);
						print json_encode($val);
						return false;
					
					}
		}
		else
		{
		  	$data = array("title"=>"No Post Data Found");
			$status = "fail";			
			
			$val = array('data'=>$data, 'status' => $status);
			print json_encode($val);
			return false;
			
		}	
						
	}
	
	public function update_brand_by_id()
	{ 		
			$file1 = "";
           if (!empty($_FILES['userfile1']['name']))
			{	
					$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
					$curenttimestamp = time();
					$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
					$config1['upload_path'] = "./doc/";
					$config1['allowed_types'] = 'pdf';
					$config1['max_size']	= '10240';				
					$config1['file_name'] = $code1;		
					$this->upload->initialize($config1);		
					if (!$this->upload->do_upload('userfile1'))
					{	
							$error = $this->upload->display_errors();
							
					}
					else
					{
							$val1 = array('upload_data' => $this->upload->data());				
							$file1 = $val1["upload_data"]["orig_name"];
					}
			}	
			else { 
			$file1 = $this->input->post('oldfilename');
			}			
						
			$data = array(
					'brandname' => $this->input->post('txtbrandname'),
					'mid' => $this->input->post('selclient'),
					'catalogue' => $file1
					);   	
		
			$id = $this->input->post('id');
				
			$this->BrandModel->update($id,$data);	

			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}	
	
	
	public function get_manf_list_by_cat($cid, $scid, $sccid)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_manf_list_by_cat($cid, $scid, $sccid, 1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_dealers_city_by_manf_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->dealerModel->get_dealers_city_by_manf_id($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_manf_list_by_cat_subcat($cid, $scid)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_manf_list_by_cat_subcat($cid, $scid, 1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function get_products_by_cat_subcat($cid, $scid)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ProductModel->get_products_by_cat_subcat($cid, $scid, 1000, 0)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function delete_prod_image($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$val = $this->ProductModel->delete_image($id);

			if($this->db->affected_rows() > 0) { 
			$status = "success";			
			} else {
			$status = "Fail";
			}
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
	
	public function send_notification_to_admin($mid, $section)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ManufacturerModel->get_manf_by_id($mid)->row();
			
			if($viewdata->status == "Active") { 
			/* MAIL START */ 
			$FName = $viewdata->first_name;
			$LName = $viewdata->last_name;
			
			$user_email = trim($this->input->post('Email'));
			$this->load->library('email');
			$config['mailtype'] = 'html';
	        $this->email->initialize($config);
			$name = $viewdata->company_name;
			$email_from = "headwayappworld@gmail.com";
			$examil_to = 'headwayappworld@gmail.com';					
			$data['section'] = ucfirst($section);				
			$data['name'] = $name;	
			
			$this->email->from($email_from, "Hardware Channel");
			$this->email->to($examil_to); 
			$this->email->subject('Hardware Channel App Notification -'.$name);
			$this->email->message($this->load->view("emailnotification",$data,true));	
			
			$this->email->send();
			/* MAIL END */	
            echo $this->email->print_debugger();
			
			}
	}
        
	public function delete_inquiry_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
	
			$data = array('status' => 'deleted');
			$val = $this->InquiryModel->update_status($id,$data);	
			
			$status = "success";			
			
			$val = array('status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}

	public function get_images_of_event($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->eventModel->get_images_list($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}	
	
	public function get_all_countries()
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $this->ManufacturerModel->getCountry()->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}	
	
	public function get_state_by_country_id($id)
	{ 	
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $result=$this->ManufacturerModel->getData('state',$id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}	
	
	public function get_city_by_state_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $result=$this->ManufacturerModel->getData('city',$id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}	
	
	public function change_manf_password($manfid,$newpassword)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.			
			
			if($manfid !="" && $newpassword != "") { 
			
			$pass = array('password' => $newpassword);
			$this->user->updatepass($manfid,$pass);

				if($this->db->affected_rows() > 0) { 
					$status = "success";			
				} else {
					$status = "Fail";
				}
			
				$val = array('status' => $status);
				print json_encode($val);
				return TRUE;
			
			} else {
			
				$status = "Fail";
				$val = array('status' => $status);
				print json_encode($val);
				return TRUE;
			
			}
            
	}
	
	public function get_page_by_id($id)
	{ 		
			header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
			header("Pragma: no-cache"); // HTTP 1.0.
			header("Expires: 0"); // Proxies.
			
			$viewdata = $result=$this->PageModel->get_by_id($id)->result();
			$status = "success";			
			
			$val = array('data'=>$viewdata, 'status' => $status);
			print json_encode($val);
		  	return TRUE;
            
	}
}

?>
