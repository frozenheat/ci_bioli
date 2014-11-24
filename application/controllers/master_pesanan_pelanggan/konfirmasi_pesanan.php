<?php
class konfirmasi_pesanan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pesanan_barang');
	}
	
	function index()
	{

		
		$update = array(
			
			'sts_konfirm' => $this->input->post('hasil_konfirm')
		);
		
		$this->m_pesanan_barang->konfirmasi_barang($this->input->post('hasil_konfirm'), $this->input->post('id_pesanan'), $this->input->post('id_pemesan'), $this->input->post('nama_barang'), $update);
			
		redirect('master_pesanan_pelanggan/c_tampil_pesanan');
	}
		
		
		
}

?>