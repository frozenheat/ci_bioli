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
	
	
	function pilih_status($status)
	{
		
		$this->db->select('*');
		$this->db->from('pesanan_barang');
		
		if ($status == 'belum')
		{
		$this->db->where('status_pesanan','belum_konfirmasi');
		}
		else if($status == 'telah')
		{
		$this->db->where('status_pesanan','telah_konfirmasi');
		}
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
	
	function pilih_jenis_barang($nama_barang)
	{
		$this->db->select('nm_jns_brng');
		$this->db->from('barang');
		$this->db->where('nm_brng',$nama_barang);
		$query=$this->db->get();
		
		if ($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	function input_pesanan($insert)
	{
		$this->db->insert('pesanan_barang',$insert);
	}
}
	
	
	

?>