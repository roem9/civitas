<?php

class Kesediaan extends CI_CONTROLLER{
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

        $data['title'] = "Kesediaan Mengajar";
        
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

        $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
        $sedia = $this->Civitas_model->get_all_kesediaan($nip);

        foreach ($sedia as $i => $sedia) {
            $data['sedia'][$i] = $sedia['hari'] . " " . $sedia['jam'];
        }
        
        // var_dump($data['sedia']);
        $this->load->view("templates/header", $data);
        $this->load->view("page/kesediaan", $data);
        $this->load->view("templates/footer");
    }

    // add
        public function add_kesediaan(){
            $data = $this->Civitas_model->add_kesediaan();
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mengubah data kesediaan mengajar<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }
    // add
}