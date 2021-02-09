<?php

class Kesediaan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Civitas_model');
        $this->load->model('Main_model');
        if(!$this->session->userdata('nip')){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("auth"));
		}
    }

    public function index(){
        $data = $this->Main_model->sidebar();
        $nip = $this->session->userdata('nip');
        
        $this->Civitas_model->edit_status_inbox($nip);

        $data['title'] = "Kesediaan Mengajar";

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
        // public function add_kesediaan(){
        //         $data = $this->Civitas_model->add_kesediaan();
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mengubah data kesediaan mengajar<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
        
        public function add_kesediaan(){
            $nip = $this->session->userdata('nip');
            // delete kesediaan seluruhnya
                $this->Main_model->delete_data("kesediaan", ["nip" => $nip]);
            // delete kesediaan seluruhnya
            $sedia = $this->input->post("sedia");
            if($sedia){
                foreach ($sedia as $sedia) {
                    $data = explode("|", $sedia);
                    $kesediaan = [
                        "hari" => $data[0],
                        "jam" => $data[1],
                        "nip" => $nip
                    ];
                    $this->Main_model->add_data("kesediaan", $kesediaan);
                }
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengubah data kesediaan mengajar<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-circle text-warning mr-1"></i> Data kesediaan mengajar Anda kosong<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add
}