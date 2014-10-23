<?php

class edit_pelanggan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pelanggan');
	}

	function index()
	{

	if ($this->input->POST('tindak') == 'hapus')
	{
		$delete = array(
			
			'id_pln' => $this->input->POST('id_pelanggan'),
		
		);
		
		
		
		$this->m_pelanggan->delete_pelanggan($delete);
		redirect('master_pelanggan/c_tampil_pelanggan');
		
	}
	
	else if ($this->input->POST('tindak') == 'ubah')
	{
	
		$data['body']="ubah";
		$data['bagian']="master_pelanggan";
	
		$data['id_pelanggan'] = $this->input->POST('id_pelanggan');
		$data['nama_pelanggan'] = $this->input->POST('nama_pelanggan');
		$data['alamat_email'] = $this->input->POST('alamat_email');
		$data['alamat_pelanggan'] = $this->input->POST('alamat_pelanggan');
		$data['telp_pelanggan'] = $this->input->POST('telp_pelanggan');
	
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['otoritas']=$session_data['otoritas'];
			$this->load->view('hlm_utm',$data);
	
		}
	
	}
	
	}
	
	function ubah_pelanggan()
	{
	
	
	
	if ($this->input->POST('password')=='')
	{
		$result = $this->m_pelanggan->select_password($this->input->post('id_pelanggan'));
		foreach ($result as $row)
		{
			$password = $row->password;
		}
	}
	else
	{
		$password = $this->input->POST('password');
	}
	
	$ubah = array(
	
		'nm_pln'=> $this->input->POST('nama_pelanggan'),
		'almt_pln'=> $this->input->POST('alamat_pelanggan'),
		'almt_email'=> $this->input->POST('alamat_email'),
		'no_telp'=> $this->input->POST('telp_pelanggan'),
		'password' => $password
	);
	
	$id_pelanggan = $this->input->POST('id_pelanggan');
	
	$this->m_pelanggan->ubah_pelanggan($ubah, $id_pelanggan);
	redirect('master_pelanggan/c_tampil_pelanggan');
	
	}
}

?>