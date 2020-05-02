<?php
class Login extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index(){
        $data['header'] = 'Login';
        $data['title'] = 'Login';

        $this->load->view("templates/header-login", $data);
        $this->load->view("login/login");
        $this->load->view("templates/footer");
    }

    public function cekLogin(){
		// $where = array(
		// 	'id_admin' => $username,
        //     'password' => $password,
        //     'level' => 'kpq'
		// 	);
        // $cek = $this->Login_model->cekLogin("admin",$where)->num_rows();
        $cek = COUNT($this->Login_model->cek_login());
        $data = $this->Login_model->cek_login();
		if($cek > 0){
 
			$data_session = array(
				'id' => $data['nip'],
                'status' => "login",
                'gol' => $data['golongan'],
                'jk' => $data['jk']
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("home"));
 
		}else{
            $this->session->set_flashdata('login', 'Maaf, kombinasi username dan password salah');
			redirect(base_url("login"));
		}

    }

    function logout(){
        // $this->session->set_flashdata('login', 'Berhasil logout');
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }
}