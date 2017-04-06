<?php
Class SubscriptionModel extends CI_Model
{
	private $table = 'tbl_subscription';
			
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
	
	function get_daily_sub_by_date()
	{
		$this->db->where('date', date('Y-m-d'));
		return $this->db->get($this->table);
	}

}
?>