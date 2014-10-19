<?php
class m_pelanggan extends CI_Model{
	function tampil_pelanggan()
	{
		$this->db->select('*');
		$this->db->from('pelanggan');
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	function input_pelanggan($insert)
	{
		$this->db->insert('pelanggan',$insert);
		
	}
}
?>