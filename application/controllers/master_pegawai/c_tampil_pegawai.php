<?php
class c_tampil_pegawai extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pegawai');
		
		
	}

	function index()
	{
	$data['body']="master_pegawai";
	
	//if($this->session->userdata('menu'))
	//{
		//$this->session->unset_userdata('menu');
	//}
	
	//$this->session->userdata('menu',$body);
	
	
	//$user_data=$this->session->userdata('logged_in');
	
	
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['database']=$session_data['database'];
			if ($data['database']=='pegawai')
			{
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$data['data_pegawai']=$this->m_pegawai->tampil_pegawai();
			$this->load->view('hlm_utm',$data);
			}
			else if($data['database']=='pelanggan')
			{
			$data['id_pelanggan']=$session_data['id_pelanggan'];
			$data['otoritas']=$session_data['otoritas'];
			$this->load->view('hlm_utm',$data);
			
			}
		}
	}

}

?>
