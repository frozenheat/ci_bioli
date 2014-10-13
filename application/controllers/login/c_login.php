<?php
	
	class c_login extends CI_Controller
	{
		
		function index()
		{
		//$this->load->helper(array('form')); tidak diperlukan karena sudah disetting di autoload
		$this->load->view('hlm_login');
		}
		
		
		
	}
	
?>