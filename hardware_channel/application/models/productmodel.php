<?php
Class ProductModel extends CI_Model
{
	private $table = 'tbl_product';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','desc');
               return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_paged_list_api($limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','asc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		$this->db->where('tbl_users.status', 'Active');
        return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_product_search_list_api($cid, $scid, $sccid, $limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','asc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		$this->db->where('tbl_users.status', 'Active');
		$this->db->where('tbl_product.cid', $cid);
		$this->db->where('tbl_product.subcat_id	', $scid);
		$this->db->where('tbl_product.sscat_id', $sccid);
        return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_product_details_by_id($pid)
	{
		$this->db->order_by('pid','asc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		/*$this->db->join('tbl_categories', 'tbl_categories.cid = tbl_product.cid');
		$this->db->join('tbl_subcategories', 'tbl_subcategories.subcat_id = tbl_product.subcat_id');
		$this->db->join('tbl_sub_subcategories', 'tbl_sub_subcategories.sscat_id = tbl_product.sscat_id');*/
		$this->db->where('tbl_product.pid', $pid);
		/*$this->db->where('tbl_product.cid', $cid);
		$this->db->where('tbl_product.subcat_id	', $scid);
		$this->db->where('tbl_product.sscat_id', $sccid);*/
        return $this->db->get($this->table);
	}
	
	function get_cat_by_id($id)
	{
		$this->db->where('cid', $id);
		return $this->db->get('tbl_categories');
	}
	
	function get_product_list_autosuggest($keyword, $limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','asc');
		$this->db->like('pname', $keyword, 'after');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_product_search_by_nameapi($keyword, $desc, $limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','asc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		$this->db->where('tbl_users.status', 'Active');
		$this->db->like('pname', urldecode($keyword), 'after');
		$this->db->or_like('pdetail', urldecode($keyword));
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_product_search_by_nameapi_list($keyword, $limit = 8, $offset = 0)
	{
		$this->db->order_by('A.pid','asc');
		$this->db->select('*');
		//$this->db->from('tbl_product AS A');
		$this->db->join('tbl_users AS B', 'B.id = A.manufacture_id');		
		$this->db->join('tbl_brand AS C', 'C.id = A.brand_id');
		$this->db->where('B.status', 'Active');
		$this->db->where('B.role', 'Manufacture');
		$this->db->like('A.pname', urldecode($keyword));
		$this->db->or_like('A.pdetail', urldecode($keyword));
		$this->db->or_like('B.company_name', urldecode($keyword));
		$this->db->or_like('C.brandname', urldecode($keyword));
        return $this->db->get('tbl_product AS A', $limit, $offset);
	}
	
	/*function get_product_search_by_nameapi($keyword, $desc, $limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','asc');
		$this->db->like('pname', $keyword, 'after');
		if($desc != "") {
		$this->db->like('pdetail', $desc);
		}
        return $this->db->get($this->table, $limit, $offset);
	}*/
        
        function count_all()
	{
		$this->db->order_by('pid','desc');
                return $this->db->count_all($this->table);
	}
     
	function get_by_id($id)
	{
		$this->db->where('pid', $id);
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
		$this->db->where('pid', $id);
		$this->db->update($this->table, $data);
	}		
	function delete($id)
	{
		$this->db->where('pid', $id);
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
        function get_subcategories_list()
	{
		$this->db->order_by('subcat_name','asc');	
		return $this->db->get("tbl_subcategories");
	}
        
    /*    function get_categories_list_by_id($id)
	{
		$this->db->where('cname', $id);
		return $this->db->get("tbl_categories");
	} */
        function get_subcategories_list_by_id($id)
	{
		$this->db->order_by('subcat_name','asc');
		$this->db->where('subcat_id', $id);	
		return $this->db->get("tbl_subcategories");
	}
        function get_subsubcategories_list_by_id($id)
	{
		$this->db->order_by('ssname','asc');
		$this->db->where('sscat_id', $id);	
		return $this->db->get("tbl_sub_subcategories");
	}
	
	   function get_subsubcategories_list_by_scid($id)
	{
		$this->db->order_by('ssname', 'asc'); 
		$this->db->where('subcat_id', $id);	
		return $this->db->get("tbl_sub_subcategories");
	}
       function getCategories(){
		$this->db->select('cid,cname');
		$this->db->from('tbl_categories');
		$this->db->order_by('cname', 'asc'); 
		$query=$this->db->get();
		return $query; 
	}
	
	function getData($loadType,$loadId){
		if($loadType=="state"){
			$fieldList='subcat_id as id,subcat_name as name';
			$table='tbl_subcategories';
			$fieldName='cid';
			$orderByField='subcat_name';						
		}else{
			$fieldList='sscat_id as id,ssname as name';
			$table='tbl_sub_subcategories';
			$fieldName='subcat_id';
			$orderByField='ssname';	
		}
		
		$this->db->select($fieldList);
		$this->db->from($table);
		$this->db->where($fieldName, $loadId);
		$this->db->order_by($orderByField, 'asc');
		$query=$this->db->get();
		return $query; 
	}				
	function getDatapro($loadType,$loadId){		
		if($loadType=="subcat"){
			$fieldList='subcat_id as id,subcat_name as name';		
			$table='tbl_subcategories';			
			$fieldName='cid';			
			$orderByField='subcat_name';								
		}else{
			$fieldList='sscat_id as id,ssname as name';			
			$table='tbl_sub_subcategories';			
			$fieldName='subcat_id';			
			$orderByField='ssname';			
			}		
			$this->db->select($fieldList);		
			$this->db->from($table);	
			$this->db->where($fieldName, $loadId);		
			$this->db->order_by($orderByField, 'asc');	
			$query=$this->db->get();		
			return $query; 	}
	
	function removeprod($id, $data)
	{
		$this->db->where('pid', $id);
		$this->db->update($this->table, $data);
	}
	
	function get_subcat_by_cid($id)
	{
		$this->db->order_by('subcat_name','asc');
		$this->db->where('cid', $id);	
		return $this->db->get("tbl_subcategories");
	}
        function get_subsubcat_by_scid($cid, $scid)
	{
		$this->db->where('subcat_id', $scid);	
		$this->db->where('cid', $cid);
		return $this->db->get("tbl_sub_subcategories");
	}
        
        function get_product_image_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_product_photos");
        }
        function get_list_by_id($pid)
	{
		$this->db->where('pid', $pid);
		return $this->db->get($this->table);
	}
        function get_product_images_list($id)
	{
		$this->db->order_by('id','asc');
		$this->db->where('pid', $id);
		return $this->db->get('tbl_product_photos');
	}
        function delete_image($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_product_photos');			
	}
	function save_image($data)
	{
		$this->db->insert('tbl_product_photos', $data);
		return $this->db->insert_id();
	}	
	  function changestatus($id, $data)
	{
		$this->db->where('pid', $id);
		$this->db->update($this->table, $data);
	}
	function get_user_by_id($id)
	{
			$this->db->where('id', $id);
			return $this->db->get("tbl_users");
	}
	function get_product_list_by_id($id,$limit = 10, $offset = 0)
	{
		$this->db->where('manufacture_id',$id);
                $this->db->order_by('pid','asc');
                return $this->db->get($this->table, $limit, $offset);
	}
	
	function count_all_prod_list($id)
	{
		$this->db->where('manufacture_id',$id);
                return $this->db->count_all_results($this->table);
	}
    function get_by_manufacture_id($id)
	{
            $this->db->order_by('manufacture_id','asc');
	    $this->db->where('manufacture_id', $id);
            return $this->db->get($this->table);
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
   function getlist(){
	   $this->db->order_by('company_name','asc');
	   $this->db->where('status', "Active");
 	   $this->db->where('role', "Manufacture");
	   $query=$this->db->get("tbl_users");
	   return $query; 
	}
	
	

	
	
  function getBrandData($loadType,$loadId){
		if($loadType=="brand"){
			$fieldList='id as id,brandname as name';
			$table='tbl_brand';
			$fieldName='mid';
			$orderByField='brandname';						
		}else{
			$fieldList='id as id,brandname as name';
			$table='tbl_brand';
			$fieldName='mid';
			$orderByField='brandname';		
		}
		
		$this->db->select($fieldList);
		$this->db->from($table);
		$this->db->where($fieldName, $loadId);
		$this->db->order_by($orderByField, 'asc');
		$query=$this->db->get();
		return $query; 
	}	
	
	
	function get_search_product_list($val)
	{	
			$this->db->order_by('pid','asc');
		   $this->db->like('pname', $val); 
           return $this->db->get($this->table);
		
		
	}
	function count_search_product_all($val)
	{
			$this->db->order_by('pid','asc');
			$this->db->order_by('pid','asc');
			$this->db->like('pname', $val); 
			return $this->db->count_all_results($this->table);
	}	
    function get_search_list($limit = 8, $offset = 0,$val)
	{
		$this->db->order_by('pid','asc');
		$this->db->order_by('pid','asc');
		$this->db->like('pname', $val); 
        return $this->db->get($this->table, $limit, $offset);
	} 	
	
	
	function get_autosuggest_prod_list($keyword, $limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','asc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		$this->db->where('tbl_users.status', 'Active');
		$this->db->like('pname', $keyword, 'after');
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_manf_list_by_cat($cid, $scid, $sccid, $limit = 8, $offset = 0)
	{
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		$this->db->where('tbl_users.status', 'Active');
		$this->db->where('tbl_product.cid', $cid);
		$this->db->where('tbl_product.subcat_id	', $scid);
		$this->db->where('tbl_product.sscat_id', $sccid);
		$this->db->order_by('tbl_users.first_name','asc');
        return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_manf_list_by_cat_subcat($cid, $scid, $limit = 8, $offset = 0)
	{
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		$this->db->where('tbl_users.status', 'Active');
		$this->db->where('tbl_product.cid', $cid);
		$this->db->where('tbl_product.subcat_id	', $scid);
		$this->db->order_by('tbl_users.first_name','asc');
        return $this->db->get($this->table, $limit, $offset);
	}
	
	function get_products_by_cat_subcat($cid, $scid, $limit = 8, $offset = 0)
	{
		$this->db->order_by('pid','asc');
		$this->db->select('*');
		$this->db->join('tbl_users', 'tbl_users.id = tbl_product.manufacture_id');
		$this->db->where('tbl_users.status', 'Active');
		$this->db->where('tbl_product.cid', $cid);
		$this->db->where('tbl_product.subcat_id	', $scid);
        return $this->db->get($this->table, $limit, $offset);
	}
}
?>