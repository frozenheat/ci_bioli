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
		$this->load->model('m_mesin');
	}
	
	function index()
	{
	
	$this->m_jadwal_produksi->hapus_jadwal_sementara();
	$this->m_mesin->hapus_jadwal_sementara();
	
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
		
		$datestring = '%Y';
		
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
				$id_barang = $row3->id_brng;
			}
			
			$jumlah_kekurangan_pesanan = $jumlah_pesanan - $jumlah_stock;
			
			//echo $jumlah_kekurangan_pesanan." ";
			//echo $jumlah_pesanan." ";
			//echo $jumlah_stock."<br>";
			
			
			if ($jumlah_kekurangan_pesanan <= 0)
			{
				
				$update2 = array(
					'perkiraan_waktu_selesai' => $tanggal_stock_tersedia,
					'status_pesanan' => 'terpenuhi',
					'sts_konfirm' => 'terpenuhi'
				);
				
				$this->m_pesanan_barang->update_perkiraan_waktu_selesai_utama($row->nm_brng, $update2);

				
				//pengurangan stock
				$sisa_stock = $jumlah_stock - $jumlah_pesanan;
				
				$tanggal_stock_terbaru = $tanggal_stock_tersedia;
				
				
				//echo $tanggal_stock_tersedia." ".$tanggal_stock_terbaru."<br>";
				$this->m_stock_barang->insert_new_stock($id_barang , $tanggal_stock_tersedia, $tanggal_stock_terbaru, $sisa_stock);
				
				
				//-- pengurangan stock
			}
			else
			{
			
			//========================================= revisi + =========================================//
			$jumlah_batch_cetak =ceil($jumlah_kekurangan_pesanan / $row->lot_size_cetak);
			$jumlah_batch_bubut =ceil($jumlah_kekurangan_pesanan / $row->lot_size_bubut);
			$jumlah_batch_milling =ceil($jumlah_kekurangan_pesanan / $row->lot_size_milling);
			
			
			$nama_barang = $row->nm_brng;
			
		
			$waktu_proses_cetak = $jumlah_batch_cetak * $row->wkt_prdksi_cetak;
			$waktu_proses_bubut = $jumlah_batch_bubut * $row->wkt_prdksi_bubut;
			$waktu_proses_milling = $jumlah_batch_milling * $row->wkt_prdksi_milling;
			
			
			

			$total_waktu_proses = $waktu_proses_cetak + $waktu_proses_bubut + $waktu_proses_milling;
			//========================================= revisi - =========================================//
			
			$insert = array(
		
			'id_prdksi' => $id_prdksi,
			'waktu_jdwl' => $waktu_jdwl,
			'nm_brng' => $row->nm_brng,
			'wkt_prdksi' => $total_waktu_proses,
			'status' =>'utama'
				);
				$this->m_jadwal_produksi->input_penjadwalan($insert);
			//========================================= revisi + =========================================//	
			$acak_cetak =$this->m_acak->jadwal_cetak();
			$acak_bubut =$this->m_acak->jadwal_bubut();
			$acak_milling =$this->m_acak->jadwal_milling();
			
			
			
			
				
				for($b=0;$b < 3; $b++)
				{
				if($b==0)
				{
				$id_prdksi_mesin = $id_jns.'c'.$acak_cetak;
				$jenis_mesin = 'cetak';
				$waktu_proses = $waktu_proses_cetak;
				$jumlah_batch = $jumlah_batch_cetak;
				}
				else if($b==1)
				{
				$id_prdksi_mesin= $id_jns.'b'.$acak_bubut;
				$jenis_mesin = 'bubut';
				$waktu_proses = $waktu_proses_bubut;
				$jumlah_batch = $jumlah_batch_bubut;
				}
				else if($b==2)
				{
				$id_prdksi_mesin = $id_jns.'m'.$acak_milling;
				$jenis_mesin = 'milling';
				$waktu_proses = $waktu_proses_milling;
				$jumlah_batch = $jumlah_batch_milling;
				}
				
				$insert_mesin = array(
				'id_jadwal_mesin' => $id_prdksi_mesin,
				'waktu_jdwl'=> $waktu_jdwl,
				'jenis_mesin' => $jenis_mesin,
				'id_prdksi' => $id_prdksi,
				'waktu_prdksi' => $waktu_proses,
				'jumlah_batch' => $jumlah_batch ,
				'nama_barang' => $row->nm_brng,
				'status_jadwal' => 'utama'
				);
				
				$this->m_mesin->input_jadwal($insert_mesin);
				}
		//========================================= revisi - =========================================//
			}
			
		}
		else
		{
		//cek stock selesai
		
		
//========================================= revisi + =========================================//
			$jumlah_batch_cetak =ceil($jumlah_kekurangan_pesanan / $row->lot_size_cetak);
			$jumlah_batch_bubut =ceil($jumlah_kekurangan_pesanan / $row->lot_size_bubut);
			$jumlah_batch_milling =ceil($jumlah_kekurangan_pesanan / $row->lot_size_milling);
			
			
			$nama_barang = $row->nm_brng;
			
		
			$waktu_proses_cetak = $jumlah_batch_cetak * ceil($row->wkt_prdksi_cetak / 60);
			$waktu_proses_bubut = $jumlah_batch_bubut * ceil($row->wkt_prdksi_bubut / 60);
			$waktu_proses_milling = $jumlah_batch_milling * ceil($row->wkt_prdksi_milling / 60);
			
			
			

			$total_waktu_proses = $waktu_proses_cetak + $waktu_proses_bubut + $waktu_proses_milling;
//========================================= revisi - =========================================//
		
		$insert = array(
		
			'id_prdksi' => $id_prdksi,
			'waktu_jdwl' => $waktu_jdwl,
			'nm_brng' => $row->nm_brng,
			'wkt_prdksi' => $total_waktu_proses,
			'status' =>'utama'
		);
		
	$this->m_jadwal_produksi->input_penjadwalan($insert);
	//========================================= revisi + =========================================//	

			
			
				
				for($b=0;$b < 3; $b++)
				{
				$acak_cetak =$this->m_acak->jadwal_cetak();
			$acak_bubut =$this->m_acak->jadwal_bubut();
			$acak_milling =$this->m_acak->jadwal_milling();
				if($b==0)
				{
				$id_prdksi_mesin = $id_jns.'c'.$acak_cetak;
				$jenis_mesin = 'cetak';
				}
				else if($b==1)
				{
				$id_prdksi_mesin= $id_jns.'b'.$acak_bubut;
				$jenis_mesin = 'bubut';
				}
				else if($b==2)
				{
				$id_prdksi_mesin = $id_jns.'m'.$acak_milling;
				$jenis_mesin = 'milling';
				}
				
				$insert_mesin = array(
				'id_jadwal_mesin' => $id_prdksi_mesin,
				'waktu_jdwl'=> $waktu_jdwl,
				'jenis_mesin' => $jenis_mesin,
				'id_prdksi' => $id_prdksi,
				'nama_barang' => $row->nm_brng,
				'status_jadwal' => 'utama'
				);

				$this->m_mesin->input_jadwal($insert_mesin);
				
				}
			//========================================= revisi - =========================================//
		
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
		//====================================== revisi + ========================================//
		//$result2 = $this->m_jadwal_produksi->pengecekan_jam_selesai($waktu_jdwl);
	
		$result2 = $this->m_mesin->pengecekan_jam_selesai_mesin_cetak($waktu_jdwl);
		//====================================== revisi - ========================================//
		
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
		
		//====================================== revisi + ========================================//
	for($j=0; $j<3; $j++)
	{
	if($j==0)
		{
		$mesin= 'cetak';
		$waktu_mulai_produksi = date('Y-m-d H:i',time()+3600);
		$update_waktu_mulai_produksi = array(
		'waktu_mulai' => $waktu_mulai_produksi
		);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
		}
		else if($j==1)
		{
		echo $waktu_selesai_produksi."    ";
		$mesin= 'bubut';
		$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
	
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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

		}
		else
		{	
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}

		}
		}
		else if($j==2)
		{
		$mesin= 'milling';
	$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}
		}
		}
		
	$id_pro_mesin = $this->m_mesin->cari_id_pro_mesin($row->id_prdksi, $mesin);
		//====================================== revisi - ========================================//
		
