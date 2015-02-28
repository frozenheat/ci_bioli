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
	
	$id_pelanggan = $this->input->POST('id_pelanggan');
	
	$nama_file = $_FILES['foto']['name'];
	echo $_FILES['foto']['name'];
	$directory= "./uploads/pelanggan/".$id_pelanggan;
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
	
		'nm_pln'=> $this->input->POST('nama_pelanggan'),
		'almt_pln'=> $this->input->POST('alamat_pelanggan'),
		'almt_email'=> $this->input->POST('alamat_email'),
		'no_telp'=> $this->input->POST('telp_pelanggan'),
		'password' => $password,
		'image_path' => base_url().substr($directory,2)."/".$nama_file
	);
	
	
	
	$this->m_pelanggan->ubah_pelanggan($ubah, $id_pelanggan);
	redirect('master_pelanggan/c_tampil_pelanggan');
	
	}
}

?>