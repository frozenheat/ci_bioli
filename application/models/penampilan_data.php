<?php
	
	class penampilan_data extends CI_Model{
	
		function pegawai($username,$password)
		{
			$this->db->select('nm_pgw, password');
			$this->db->from('pegawai');
			$this->db->where('id_pgw',$username);
			$this->db->where('password',$password);
			$query=$this->db->get();

			$result=array();
			$result['database']=1;
			$result['query']=$query->result();
			if($query->num_row=1)
			{
				return $result;
			}
			else
			{
			return false;
			}
		
		}
	
	}



?>