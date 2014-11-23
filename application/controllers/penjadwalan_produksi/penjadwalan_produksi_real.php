<?php
class penjadwalan_produksi_real extends CI_Controller
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
	
	}




}


?>