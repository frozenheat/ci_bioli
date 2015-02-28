<?php
class c_input_pelanggan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pelanggan');
		$this->load->model('m_acak');
		$this->load->model('m_waktu');
	}

	function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_pelanggan','Nama_pelanggan','trim|required|xss_clean');
		$this->form_validation->set_rules('alamat_pelanggan','Alamat_pelanggan','trim|required|xss_clean');
		$this->form_validation->set_rules('alamat_email','Alamat_email','trim|required|xss_clean');
		$this->form_validation->set_rules('no_telp','No_telp','trim|required|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
		
	if($this->form_validation->run()==true)
	{
	
		$acak = $this->m_acak->input_pelanggan();
		$this->m_waktu->setting_waktu_local();
		$time = time();
		$datestring ='%d%m%Y';
		$tanggalsistem = mdate($datestring,$time);
		$id_pelanggan = 'c'.$tanggalsistem.$acak;
		
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
		
		
		$insert=array(
		
			'id_pln' => $id_pelanggan,
			'nm_pln' => $this->input->post('nama_pelanggan'),
			'almt_pln' => $this->input->post('alamat_pelanggan'),
			'almt_email' => $this->input->post('alamat_email'),
			'no_telp' => $this->input->post('no_telp'),
			'password' => $this->input->post('password'),
			'image_path' => base_url().substr($directory,2)."/".$nama_file
		
		);
		
		$this->m_pelanggan->input_pelanggan($insert);
		
	}
	else
	{
		return false;
	}
	redirect('master_pelanggan/c_tampil_pelanggan');
	
}
}

?>