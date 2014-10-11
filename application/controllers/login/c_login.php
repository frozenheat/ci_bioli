<?php
	
	class c_login extends CI_Controller
	{
		
		function index()
		{
		$this->load->helper(array('form'));
		$this->load->view('hlm_login');
		}
		
		
		
	}
	
?>