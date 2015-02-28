<?php
class verifikasi_login extends CI_Controller{
function __construct()
		{
			parent::__construct();
			$this->load->model('m_login');
			$this->load->model('penampilan_data');
		}
		
		//function percobaan($username,$password)
		//{
			//$result=$this->penampilan_data->pegawai($username,$password);
			//$data=array();
			
			//foreach($result['query'] as $row)
			//{
				//$data=array(
				//'database'=>$row->database,
				//'nama_pegawai'=>$row->nm_pgw,
				//'password'=>$row->password);
			//}
			
			//$data["database"]=$result["database"];	// harus ditaruh dibawah setelah deklarasi $data = array()diatas
			//$this->load->view('penampilan_data',$data);
		//}

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
				redirect('c_halaman_utama','refresh');
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
				if($result['database']=='1')
				{
				foreach($result['query'] as $row)
				{
					$sess_array = array(
						'id_pegawai' => $row->id_pgw,
						'nama_pegawai'=>$row->nm_pgw,
						'otoritas'=>$row->otoritas,
						'database'=>'pegawai',
						'image_path'=> $row->image_path
					);
					$this->session->set_userdata('logged_in',$sess_array);
				}
				}
				elseif($result['database']=='2')
				{
					foreach($result['query'] as $row)
					{
					$sess_array = array(
						'id_pelanggan' => $row->id_pln,
						'nama_pelanggan'=>$row->nm_pln,
						'otoritas'=>'pelanggan',
						'database'=>'pelanggan',
						'image_path'=> $row->image_path
						//database dipakai apabila ada 1 halaman yang dipakai oleh pegawai atau pelanggan
					);
					}
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