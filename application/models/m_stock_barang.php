<?php
	class m_stock_barang extends CI_Model
	{
			function tampil_stock_barang()
			{
				$this->db->select('*');
				$this->db->from('stock_barang');
				$this->db->join('barang','barang.id_brng = stock_barang.id_brng');
				$this->db->where('status','terbaru');
				$query=$this->db->get();
				
				if($query->num_rows()>0 )
				{
				return $query->result();
				}
				else
				{
					return false;
				}
				
			}
			
			function cek_stock_awal($nama_barang)
			{
				$this->db->select('id_brng');
				$this->db->from('barang');
				$this->db->where('nm_brng',$nama_barang);
				$query = $this->db->get();
				
				foreach ($query->result() as $row)
				{
					$id_barang = $row->id_brng;
				}
				
				$this->db->select('*');
				$this->db->from('stock_barang');
				$this->db->where('id_brng',$id_barang);
				$this->db->where('status','terbaru');
				$query = $this->db->get();
				
				if ($query->num_rows() > 0 )
				{
					return $query->result();
				}
				else
				{
					return false;
				}
			}
			
			function cek_nama_barang($nama_barang)
			{
				$this->db->select('id_brng');
				$this->db->from('barang');
				$this->db->where('nm_brng',$nama_barang);
				$query = $this->db->get();
				
				if ($query->num_rows() > 0 )
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
			
			
			function total_pesanan_belum_konfirmasi($nama_barang)
		{
			$this->db->select('sum(jumlah_pesanan)');
			$this->db->from('pesanan_barang');
			$this->db->where('nama_barang',$nama_barang);
			$query = $this->db->get();
			if ($query->num_rows() >0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
		}
		
		
		function input_stock($waktu, $id_barang, $jumlah_stock, $status)
		{
			$insert = array
			(
				'tgl_stock' => $waktu,
				'id_brng' => $id_barang,
				'jml_stock' => $jumlah_stock,
				'status' => $status
			);
			
			$this->db->insert('stock_barang',$insert);
		}
		
		function update_stock($update, $id_barang)
		{
			$this->db->where('id_brng',$id_barang);
			$this->db->where('status', 'terbaru');
			$this->db->update('stock_barang',$update);
			
		}
		
		function insert_new_stock($id_barang, $tanggal_lama , $tanggal_baru , $sisa_stock)
		{
		
		if ($tanggal_lama == $tanggal_baru)
		{
			$update = array(
				'jml_stock' => $sisa_stock
			);
			
			$this->db->where('id_brng', $id_barang);
			$this->db->where('status', 'terbaru');
			$this->db->where('tgl_stock', $tanggal_baru);
			$this->db->update('stock_barang', $update);
			
		}
		else
		{
			$update = array(
				'status' => 'lama'
			);
			
			$this->db->where('id_brng',$id_barang);
			$this->db->where('tgl_stock',$tanggal_lama);
			$this->db->update('stock_barang',$update);
			
			$insert = array(
			
				'tgl_stock' => $tanggal_baru,
				'id_brng' => $id_barang,
				'jml_stock' => $sisa_stock,
				'status' => 'terbaru'
			
			);
			
			$this->db->insert('stock_barang',$insert);
			
			return $tanggal_baru;
			
		}
			
			
			
		}
		
		
	}

?>