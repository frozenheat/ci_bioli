<?php

	class m_login extends CI_Model
	{
		function login($username,$password)
		{
			$this->db->select('id_pgw, password, nm_pgw, otoritas , image_path');
			$this->db->from('pegawai');
			$this->db->where('id_pgw',$username);
			$this->db->where('password',$password);
			$query= $this->db->get();
		$result = array();
	
		if($query->num_rows()== 1)
		{
			$result['database']='1';
			$result['query']=$query->result();
			return $result;
		}
		else
		{
			$this->db->select('id_pln, password, nm_pln');
			$this->db->from('pelanggan');
			$this->db->where('id_pln',$username);
			$this->db->where('password',$password);
			$query= $this->db->get();
			
			if($query->num_rows()== 1)
		{
			$result['database']='2';
			$result['query']=$query->result();
			return $result;
		}
		else
		{
			return false;
		}
		
		}
		}
		
	
	}
?>