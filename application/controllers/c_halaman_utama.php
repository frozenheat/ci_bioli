<?php
	
	class c_halaman_utama extends CI_Controller{
	
		function index()
		{
		if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$this->load->view('hlm_utm',$data);
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