<?php
 class c_input_barang extends CI_Controller{
 
	function __construct(){
	
	parent::__construct();
	
		$this->load->model('m_barang');
		$this->load->model('m_acak');
		$this->load->model('m_mesin');
	}
 
 
	function master_barang()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_barang','Nama_barang','trim|required|xss_clean');
		if($this->form_validation->run()==true)
		{
		
		
		
		$result=$this->m_barang->pencarian_jenis_barang($this->input->post('jenis_barang'));
		
		foreach ($result as $row)
		{
			$id_jenis_barang = $row->id_jns_brng;
		}
		
		
		$acak = $this->m_acak->input_barang();
		$id_barang=$id_jenis_barang.$acak;
	
		
		
		$insert=array(
				
				'id_brng' => $id_barang,
				'nm_brng' => $this->input->post('nama_barang'),
				'nm_jns_brng' => $this->input->post('jenis_barang'),
				'lot_size_cetak' => $this->input->post('lot_cetak'),
				'lot_size_bubut' => $this->input->post('lot_bubut'),
				'lot_size_milling' => $this->input->post('lot_milling'),
				'wkt_prdksi_cetak' => $this->input->post('waktu_cetak'),
				'wkt_prdksi_bubut' => $this->input->post('waktu_bubut'),
				'wkt_prdksi_milling' => $this->input->post('waktu_milling')
		
		);
		
		$this->m_barang->input_master_barang($insert);
		
		redirect('master_barang/c_tampil_barang');
		}
		else
		{
		return false;
		redirect('master_barang/c_tampil_barang');
		}
		
	
	}
	
	function jenis_barang()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('id_jenis_barang','Id_jenis_barang','trim|required|xss_clean');
		$this->form_validation->set_rules('nama_jenis_barang','Nama_jenis_barang','trim|required|xss_clean');
		
		if ($this->form_validation->run()==true)
		{
			$insert=array(
					
				'id_jns_brng' => $this->input->post('id_jenis_barang'),
				'nm_jns_brng' => $this->input->post('nama_jenis_barang')
			
			);
			
			$this->m_barang->input_jenis_barang($insert);
		
		}
		else
		{
		return false;
		}
		redirect('master_barang/c_tampil_jenis_barang');
	
	
	
	}
	
 
 }


?>