<?php
class c_input_pelanggan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_pelanggan');
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
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
		{
		@$acak.=strtoupper($line);
		$no++;
		if (($no >= 7)) break;
		}
		$id_pelanggan = 'c'.$acak;
		
		$insert=array(
		
			'id_pln' => $id_pelanggan,
			'nm_pln' => $this->input->post('nama_pelanggan'),
			'almt_pln' => $this->input->post('alamat_pelanggan'),
			'almt_email' => $this->input->post('alamat_email'),
			'no_telp' => $this->input->post('no_telp'),
			'password' => $this->input->post('password'),
		
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