//bagian penghitungan waktu pemrosesan berdasarkan batch
	//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	//$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	//====================================== revisi + ========================================//
	
	$this->m_mesin->update_waktu_mulai_mesin($update_waktu_mulai_produksi, $id_pro_mesin);
	$data_jadwal_mesin = $this->m_mesin->ambil_data_mesin($id_pro_mesin);
	$data_waktu_jadwal_mesin = $data_jadwal_mesin['waktu_jadwal'];
	$data_jenis_mesin = $data_jadwal_mesin['jenis_mesin'];
	$data_waktu_proses_mesin = $data_jadwal_mesin['waktu_proses'];
	$data_batch_mesin = $data_jadwal_mesin['jumlah_batch'];
	$waktu_pemrosesan = ($data_waktu_proses_mesin/ $data_batch_mesin) * 3600;

	//====================================== revisi - ========================================//
	//$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		//for ($g=0;$g<$row->jumlah_batch;$g++)
		//====================================== revisi + ========================================//
		for ($g=0;$g<$data_batch_mesin;$g++)
		//====================================== revisi - ========================================//
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
			
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
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
			
			}
			else
			{
			
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%Y';
		
			$waktu = mdate($datestring,$time);
			
			//$id_jns = substr($row->id_prdksi, 0 ,1);
			//====================================== revisi + ========================================//
			$id_jns = substr($id_pro_mesin, 0 ,2);
			$acak=$this->m_acak->jadwal_cetak();
			//====================================== revisi - ========================================//
			//$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			$id_pro_mesin = $id_prdksi;
			
			//$insert2 = array(
		
			//'id_prdksi' => $id_prdksi,
			//'waktu_jdwl' => $row->waktu_jdwl,
			//'nm_brng' => $row->nm_brng,
			//'status' =>'lanjutan',
			//'waktu_mulai' => $waktu_mulai_produksi,
			//'waktu_selesai' => $waktu_selesai_produksi
		//);
		
		//====================================== revisi + ========================================//
		$insert2 = array(
		
			'id_jadwal_mesin' => $id_prdksi,
			'waktu_jdwl' => $row->waktu_jdwl,
			'jenis_mesin' => $mesin,
			'nama_barang' => $row->nm_brng,
			'status_jadwal' =>'lanjutan',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		$this->m_mesin->input_jadwal($insert2);	
		$id_prdksi = $row->id_prdksi;
		$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
		//====================================== revisi - ========================================//
		//$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai
		
		//====================================== revisi + ========================================//
		//$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+1800);	
		}
		//====================================== revisi - ========================================//
		
		$update2 = array(
			'id_prdksi' => $row->id_prdksi,
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
		
		
		
		
	//====================================== revisi + ========================================//
	for($j=0; $j<3; $j++)
	{
	if($j==0)
		{
		$mesin= 'cetak';
		$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);	
		if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}
		$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);	

		}
		else if($j==1)
		{
		echo $waktu_selesai_produksi."    ";
		$mesin= 'bubut';
		$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
	
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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

		}
		else
		{	
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}

		}
		}
		else if($j==2)
		{
		$mesin= 'milling';
	$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}
		}
		}
		
	$id_pro_mesin = $this->m_mesin->cari_id_pro_mesin($row->id_prdksi, $mesin);
		//====================================== revisi - ========================================//
		
		
	
