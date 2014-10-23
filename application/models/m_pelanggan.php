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
	
	
	function select_password($id_pelanggan)
	{
		$this->db->select('password');
		$this->db->from('pelanggan');
		$this->db->where('id_pln',$id_pelanggan);
		$query = $this->db->get();
		
		if ($query->num_rows()>0)
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
	
	function delete_pelanggan($delete)
	{
		$this->db->delete('pelanggan',$delete);
	}
	
	
	function ubah_pelanggan($ubah, $id_pelanggan)
	{
		$this->db->where('id_pln',$id_pelanggan);
		$this->db->update('pelanggan',$ubah);
	}
	
}
?>