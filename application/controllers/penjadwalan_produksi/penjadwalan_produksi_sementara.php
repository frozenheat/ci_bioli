<?php 
class penjadwalan_produksi_sementara extends CI_Controller
{
	function __construct()
	{
	 parent::__construct();
	 $this->load->model('m_jadwal_produksi');
	 $this->load->model('m_waktu');
	 $this->load->model('m_acak');
	 $this->load->model('m_barang');
	}
	
	
	
function index()
{
	$time = time();
	$result = $this->m_jadwal_produksi->pilih_lot_size_dan_waktu_produksi_dari_pesanan_belum_konfirm();
	$jumlah_result = $result['jumlah_row'];
	// untuk penginputan jadwal produksi berdasarkan pesanan barang yang belum dikonfirmasi 
	 for ($a=0; $a<$jumlah_result; $a++)
	 {
	 foreach ($result[$a]->result() as $row)
	 {
		//$row->nm_brng;
		//echo $row->lot_size;
		//echo $row->wkt_prdksi;
		//echo '<br>';
		$total_pesanan = $this->m_jadwal_produksi->penjumlahan_pesanan($row->nm_brng);
		
		foreach ($total_pesanan as $row2)
		{
			$row2->total_pesanan;
		}
		$jumlah_batch_proses = ceil($row2->total_pesanan / $row->lot_size);
		
		$waktu_proses = $jumlah_batch_proses * $row->wkt_prdksi;
		
		$this->m_waktu->setting_waktu_local();
		
		$datestring = '%d%m%Y%H%i';
		
		$waktu = mdate($datestring,$time);
		
		$acak=$this->m_acak->jadwal_prdksi();
		
		$jenis = $this->m_barang->pencarian_jenis_barang($row->nm_jns_brng);
		
		foreach ($jenis as $row3)
		{
			$id_jns = $row3->id_jns_brng;
		}
		
		//echo 'jumlah batch untuk '.$row->nm_brng.' adalah '.$jumlah_batch_proses.' dan waktu yang dibutuhkan untuk pemrosesan adalah '.$waktu_proses.' jam';
		//echo '<br>';
		$id_prdksi = $id_jns.$waktu.$acak;
		//echo $id_prdksi;
		$datestring = '%Y-%m-%d %H:%i';
		$waktu_jdwl = mdate($datestring, $time);
		
		
		$insert = array(
		
			'id_prdksi' => $id_prdksi,
			'waktu_jdwl' => $waktu_jdwl,
			'nm_brng' => $row->nm_brng,
			'wkt_prdksi' => $waktu_proses
		
		);
		
		$this->m_jadwal_produksi->input_penjadwalan($insert);
		
		
		
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
		if ($result2)
		{
		foreach ($result2 as $row2)
		{
		$nama_barang_terakhir = $row2->nm_brng;
		$waktu_jadwal_terakhir = $row2->waktu_jdwl;
		$jam_selesai_terakhir = $row2->jam_selesai;
		}
		//echo $nama_barang_terakhir." ";
		//echo $waktu_jadwal_terakhir." ";
		//echo $jam_selesai_terakhir." ";
		$waktu_pemrosesan = 3600 * $row->wkt_prdksi;
		$waktu_mulai_produksi = $jam_selesai_terakhir;
		$waktu_selesai_produksi = date('H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
		
		$update = array(
			'jam_mulai' =>$waktu_mulai_produksi,
			'jam_selesai' => $waktu_selesai_produksi
		);
		$this->m_jadwal_produksi->update_waktu_mulai($update, $row->id_prdksi);
		//echo $waktu_mulai_produksi;
		//echo '<br>';
		
		}
		else
		{
		$waktu_pemrosesan = 3600 * $row->wkt_prdksi;
		$waktu_mulai_produksi = date('H:i',time()+3600);
		$waktu_selesai_produksi = date('H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
		$update = array(
			'jam_mulai' =>$waktu_mulai_produksi,
			'jam_selesai' =>$waktu_selesai_produksi
		);
		$this->m_jadwal_produksi->update_waktu_mulai($update, $row->id_prdksi);
		echo $waktu_mulai_produksi;
		}
		
		$b=1;
	}
		
		
		
	else
	{
		$waktu_pemrosesan = 3600 * $row->wkt_prdksi;
		$waktu_mulai_produksi = $waktu_selesai_produksi;
		$waktu_selesai_produksi = date('H:i',strtotime($waktu_mulai_produksi)+$waktu_pemrosesan);
		$update = array(
			'jam_mulai' =>$waktu_mulai_produksi,
			'jam_selesai' =>$waktu_selesai_produksi
		);
		$this->m_jadwal_produksi->update_waktu_mulai($update, $row->id_prdksi);
		 //echo 'test';
		 //echo '<br>';
	}
		
	 }
	 }
	 
	 //redirect('master_pesanan_pelanggan/c_tampil_pesanan');
}

}

?>