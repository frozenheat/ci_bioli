<?php


	class input_stock_barang extends CI_Controller
	{
	
		function __construct()
		{
		
			parent::__construct();
			$this->load->model('m_stock_barang');
			$this->load->model('m_waktu');
			
		}
	
	
		function index()
		{
			$data_stock_lama = $this->m_stock_barang->cek_stock_awal($this->input->post('nama_barang'));
			
			if ($data_stock_lama == false)
			{
			
			$id_barang = $this->m_stock_barang->cek_nama_barang($this->input->post('nama_barang'));
			
			$this->m_waktu->setting_waktu_local();
			$time = time();
		
			$datestring = '%Y-%m-%d';
		
			$waktu = mdate($datestring,$time);
			
		
			$jumlah_stock = $this->input->post('jumlah_stock');
			
			$this->m_stock_barang->input_stock($waktu, $id_barang, $jumlah_stock, 'terbaru');
			
			redirect('master_barang/c_tampil_stock_barang');
			}
			else
			{
			foreach ($data_stock_lama as $row)
			{
				$jumlah_stock = $row->jml_stock;
				$id_barang = $row->id_brng;
			}
			
			
			$this->m_waktu->setting_waktu_local();
			$time = time();
		
			$datestring = '%Y-%m-%d';
		
			$waktu = mdate($datestring,$time);
			
			
		
			$jumlah_stock = $this->input->post('jumlah_stock')+$jumlah_stock;
			
			$update = array(
			
				'jml_stock' => $jumlah_stock
				
			);
			
			//echo $jumlah_stock;
			$this->m_stock_barang->update_stock($update, $id_barang);
			redirect('master_barang/c_tampil_stock_barang');
			}
		}
	
	}

?>