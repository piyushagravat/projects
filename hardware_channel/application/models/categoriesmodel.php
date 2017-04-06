<?php
Class CategoriesModel extends CI_Model
{
	private $table = 'tbl_categories';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('cname','asc');
               return $this->db->get($this->table, $limit, $offset);
	}
        
        function count_all()
	{
		$this->db->order_by('cid','asc');
                return $this->db->count_all($this->table);
	}
     
	function get_by_id($id)
	{
		$this->db->where('cid', $id);
		return $this->db->get($this->table);
	}	
	function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
                print_r($data);exit;
	}			
	function update($id, $data)
	{
		$this->db->where('cid', $id);
		$this->db->update($this->table, $data);
	}		
	function delete($id)
	{
		$this->db->where('cid', $id);
		$this->db->delete($this->table);			
	}
	
	function get_user_role_list()
	{
		$this->db->order_by('id','asc');
		return $this->db->get("tbl_roles");
	}
	   function get_categories_images_list($id)
	{
		$this->db->order_by('id','asc');
		$this->db->where('cid', $id);
		return $this->db->get('cat_images');
	}
        function save_image($data)
	{
		$this->db->insert('cat_images', $data);
		return $this->db->insert_id();
	}
        function delete_image($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cat_images');			
	}
	
	function get_search_cat_list($limit = 1000, $offset = 0, $val)
	{	
	$this->db->order_by('cid','asc');
			$this->db->like('cname', $val);
			return $this->db->get($this->table, $limit, $offset);
		
		
	}
	
	function count_search_cat_all($val)
	{
		
			$this->db->order_by('cid','asc');
			$this->db->like('cname', $val);
			return $this->db->count_all_results($this->table);
		
		
		
	}
	function get_search_list($limit = 8, $offset = 0,$val)
	{
		$this->db->order_by('cid','asc');
		$this->db->where('cname',$val);
               return $this->db->get($this->table, $limit, $offset);
	}
	
}
?>