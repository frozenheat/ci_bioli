<?php
class c_tampil_barang extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		
		
	}

	function index()
	{
	$data['body']="master_barang";
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$data['barang']=$this->m_barang->tampil_barang();
			$data['jenis_barang']=$this->m_barang->jenis_barang();
			$this->load->view('hlm_utm',$data);
	
		}
	}	
}

?>
