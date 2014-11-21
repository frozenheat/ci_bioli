<?php
	class pengecekan_stock extends CI_Controller{
	
		function __construct()
		{
			parent::__construct();
			$this->load->model('m_stock_barang');
			$this->load->model('m_jadwal_produksi');
			$this->load->model('m_acak');
			$this->load->model('m_waktu');
			$this->load->model('m_barang');
		}
	
		
		function index()
		{
			$this->m_waktu->setting_waktu_local();
			$time = time();
			
			$data_stock_awal = $this->m_stock_barang->cek_stock_awal();
			
			if ($data_stock_awal == true)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
	
	}
?>