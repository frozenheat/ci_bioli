<?php
	
	class c_halaman_utama extends CI_Controller{
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pegawai');
	}
	
		function index()
		{

		if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['database']=$session_data['database'];
			if ($data['database']=='pegawai')
			{
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['nm_pegawai']=$session_data['nama_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$data['image_path']=$session_data['image_path'];
			$this->load->view('hlm_utm',$data);
			}
			else if($data['database']=='pelanggan')
			{
			$data['id_pelanggan']=$session_data['id_pelanggan'];
			$data['nm_pelanggan']=$session_data['nama_pelanggan'];
			$data['otoritas']=$session_data['otoritas'];
			$this->load->view('hlm_utm',$data);
			}
		}

		else
			{
				redirect('c_login','refresh');
			}
		}
		
		function logout()
		{
			$this->session->unset_userdata('logged_in');
			session_destroy();
			redirect('login/c_login','refresh');
			
		}
		
		
	}
	
	
?>