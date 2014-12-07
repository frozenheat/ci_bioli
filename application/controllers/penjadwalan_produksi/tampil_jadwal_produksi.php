<?php
class tampil_jadwal_produksi Extends CI_Controller
{
	function __construct()
	{
		
		parent::__construct();
		$this->load->model('m_jadwal_produksi');
		$this->load->model('m_pesanan_barang');
	
	
	}
	
	
	function index()
	{
	if ($this->session->userdata('logged_in'))
		{
		$session_data=$this->session->userdata('logged_in');
		 if ($session_data['database']=='pegawai')
		{
		$data['body']='jadwal_produksi';
		$data['id_pegawai']=$session_data['id_pegawai'];
		$data['otoritas']=$session_data['otoritas'];
		if ($this->m_jadwal_produksi->tampil_jadwal_produksi() == true)
		{
		$data['jadwal_produksi']=$this->m_jadwal_produksi->tampil_jadwal_produksi();
		}
		$this->load->view('hlm_utm',$data);
		}
		}
	}
	
	function update_status_pesanan()
	{
		if ($this->session->userdata('logged_in'))
		{
		$this->m_pesanan_barang->pemenuhan_pesanan($this->input->POST('id_produksi'));
		$this->m_jadwal_produksi->pemenuhan_jadwal($this->input->POST('id_produksi'));
		
		
		$session_data=$this->session->userdata('logged_in');
		 if ($session_data['database']=='pegawai')
		{
		$data['body']='jadwal_produksi';
		$data['id_pegawai']=$session_data['id_pegawai'];
		$data['otoritas']=$session_data['otoritas'];
		if ($this->m_jadwal_produksi->tampil_jadwal_produksi() == true)
		{
		$data['jadwal_produksi']=$this->m_jadwal_produksi->tampil_jadwal_produksi();
		}
		$this->load->view('hlm_utm',$data);
		}
		}
	}
}



?>