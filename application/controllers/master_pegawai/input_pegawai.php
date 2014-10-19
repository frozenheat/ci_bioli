<?php
class input_pegawai extends CI_Controller
{

	
	
	function __construct()
	{
	parent::__construct();
	$this->load->model('m_pegawai');
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
	
	$array_word=array('0','1','2','3','4','5','6','7','8','9');
	shuffle($array_word);
	reset($array_word);
	$no=0;
	foreach($array_word as $line)
	{
	@$acak.=strtoupper($line);
	$no++;
	if (($no >= 5)) break;
	}
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