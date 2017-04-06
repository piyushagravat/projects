<?php
Class InquiryModel extends CI_Model
{
	
	private $table = 'tbl_inquiry';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 15, $offset = 0)
	{
		$this->db->order_by('id','desc');
		$this->db->where('inquiry_type', 'Ads');
        return $this->db->get($this->table, $limit, $offset);
	}
	function count_all()
	{
		$this->db->order_by('id','desc');
		$this->db->where('inquiry_type', 'Ads');
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_product($limit = 10, $offset = 0)
	{
		$this->db->where('inquiry_type', 'Product');
		$this->db->order_by('inquirydate','desc');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_product_inquiry()
	{
		$this->db->where('inquiry_type', 'Product');
		return $this->db->count_all_results($this->table);
	}	
	
	function get_paged_list_whatsnew_product($limit = 10, $offset = 0, $id)
	{
		$this->db->where('inquiry_type', 'Whatsnew');
		$this->db->order_by('inquirydate','desc');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_whatsnew_product_inquiry()
	{
		$this->db->where('inquiry_type', 'Whatsnew');
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_dealer($limit = 10, $offset = 0)
	{
		$this->db->where('inquiry_type', 'Dealer');
		$this->db->order_by('id','desc');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_client_by_id($id)
	{
		$this->db->where('pid', $id);
		return $this->db->get("tbl_product");
	}	
	function count_all_client($id)
	{
		$this->db->where('mid', $id);
		$this->db->order_by('id','asc');
		return $this->db->count_all_results($this->table);
	}
	function count_all_dealer()
	{
		$this->db->where('inquiry_type', 'Dealer');
		$this->db->order_by('id','desc');
		return $this->db->count_all_results($this->table);
	}
	function get_by_id($aid)
	{
		$this->db->where('id', $aid);
		return $this->db->get($this->table);
	}	
	function get_dealer_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_dealer");
	}
    function get_adsname_by_id($id)
	{
		$this->db->where('aid', $id);
		return $this->db->get($this->table);
	}
	
	function get_brand_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_brand");
	}
	
	function delete($aid)
	{
		$this->db->where('id', $aid);
		$this->db->delete($this->table);			
	}
	function deletedealer($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);			
	}
	function delete_manufa_inquiry($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);			
	}
	
	
	function get_user_list()
	{
		$this->db->where('role', "Manufacture");
		$this->db->order_by('id','asc');
		return $this->db->get("tbl_users");
	}
	function get_user_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_users");
	}	
	function get_all_ads_list_by_client_id1()
	{
		$this->db->where('aid', 'asc');	
		return $this->db->get("tbl_ads");
	}
	
    function get_all_ads_list_by_client_id($id)
	{
		$this->db->where('aid', $id);	
		return $this->db->get("tbl_ads");
	}
	function get_all_product_list_by_client_id($id)
	{
		$this->db->where('pid', $id);	
		return $this->db->get("tbl_product");
	}
    function get_all_product_list_by_whatsnew($id)
	{
		$this->db->where('id', $id);
        return $this->db->get("tbl_whatsnew_product");
	}
	function get_paged_list_manufa_inquiry($limit = 8, $offset = 0)
	{
		$this->db->where('inquiry_type', 'Manufacturer');
		$this->db->order_by('id','desc');
		return $this->db->get($this->table, $limit, $offset);
		
	}
	function count_all_manufa()
	{
		$this->db->order_by('id','desc'	);
		$this->db->where('inquiry_type', 'Manufacturer');
		return $this->db->count_all_results($this->table);
	}
	function get_client_by_whatsnew($id)
	{
		$this->db->where('whats_new', "Whatsnew");
                $this->db->order_by('pid', $id);
		return $this->db->get("tbl_product");
	}
     
	function get_all_products_by_manfid($id)
	{
		$this->db->where('inquiry_type', 'Product');
		$this->db->where('mid', $id);
		
		return $this->db->get($this->table);
	}
    function get_user_list_with_location()
	{
		$this->db->distinct('city');
                $this->db->group_by('city');
                $this->db->order_by('city','asc');
                return $this->db->get($this->table);
    }
    function get_user_list_with_location_byid($id)
	{
		$this->db->where('city',$id);
		$this->db->order_by('inquirydate','desc');
                return $this->db->get($this->table);
    }  

	function get_search_list($limit = 8, $offset = 0,$val)
	{
		$val1 = explode('-',$val);
		$this->db->order_by('id','asc');
		$this->db->where('inquiry_type', 'Ads');
		$this->db->like('aid', $val1[1]);
        return $this->db->get($this->table, $limit, $offset);
	} 
	function get_search_adsinquiry_list($limit = 8, $offset = 0, $val)
	{	
			$val1 = explode('-',$val);
			$this->db->order_by('id','asc');
			$this->db->where('inquiry_type', 'Ads');
			$this->db->like('aid', $val1[1]);
			return $this->db->get($this->table, $limit, $offset);
	}
	function count_search_adsinquiry_all($val)
	{
			$val1 = explode('-',$val);
			$this->db->order_by('id','asc');
			$this->db->where('inquiry_type', 'Ads');
			$this->db->like('aid', $val1[1]);
			return $this->db->count_all_results($this->table);
	}
	
	function get_wtsnewsearch_list($limit = 8, $offset = 0,$val)
	{
		$val1 = explode('-',$val);
		$this->db->order_by('id','asc');
		$this->db->where('inquiry_type', 'Whatsnew');
		$this->db->like('wts_new', $val1[1]);
        return $this->db->get($this->table, $limit, $offset);
	} 
	function get_search_wtsnewinquiry_list($limit = 8, $offset = 0,$val)
	{	
			$val1 = explode('-',$val);
			$this->db->order_by('id','asc');
			$this->db->where('inquiry_type', 'Whatsnew');
			$this->db->like('wts_new', $val1[1]);
			return $this->db->get($this->table, $limit, $offset);
	}
	function count_search_wtsnewinquiry_all($val)
	{
			$val1 = explode('-',$val);
			$this->db->order_by('id','asc');
			$this->db->where('inquiry_type', 'Whatsnew');
			$this->db->like('wts_new', $val1[1]);
			return $this->db->count_all_results($this->table);
	}
	
	
	function get_by_wts_new_id($id)
	{
		$this->db->where('wts_new', $id);
		return $this->db->get($this->table);
	}	
	
	function count_ads()
	{
		$date1 = date("Y-m-d"). " 00:00:01";
		$date2 = date("Y-m-d"). " 23:59:59";
				$this->db->select('count(*)');
                $this->db->from('tbl_inquiry');
                $this->db->where('inquiry_type',"Ads");
                $this->db->where('inquirydate >=',$date1 );
				$this->db->where('inquirydate <=',$date2 );
               //SELECT COUNT(*) FROM `tbl_inquiry` WHERE `inquiry_type` = "Ads" AND `inquirydate`= "2015-12-31"
                $query=$this->db->get();
                if($query->num_rows > 0)
		{
			return $query->result_array();
                }
		else
		{
			return false;
		}
	}
    function count_whatsnew()
	{
		$date1 = date("Y-m-d"). " 00:00:01";
		$date2 = date("Y-m-d"). " 23:59:59";
		$this->db->select('count(*)');
                $this->db->from('tbl_inquiry');
                $this->db->where('inquiry_type',"Whatsnew");
                $this->db->where('inquirydate >=',$date1 );
				$this->db->where('inquirydate <=',$date2 );
               //SELECT COUNT(*) FROM `tbl_inquiry` WHERE `inquiry_type` = "Whatsnew" AND `inquirydate`= "2015-12-31"
                $query=$this->db->get();
                if($query->num_rows > 0)
		{
			return $query->result_array();
                }
		else
		{
			return false;
		}
	}
    function count_product()
	{
		$date1 = date("Y-m-d"). " 00:00:01";
		$date2 = date("Y-m-d"). " 23:59:59";
		$this->db->select('count(*)');
                $this->db->from('tbl_inquiry');
                $this->db->where('inquiry_type',"Product");
                $this->db->where('inquirydate >=',$date1 );
				$this->db->where('inquirydate <=',$date2 );
               //SELECT COUNT(*) FROM `tbl_inquiry` WHERE `inquiry_type` = "Product" AND `inquirydate`= "2015-12-31"
                $query=$this->db->get();
                if($query->num_rows > 0)
		{
			return $query->result_array();
                }
		else
		{
			return false;
		}
	}
	
	function get_all_products_inquiry_by_manfid($mid)
	{
		$this->db->order_by('id','desc');
		$this->db->select('*');
		$this->db->join('tbl_product', 'tbl_product.pid = tbl_inquiry.pid');
		$this->db->where('tbl_product.manufacture_id', $mid);
		$this->db->where('tbl_inquiry.status !=', 'deleted');
        return $this->db->get($this->table);
	}
	
	function get_all_manf_inquiry_by_manfid($mid)
	{
		$this->db->order_by('id','desc');
		$this->db->where('mid', $mid);
		$this->db->where('aid =', 0);
		$this->db->where('did =', 0);
		$this->db->where('wts_new =', 0);
		$this->db->where('status !=', 'deleted');
        return $this->db->get($this->table);
	}
	
	function get_all_manf_inquiry_by_manfid_in_api($mid)
	{
		$this->db->order_by('id','desc');
		$this->db->where('mid', $mid);
		$this->db->where('pid', 0);
		$this->db->where('aid', 0);
		$this->db->where('did', 0);
		$this->db->where('wts_new', 0);
		$this->db->where('status !=', 'deleted');
        return $this->db->get($this->table);
	}
	
	
	function get_all_ads_inquiry_by_manfid($mid)
	{
		$this->db->order_by('tbl_inquiry.id','desc');
		$this->db->select('*');
		$this->db->join('tbl_ads', 'tbl_ads.aid = tbl_inquiry.aid');
		$this->db->where('tbl_inquiry.mid', $mid);
		$this->db->where('tbl_inquiry.status !=', 'deleted');
        return $this->db->get($this->table);
	}
	
	function get_all_dealers_inquiry_by_manfid($mid)
	{
		$this->db->order_by('I.id','desc');
		$this->db->select('I.*, d.id as DID, d.firmname, d.mid');
		$this->db->join('tbl_dealer as d', 'd.id = I.did');
		$this->db->where('d.mid', $mid);
		$this->db->where('I.status !=', 'deleted');
        return $this->db->get('tbl_inquiry as I');
	}
	
	
	function get_all_whatsnew_inquiry_by_manfid($mid)
	{
		$this->db->order_by('I.id','desc');
		$this->db->select('I.*', 'p.id as PID, p.pname, p.manufacture_id');
		$this->db->join('tbl_whatsnew_product as p', 'p.id = I.wts_new');
		$this->db->where('p.manufacture_id', $mid);
		$this->db->where('I.status !=', 'deleted');
        return $this->db->get('tbl_inquiry as I');
	}
	
	function update_status($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	
	// newly addition
	function getCountrybyState($state){
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('state_name', $state); 
		$query=$this->db->get();
		$row1 = $query->row(1);
		
		$countryId = $row1->country_id;
		$this->db->select('country_name');
		$this->db->from('country');
		$this->db->where('id', $countryId);
		$query=$this->db->get();
		return $query->row(1)->country_name;
	}
	
	function getmanufactuinfo($id){
		
		
		
		$this->db->select('company_name');
		$this->db->from('tbl_users');
		$this->db->where('id', $id); 
		$query=$this->db->get();
		return $query->row();
		
	}
     function get_maufacturer_by_pid($id)
	{
		$this->db->select('manufacture_id');
		$this->db->from('tbl_product');
		$this->db->where('pid', $id); 
		$query=$this->db->get();
		return $query->row();
		
		
	}
	
	
}
?>