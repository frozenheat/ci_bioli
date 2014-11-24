<?php
class input_pesanan extends CI_Controller
{
 function __construct()
 {
	parent::__construct();
		$this->load->model('m_pesanan_barang');
		$this->load->model('m_barang');
		$this->load->model('m_waktu');
		$this->load->model('m_acak');
 }
 
	
		function index()
		{
			if ($this->input->POST('database') == 'pegawai')
			{
				echo $this->input->POST('database');
			}
			else if ($this->input->POST('database')== 'pelanggan')
			{
			
				
				//setting waktu local
				$this->m_waktu->setting_waktu_local();
				$time = time();
				$datestring = "%d%m%Y";
				$tanggalsistem=mdate($datestring, $time);
				
				$result=$this->m_pesanan_barang->pilih_jenis_barang($this->input->POST('nama_barang'));
				
				foreach ($result as $row)
				{
					$jenis_barang = $row->nm_jns_brng;
				}
				
				$result = $this->m_barang->pencarian_jenis_barang($jenis_barang);
				
				foreach ($result as $row)
				{
					$id_jenis_barang = $row->id_jns_brng;
				}
				
				
				//pengacakan no id
				$acak = $this->m_acak->input_pesanan();
				
				
				$id_pesanan_barang = $id_jenis_barang.$tanggalsistem.$acak;
				//echo $id_pesanan_barang;
				
				//lanjutkan penginputan data pesanan ke dalam database pesanan barang
				
				$datestring = "%Y-%m-%d";
				$tanggalsistem=mdate($datestring, $time);
				
				$datestring = "%H:%i:%s";
				$jamsistem = mdate($datestring, $time);
				
				//echo $jamsistem;
				//echo $this->input->post('nama_barang');
				
				$insert = array(
					
					'id_pesanan' => $id_pesanan_barang,
					'id_pemesan' => $this->input->post('id_pelanggan'),
					'nama_barang'=> $this->input->post('nama_barang'),
					'tanggal_pemesanan' => $tanggalsistem,
					'jam_pemesanan' => $jamsistem,
					'jumlah_pesanan' => $this->input->post('jml_psn'),
					'status_pesanan' => 'belum_diproses',
					'sts_konfirm' => 'belum_konfirmasi'
				);
				
				$this->m_pesanan_barang->input_pesanan($insert);
				
				redirect('master_pesanan_pelanggan/c_tampil_pesanan');
			}
		}
}
?>