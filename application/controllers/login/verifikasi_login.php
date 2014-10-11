<?php
class verifikasi_login extends CI_Controller{
function __construct()
		{
			parent::__construct();
			$this->load->model('m_login');
		}

function index()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password','Password', 'trim|required|xss_clean|callback_check_database');
			
			if($this->form_validation->run()== FALSE)
			{
				$this->load->view("hlm_login");
			}
			else
			{
				redirect('admin/c_halaman_utama','refresh');
			}
		}
		
		function check_database($password)
		{
			$username=$this->input->post('username');
			
			//mengambil hasil query dari m_login
			$result = $this->m_login->login($username, $password);
			
			if($result)//artinya kalo ada result yang dihasilkan
			{
				$sess_array= array();
				foreach($result as $row)
				{
					$sess_array = array(
						'id_pegawai' => $row->id_pgw,
						'nama_pegawai'=>$row->nm_pgw,
						'otoritas'=>$row->otoritas
					);
					$this->session->set_userdata('logged_in',$sess_array);
				}
				return TRUE;
	
		}
		else{
			$this->form_validation->set_message('check_database','Invalid username or password');
			return false;
		}
		}
}
?>