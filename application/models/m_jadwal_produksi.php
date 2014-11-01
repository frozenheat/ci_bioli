<?php

	class m_jadwal_produksi extends CI_Model
	{
	
		
		
		function pilih_lot_size_dan_waktu_produksi_dari_pesanan_belum_konfirm()
		{
			$this->db->select('nama_barang');
			$this->db->from('pesanan_barang');
			$this->db->where('status_pesanan','belum_konfirmasi');
			$this->db->group_by('nama_barang');
			$query = $this->db->get();
			$a =0;
			//penghitungan jumlah row yang dihasilkan dari data barang yang belum konfirmasi
			$query2['jumlah_row'] = $query->num_rows();
			//end
			foreach ($query->result() as $row)
			{
				$this->db->select('nm_brng, lot_size, wkt_prdksi');
				$this->db->from('barang');
				$this->db->where('nm_brng',$row->nama_barang);
				$query2[$a]= $this->db->get();
				$a++;
			}
			return $query2;
		}
		
		function penjumlahan_pesanan($nama_barang)
		{
			$this->db->select('nama_barang, sum(jumlah_pesanan) as total_pesanan');
			$this->db->from('pesanan_barang');
			$this->db->where('nama_barang',$nama_barang);
			$this->db->where('status_pesanan','belum_konfirmasi');
			$query = $this->db->get();
			if ($query->num_rows()>0)
			{
				return $query->result();
			}
		}
		
	}
	
?>