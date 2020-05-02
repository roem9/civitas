<?php

class Inbox extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Civitas_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function index(){
        $nip = $this->session->userdata('id');
        
        $this->Civitas_model->edit_status_inbox($nip);

        $data['title'] = "Inbox";
        
        $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
        $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
        $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip));
        
        $data['jml'] = [
            "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')),
            "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')),
            "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')),
            "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')),
            "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')),
            "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')),
            "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad'))
        ];

        $data['inbox'] = $this->Civitas_model->get_all_inbox($nip);
        $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
        
        $this->load->view("templates/header", $data);
        $this->load->view("page/inbox", $data);
        $this->load->view("templates/footer");
    }

    // delete
        public function delete_inbox($id){
            $data = $this->Civitas_model->delete_inbox($id);
            
            if($data == 0){
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal menghapus pesan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menghapus pesan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }

            redirect($_SERVER['HTTP_REFERER']);
        }
    // delete
}