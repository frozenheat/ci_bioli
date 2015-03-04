<?php
class c_tampil_mesin extends CI_Controller{
		
		function __construct()
		{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_pesanan_barang');
		$this->load->model('m_mesin');
		}
		
		function index(){
			$data['body']="master_mesin";
	
		if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['database']=$session_data['database'];
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$data['data_mesin']=$this->db->get('mesin');
			$this->load->view('hlm_utm',$data);
	
		}
		
		}
}
?>