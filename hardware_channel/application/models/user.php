<?php
Class User extends CI_Model
{
	function login($email,$password)
	{
		$this -> db -> select('id,email,password,role,first_name,last_name,birthdate,contact');
		$this -> db -> from('tbl_users');
		$this -> db -> where('email = '."'".mysql_real_escape_string($email)."'");
		$this -> db -> where('password = '."'".mysql_real_escape_string($password) ."'");
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		
		//$this->db->_compile_select();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	function check_oldpassword($email,$password)
	{
		$this->db->where('email', mysql_real_escape_string($email));
		$this->db->where('password', mysql_real_escape_string($password));
		$this->db->from('tbl_users');
		
		$query = $this -> db -> get();
			
		if($query -> num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function updatepassword($email,$oldpassword,$data)
	{
		$this->db->where('email', $email);
		$this->db->where('password', mysql_real_escape_string($oldpassword));
		$this->db->update('tbl_users', $data);
	}
	
	function update_password($id, $newpass)
	{
		$this->db->where('id', $id);
		$this->db->where('role', 'Admin');
		$this->db->update('tbl_users', $newpass);
	}
	
	function updatepass($id, $pass)
	{
		
		$this->db->where('id', $id);
		$this->db->update('tbl_users', $pass);
	}
	
	function login_member($email,$password)
	{
		$this -> db -> select('id,role,password,email,first_name,last_name,company_name,profile_img,brochar_img,birthdate,contact,status');
		$this -> db -> from('tbl_users');
		$this -> db -> where('email = '."'".mysql_real_escape_string($email)."'");
		$this -> db -> where('password = '."'".mysql_real_escape_string($password) ."'");
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		
		//$this->db->_compile_select();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	function check_email($email)
	{
		$this -> db -> select('id,email,first_name,last_name');
		$this -> db -> from('tbl_users');
		$this -> db -> where('email = '."'".mysql_real_escape_string($email)."'");
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		
		//$this->db->_compile_select();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	
	
	
}
?>