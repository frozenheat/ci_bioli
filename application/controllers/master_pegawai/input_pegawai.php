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
	$insert=array(
	'id_pgw' => $id_pegawai,
	'nm_pgw' => $this->input->post('nama_pegawai'),
	'almt_pgw' => $this->input->post('almt_pgw'),
	'almt_email_pgw' => $this->input->post('almt_email'),
	'telp_pgw' => $this->input->post('telp'),
	'otoritas' => $this->input->post('otoritas'),
	'password' => $this->input->post('password'),
	);
	
	$this->m_pegawai->input_pegawai($insert);
	}
	redirect('master_pegawai/c_tampil_pegawai');
	
	}
	
}

?>