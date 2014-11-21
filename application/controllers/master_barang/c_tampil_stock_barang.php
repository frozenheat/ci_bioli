<?php class c_tampil_stock_barang extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('m_stock_barang');
		$this->load->model('m_barang');
	}
	
	function index()
	{
	if ($this->session->userdata('logged_in'))
		{
		$session_data=$this->session->userdata('logged_in');
		 if ($session_data['database']=='pegawai')
		{
		$data['body']='stock_barang';
		$data['id_pegawai']=$session_data['id_pegawai'];
		$data['otoritas']=$session_data['otoritas'];
		//$data['database']=$session_data['database'];
		$data['data_barang']=$this->m_barang->tampil_barang();
		$data['stock_barang']=$this->m_stock_barang->tampil_stock_barang();
		
		
		$this->load->view('hlm_utm',$data);
		}
		}
	}
}
?>