<?php

class edit_barang extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
	}

	function index()
	{
		if($this->input->POST('tindak')=='hapus')
		{
		
			$delete = array(
				'id_brng' => $this->input->POST('id_barang')
			);
			$this->m_barang->delete_master_barang($delete);
			
			redirect('master_barang/c_tampil_barang');
			
		}
		else if($this->input->POST('tindak')=='ubah')
 		{
			$data['body']='ubah';
			$data['bagian']='master_barang';
			
		$data['id_barang'] = $this->input->POST('id_barang');
		$data['nama_barang'] = $this->input->POST('nama_barang');
		$data['lot_size'] = $this->input->POST('lot_size');
		$data['waktu_produksi'] = $this->input->POST('waktu_produksi');
			
			if($this->session->userdata('logged_in'))
			{
			$session_data=$this->session->userdata('logged_in');;
			$data['otoritas']=$session_data['otoritas'];
			$this->load->view('hlm_utm',$data);
	
			}
		}
		
		
	}
	
	function ubah_barang()
	{
		$id_barang = $this->input->POST('id_barang');
		
		$ubah = array(
		
			'nm_brng' => $this->input->POST('nama_barang'),
			'lot_size' => $this->input->POST('lot_size'),
			'wkt_prdksi' => $this->input->POST('waktu_produksi')
		);
		
		$this->m_barang->ubah_master_barang($ubah, $id_barang);
		
		redirect('master_barang/c_tampil_barang');
	}

}


?>