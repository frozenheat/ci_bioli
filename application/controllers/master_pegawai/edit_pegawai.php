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
	
	$data['body']="ubah";
	$data['bagian']="pegawai";
	
	$data['id_pegawai'] = $this->input->POST('id_pegawai');
	$data['nama_pegawai'] = $this->input->POST('nama_pegawai');
	$data['alamat_email'] = $this->input->POST('alamat_email');
	$data['alamat_pegawai'] = $this->input->POST('alamat_pegawai');
	$data['telp_pegawai'] = $this->input->POST('telp_pegawai');
	//$data['otoritas'] = $this->input->POST('otoritas');
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['otoritas']=$session_data['otoritas'];
			$this->load->view('hlm_utm',$data);
	
		}
	}
	
	
	}

	
	function ubah_pegawai()
	{
	$id_pegawai = $this->input->post('id_pegawai');
	$nama_file = $_FILES['foto']['name'];
	echo $_FILES['foto']['name'];
	$directory= "./uploads/".$id_pegawai;
	$check = file_exists($directory);
	if($check == true)
	{

		$files = glob($directory.'/*'); // get all file names
		foreach($files as $filez){ // iterate files
		if(is_file($filez))
		{
		unlink($filez); // delete file
		}
		}
	$upload = $directory."/".$nama_file;
	move_uploaded_file($_FILES['foto']['tmp_name'], $upload);
	}
	else
	{
	mkdir($directory);
	$upload = $directory."/".$nama_file;
	move_uploaded_file($_FILES['foto']['tmp_name'], $upload);
	}
	
	$ubah = array(
		
		'nm_pgw' => $this->input->POST('nama_pegawai'),
		'almt_pgw' => $this->input->POST('almt_pgw'),
		'telp_pgw' => $this->input->POST('telp'),
		'almt_email_pgw' => $this->input->POST('almt_email'),
		'otoritas' => $this->input->POST('otoritas'),
		'image_path' => base_url().substr($directory,2)."/".$nama_file
	);

	if ($this->input->POST('password')=='')
	{	
		$password = $this->m_pegawai->select_password($this->input->post('id_pegawai'));
		foreach ($password as $row)
		{
			$ubah['password'] = $row->password;
		}
	}
	else
	{
			$ubah['password'] = $this->input->POST('password');
	}
	
	$id_pgw = $this->input->POST('id_pegawai');
	
	
	$this->m_pegawai->ubah_pegawai($ubah, $id_pgw);
	
	redirect('master_pegawai/c_tampil_pegawai');
	
	}
	
}

?>