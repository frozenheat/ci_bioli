<?php
class m_pegawai extends CI_Model{

	function tampil_pegawai()
	{
	$this->db->select('*');
	$this->db->from('pegawai');
	$query = $this->db->get();
	
	$result=array();
	if ($query->num_rows() >0)
	{
	$result=$query->result();
	return $result;
	}
	else
	{
	return false;
	}
	}

}
?>