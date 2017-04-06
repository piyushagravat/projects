<?php
Class DealerModel extends CI_Model
{
	private $table = 'tbl_dealer';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('id','desc');
               return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_auto_suggest_list_manf($limit = 8, $offset = 0)
	{
		$this->db->order_by('tbl_dealer.id','asc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_dealer.mid');
		$this->db->group_by('tbl_dealer.mid');
        return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_auto_suggest_list_brand($limit = 8, $offset = 0)
	{
		$this->db->order_by('tbl_dealer.id','asc');
		$this->db->select('*');
		$this->db->join('tbl_brand', 'tbl_brand.id = tbl_dealer.brand_id');
		$this->db->group_by('tbl_dealer.brand_id');
        return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all()
	{
		$this->db->order_by('id','desc');
               return $this->db->count_all_results($this->table);
	}
        function changestatus($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	function get_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}	
	function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}			
	function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}		
	function delete($id)
	{
		
		$this->db->where('id', $id);
		$this->db->delete($this->table);			
	}
	
	function get_user_role_list()
	{
		$this->db->order_by('id','desc');
		return $this->db->get("tbl_roles");
	}
	  function get_paged_list_id($id,$limit = 8, $offset = 0)
	{
		$this->db->where('mid',$id);
                $this->db->order_by('id','desc');
                return $this->db->get('tbl_dealer', $limit, $offset);
	}
	function get_by_manufacture_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}
	
	function count_all_by_manufacture_id($id)
	{
		$this->db->order_by('id','desc');
		$this->db->where('mid',$id);
        return $this->db->count_all_results($this->table);
	}
	function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("tbl_users");
    }
		
	function get_dealers_by_manufacture_id($id)
	{
		$this->db->order_by('tbl_dealer.id','asc');
		$this->db->select('tbl_dealer.id, tbl_dealer.mid, tbl_dealer.email, tbl_dealer.mobileno, tbl_dealer.address1, tbl_dealer.address2, tbl_dealer.country, tbl_dealer.state, tbl_dealer.city, tbl_dealer.pincode, tbl_dealer.firmname, tbl_dealer.brand_id, tbl_brand.brandname');
		$this->db->join('tbl_brand', 'tbl_brand.id = tbl_dealer.brand_id');
		$this->db->where('tbl_dealer.mid', $id);
		return $this->db->get($this->table);	
	}
	
	function get_dealers_city_by_manf_id($id)
	{
		$this->db->distinct();
		$this->db->select('city');
		$this->db->where('mid', $id);
		return $this->db->get($this->table);
	}
	
	//dealer search in serach table
	function get_new_search_dealer_list($limit = 8, $offset = 0,$val)
	{	
		$names = explode(' - ',$val);
			$this->db->order_by('mid','asc');
			$this->db->like('mid',$names[1]);
				
				
			
			return $this->db->get($this->table, $limit, $offset);
	}
	function count_new_search_dealer_all($val)
	{
			$names = explode(' - ',$val);
		
			$this->db->order_by('mid','asc');
			$this->db->like('mid',$names[1]); 		
					
			
			return $this->db->count_all_results($this->table);
	}
	
	
    function get_search_list($limit = 8, $offset = 0,$val)
	{
		$this->db->order_by('id','asc');
		$this->db->where('firmname', $val); 
    
		return $this->db->get($this->table, $limit, $offset);
	} 
	
	function get_search_dealer_list($limit = 8, $offset = 0, $val)
	{	
			
		$this->db->order_by('tbl_dealer.id','desc');
		$this->db->select('tbl_dealer.id,tbl_dealer.firmname,tbl_dealer.brand_id,tbl_dealer.mid,tbl_dealer.email,tbl_dealer.mobileno,tbl_dealer.address1,tbl_dealer.address2,tbl_dealer.city');
		$this->db->join('tbl_users', 'tbl_dealer.mid = tbl_users.id','left');
		$this->db->like('tbl_users.company_name', $val);
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_search_dealer_all($val)
	{
		$this->db->order_by('tbl_dealer.id','desc');
		$this->db->select('tbl_dealer.id,tbl_dealer.firmname,tbl_dealer.brand_id,tbl_dealer.mid,tbl_dealer.email,tbl_dealer.mobileno,tbl_dealer.address1,tbl_dealer.address2,tbl_dealer.city');
		$this->db->join('tbl_users', 'tbl_dealer.mid = tbl_users.id','left');
		$this->db->like('tbl_users.company_name', $val);
		
		
		return $this->db->count_all_results($this->table);
	}
	

}
?>