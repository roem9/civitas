<?php

class Pengaturan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Civitas_model');
        $this->load->model('Main_model');
        if($this->session->userdata('status') != "login" || empty($this->session->userdata('id'))){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
		}
    }

    public function password(){
        $nip = $this->session->userdata('id');

        $data['title'] = "Pengaturan Password";
        
        // sidebar
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
        // sidebar
        
        $data['kpq'] = $this->Civitas_model->get_data_kpq($nip);
        
        $this->load->view("templates/header", $data);
        $this->load->view("page/pengaturan", $data);
        $this->load->view("templates/footer");
    }
    
    public function profil(){
        $nip = $this->session->userdata('id');
        $data['title'] = "Pengaturan Profil";
        
        // sidebar
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
        // sidebar

        // $data['kpq'] = $this->Civitas_model->get_data_kpq($nip);
        $data['kpq'] = $this->Main_model->get_one("kpq", ["nip" => $nip]);
        
        // var_dump($data['sedia']);
        $this->load->view("templates/header", $data);
        $this->load->view("page/profil", $data);
        $this->load->view("templates/footer");
    }

    // edit
        public function edit_kpq(){
            $nip = $this->session->userdata("id");
            // $data = $this->Civitas_model->edit_kpq();
            $data = [
                "t4_lahir" => $this->input->post("t4_lahir", TRUE),
                "tgl_lahir" => $this->input->post("tgl_lahir", TRUE),
                "no_hp" => $this->input->post("no_hp", TRUE),
                "alamat" => $this->input->post("alamat", TRUE),
                "tgl_masuk" => $this->input->post("tgl_masuk", TRUE),
                "pendidikan" => $this->input->post("pendidikan", TRUE),
                "jurusan" => $this->input->post("jurusan", TRUE),
                "no_ktp" => $this->input->post("no_ktp", TRUE)
            ];
            $result = $this->Main_model->edit_data("kpq", ["nip" => $nip], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengubah data profil Anda<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-circle text-warning mr-1"></i> Data profil Anda tidak berubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_password(){
            $pass1 = $this->input->post("pass1", TRUE);
            $pass2 = $this->input->post("pass2", TRUE);
            if($pass1 === $pass2){
                $nip = $this->session->userdata("id");
                $data = [
                    "password" => $pass1
                ];
                // $data = $this->Civitas_model->edit_password();
                $result = $this->Main_model->edit_data("admin", ["id_admin" => $nip], $data);
                if($result)
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah password<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                else
                    $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-circle text-warning mr-1"></i> Password Anda tidak berubah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal merubah password. Form password dan konfirm password harus sama<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // add
        public function add_kesediaan(){
            $nip = $this->session->userdata("id");
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
                    $result = $this->Main_model->add_data("kesediaan", $data);
                }
                if($result)
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengubah data kesediaan mengajar<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                else
                    $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-circle text-warning mr-1"></i> Data kesediaan mengajar Anda kosong<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add
}