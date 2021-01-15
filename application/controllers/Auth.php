<?php
class Auth extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Main_model');
        $this->load->helper(array('Form', 'Cookie', 'String'));
    }

    public function index(){
        
        if($_POST){
            $this->login();
        } else {
            // ambil cookie
            $cookie = get_cookie('kpq');
            // cek session
            if ($this->session->userdata('nip')) {
                redirect("home");
            } else if($cookie <> '') {
                // cek cookie
                $row = $this->Main_model->get_one("kpq", ["cookie" => $cookie]);
                // $row = $this->Login_model->cek_login();
    
                if ($row) {
                    $this->_daftarkan_session($row);
                } else {
                    $data['header'] = 'Login';
                    $data['title'] = 'Login';
                    $this->load->view("templates/header-login", $data);
                    $this->load->view("login/login");
                    $this->load->view("templates/footer");
                }
            } else {
                $data['header'] = 'Login';
                $data['title'] = 'Login';
                $this->load->view("templates/header-login", $data);
                $this->load->view("login/login");
                $this->load->view("templates/footer");
            }
        }
    }


    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post("password", TRUE);
        $remember = $this->input->post('remember');
        // $row = $this->Main_model->get_one("kpq", ["nip" => $username, "password" => $password]);
        $row = $this->Login_model->cek_login();

        if ($row) {
            // login berhasil
            // 1. Buat Cookies jika remember di check
            if ($remember) {
                $key = random_string('alnum', 64);
                set_cookie('kpq', $key, 3600*24*365); // set expired 30 hari kedepan
                // simpan key di database
                
                $this->Main_model->edit_data("kpq", ["nip" => $row['nip']], ["cookie" => $key]);
            }
            $this->_daftarkan_session($row);
        } else {
            // login gagal
            // $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i>Maaf, kombinasi username dan password salah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect('auth');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Maaf, kombinasi NIK dan password salah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            $data['header'] = 'Login';
            $data['title'] = 'Login';
    
            $this->load->view("templates/header-login", $data);
            $this->load->view("login/login");
            $this->load->view("templates/footer");
        }
    }

    public function _daftarkan_session($row) {
        // 1. Daftarkan Session
        $sess = array(
            'nip' => $row['nip'],
            'logged' => TRUE,
            'jk' => $row['jk'],
        );
        $this->session->set_userdata($sess);
        // 2. Redirect ke home
        redirect("home");
    }

    public function logout(){
        // delete cookie dan session
        delete_cookie('kpq');
        $this->session->sess_destroy();
        redirect('auth');
    }
}