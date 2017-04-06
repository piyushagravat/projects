<?php
Class PageModel extends CI_Model
{
	private $table = 'tbl_pages';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	
	function get_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}	
	function saveaboutus($data)
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
	
	
	
	
}
?>