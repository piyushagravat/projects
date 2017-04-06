<?php
Class WhatsnewModel extends CI_Model
{
	private $table = 'tbl_whatsnew_product';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
    function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('id','desc');
               return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_whats_new_prod_list($limit = 8, $offset = 0)
	{
		$curdate = date("Y-m-d");
		$this->db->order_by('id','desc');
		$this->db->where('enddate >=', $curdate);
        return $this->db->get($this->table, $limit, $offset);
	}
	
        function get_all_product_list($limit = 8, $offset = 0)
	{
	       $this->db->order_by('id','asc');
               return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_prod_list_by_manf_id($id)
	{
		$this->db->order_by('id','asc');
		$this->db->where('manufacture_id', $id);
        return $this->db->get($this->table);
	}
        
    function count_all()
	{
		$this->db->order_by('id','desc');
        return $this->db->count_all($this->table);
	}
     
	function get_by_id($pid)
	{
		$this->db->where('id', $pid);
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
		
		$this->db->where('wts_new', $id);
		$this->db->delete('tbl_inquiry');				
	}
	
	function get_user_role_list()
	{
		$this->db->order_by('id','asc');
		return $this->db->get("tbl_roles");
	}
        function get_categories_list()
	{
		$this->db->order_by('cid','desc');	
		return $this->db->get("tbl_categories");
	}
        
        function get_user_by_id($id)
        {
                $this->db->where('id', $id);
                return $this->db->get("tbl_users");
        }
        function changestatus($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}  
        function get_user_list()
	{
		$this->db->where('role', "Manufacture");
		$this->db->order_by('id','asc');
		return $this->db->get("tbl_users");
	}
	 function get_by_manufacture_id($id)
	{
        $this->db->order_by('manufacture_id','asc');
		$this->db->where('manufacture_id', $id);
		return $this->db->get($this->table);
	}
	function count_all_by_manufacture_id()
	{
		$this->db->order_by('manufacture_id','asc');
        return $this->db->count_all($this->table);
	}
	 /*image save and delete function */
         function save_image($data)
	{
		$this->db->insert('whatsnew_img', $data);
		return $this->db->insert_id();
	}
        function delete_image($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('whatsnew_img');			
	}
           function get_whatsnew_images_list($pid)
	{
		$this->db->order_by('id','asc');
		$this->db->where('pid', $pid);
		return $this->db->get('whatsnew_img');
	}
}
?>