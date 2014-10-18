<?php
class c_tampil_pegawai extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_pegawai');
		
		
	}

	function index()
	{
	$data['body']="master_pegawai";
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['database']=$session_data['database'];
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$data['data_pegawai']=$this->m_pegawai->tampil_pegawai();
			$this->load->view('hlm_utm',$data);
	
		}
	}

	
	function input_pegawai()
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
	
	$data['body']="master_pegawai";
	
	if($this->session->userdata('logged_in'))
		{
			$session_data=$this->session->userdata('logged_in');;
			$data['database']=$session_data['database'];
			$data['id_pegawai']=$session_data['id_pegawai'];
			$data['otoritas']=$session_data['otoritas'];
			$data['data_pegawai']=$this->m_pegawai->tampil_pegawai();
			$this->load->view('hlm_utm',$data);
	
		}
	}

}

?>
