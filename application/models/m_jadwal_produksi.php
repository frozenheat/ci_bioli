<?php

	class m_jadwal_produksi extends CI_Model
	{
	
		
		function tampil_jadwal_produksi()
		{
			$this->db->select('*');
			$this->db->from('jadwal_prdksi');
			$this->db->where('status','utama');
			$this->db->or_where('status','lanjutan');
			$this->db->order_by('waktu_mulai','asc');
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
		}
		
		function pilih_lot_size_dan_waktu_produksi_dari_pesanan_belum_konfirm()
		{
			$this->db->select('nama_barang');
			$this->db->from('pesanan_barang');
			$this->db->where('sts_konfirm','belum_konfirmasi');
			$this->db->where('status_pesanan','belum_diproses');
			$this->db->where('perkiraan_waktu_selesai','0000-00-00 00:00:00');
			$this->db->group_by('nama_barang');
			$query = $this->db->get();
			$a =0;
			//penghitungan jumlah row yang dihasilkan dari data barang yang belum konfirmasi
			$query2['jumlah_row'] = $query->num_rows();
			//end
			foreach ($query->result() as $row)
			{
				$this->db->select('*');
				$this->db->from('barang');
				$this->db->where('nm_brng',$row->nama_barang);
				$query2[$a]= $this->db->get();
				$a++;
			}
			return $query2;
		}
		
		
		function pilih_lot_size_dan_waktu_produksi_dari_pesanan_telah_konfirm()
		{
			$this->db->select('nama_barang');
			$this->db->from('pesanan_barang');
			$this->db->where('sts_konfirm','pesan');
			$this->db->where('status_pesanan !=','belum_diproses');
			$this->db->group_by('nama_barang');
			$query = $this->db->get();
			$a =0;
			//penghitungan jumlah row yang dihasilkan dari data barang yang belum konfirmasi
			$query2['jumlah_row'] = $query->num_rows();
			//end
			foreach ($query->result() as $row)
			{
				$this->db->select('*');
				$this->db->from('barang');
				$this->db->where('nm_brng',$row->nama_barang);
				$query2[$a]= $this->db->get();
				$a++;
			}
			return $query2;
		}
		
		
		function pilih_lot_size_dari_pesanan_telah_dijadwalkan($nama_barang)
		{
			
			$this->db->select('lot_size');
			$this->db->from('barang');
			$this->db->where('nm_brng',$nama_barang);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
			return false;
			}
			
		}
		
		
		
		
		
		function penjumlahan_pesanan($nama_barang)
		{
			$this->db->select('sum(jumlah_pesanan) as total_pesanan');
			$this->db->from('pesanan_barang');
			$this->db->where('nama_barang',$nama_barang);
			$this->db->where('sts_konfirm','belum_konfirmasi');
			$this->db->where('status_pesanan','belum_diproses');
			$query = $this->db->get();
			if ($query->num_rows()>0)
			{
				return $query->result();
			}
		}
		
		function penjumlahan_pesanan_utama($nama_barang)
		{
			$this->db->select('sum(jumlah_pesanan) as total_pesanan');
			$this->db->from('pesanan_barang');
			$this->db->where('nama_barang',$nama_barang);
			$this->db->where('sts_konfirm ','pesan');
			$this->db->where('status_pesanan !=','dalam_penjadwalan');
			$query = $this->db->get();
			if ($query->num_rows()>0)
			{
				return $query->result();
			}
		}
		function penjumlahan_pesanan_utama_after($nama_barang)
		{
			$this->db->select('sum(jumlah_pesanan) as total_pesanan');
			$this->db->from('pesanan_barang');
			$this->db->where('nama_barang',$nama_barang);
			$this->db->where('sts_konfirm ','pesan');
			$this->db->where('status_pesanan','dalam_penjadwalan');
			$this->db->where('penghitungan_stock','');
			$query = $this->db->get();
			if ($query->num_rows()>0)
			{
				return $query->result();
			}
		}
		
		function input_penjadwalan($insert)
		{
			$this->db->insert('jadwal_prdksi',$insert);
		}
		
		function urutan_waktu_proses($waktu_jdwl)
		{
			$this->db->select('*');
			$this->db->from('jadwal_prdksi');
			$this->db->where('waktu_jdwl',$waktu_jdwl);
			$this->db->order_by('wkt_prdksi','asc');
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
		
		function pengecekan_jam_selesai($wkt_jdwl)
		{
			$this->db->select('waktu_jdwl');
			$this->db->from('jadwal_prdksi');
			$this->db->where('waktu_jdwl <',$wkt_jdwl);
			$this->db->order_by('waktu_jdwl','asc');
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$waktu_jadwal = $row->waktu_jdwl;
				}
				$this->db->select('*');
				$this->db->from('jadwal_prdksi');
				$this->db->where('waktu_jdwl',$waktu_jadwal);
				$this->db->order_by('waktu_selesai','asc');
				$query = $this->db->get();
				
				return $query ->result();
			}
			else
			{
			return false;
			}
		}
		
		function update_waktu_mulai($update_waktu_mulai_produksi, $id_prdksi)
		{
			$this->db->where('id_prdksi',$id_prdksi);
			$this->db->update('jadwal_prdksi',$update_waktu_mulai_produksi);
		}
		
		function update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi)
		{
			$this->db->where('id_prdksi',$id_prdksi);
			$this->db->update('jadwal_prdksi',$update_waktu_selesai_produksi);
		}
	
	
	
		
		function hapus_jadwal_sementara()
		{
			$this->db->where('status','sementara');
			$this->db->delete('jadwal_prdksi');
		}
		
		function pemenuhan_jadwal($id_produksi)
		{
			$update = array(
			'status' => 'terpenuhi'
			);
			
			$this->db->where('id_prdksi',$id_produksi);
			$this->db->update('jadwal_prdksi',$update);
			
			$this->db->select('nm_brng, waktu_jdwl');
			$this->db->from('jadwal_prdksi');
			$this->db->where('id_prdksi',$id_produksi);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
			
			foreach ($query->result() as $row)
			{
				$nama_barang = $row->nm_brng;
				$waktu_jdwl = $row->waktu_jdwl;
			}
			
			$this->db->where('nm_brng',$nama_barang);
			$this->db->where('waktu_jdwl',$waktu_jdwl);
			$this->db->where('status','lanjutan');
			$this->db->update('jadwal_prdksi',$update);
			}
			else
			{
			return false;
			}
		}
	}
	
?>