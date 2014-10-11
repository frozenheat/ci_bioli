<?php

	class m_login extends CI_Model
	{
		function login($username,$password)
		{
			$this->db->select('id_pgw, password, nm_pgw, otoritas');
			$this->db->from('pegawai');
			$this->db->where('id_pgw',$username);
			$this->db->where('password',$password);
			$query= $this->db->get();
		
		if($query->num_rows()== 1)
		{
			return $query ->result();
		}
		else
		{
			return false;
		}
		}
		
	
	}
?>