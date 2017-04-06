<?php
Class ReportsModel extends CI_Model
{
	
	private $table = 'tbl_users';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list()
	{
		$this->db->order_by('id','desc');
                $this->db->where('status','Active');
                $this->db->where('role','Manufacture');
		return $this->db->get($this->table);
	}
	function count_all($id)
	{
		$this->db->where('aid', $id);
		$this->db->order_by('id','desc');
		return $this->db->count_all_results($this->table);
	}
	
	
	function get_chart_data($start,$end,$id)
	{
           $q = "SELECT tbl_users.id, tbl_users.first_name, tbl_users.last_name, tbl_users.role, tbl_users.company_name, tbl_users.status, tbl_inquiry. * FROM tbl_users LEFT JOIN tbl_inquiry ON tbl_inquiry.mid = tbl_users.id WHERE tbl_users.status = 'Active' AND tbl_users.role = 'Manufacture' AND tbl_inquiry.inquirydate BETWEEN '".$start."' AND '".$end."' AND tbl_users.id = '".$id."' order by inquirydate desc";
             //SELECT tbl_users.*, count(tbl_inquiry.mid) as INQUIRES FROM tbl_users LEFT JOIN tbl_inquiry ON tbl_inquiry.mid = tbl_users.id WHERE tbl_users.status = 'Active' AND tbl_users.role = 'Manufacture' AND tbl_inquiry.inquirydate BETWEEN '2015-12-12' AND '2015-12-12'  GROUP BY tbl_users.id
		$sql = $this->db->query($q);
		return $sql->result();
	}
	function get_ads_list()
	{
		$this->db->order_by('aid','desc');
        $this->db->where('status','Enable');
        return $this->db->get("tbl_ads");
	}
	function get_whatsnew_list()
	{
		$this->db->order_by('id','desc');
        $this->db->where('status','Enable');
        return $this->db->get("tbl_whatsnew_product");
	}
	function get_ads_data($start,$end,$id)
	{			
			
			$q = "SELECT * FROM tbl_ads LEFT JOIN tbl_inquiry ON tbl_inquiry.aid = tbl_ads.aid WHERE tbl_ads.status = 'Enable' AND tbl_inquiry.inquirydate BETWEEN '".$start."'  AND '".$end."' AND tbl_ads.aid = '".$id."' order by inquirydate desc";	
			$sql = $this->db->query($q);
			return $sql->result();
				
		
	}
	function get_wtsnew_data($start,$end,$id)
	{
           	$q = "SELECT * FROM tbl_whatsnew_product LEFT JOIN tbl_inquiry ON tbl_inquiry.wts_new = tbl_whatsnew_product.id WHERE tbl_whatsnew_product.status = 'Enable' AND tbl_inquiry.inquirydate BETWEEN '".$start."' AND '".$end."' AND tbl_whatsnew_product.id = '".$id."' order by inquirydate desc";
            //SELECT tbl_whatsnew_product.*, count(tbl_inquiry.wts_new) as INQUIRES FROM tbl_whatsnew_product LEFT JOIN tbl_inquiry ON tbl_inquiry.wts_new = tbl_whatsnew_product.id WHERE tbl_whatsnew_product.status = 'Enable' AND tbl_inquiry.inquirydate BETWEEN '2015-12-12' AND '2016-01-19' AND tbl_whatsnew_product.id = '3' GROUP BY tbl_whatsnew_product.id
			 
		$sql = $this->db->query($q);
		return $sql->result();
	}
}
?>