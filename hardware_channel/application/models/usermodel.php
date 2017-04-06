<?php
Class UserModel extends CI_Model
{
	
	private $table = 'tbl_inquiry';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('id','desc');
		return $this->db->get($this->table, $limit, $offset);
	}
	function get_user_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('tbl_users.id','desc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_inquiry.mid');
		$this->db->group_by('tbl_inquiry.mid');
        return $this->db->get($this->table, $limit, $offset);
		
	}
	function count_all()
	{
		$this->db->order_by('id','desc');
		return $this->db->count_all($this->table);
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
		$this->db->order_by('id','asc');
		return $this->db->get("tbl_roles");
	}
	function get_user_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_users");
	}
	function get_user_by_pid($id)
	{
		$this->db->where('pid', $id);	
		return $this->db->get("tbl_product");
	}
	
	function get_search_user_list($limit = 8, $offset = 0, $val)
	{	
		
		$this->db->order_by('tbl_users.id','desc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_inquiry.mid');
	    $this->db->like('tbl_users.company_name', $val);
	    return $this->db->get($this->table, $limit, $offset);
		
		
	}
	function count_search_user_all($val)
	{
		
			$this->db->order_by('tbl_users.id','desc');
			$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_inquiry.mid');
		$this->db->like('tbl_users.company_name', $val);
			return $this->db->count_all_results($this->table);
	}	
    function get_search_list($limit = 8, $offset = 0,$val)
	{
		$this->db->order_by('id','asc');
		$this->db->where('name',$val);
        return $this->db->get($this->table, $limit, $offset);
	} 	
	
	function get_user_by_dealerid($did)
	{
		$this->db->select('*');
		$this->db->join('tbl_dealer', 'tbl_dealer.mid = tbl_users.id');
		$this->db->where('tbl_dealer.id', $did);
        return $this->db->get('tbl_users');
	}
	
	function get_user_by_prodid($pid)
	{
		$this->db->select('*');
		$this->db->join('tbl_product', 'tbl_product.manufacture_id = tbl_users.id');
		$this->db->where('tbl_product.pid', $pid);
        return $this->db->get('tbl_users');
	}
	
	function get_user_by_whtsnwid($wid)
	{
		$this->db->select('*');
		$this->db->join('tbl_whatsnew_product', 'tbl_whatsnew_product.manufacture_id = tbl_users.id');
		$this->db->where('tbl_whatsnew_product.id', $wid);
        return $this->db->get('tbl_users');
	}
}
?>