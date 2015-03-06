<?php
class m_mesin extends CI_Model{

function __construct(){
	
	parent::__construct();
	$this->load->dbforge();
	}

	
	function tampil_mesin(){
	$this->db->select('*');
	$this->db->from('mesin');
	$this->db->order_by('urutan','ASC');
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
	
	function get_column_name()
	{
		$fields = $this->db->list_fields('mesin');
		return $fields;
	}
	
	function add_column($alter){
	
		$this->dbforge->add_column('mesin', $alter);
	
	}
	function delete_column($alter){
		
		$this->dbforge->drop_column('mesin', $alter);
	
	}
	
	function jenis_mesin(){
		
		$this->db->select('jenis_mesin');
		$this->db->from('mesin');
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
	
	function input_mesin($insert){
	
		$this->db->insert('mesin',$insert);
	
	}
	function urutan_mesin()
	{
		$this->db->select('urutan');
		$this->db->from('mesin');
		$this->db->order_by('urutan','ASC');
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
	
	function penghitungan_mesin()
	{
		$this->db->select('jenis_mesin');
		$this->db->from('mesin');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function update_waktu_lot($jenis_mesin, $update){
	
		$this->db->where('jenis_mesin',$jenis_mesin);
		$this->db->update('mesin',$update);
	
	}
	
	function pencarian_lot_size($nama_barang){
		$this->db->select('jenis_mesin,'.$nama_barang.'_lot_size');
		$this->db->from('mesin');
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
	
	function  input_jadwal($insert){
		
		$this->db->insert('jadwal_mesin',$insert);
	}
	
}
?>