//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	//$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	//====================================== revisi + ========================================//
	
	$this->m_mesin->update_waktu_mulai_mesin($update_waktu_mulai_produksi, $id_pro_mesin);
	$data_jadwal_mesin = $this->m_mesin->ambil_data_mesin($id_pro_mesin);
	$data_waktu_jadwal_mesin = $data_jadwal_mesin['waktu_jadwal'];
	$data_jenis_mesin = $data_jadwal_mesin['jenis_mesin'];
	$data_waktu_proses_mesin = $data_jadwal_mesin['waktu_proses'];
	$data_batch_mesin = $data_jadwal_mesin['jumlah_batch'];
	$waktu_pemrosesan = ($data_waktu_proses_mesin/ $data_batch_mesin) * 3600;

	//====================================== revisi - ========================================//
	//$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		//for ($g=0;$g<$row->jumlah_batch;$g++)
		//====================================== revisi + ========================================//
		for ($g=0;$g<$data_batch_mesin;$g++)
		//====================================== revisi - ========================================//
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
			
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
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
			}
			else
			{
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$jam_mulai = "07:00";
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%Y';
		
			$waktu = mdate($datestring,$time);
			
			//$id_jns = substr($row->id_prdksi, 0 ,1);
			//====================================== revisi + ========================================//
			$id_jns = substr($id_pro_mesin, 0 ,2);
			$acak=$this->m_acak->jadwal_cetak();
			//====================================== revisi - ========================================//
			
			//$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			$id_pro_mesin = $id_prdksi;
			
			//$insert2 = array(
		
			//'id_prdksi' => $id_prdksi,
			//'waktu_jdwl' => $row->waktu_jdwl,
			//'nm_brng' => $row->nm_brng,
			//'status' =>'lanjutan',
			//'waktu_mulai' => $waktu_mulai_produksi,
			//'waktu_selesai' => $waktu_selesai_produksi
		//);
		
		//====================================== revisi + ========================================//
		$insert2 = array(
		
			'id_jadwal_mesin' => $id_prdksi,
			'waktu_jdwl' => $row->waktu_jdwl,
			'jenis_mesin' => $mesin,
			'nama_barang' => $row->nm_brng,
			'status_jadwal' =>'lanjutan',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		$this->m_mesin->input_jadwal($insert2);	
		$id_prdksi = $row->id_prdksi;
		$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
		//====================================== revisi - ========================================//
		//$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai
		
		
	//====================================== revisi + ========================================//
//$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+1800);		
		}
	//====================================== revisi - ========================================//	
		
		$update2 = array(
			'id_prdksi' => $row->id_prdksi,
			'perkiraan_waktu_selesai' => $waktu_selesai_produksi,
			'status_pesanan'=>'dalam_penjadwalan'
		);
		
		}
		
		
		
		
		
		
		}
	else
		{
		

//====================================== revisi + ========================================//
	for($j=0; $j<3; $j++)
	{
	if($j==0)
		{
		$mesin= 'cetak';
		$waktu_mulai_produksi = date('Y-m-d H:i',time()+3600);
		$update_waktu_mulai_produksi = array(
		'waktu_mulai' => $waktu_mulai_produksi
		);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
		}
		else if($j==1)
		{
		echo $waktu_selesai_produksi."    ";
		$mesin= 'bubut';
		$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
	
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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

		}
		else
		{	
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}

		}
		}
		else if($j==2)
		{
		$mesin= 'milling';
	$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}
		}
		}
		
	$id_pro_mesin = $this->m_mesin->cari_id_pro_mesin($row->id_prdksi, $mesin);
		//====================================== revisi - ========================================//
		
