<?php

class m_pesanan_barang extends CI_Model
	{
	
	function tampil_pesanan()
	{
	
	$this->db->select('*');
	$this->db->from('pesanan_barang');
	$this->db->order_by('tanggal_pemesanan','asc');
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
		$this->db->where('sts_konfirm','belum_konfirmasi');
		}
		else if($status == 'telah')
		{
		$this->db->where('sts_konfirm !=','belum_konfirmasi');
		}
		else if($status == 'terpenuhi')
		{
		$this->db->where('status_pesanan','terpenuhi');
		}
		$this->db->order_by('tanggal_pemesanan','asc');
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
	
	function update_perkiraan_waktu_selesai_sementara($nama_barang, $update2)
	{
		$this->db->where('nama_barang', $nama_barang);
		$this->db->where('status_pesanan', 'belum_diproses');
		$this->db->where('sts_konfirm','belum_konfirmasi');
		$this->db->update('pesanan_barang', $update2);
	}
	
	function update_perkiraan_waktu_selesai_utama($nama_barang, $update2)
	{
		$this->db->where('nama_barang', $nama_barang);
		$this->db->where('status_pesanan', 'dalam_proses');
		$this->db->where('sts_konfirm','pesan');
		$this->db->update('pesanan_barang', $update2);
	}
	
	function konfirmasi_barang($hasil_konfirm, $id_pesanan, $id_pemesan, $nama_barang, $update)
	{
		if($hasil_konfirm =='pesan')
		{
			$this->db->where('id_pesanan',$id_pesanan);
			$this->db->where('id_pemesan',$id_pemesan);
			$this->db->where('nama_barang',$nama_barang);
			$this->db->update('pesanan_barang',$update);
		}
		else if($hasil_konfirm == 'batal')
		{
			$this->db->where('id_pesanan',$id_pesanan);
			$this->db->delete('pesanan_barang');
		}
	}
	
	function pilih_pesanan_belum_dijadwalkan_sementara()
	{
		$this->db->select('*');
		$this->db->from('pesanan_barang');
		$this->db->where('status_pesanan','belum_diproses');
		$this->db->where('perkiraan_waktu_selesai','0000-00-00 00:00:00');
		$query=$this->db->get();
		
		if($query->num_rows()>0)
			{
			return true;
			}
		else
			{
			return false;
			}
	}
		function pilih_pesanan_belum_dijadwalkan_utama()
	{
		$this->db->select('*');
		$this->db->from('pesanan_barang');
		$this->db->where('status_pesanan','dalam_proses');
		$this->db->where ('sts_konfirm','pesan');
		$query=$this->db->get();
		
		if($query->num_rows()>0)
			{
			return true;
			}
		else
			{
			return false;
			}
	}
	
}
		
	

?>