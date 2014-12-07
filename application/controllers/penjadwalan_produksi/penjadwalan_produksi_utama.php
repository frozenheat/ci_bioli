<?php
class penjadwalan_produksi_utama extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_jadwal_produksi');
		$this->load->model('m_waktu');
		$this->load->model('m_acak');
		$this->load->model('m_barang');
		$this->load->model('m_pesanan_barang');
		$this->load->model('m_stock_barang');
	}
	
	function index()
	{
	
	$this->m_jadwal_produksi->hapus_jadwal_sementara();
	
	
	$result = $this->m_pesanan_barang->pilih_pesanan_belum_dijadwalkan_utama();
	
if($result == true)
{

	$time = time();
	$result = $this->m_jadwal_produksi->pilih_lot_size_dan_waktu_produksi_dari_pesanan_telah_konfirm();
	
	$jumlah_result = $result['jumlah_row'];
	// untuk penginputan jadwal produksi berdasarkan pesanan barang yang telah dikonfirmasi 
	 for ($a=0; $a<$jumlah_result; $a++)
	 {
	 foreach ($result[$a]->result() as $row)
	 {
		//echo $row->nm_brng." ";
		//echo $row->lot_size." ";
		//echo $row->wkt_prdksi." ";
		//echo '<br>';
		$total_pesanan = $this->m_jadwal_produksi->penjumlahan_pesanan_utama($row->nm_brng);
		
		foreach ($total_pesanan as $row2)
		{
			$jumlah_pesanan = $row2->total_pesanan;
		}
		

		
		
		$this->m_waktu->setting_waktu_local();
		
		$datestring = '%d%m%Y%H%i';
		
		$waktu = mdate($datestring,$time);
		
		$acak=$this->m_acak->jadwal_prdksi();
		
		$jenis = $this->m_barang->pencarian_jenis_barang($row->nm_jns_brng);
		
		foreach ($jenis as $row3)
		{
			$id_jns = $row3->id_jns_brng;
		}
		
		
		$id_prdksi = $id_jns.$waktu.$acak;

		$datestring = '%Y-%m-%d %H:%i';
		$waktu_jdwl = mdate($datestring, $time);
		
		//pengecekan stock dan penginputah data pesanan yang belum terpenuhi kedalam jadwal produksi
		$data_stock_terbaru = $this->m_stock_barang->cek_stock_awal($row->nm_brng);
		
		if ($data_stock_terbaru == true)
		{
			
			foreach ($data_stock_terbaru as $row3)
			{
				$jumlah_stock = $row3->jml_stock;
				$tanggal_stock_tersedia = $row3->tgl_stock;
			}
			
			$jumlah_kekurangan_pesanan = $jumlah_pesanan - $jumlah_stock;
			
			
			
			if ($jumlah_kekurangan_pesanan <= 0)
			{
				
				$update2 = array(
					'perkiraan_waktu_selesai' => $tanggal_stock_tersedia,
					'status_pesanan' => 'terpenuhi'
				);
				//$this->m_pesanan_barang->update_perkiraan_waktu_selesai($row->nm_brng, $update2);
				
				//tambahkan pengurangan stock
			}
			else
			{
			
			$jumlah_batch_proses = ceil($jumlah_kekurangan_pesanan / $row->lot_size);
		
			$waktu_proses = $jumlah_batch_proses * $row->wkt_prdksi;
			
			
			$insert = array(
		
			'id_prdksi' => $id_prdksi,
			'waktu_jdwl' => $waktu_jdwl,
			'nm_brng' => $row->nm_brng,
			'wkt_prdksi' => $waktu_proses,
			'jumlah_batch' => $jumlah_batch_proses,
			'status' =>'utama'
				);
				$this->m_jadwal_produksi->input_penjadwalan($insert);
			}
			
		}
		else
		{
		//cek stock selesai
		
		
		$jumlah_batch_proses = ceil($jumlah_pesanan / $row->lot_size);
		
		$waktu_proses = $jumlah_batch_proses * $row->wkt_prdksi;
		
		$insert = array(
		
			'id_prdksi' => $id_prdksi,
			'waktu_jdwl' => $waktu_jdwl,
			'nm_brng' => $row->nm_brng,
			'wkt_prdksi' => $waktu_proses,
			'jumlah_batch' => $jumlah_batch_proses,
			'status' =>'utama'
		);
		
	$this->m_jadwal_produksi->input_penjadwalan($insert);
		
	}	
		
	 }
	 }
	 //penginputan selesai
	 
	 
	 //----------------------------------------------------------------------------------------------------
	 $result = $this->m_jadwal_produksi->urutan_waktu_proses($waktu_jdwl);
	 
	 if ($result)
	 {
	 $b=0;
	 foreach ($result as $row)
	 {
		//echo $row->nm_brng." ";
		//echo $row->wkt_prdksi." ";
		//echo $row->waktu_jdwl;
		//echo '<br>';
		
		
	if($b==0)
	{
		$result2 = $this->m_jadwal_produksi->pengecekan_jam_selesai($waktu_jdwl);
		
			if ($result2 == true)
		{
				foreach ($result2 as $row2)
			{
			$nama_barang_terakhir = $row2->nm_brng;
			$waktu_jadwal_terakhir = $row2->waktu_jdwl;
			$waktu_selesai_terakhir = $row2->waktu_selesai;
			}
		
		}
		
		
		if ($result2 == true)
		{
		
		if (date('Y-m-d H:i',strtotime($waktu_jdwl)) > date('Y-m-d H:i',strtotime($waktu_selesai_terakhir)))
		{
		
		// apabila jadwal telah kadarluarsa
		
		$waktu_mulai_produksi = date('Y-m-d H:i',time()+3600);
		
//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		for ($g=0;$g<$row->jumlah_batch;$g++)
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			$h=1;
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr($waktu_selesai_produksi, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			}
			else
			{
			
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%d%m%Y%H%i';
		
			$waktu = mdate($datestring,$time);
			
			$id_jns = substr($row->id_prdksi, 0 ,1);
			
			$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			
			
			$insert2 = array(
		
			'id_prdksi' => $id_prdksi,
			'nm_brng' => $row->nm_brng,
			'status' =>'sementara',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		
		$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai
		
		
		
		$update2 = array(
			'perkiraan_waktu_selesai' => $waktu_selesai_produksi,
			'status_pesanan' => 'dalam_proses'
		);
		
		
		//- jadwal kadarluarsa
		
		
		
		}
		else
		{
		//echo $nama_barang_terakhir." ";
		//echo $waktu_jadwal_terakhir." ";
		//echo $jam_selesai_terakhir." ";
		
		
		
		
		if (mdate('%H:%i',strtotime(substr($waktu_selesai_terakhir, -8))) <= mdate('%H:%i',strtotime('17:00:00')))
		{
		$waktu_mulai_produksi = $waktu_selesai_terakhir;
		}
		else
		{
		
		//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
		$tanggal_selesai_terakhir = substr($waktu_selesai_terakhir, 0, 10);
		$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
		$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
		$jam_mulai = "07:00";
		
		$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
		}
		
		
	
//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		for ($g=0;$g<$row->jumlah_batch;$g++)
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			$h=1;
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr($waktu_selesai_produksi, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			}
			else
			{
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$jam_mulai = "07:00";
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%d%m%Y%H%i';
		
			$waktu = mdate($datestring,$time);
			
			$id_jns = substr($row->id_prdksi, 0 ,1);
			
			$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			
			
			$insert2 = array(
		
			'id_prdksi' => $id_prdksi,
			'nm_brng' => $row->nm_brng,
			'status' =>'utama',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		
		$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai
		
		
		
		
		$update2 = array(
			'perkiraan_waktu_selesai' => $waktu_selesai_produksi,
			'status_pesanan'=>'dalam_penjadwalan'
		);
		
		}
		
		
		
		
		
		
		}
	else
		{
		
		$waktu_mulai_produksi = date('Y-m-d H:i',time()+3600);
		
//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		for ($g=0;$g<$row->jumlah_batch;$g++)
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			$h=1;
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr($waktu_selesai_produksi, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			}
			else
			{
			
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%d%m%Y%H%i';
		
			$waktu = mdate($datestring,$time);
		
			$id_jns = substr($row->id_prdksi, 0 ,1);
		
			$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			
			
			$insert2 = array(
		
			'id_prdksi' => $id_prdksi,
			'nm_brng' => $row->nm_brng,
			'status' =>'utama',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		
		$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai
		
		
		
		$update2 = array(
			'perkiraan_waktu_selesai' => $waktu_selesai_produksi,
			'status_pesanan'=>'dalam_penjadwalan'
		);
		
		
		
		
		
		
		
		
		}
		
		
		
	$this->m_pesanan_barang->update_perkiraan_waktu_selesai_utama($row->nm_brng, $update2);
		
		
		
		$b=1;
	}
		
		
		
	else
	{
		
		
		
		if (mdate('%H:%i',strtotime(substr($waktu_selesai_produksi, -5))) <= mdate('%H:%i',strtotime('17:00')))
		{
		
		$waktu_mulai_produksi = $waktu_selesai_produksi;
		 
		}
		else
		{
		
		//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
		$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
		$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
		$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
		$jam_mulai = "07:00";
		
		$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
		}

//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		for ($g=0;$g<$row->jumlah_batch;$g++)
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			$h=1;
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr($waktu_selesai_produksi, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
		
			}
			else
			{
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$jam_mulai = "07:00";
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%d%m%Y%H%i';
		
			$waktu = mdate($datestring,$time);
		
			$id_jns = substr($row->id_prdksi, 0 ,1);
		
			$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			
			
			$insert2 = array(
		
			'id_prdksi' => $id_prdksi,
			'nm_brng' => $row->nm_brng,
			'status' =>'utama',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		
		$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai		

		
		
		
		$update2 = array(
			'perkiraan_waktu_selesai' => $waktu_selesai_produksi,
			'status_pesanan'=>'dalam_penjadwalan'
		);
		
		
		
		
		
		
		$this->m_pesanan_barang->update_perkiraan_waktu_selesai_utama($row->nm_brng, $update2);
	}
	
	 //tempat penghitungan stock
	 $stock_perusahaan = $this->m_stock_barang->cek_stock_awal($row->nm_brng);
	 foreach ($stock_perusahaan as $row4)
	 {
		$jumlah_stock_barang = $row4->jml_stock;	
	 }
	 $result4 = $this->m_jadwal_produksi->pilih_lot_size_dari_pesanan_telah_dijadwalkan($row->nm_brng);
	 
	 foreach ($result4 as $row4)
	 {
		$jumlah_lot_size = $row4->lot_size;
	 }
	 
	$jumlah_stock_barang = $jumlah_stock_barang + ($jumlah_lot_size * $row->jumlah_batch);
	 
	 $total_pesanan = $this->m_jadwal_produksi->penjumlahan_pesanan_utama($row->nm_brng);
		
		foreach ($total_pesanan as $row4)
		{
			$jumlah_pesanan = $row2->total_pesanan;
		}
	 $jumlah_stock_tersisa = $jumlah_stock_barang - $jumlah_pesanan;
	 
	 $result4 = $this->m_stock_barang->cek_stock_awal($row->nm_brng);
	 foreach ($result4 as $row4)
	 {
		$id_barang = $row4->id_brng;
		$tanggal_stock_terbaru = $row4->tgl_stock;
	 }
	 
	 
	 
	 
	$this->m_stock_barang->insert_new_stock($id_barang, $tanggal_stock_terbaru, substr($waktu_selesai_produksi, 0, 10), $jumlah_stock_tersisa);
	 //echo "jumlah stock = ".$jumlah_stock_barang." jumlah_pesanan = ".$jumlah_pesanan." jumlah stock yang tersisa=".$jumlah_stock_tersisa."<br>";
	 //penghitungan stock selesai
	
	
		
	 }
	 
	
	 }
	 
	 
	
}
 redirect('master_pesanan_pelanggan/c_tampil_pesanan');
	
	
	
	
	
	}




}


?>