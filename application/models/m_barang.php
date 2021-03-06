<?php
class m_barang extends CI_Model{

	function tampil_barang()
	{
	$this->db->select('*');
	$this->db->from('barang');
	$query = $this->db->get();
	
	$result=array();
	if ($query->num_rows() > 0)
	{
	$result = $query->result();
	return $result;
	}
	else
	{
	return false;
	}
	}
	
	
	function jenis_barang()
	{
	$this->db->select('*');
	$this->db->from('jenis_barang');
	$query = $this->db->get();
	
	if($query->num_rows() > 0)
	{
		return $query->result();
	}
	else
	{
	return false;
	}
	}
	
	
	function pencarian_jenis_barang($jenis)
	{
	$this->db->select('id_jns_brng');
	$this->db->from('jenis_barang');
	$this->db->where('nm_jns_brng',$jenis);
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
	
	function input_master_barang($insert)
	{
		$this->db->insert('barang',$insert);
	}
	
	function delete_master_barang($delete)
	{
		
		$this->db->delete('barang',$delete);
		
	}
	
	function ubah_master_barang($ubah, $id_barang)
	{
		$this->db->where('id_brng',$id_barang);
		$this->db->update('barang',$ubah);
	}
	
	function input_jenis_barang($insert)
	{	
		$this->db->insert('jenis_barang',$insert);
	}
	
	function pencarian_id_barang($nama_barang)
	{
		$this->db->select('id_brng');
		$this->db->from('barang');
		$this->db->where('nm_brng',$nama_barang);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
		foreach ($query->result() as $row)
		{
			$id_barang = $row->id_brng;
		}
		return $id_barang;
		}
		else
		{
			return false;
		}
	}
	function pencarian_nama_barang($id_barang)
	{
		$this->db->select('nm_brng');
		$this->db->from('barang');
		$this->db->where('id_brng',$id_barang);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
		foreach ($query->result() as $row)
		{
			$nama_barang = $row->nm_brng;
		}
		return $nama_barang;
		}
		else
		{
			return false;
		}
	}
	
	function update_waktu_lot($id_barang, $update){
		
		$this->db->where('id_brng',$id_barang);
		$this->db->update('barang',$update);
		
	}

	
}
?>