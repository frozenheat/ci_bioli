<?php
	
	class c_login extends CI_Controller
	{
		function index()
		{
		$this->load->helper('url');
		$this->load->view('hlm_login');
		}
	}
	
?>