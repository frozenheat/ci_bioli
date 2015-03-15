<?php
class m_kapasitas extends CI_model
{
				function tampil_kapasitas()
				{
				$this->db->select('*');
				$this->db->from('kapasitas');
				$result = $this->db->get();
				if ($result->num_rows() > 0 )
				{
				$a=0;
				foreach($result->result() as $row )
				{
				$this->db->select('nm_brng');
				$this->db->from('barang');
				$this->db->where('id_brng', $row->id_barang);
				$query = $this->db->get();
					foreach($query->result() as $row2)
					{
						$nama_barang[$a] = $row2->nm_brng;
					}
				$this->db->select('nm_mesin');
				$this->db->from('mesin');
				$this->db->where('id_mesin', $row->id_mesin);
				$query = $this->db->get();
					foreach($query->result() as $row2)
					{
						$nama_mesin[$a] = $row2->nm_mesin;
					}
				$lot_size[$a] = $row->lot_size;
				$waktu_prdksi[$a] = $row->waktu_prdksi;
				$a++;
				}

				$data['nama_barang'] = $nama_barang;
				$data['nama_mesin'] = $nama_mesin;
				$data['jumlah_row'] = $result->num_rows();
				$data['lot_size'] = $lot_size;
				$data['waktu_prdksi'] = $waktu_prdksi;
				return $data;
				}
				else
				{
				return false;
				}
				}
				
				
				
				
				function pengecekan($id_barang, $id_mesin)
				{
					$this->db->select('*');
					$this->db->from('kapasitas');
					$this->db->where('id_mesin',$id_mesin);
					$this->db->where('id_barang',$id_barang);
					$query = $this->db->get();
					if($query->num_rows() > 0)
					{
					return true;
					}
					else
					{
					return false;
					}
					
				}
				
				
				function input_data($insert)
				{
					$this->db->insert('kapasitas',$insert);
				
				}
				
				function update_data($id_barang, $id_mesin, $update)
				{
					$this->db->where('id_mesin', $id_mesin);
					$this->db->where('id_barang', $id_barang);
					$this->db->update('kapasitas',$update);
				
				}
				
				function update_barang($id_barang, $jenis_mesin)
				{
					$this->db->select('sum(lot_size) as lot_size, sum(waktu_prdksi) as waktu_prdksi');
					$this->db->from('kapasitas');
					$this->db->join('mesin','kapasitas.id_mesin = mesin.id_mesin');
					$this->db->where('id_barang',$id_barang);
					$this->db->where('jenis_mesin',$jenis_mesin);
					$query = $this->db->get();
					
					foreach($query->result() as $row)
					{
						$total_lot = $row->lot_size;
						$total_waktu = $row->waktu_prdksi;
					}
					
					if($jenis_mesin == 'cetak')
					{
						$update = array(
							'lot_size_cetak' => $total_lot,
							'wkt_prdksi_cetak' =>$total_waktu
						);
					$this->db->where('id_brng',$id_barang);
					$this->db->update('barang',$update);
					}
					elseif($jenis_mesin == 'bubut')
					{
						$update = array(
							'lot_size_bubut' => $total_lot,
							'wkt_prdksi_bubut' =>$total_waktu
						);
					$this->db->where('id_brng',$id_barang);
					$this->db->update('barang',$update);
					}
					elseif($jenis_mesin == 'milling')
					{
					$update = array(
							'lot_size_milling' => $total_lot,
							'wkt_prdksi_milling' =>$total_waktu
						);
					$this->db->where('id_brng',$id_barang);
					$this->db->update('barang',$update);
					}
					
				}
				
			
}