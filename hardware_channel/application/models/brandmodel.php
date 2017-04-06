<?php
Class BrandModel extends CI_Model
{
	private $table = 'tbl_brand';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('id','desc');
               return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all()
	{
		$this->db->order_by('id','desc');
        return $this->db->count_all_results($this->table);
	}
	function count_all_brands($id)
	{
		$this->db->where('id',$id);
        return $this->db->count_all_results($this->table);
	}
	function count_brands()
	{
		$this->db->where('id','desc');
        return $this->db->count_all($this->table);
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
		$this->db->order_by('id','desc');
		$this->db->where('mid', $id);
		return $this->db->get('tbl_brand', $limit, $offset);
	}
	
	function count_all_brands_by_id($id)
	{
		$this->db->order_by('id','desc');
		$this->db->where('mid', $id);
		return $this->db->count_all_results($this->table);
	}
	function get_user_by_id($id)
    {
                $this->db->where('id', $id);
                return $this->db->get("tbl_users");
    }
	
	function get_search_brand_list($limit = 8, $offset = 0, $val)
	{	
			$this->db->order_by('id','asc');
			$this->db->like('brandname', $val, 'after');
			return $this->db->get($this->table, $limit, $offset);
		
		
	}
	function count_search_brand_all($val)
	{
		
			$this->db->order_by('id','asc');
			$this->db->like('brandname', $val, 'after');
			return $this->db->count_all_results($this->table);
	}	
    function get_search_list($limit = 8, $offset = 0,$val)
	{
		$this->db->order_by('id','asc');
		$this->db->where('brandname',$val);
        return $this->db->get($this->table, $limit, $offset);
	} 	
	function get_auto_brand_list($keyword, $limit = 8, $offset = 0)
	{
		$this->db->order_by('id','desc');
		$this->db->like('brandname', $keyword, 'after');
		return $this->db->get($this->table, $limit, $offset);
	}	
}
?>