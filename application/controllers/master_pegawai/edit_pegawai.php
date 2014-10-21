<?php

class edit_pegawai extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pegawai');
	}

	function index()
	{

	if ($this->input->POST('tindak') == 'hapus')
	{
		$delete = array(
			
			'id_pgw' => $this->input->POST('id_pegawai'),
		
		);
		
		
		
		$this->m_pegawai->delete_pegawai($delete);
		redirect('master_pegawai/c_tampil_pegawai');
		
	}
	else if ($this->input->POST('tindak')=='ubah')
	{
	
	$data['body']="ubah_pegawai";
	
	$data['id_pegawai'] = $this->input->POST('id_pegawai');
	$data['nama_pegawai'] = $this->input->POST('nama_pegawai');
	$data['alamat_email'] = $this->input->POST('alamat_email');
	$data['alamat_pegawai'] = $this->input->POST('alamat_pegawai');
	$data['telp_pegawai'] = $this->input->POST('telp_pegawai');
	//$data['otoritas'] = $this->input->POST('otoritas');
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['database']=$session_data['database'];
			
			$data['otoritas']=$session_data['otoritas'];
			$data['data_pegawai']=$this->m_pegawai->tampil_pegawai();
			$this->load->view('hlm_utm',$data);
	
		}
	}
	
	
	}

	
	function ubah_pegawai()
	{
	
	$ubah = array(
		
		'nm_pgw' => $this->input->POST('nama_pegawai'),
		'almt_pgw' => $this->input->POST('almt_pgw'),
		'telp_pgw' => $this->input->POST('telp'),
		'almt_email_pgw' => $this->input->POST('almt_email'),
		'otoritas' => $this->input->POST('otoritas'),
		'password' => $this->input->POST('password')
		
	);
	
	$id_pgw = $this->input->POST('id_pegawai');
	
	
	$this->m_pegawai->ubah_pegawai($ubah, $id_pgw);
	
	redirect('master_pegawai/c_tampil_pegawai');
	
	}
	
}

?>