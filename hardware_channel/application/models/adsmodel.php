<?php
Class AdsModel extends CI_Model
{
	
	private $table = 'tbl_ads';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 20, $offset = 0)
	{
		$this->db->order_by('aid','asc');
		$this->db->select('*, DATEDIFF(`enddate`,CURDATE()) AS DiffDate');
		return $this->db->get($this->table, $limit, $offset);
		
	}
	function count_all()
	{
		$this->db->select('*, DATEDIFF(`enddate`,CURDATE()) AS DiffDate');
		return $this->db->count_all_results($this->table);
	}
	
	function get_paged_list_client($limit = 10, $offset = 0, $id)
	{
		$this->db->where('clientid', $id);
		$this->db->order_by('aid','asc');
		return $this->db->get($this->table, $limit, $offset);
	}
	function count_all_client($id)
	{
		$this->db->where('clientid', $id);
		$this->db->order_by('aid','asc');
		return $this->db->count_all_results($this->table);
	}
	
	function count_all_ads_clicks($id)
	{
		$this->db->where('aid', $id);
		$this->db->order_by('aid','asc');
		return $this->db->count_all_results("ads_reports");
	}
	
	function get_client_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_users");
	}	
	
	function get_by_id($aid)
	{
		$this->db->where('aid', $aid);
		return $this->db->get($this->table);
	}	
	function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}			
	function update($aid, $data)
	{
		$this->db->where('aid', $aid);
		$this->db->update($this->table, $data);
	}		
	function delete($aid)
	{
		$this->db->where('aid', $aid);
		$this->db->delete($this->table);			
	}
	
	function changestatus($id, $data)
	{
		$this->db->where('aid', $id);
		$this->db->update($this->table, $data);
	}
	function get_user_list()
	{
		$this->db->order_by('company_name','asc');
		$this->db->where('role', "Manufacture");
		$this->db->where('status', "Active");
		$this->db->or_where('status', "Inactive");
		$this->db->where('phase', "new_signup");
		return $this->db->get("tbl_users");
	}
	function get_user_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_users");
	}	
	
	function get_all_ads_list()
	{
		$this->db->order_by('aid','asc');
		return $this->db->get("tbl_ads");
	}
	function get_all_ads_list_by_client_id($id)
	{
		$this->db->where('clientid', $id);
		$this->db->order_by('aid','asc');
		return $this->db->get("tbl_ads");
	}
	
	
	public function date_verification()
	{
			$this->db->order_by('aid','asc');
			$where = "enddate > DATE_SUB( NOW( ) , INTERVAL 7 DAY )";
			$this->db->where($where);
		//	$this->db->where('clientid', $id);
			return $this->db->get($this->table);
	}
		public function enddate($id)
	{
		$curdate = date("Y-m-d");
		$this->db->where('enddate >=', $curdate);
		$this->db->where('clientid', $id);
		return $this->db->get($this->table);
	}
	

	function get_ads_list_with_date()
	{
		$curdate = date("Y-m-d");
		$this->db->where('enddate >=', $curdate);
		$this->db->where('status', 'Enable');
		$this->db->order_by('aid','desc');
		return $this->db->get($this->table);
	}		
	
}
?>