<?php
class input_pegawai extends CI_Controller
{

	
	
	function __construct()
	{
	parent::__construct();
	$this->load->model('m_pegawai');
	$this->load->model('m_acak');
	}
	
	function index()
	{
	
	$this->load->library('form_validation');
	$this->form_validation->set_rules('nama_pegawai','Nama_pegawai','trim|required|xss_clean');
	$this->form_validation->set_rules('almt_pgw','Almt_pegawai','trim|required|xss_clean');
	$this->form_validation->set_rules('almt_email','Almt_email','trim|required|xss_clean');
	$this->form_validation->set_rules('telp','Telp','trim|required|xss_clean');
	$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
	

	
	if($this->form_validation->run()==true)
	{
	
	$acak = $this->m_acak->input_pegawai();
	
	$result=$this->m_pegawai->id_otoritas($this->input->post('otoritas'));
	foreach ($result as $row)
	{
		$id = $row->id_otoritas;
	}
	

	
	$id_pegawai= $id.$acak;
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
	
	
 
	
	
	$insert=array(
	'id_pgw' => $id_pegawai,
	'nm_pgw' => $this->input->post('nama_pegawai'),
	'almt_pgw' => $this->input->post('almt_pgw'),
	'almt_email_pgw' => $this->input->post('almt_email'),
	'telp_pgw' => $this->input->post('telp'),
	'otoritas' => $this->input->post('otoritas'),
	'password' => $this->input->post('password'),
	'image_path' => base_url().substr($directory,2)."/".$nama_file
	);
	
	$this->m_pegawai->input_pegawai($insert);
	}
	redirect('master_pegawai/c_tampil_pegawai');
	
	}
	
}

?>