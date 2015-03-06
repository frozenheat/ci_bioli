<?php 
class input_mesin extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_pesanan_barang');
		$this->load->model('m_mesin');
		$this->load->model('m_acak');
	
	}
	
	function master_mesin()
	{
		$jenis_mesin = $this->input->POST('jenis_mesin');
		$acak = $this->m_acak->master_mesin();
		
		$id_mesin = 'z'.$acak;
		
		$urutan_mesin = $this->m_mesin->urutan_mesin();
		
		foreach($urutan_mesin as $row)
		{
			$urutan = $row->urutan;
		}
	
			$urutan = $urutan + 1;
		
		$insert = array(
			
			'id_mesin' => $id_mesin,
			'jenis_mesin' => $jenis_mesin,
			'urutan' => $urutan
		
		);
		$this->m_mesin->input_mesin($insert);
		redirect('master_mesin/c_tampil_mesin');
	}
	
	function update_mesin(){
	
		$banyak_mesin = $this->m_mesin->penghitungan_mesin();
		$waktu_produksi = 0;
		$lot_size = 0;
		for($a=1;$a <= $banyak_mesin; $a++)
		{
			
			$update = array(
				$this->input->POST('nama_barang')."_waktu_proses" => $this->input->POST('waktu_produksi'.$a),
				$this->input->POST('nama_barang')."_lot_size" => $this->input->POST('lot_size'.$a)
			);
			
		
			$jenis_mesin = $this->input->POST('jenis_mesin'.$a);
			
			$this->m_mesin->update_waktu_lot($jenis_mesin, $update);
			
			$waktu_produksi = $waktu_produksi + $this->input->POST('waktu_produksi'.$a);
			$lot_size = $lot_size + $this->input->POST('lot_size'.$a);
		}
		
		$update2 = array(
				'wkt_prdksi' => $waktu_produksi,
				'lot_size' => $lot_size
			);
			$this->m_barang->update_waktu_lot($this->input->POST('id_barang'), $update2);
	redirect('master_barang/c_tampil_barang');
		
	}
}
?>