<?php
 class c_kapasitas extends CI_Controller{
 
 	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_mesin');
		$this->load->model('m_kapasitas');
		
		
	}
 
	function index()
	{
		if ($this->session->userdata('logged_in'))
		{
		$session_data=$this->session->userdata('logged_in');
		 if ($session_data['database']=='pegawai')
		{
		$data['body']='kapasitas';
		$data['id_pegawai']=$session_data['id_pegawai'];
		$data['otoritas']=$session_data['otoritas'];
		$data['database']=$session_data['database'];
		$data['data_barang']=$this->m_barang->tampil_barang();
		$data['data_mesin']=$this->m_mesin->tampil_mesin();
		$data['data_kapasitas']=$this->m_kapasitas->tampil_kapasitas();
		//$data['stock_barang']=$this->m_stock_barang->tampil_stock_barang();
		
		
		$this->load->view('hlm_utm',$data);
		}
		}
	}
	
	
	function input_data()
	{
		if ($this->session->userdata('logged_in'))
		{
		$session_data=$this->session->userdata('logged_in');
		 if ($session_data['database']=='pegawai')
		{
		
		$id_barang = $this->input->POST('id_barang');
		$id_mesin = $this->input->POST('id_mesin');
		$lot_size = $this->input->POST('lot');
		$waktu = $this->input->POST('wkt_prdksi');
		
		$pengecekan = $this->m_kapasitas->pengecekan($id_barang, $id_mesin);
		
		
		if($pengecekan == false)
		{
		$insert = array(
			'id_mesin' => $id_mesin,
			'id_barang' => $id_barang,
			'lot_size' => $lot_size,
			'waktu_prdksi' =>$waktu
			
		);
		
		$this->m_kapasitas->input_data($insert);
		}
		else
		{
		$update = array(
			'lot_size' => $lot_size,
			'waktu_prdksi' =>$waktu	
		);
		$this->m_kapasitas->update_data($id_barang, $id_mesin, $update);
		}
		
		$jenis_mesin = $this->m_mesin->pilih_jenis_mesin($id_mesin);

		$this->m_kapasitas->update_barang($id_barang, $jenis_mesin);
		
		$data['body']='kapasitas';
		$data['id_pegawai']=$session_data['id_pegawai'];
		$data['otoritas']=$session_data['otoritas'];
		$data['database']=$session_data['database'];
		$data['data_barang']=$this->m_barang->tampil_barang();
		$data['data_mesin']=$this->m_mesin->tampil_mesin();
		$data['data_kapasitas']=$this->m_kapasitas->tampil_kapasitas();
			
		
		$this->load->view('hlm_utm',$data);
		}
		}
	}
	
	
 }
 ?>