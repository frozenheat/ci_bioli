<?php
class c_tampil_pesanan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pesanan_barang');
	}

	function index()
	{
		if ($this->session->userdata('logged_in'))
		{
		$session_data=$this->session->userdata('logged_in');
		 if ($session_data['database']=='pegawai')
		{
		$data['body']='pesanan_pelanggan';
		$data['id_pegawai']=$session_data['id_pegawai'];
		$data['otoritas']=$session_data['otoritas'];
		$data['nama_barang']=$this->m_pesanan_barang->nama_barang();
		$data['data_pesanan']=$this->m_pesanan_barang->tampil_pesanan();
		$this->load->view('hlm_utm',$data);
		}
		
		
		elseif ($session_data['database']=='pelanggan')
		{
		$data['id_pelanggan']=$session_data['id_pelanggan'];
		$data['nama_pelanggan']=$session_data['nama_pelanggan'];
		$data['otoritas']=$session_data['otoritas'];
		$data['nama_barang']=$this->m_pesanan_barang->nama_barang();
		
		
		$this->load->view('hlm_utm',$data);
		}
		}
		
		
		
		else
		{
		redirect('login/c_login');
		}
	}

}
?>