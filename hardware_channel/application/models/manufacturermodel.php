<?php
Class ManufacturerModel extends CI_Model
{
	private $table = 'tbl_users';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('approved_date','desc');
        $this->db->where('role != ','Admin');
		$this->db->where('phase != ','new_signup');
		return $this->db->get($this->table, $limit, $offset);
	}
	function count_all()
	{
		$this->db->order_by('approved_date','desc');
        $this->db->where('role != ','Admin');
		$this->db->where('phase != ','new_signup');
		return $this->db->count_all_results($this->table);
	}
        
    function get_inactive_paged_list($limit = 8, $offset = 0)
	{
		if($offset == "") { $offset = 0; } ;
		/*$this->db->order_by('id','desc');
		$this->db->where('role != ','Admin');
		$this->db->where('phase','new_signup');
	    return $this->db->get($this->table, $limit, $offset);*/
		$sql = "SELECT * FROM tbl_users a WHERE a.status =  'Inactive' AND a.phase = 'new_signup' AND a.id NOT IN ( SELECT manufacture_id FROM tbl_product ) ORDER BY a.id DESC LIMIT ".$offset.", ".$limit."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_inactive_all()
	{
		/*$this->db->order_by('id','desc');
		$this->db->where('role != ','Admin');
		$this->db->where('phase','new_signup');
		return $this->db->count_all_results($this->table);*/
		$sql = "SELECT * FROM tbl_users a WHERE a.status =  'Inactive' AND a.phase = 'new_signup' AND a.id NOT IN ( SELECT manufacture_id FROM tbl_product ) ";		
		$res = $this->db->query($sql);
		return count($res->result());
	}
	
	
	function get_product_list($mid)
	{
		$this->db->where('manufacture_id',$mid);
        return $this->db->get('tbl_product');
	}
	
	function get_waiting_paged_list($limit = 8, $offset = 0)
	{
	//	SELECT u.*, p.manufacture_id FROM tbl_users u, tbl_product p WHERE u.status = 'Inactive' 
	//	AND u.role = 'Manufacture' AND u.id = p.manufacture_id
		
		$this->db->select('tbl_users.*');
		$this->db->from('tbl_product p');
		$this->db->where('tbl_users.status','Inactive');
		$this->db->where('tbl_users.phase','new_signup');
		$this->db->where('tbl_users.id = p.manufacture_id');
		$this->db->where('tbl_users.role','Manufacture');
		$this->db->or_where('tbl_users.role','Importer');
		$this->db->or_where('tbl_users.role','Both');
		$this->db->order_by('tbl_users.created_date','desc');
		$this->db->distinct();
		return $this->db->get($this->table, $limit, $offset);
	
	}
	
	function count_waiting_all()
	{
		$this->db->select('tbl_users.*');
		$this->db->from('tbl_product p');
		$this->db->where('tbl_users.status','Inactive');
		$this->db->where('tbl_users.phase','new_signup');
		$this->db->where('tbl_users.id = p.manufacture_id');
		$this->db->where('tbl_users.role','Manufacture');
		$this->db->or_where('tbl_users.role','Importer');
		$this->db->or_where('tbl_users.role','Both');
		
		$this->db->distinct();
		return $this->db->count_all_results($this->table);
	}				function get_waiting_paged_list_count()	{				$this->db->select('tbl_users.*');		$this->db->from('tbl_product p');		$this->db->where('tbl_users.status','Inactive');		$this->db->where('tbl_users.phase','new_signup');		$this->db->where('tbl_users.id = p.manufacture_id');		$this->db->where('tbl_users.role','Manufacture');		$this->db->or_where('tbl_users.role','Importer');		$this->db->or_where('tbl_users.role','Both');		$this->db->order_by('tbl_users.created_date','desc');		$this->db->distinct();		return $this->db->get($this->table);		}
	
	
        function get_latest_ten_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('id','desc');
                $this->db->where('status','Inactive');
                $this->db->where('role','Manufacture');
		return $this->db->get($this->table, $limit, $offset);
	}
	function count_latest_ten()
	{
		$this->db->order_by('id','desc');
                $this->db->where('status','Inactive');
                $this->db->where('role','Manufacture');
		return $this->db->count_all_results($this->table);
	}
        function changestatus($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	
	function get_manf_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->where('role','Manufacture');
		return $this->db->get($this->table);
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
		$this->db->where('manufacture_id', $id);
		$this->db->delete('tbl_whatsnew_product');
		$this->db->where('manufacture_id', $id);
		$this->db->delete('tbl_product');
		$this->db->where('mid', $id);
		$this->db->delete('tbl_brand');
		$this->db->where('mid', $id);
		$this->db->delete('tbl_dealer');
		$this->db->where('mid', $id);
		$this->db->delete('tbl_inquiry');
				
	}
	
	function get_user_role_list()
	{
		$this->db->order_by('id','asc');
		return $this->db->get("tbl_roles");
	}
	
	 function count_inactivemanufacture()
	{
		$this->db->select('count(*)');
                $this->db->from('tbl_users');
                $this->db->where('status','Inactive');
                $this->db->where('role','Manufacture');
				$this->db->where('created_date',date("Y-m-d"));
                //SELECT COUNT(*) FROM `tbl_users` WHERE `role` = "Manufacture" AND `status` = "Active" ORDER BY `id` DESC
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
	
	
	function get_search_manf_list($val)
	{	
		//	$names = explode(' ',$val);
			$this->db->order_by('id','asc');
		//	$this->db->like('first_name', $names[0]); 
         //   $this->db->like('last_name', $names[1]);
		$this->db->like('company_name', $val);
			return $this->db->get($this->table);
		
		
	}
	function count_search_manf_all($val)
	{
		
	//	$names = explode(' ',$val);
			$this->db->order_by('id','asc');
			//$this->db->like('first_name', $names[0]); 
         //   $this->db->like('last_name', $names[1]);
		$this->db->like('company_name', $val);
			return $this->db->count_all_results($this->table);
	}	
    function get_search_list($limit = 8, $offset = 0,$val)
	{
		$this->db->order_by('id','asc');
		$this->db->where('first_name', $val); 
        $this->db->or_where_in('last_name', $val);
        return $this->db->get($this->table, $limit, $offset);
	} 	
	
	
	
	function save_inquiry($data)
	{
		$this->db->insert('tbl_inquiry', $data);
		return $this->db->insert_id();
	}	
	
	
	function save_manf_inquiry($data)
	{
		$this->db->insert('tbl_manf_inquiry', $data);
		return $this->db->insert_id();
	}	
	
	function get_auto_manf_list($keyword, $limit = 8, $offset = 0)
	{
		$this->db->order_by('id','asc');
                $this->db->where('status','Active');
                $this->db->where('role','Manufacture');
				$this->db->like('company_name', $keyword, 'after');
		return $this->db->get($this->table, $limit, $offset);
	}
	 
	// start country, state, city function.
	function getCountry(){
		$this->db->select('id,country_name');
		$this->db->from('country');
		$this->db->order_by('country_name', 'asc'); 
		$query=$this->db->get();
		return $query; 
	}
	
	function getData($loadType,$loadId){
		if($loadType=="state"){
			$fieldList='id,state_name as name';
			$table='state';
			$fieldName='country_id';
			$orderByField='state_name';						
		}else{
			$fieldList='id,city_name as name';
			$table='city';
			$fieldName='state_id';
			$orderByField='city_name';	
		}
		
		$this->db->select($fieldList);
		$this->db->from($table);
		$this->db->where($fieldName, $loadId);
		$this->db->order_by($orderByField, 'asc');
		$query=$this->db->get();
		return $query; 
	}
	
	function selcity($city)
	{
		$this->db->select('city_name'); 
		$this->db->where('id', $city);
		$query = $this->db->get('city'); 
		return $query; 
	}
	function selstate($state)
	{
		$this->db->select('state_name'); 
		$this->db->where('id', $state);
		$query = $this->db->get('state'); 
		return $query; 
	}
	function selcountry($country)
	{
		$this->db->select('country_name'); 
		$this->db->where('id', $country);
		$query = $this->db->get('country'); 
		return $query; 
	}
	
	
	function getState($statename){
		$this->db->select('id,state_name');
		$this->db->from('state');
		$this->db->where('state_name', $statename);
		$this->db->order_by('state_name', 'asc'); 
		$query=$this->db->get();
		return $query; 
	}
	function getCity($cityname){
		$this->db->select('id,city_name');
		$this->db->from('city');
		$this->db->where('city_name', $cityname);
		$this->db->order_by('city_name', 'asc'); 
		$query=$this->db->get();
		return $query; 
	}
	
	
	function get_city_by_id($id)
	{
		$this->db->where('id', $id);	
		return $this->db->get("city");
	}

	// country, state, city function.
}
?>