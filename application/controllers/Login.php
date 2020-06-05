<?php
class Login extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Main_model');
        $this->load->helper('form');
    }

    public function index(){
        if($_POST){
            $this->cekLogin();
        } else {
            $data['header'] = 'Login';
            $data['title'] = 'Login';
    
            $this->load->view("templates/header-login", $data);
            $this->load->view("login/login");
            $this->load->view("templates/footer");
        }
    }

    public function cekLogin(){
        $data = $this->Login_model->cek_login();
		if($data){
            $this->Login_model->status_login($data['nip']);
			$data_session = array(
				'id' => $data['nip'],
                'status' => "login",
                'gol' => $data['golongan'],
                'jk' => $data['jk']
				);
			$this->session->set_userdata($data_session);
			redirect(base_url("home"));
		}else{
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Maaf, kombinasi NIK dan password salah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            $data['header'] = 'Login';
            $data['title'] = 'Login';
    
            $this->load->view("templates/header-login", $data);
            $this->load->view("login/login");
            $this->load->view("templates/footer");
		}
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }
}