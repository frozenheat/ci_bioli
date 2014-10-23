<?php

class m_pesanan_barang extends CI_Model
	{
	
	function tampil_pesanan()
	{
	
	$this->db->select('*');
	$this->db->from('pesanan_barang');
	$query=$this->db->get();
	
	if($query->num_rows()>0)
	{
	
	return $query->result();
	
	}
	else
	{
	return false;
	}
	}
	
	
	function nama_barang()
	{
		$this->db->select('nm_brng');
		$this->db->from('barang');
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
	
	
	
}
	
	
	

?>