//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	//$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	//====================================== revisi + ========================================//
	
	$this->m_mesin->update_waktu_mulai_mesin($update_waktu_mulai_produksi, $id_pro_mesin);
	$data_jadwal_mesin = $this->m_mesin->ambil_data_mesin($id_pro_mesin);
	$data_waktu_jadwal_mesin = $data_jadwal_mesin['waktu_jadwal'];
	$data_jenis_mesin = $data_jadwal_mesin['jenis_mesin'];
	$data_waktu_proses_mesin = $data_jadwal_mesin['waktu_proses'];
	$data_batch_mesin = $data_jadwal_mesin['jumlah_batch'];
	$waktu_pemrosesan = ($data_waktu_proses_mesin/ $data_batch_mesin) * 3600;

	//====================================== revisi - ========================================//
		
	//$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		//for ($g=0;$g<$row->jumlah_batch;$g++)
		//====================================== revisi + ========================================//
		for ($g=0;$g<$data_batch_mesin;$g++)
		//====================================== revisi - ========================================//
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
			
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
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
			}
			else
			{
			
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$jam_mulai = "07:00";
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%Y';
		
			$waktu = mdate($datestring,$time);
		
			//$id_jns = substr($row->id_prdksi, 0 ,1);
			//====================================== revisi + ========================================//
			$id_jns = substr($id_pro_mesin, 0 ,2);
			$acak=$this->m_acak->jadwal_cetak();
			//====================================== revisi - ========================================//
			//$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			$id_pro_mesin = $id_prdksi;
			
			
			//$insert2 = array(
		
			//'id_prdksi' => $id_prdksi,
			//'waktu_jdwl' => $row->waktu_jdwl,
			//'nm_brng' => $row->nm_brng,
			//'status' =>'lanjutan',
			//'waktu_mulai' => $waktu_mulai_produksi,
			//'waktu_selesai' => $waktu_selesai_produksi
		//);
		
		//====================================== revisi + ========================================//
		$insert2 = array(
		
			'id_jadwal_mesin' => $id_prdksi,
			'waktu_jdwl' => $row->waktu_jdwl,
			'jenis_mesin' => $mesin,
			'nama_barang' => $row->nm_brng,
			'status_jadwal' =>'lanjutan',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		$this->m_mesin->input_jadwal($insert2);	
		$id_prdksi = $row->id_prdksi;
		$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
		//====================================== revisi - ========================================//
		//$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai
		
	//====================================== revisi + ========================================//
	//$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+1800);	
		}
	//====================================== revisi - ========================================//	
		
		$update2 = array(
			'id_prdksi' => $row->id_prdksi,
			'perkiraan_waktu_selesai' => $waktu_selesai_produksi,
			'status_pesanan'=>'dalam_penjadwalan'
		);
		
		
		
		
		
		
		
		
		}
		
		
		
	$this->m_pesanan_barang->update_perkiraan_waktu_selesai_utama($row->nm_brng, $update2);
		
		
		
		$b=1;
	}
		
		
		
	else
	{
		
		
	//====================================== revisi + ========================================//
	for($j=0; $j<3; $j++)
	{
	if($j==0)
		{
		$mesin= 'cetak';
		$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);	
		if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}
		$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);	

		}
		else if($j==1)
		{
		echo $waktu_selesai_produksi."    ";
		$mesin= 'bubut';
		$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
	
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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

		}
		else
		{	
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}

		}
		}
		else if($j==2)
		{
		$mesin= 'milling';
	$waktu_selesai_terakhir_mesin = substr($this->m_mesin->pengecekan_waktu_selesai($mesin),0,16);
		if( strtotime($waktu_selesai_produksi) >= strtotime($waktu_selesai_terakhir_mesin))
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
		}
		else
		{
			if (mdate('%H:%i',strtotime(substr( $waktu_selesai_terakhir_mesin, -5))) <= mdate('%H:%i',strtotime('17:00')))
			{
		$waktu_selesai_terakhir_mesin = date('Y-m-d H:i',strtotime($waktu_selesai_terakhir_mesin)+1800);
			$waktu_mulai_produksi =  $waktu_selesai_terakhir_mesin;
		 
			}
			else
			{
		
			//apabila pemroduksian telah melebihi jam 17:00 pemroduksian akan dialihkan pada hari berikutnya dengan jam mulai produksi adalah jam 07:00
			$tanggal_selesai_terakhir = substr( $waktu_selesai_terakhir_mesin, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
		
			$jam_mulai = "07:00";
		
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			}
		}
		}
		
	$id_pro_mesin = $this->m_mesin->cari_id_pro_mesin($row->id_prdksi, $mesin);
		//====================================== revisi - ========================================//

