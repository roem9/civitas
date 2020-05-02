<?php

class Kelas extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Civitas_model');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("login"));
		}
    }

    public function index(){
        $data['title'] = "Jadwal KBM Semua Hari";
        $nip = $this->session->userdata("id");

        $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
        $data['kpq'] = $this->Civitas_model->get_all_kpq();
        $data['program'] = $this->Civitas_model->get_all_program();
        $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
        $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip));
        
        $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
        $data['jml'] = [
            "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')),
            "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')),
            "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')),
            "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')),
            "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')),
            "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')),
            "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad'))
        ];

        // $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_kelas_kpq($nip));

        $data['kelas'] = $this->Civitas_model->get_all_jadwal_kpq($nip);
        
        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/kelas", $data);
        $this->load->view("templates/footer", $data);
    }

    public function hari($hari){
        $data['title'] = "Jadwal KBM " . ucwords($hari);
        $nip = $this->session->userdata("id");
        
        $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
        $data['kpq'] = $this->Civitas_model->get_all_kpq();
        $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
        $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip));

        $data['program'] = $this->Civitas_model->get_all_program();

        $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
        $data['jml'] = [
            "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')),
            "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')),
            "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')),
            "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')),
            "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')),
            "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')),
            "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad'))
        ];

        $data['kelas'] = $this->Civitas_model->get_jadwal_hari_kpq($nip, $hari);
        
        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/kelas", $data);
        $this->load->view("templates/footer", $data);
    }

    public function badal(){
        $data['title'] = "Jadwal Badal";
        $nip = $this->session->userdata("id");
        
        $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
        $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
        $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip));
        $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
        $data['jml'] = [
            "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')),
            "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')),
            "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')),
            "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')),
            "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')),
            "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')),
            "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad'))
        ];


        $data['kelas'] = $this->Civitas_model->get_all_jadwal_badal_kpq($nip);
        
        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/badal", $data);
        $this->load->view("templates/footer", $data);

    }

    public function wl(){
        $data['title'] = "Waiting List";
        $nip = $this->session->userdata("id");
        
        $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
        $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
        $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip));
        $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
        $data['jml'] = [
            "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')),
            "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')),
            "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')),
            "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')),
            "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')),
            "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')),
            "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad'))
        ];

        $data['kelas'] = $this->Civitas_model->get_all_wl();
        
        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/wl", $data);
        $this->load->view("templates/footer", $data);

    }


    // edit
        public function edit_program(){
            $this->Civitas_model->edit_program();
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mengubah program<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // edit

    // add
        public function add_badal(){
            $this->Civitas_model->add_badal();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mengajukan badal, silahkan tunggu konfirmasi di inbox<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_kbm(){
            // var_dump($_POST);
            $this->Civitas_model->add_kbm();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menambahkakn KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }

        public function rekap_badal(){
            $this->Civitas_model->rekap_badal();
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil merekap badal<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect($_SERVER['HTTP_REFERER']);
        }

        public function ambil_wl($id){
            $data = $this->Civitas_model->ambil_kelas_wl($id);
            
            if($data == 1){
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil mengambil waiting list. Cek Inbox Anda untuk mengetahui konfirmasi waiting list yang Anda ambil<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal mengambil waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // get
        public function get_peserta_aktif(){
            $id = $this->input->post("id");

            $data = $this->Civitas_model->get_peserta_aktif($id);
            echo json_encode($data);
        }

        public function get_detail_kbm(){
            $id = $this->input->post("id");

            $data = $this->Civitas_model->get_detail_kbm($id);
            echo json_encode($data);
        }

        public function get_catatan_badal(){
            $id = $this->input->post("id");

            $data = $this->Civitas_model->get_catatan_badal($id);
            echo json_encode($data);
        }

        public function get_catatan_kelas(){
            $id = $this->input->post("id");

            $data = $this->Civitas_model->get_catatan_kelas($id);
            echo json_encode($data);
        }
    // get

    // delete
        public function delete_kbm($id){
            $data = $this->Civitas_model->delete_kbm($id);
            // var_dump($data);
            if($data == 0){
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal menghapus KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil menghapus KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // delete
}