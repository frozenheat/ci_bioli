<?php
class input_pesanan extends CI_Controller
{
 function __construct()
 {
	parent::__construct();
		$this->load->model('m_pesanan_barang');
 }
 
	
		function index()
		{
			if ($this->input->POST('database') == 'pegawai')
			{
				echo $this->input->POST('database');
			}
			else if ($this->input->POST('database')== 'pelanggan')
			{
				echo $this->input->POST('database');
				echo $this->input->POST('id_pelanggan');
				echo $this->input->POST('nama_barang');
				echo $this->input->POST('jml_psn');
			}
		}
}
?>