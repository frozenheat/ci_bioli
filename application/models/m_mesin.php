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
	
	
	function cari_id_pro_mesin($id_produksi, $jenis_mesin)
	{
	 $this->db->select('id_jadwal_mesin');
	 $this->db->from('jadwal_mesin');
	 $this->db->where('id_prdksi',$id_produksi);
	 $this->db->where('jenis_mesin',$jenis_mesin);
	 $query = $this->db->get();
	 
	 if($query->num_rows() > 0)
	 {
		foreach($query->result() as $row)
		{
			$id_jadwal_mesin = $row->id_jadwal_mesin;
		}
		return $id_jadwal_mesin;
	 }
	 else
	 {
	 return false;
	 }
	}
	
	
	
	
	function pengecekan_jam_selesai_mesin_cetak($wkt_jdwl)
		{
			$this->db->select('waktu_jdwl');
			$this->db->from('jadwal_mesin');
			$this->db->where('waktu_jdwl <',$wkt_jdwl);
			$this->db->where('jenis_mesin','cetak');
			$this->db->order_by('waktu_jdwl','asc');
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$waktu_jadwal = $row->waktu_jdwl;
				}
				$this->db->select('*');
				$this->db->from('jadwal_mesin');
				$this->db->where('waktu_jdwl',$waktu_jadwal);
				$this->db->where('jenis_mesin','cetak');
				$this->db->order_by('waktu_selesai','asc');
				$query = $this->db->get();
				
				return $query ->result();
			}
			else
			{
			return false;
			}
		}
		function pengecekan_jam_selesai_mesin_bubut($wkt_jdwl)
		{
			$this->db->select('waktu_jdwl');
			$this->db->from('jadwal_mesin');
			$this->db->where('waktu_jdwl <',$wkt_jdwl);
			$this->db->where('jenis_mesin','bubut');
			$this->db->order_by('waktu_jdwl','asc');
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$waktu_jadwal = $row->waktu_jdwl;
				}
				$this->db->select('*');
				$this->db->from('jadwal_mesin');
				$this->db->where('waktu_jdwl',$waktu_jadwal);
				$this->db->where('jenis_mesin','bubut');
				$this->db->order_by('waktu_selesai','asc');
				$query = $this->db->get();
				
				return $query ->result();
			}
			else
			{
			return false;
			}
		}
	
	function pengecekan_jam_selesai_mesin_milling($wkt_jdwl)
		{
			$this->db->select('waktu_jdwl');
			$this->db->from('jadwal_mesin');
			$this->db->where('waktu_jdwl <',$wkt_jdwl);
			$this->db->where('jenis_mesin','milling');
			$this->db->order_by('waktu_jdwl','asc');
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$waktu_jadwal = $row->waktu_jdwl;
				}
				$this->db->select('*');
				$this->db->from('jadwal_mesin');
				$this->db->where('waktu_jdwl',$waktu_jadwal);
				$this->db->where('jenis_mesin','milling');
				$this->db->order_by('waktu_selesai','asc');
				$query = $this->db->get();
				
				return $query ->result();
			}
			else
			{
			return false;
			}
		}
	
	function update_waktu_mulai_mesin($update_waktu_mulai, $id_jadwal)
	{
		$this->db->where('id_jadwal_mesin',$id_jadwal);
		$this->db->update('jadwal_mesin',$update_waktu_mulai);
	}
	
	function update_waktu_selesai($update_waktu_selesai, $id_jadwal)
	{
		$this->db->where('id_jadwal_mesin',$id_jadwal);
		$this->db->update('jadwal_mesin',$update_waktu_selesai);
	}
	
	function ambil_data_mesin($id_jadwal)
	{
		$this->db->select('*');
		$this->db->from('jadwal_mesin');
		$this->db->where('id_jadwal_mesin',$id_jadwal);
		$query = $this->db->get();
		
		if($query->num_rows() >0)
		{
			foreach($query->result() as $row)
			{
				$data['waktu_jadwal'] = $row->waktu_jdwl;
				$data['jenis_mesin'] = $row->jenis_mesin;
				$data['waktu_proses'] = $row->waktu_prdksi;
				$data['jumlah_batch'] = $row->jumlah_batch;
			}
			return $data;
		}
		else
		{
			return false;
		}
		
	}
	
	function pengecekan_waktu_selesai($jenis_mesin)
	{
		$this->db->select('*');
		$this->db->from('jadwal_mesin');
		$this->db->where('jenis_mesin',$jenis_mesin);
		$this->db->order_by('waktu_selesai','ASC');
		$query = $this->db->get();
		
		if($query->num_rows())
		{
			foreach($query->result() as $row)
			{
				$waktu_selesai = $row->waktu_selesai;
			}
			return $waktu_selesai;
		}
		else
		{
			return false;
		}
	}
	
	function hapus_jadwal_sementara()
		{
			$this->db->where('status','sementara');
			$this->db->delete('jadwal_mesin');
		}
	
}
?>