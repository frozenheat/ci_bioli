<?php
class c_tampil_pelanggan extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pelanggan');
	}
	
		
function index()
	{
	$data['body']="master_pelanggan";
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['database']=$session_data['database'];
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$data['data_pelanggan']=$this->m_pelanggan->tampil_pelanggan();
			$this->load->view('hlm_utm',$data);
	
		}
	}	
	
	
	
}

?>