//bagian penghitungan waktu pemrosesan berdasarkan batch
	$update_waktu_mulai_produksi = array(
	'waktu_mulai' => $waktu_mulai_produksi
	);	
	//$this->m_jadwal_produksi->update_waktu_mulai($update_waktu_mulai_produksi, $row->id_prdksi);
	//====================================== revisi + ========================================//
	
	$this->m_mesin->update_waktu_mulai_mesin($update_waktu_mulai_produksi, $id_pro_mesin);
	$data_jadwal_mesin = $this->m_mesin->ambil_data_mesin($id_pro_mesin);
	$data_waktu_jadwal_mesin = $data_jadwal_mesin['waktu_jadwal'];
	$data_jenis_mesin = $data_jadwal_mesin['jenis_mesin'];
	$data_waktu_proses_mesin = $data_jadwal_mesin['waktu_proses'];
	$data_batch_mesin = $data_jadwal_mesin['jumlah_batch'];
	$waktu_pemrosesan = ($data_waktu_proses_mesin/ $data_batch_mesin) * 3600;

	//====================================== revisi - ========================================//
	//$waktu_pemrosesan = ($row->wkt_prdksi / $row->jumlah_batch) * 3600;
	$id_prdksi = $row->id_prdksi;
		$h=0;
		//for ($g=0;$g<$row->jumlah_batch;$g++)
		//====================================== revisi + ========================================//
		for ($g=0;$g<$data_batch_mesin;$g++)
		//====================================== revisi - ========================================//
		{		
		if ($h==0)
		{
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
			
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
			//$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			//====================================== revisi + ========================================//
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
			$this->m_mesin->update_waktu_selesai($update_waktu_selesai_produksi, $id_pro_mesin);
			
			//====================================== revisi - ========================================//
		
			}
			else
			{
			$tanggal_selesai_terakhir = substr($waktu_selesai_produksi, 0, 10);
			$tanggal_selesai_terakhir1 = str_replace('-','/', $tanggal_selesai_terakhir);
			$tommorow = date('Y-m-d', strtotime($tanggal_selesai_terakhir1."+1 days"));
			$jam_mulai = "07:00";
			$waktu_mulai_produksi = $tommorow." ".$jam_mulai;
			$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
			
			
			$datestring = '%Y';
		
			$waktu = mdate($datestring,$time);
		
			//$id_jns = substr($row->id_prdksi, 0 ,1);
			//====================================== revisi + ========================================//
			$id_jns = substr($id_pro_mesin, 0 ,2);
			$acak=$this->m_acak->jadwal_cetak();
			//====================================== revisi - ========================================//
			
			//$acak=$this->m_acak->jadwal_prdksi();
			$id_prdksi = $id_jns.$waktu.$acak;
			$id_pro_mesin = $id_prdksi;
			
			//$insert2 = array(
		
			//'id_prdksi' => $id_prdksi,
			//'waktu_jdwl' => $row->waktu_jdwl,
			//'nm_brng' => $row->nm_brng,
			//'status' =>'lanjutan',
			//'waktu_mulai' => $waktu_mulai_produksi,
			//'waktu_selesai' => $waktu_selesai_produksi
		//);
		
		//====================================== revisi + ========================================//
		$insert2 = array(
		
			'id_jadwal_mesin' => $id_prdksi,
			'waktu_jdwl' => $row->waktu_jdwl,
			'jenis_mesin' => $mesin,
			'nama_barang' => $row->nm_brng,
			'status_jadwal' =>'lanjutan',
			'waktu_mulai' => $waktu_mulai_produksi,
			'waktu_selesai' => $waktu_selesai_produksi
		);
		$this->m_mesin->input_jadwal($insert2);	
		$id_prdksi = $row->id_prdksi;
		$update_waktu_selesai_produksi = array(
			'waktu_selesai' => $waktu_selesai_produksi
			);
			if($j==2)
			{
			$this->m_jadwal_produksi->update_waktu_selesai($update_waktu_selesai_produksi, $id_prdksi);
			}
		//====================================== revisi - ========================================//
		//$this->m_jadwal_produksi->input_penjadwalan($insert2);
			
			}
		}
		}
//selesai		

		
	//====================================== revisi + ========================================//
	//$waktu_selesai_produksi = date('Y-m-d H:i',strtotime($waktu_selesai_produksi)+1800);		
		}
	//====================================== revisi - ========================================//	
		
		$update2 = array(
			'id_prdksi' => $row->id_prdksi,
			'perkiraan_waktu_selesai' => $waktu_selesai_produksi,
			'status_pesanan'=>'dalam_penjadwalan'
		);
		
		
		
		
		
		
		$this->m_pesanan_barang->update_perkiraan_waktu_selesai_utama($row->nm_brng, $update2);
	}

	
	
		
	 }
	 
	
	 }
	 
	 
	
}
 redirect('master_pesanan_pelanggan/c_tampil_pesanan');
	
	
	
	
	
	}




}


?>