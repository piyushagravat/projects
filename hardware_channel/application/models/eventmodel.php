<?php
Class EventModel extends CI_Model
{
	
	private $table = 'tbl_event';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('id','asc');
		return $this->db->get($this->table, $limit, $offset);
	}
	function count_all()
	{
		$this->db->order_by('id','desc');
		return $this->db->count_all($this->table);
	}
	function get_by_id($eid)
	{
		$this->db->where('id', $eid);
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
	
	
	function get_images_list($id)
	{
		$this->db->order_by('id','asc');
		$this->db->where('eid', $id);
		return $this->db->get('tbl_event_photos');
	}
	
	function get_image_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_event_photos");
	}	
	function save_image($data)
	{
		$this->db->insert('tbl_event_photos', $data);
		return $this->db->insert_id();
	}			
	function update_image($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_event_photos', $data);
	}		
	function delete_image($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_event_photos');			
	}
	
	
}
?>