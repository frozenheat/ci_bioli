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
	
	function id_otoritas($otoritas)
	{
	$this->db->select('id_otoritas');
	$this->db->from('otoritas');
	$this->db->where('nama_otoritas',$otoritas);
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
	function input_pegawai($insert)
	{
	$this->db->insert('pegawai',$insert);
	}

}
?>