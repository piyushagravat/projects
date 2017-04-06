<?php
Class SubcategoriesModel extends CI_Model
{
	private $table = 'tbl_subcategories';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('subcat_name','asc');
               return $this->db->get($this->table, $limit, $offset);
	}
        
        function count_all()
	{
		$this->db->order_by('subcat_id','desc');
                return $this->db->count_all($this->table);
	}
     
	function get_by_id($id)
	{
		$this->db->where('subcat_id', $id);
		return $this->db->get($this->table);
	}	
	function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}			
	function update($id, $data)
	{
                $this->db->where('subcat_id', $id);
		$this->db->update($this->table, $data);
        }		
	function delete($id)
	{
		$this->db->where('subcat_id', $id);
		$this->db->delete($this->table);			
	}
	
	function get_user_role_list()
	{
		$this->db->order_by('id','asc');
		return $this->db->get("tbl_roles");
	}
       function get_categories_list()
	{
		$this->db->order_by('cname','asc');	
		return $this->db->get("tbl_categories");
	}	
	
	function get_cat_list_by_id($id)
	{
		$this->db->order_by('cid','desc');	
		$this->db->where('cid', $id);
		return $this->db->get("tbl_categories");
	}
      function get_subcategories_images_list($id)
	{
		$this->db->order_by('id','asc');
		$this->db->where('sid', $id);
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

	
	function get_search_subcat_list($limit = 1000, $offset = 0, $val)
	{	
		$this->db->order_by('subcat_id','asc');
		$this->db->like('subcat_name', $val);
		return $this->db->get($this->table, $limit, $offset);
		
	}
	
	function count_search_subcat_all($val)
	{
		$this->db->order_by('subcat_id','asc');
		$this->db->like('subcat_name', $val);
		return $this->db->count_all_results($this->table);
	}
	function get_search_list($limit = 8, $offset = 0,$val)
	{
		$this->db->order_by('subcat_id','asc');
		$this->db->where('subcat_name',$val);
        return $this->db->get($this->table, $limit, $offset);
	}	
	
}
?>