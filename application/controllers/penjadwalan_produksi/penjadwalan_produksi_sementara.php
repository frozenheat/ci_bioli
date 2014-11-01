<?php 
class penjadwalan_produksi_sementara extends CI_Controller
{
	function __construct()
	{
	 parent::__construct();
	 $this->load->model('m_jadwal_produksi');
	}
	function index()
	{
	 $result = $this->m_jadwal_produksi->pilih_lot_size_dan_waktu_produksi_dari_pesanan_belum_konfirm();
	 $jumlah_result = $result['jumlah_row'];
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
		$jumlah_batch_proses = $row2->total_pesanan / $row->lot_size;
		
		echo 'jumlah batch untuk '.$row->nm_brng.' adalah '.$jumlah_batch_proses;
		echo '<br>';
		
	 }
	 }
	}
}
?>