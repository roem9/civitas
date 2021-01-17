<?php

class Kelas extends CI_CONTROLLER{
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
        $data['title'] = "Jadwal KBM Semua Hari";
        $nip = $this->session->userdata('nip');

        // kbm pembinaan badal 
            $badal = 0;
            $kbm = $this->Main_model->get_all("kbm_pembinaan", ["MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]);
            foreach ($kbm as $kbm) {
                $cek = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $kbm['id_kbm']]);
                if($cek) $badal++;
            }
        // kbm pembinaan badal 

        // sidebar
            $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
            $data['kpq'] = $this->Civitas_model->get_all_kpq();
            $data['program'] = $this->Civitas_model->get_all_program();
            $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
            $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip)) + $badal;
            $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip)) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif"]));
            $data['jml'] = [
                "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "senin"])),
                "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "selasa"])),
                "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "rabu"])),
                "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "kamis"])),
                "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "jumat"])),
                "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "sabtu"])),
                "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "ahad"]))
            ];
        // sidebar

        // $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_kelas_kpq($nip));
        
        $data['kelas_pembinaan'] = [];
        $data['kelas'] = $this->Civitas_model->get_all_jadwal_kpq($nip);
        $kelas_pembinaan = $this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif"]);
        foreach ($kelas_pembinaan as $i => $kelas) {
            $data['kelas_pembinaan'][$i] = $kelas;
            $data['kelas_pembinaan'][$i]['kbm'] = COUNT($this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $kelas['id_kelas'], "MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]));
            // $data['kelas_pembinaan']['kbm'] = 1;

        }

        // var_dump($data['kelas_pembinaan']);
        // exit();
        
        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/kelas", $data);
        $this->load->view("templates/footer", $data);
    }

    public function hari($hari){
        $data['title'] = "Jadwal KBM " . ucwords($hari);
        $nip = $this->session->userdata('nip');
        
        $data['program'] = $this->Civitas_model->get_all_program();
        // kbm pembinaan badal 
            $badal = 0;
            $kbm = $this->Main_model->get_all("kbm_pembinaan", ["MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]);
            foreach ($kbm as $kbm) {
                $cek = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $kbm['id_kbm']]);
                if($cek) $badal++;
            }
        // kbm pembinaan badal 

        // sidebar
            $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
            $data['kpq'] = $this->Civitas_model->get_all_kpq();
            $data['program'] = $this->Civitas_model->get_all_program();
            $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
            $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip)) + $badal;
            $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip)) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif"]));
            $data['jml'] = [
                "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "senin"])),
                "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "selasa"])),
                "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "rabu"])),
                "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "kamis"])),
                "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "jumat"])),
                "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "sabtu"])),
                "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "ahad"]))
            ];
        // sidebar
        
        $data['kelas_pembinaan'] = [];
        $data['kelas'] = $this->Civitas_model->get_jadwal_hari_kpq($nip, $hari);
        $kelas_pembinaan = $this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => $hari]);
        foreach ($kelas_pembinaan as $i => $kelas) {
            $data['kelas_pembinaan'][$i] = $kelas;
            $data['kelas_pembinaan'][$i]['kbm'] = COUNT($this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $kelas['id_kelas'], "MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]));
            // $data['kelas_pembinaan']['kbm'] = 1;

        }
        
        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/kelas", $data);
        $this->load->view("templates/footer", $data);
    }

    public function badal(){
        $data['title'] = "Jadwal Badal";
        $nip = $this->session->userdata('nip');
        
        // kbm pembinaan badal 
            $data['pembinaan'] = [];
            $badal = 0;
            $kbm = $this->Main_model->get_all("kbm_pembinaan", ["MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]);
            foreach ($kbm as $kbm) {
                $cek = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $kbm['id_kbm'], "rekap" => 0, "nip_badal" => $nip]);
                if($cek) {
                    $data['pembinaan'][$badal] = $kbm;
                    $kpq = $this->Main_model->get_one("kpq", ["nip" => $kbm['nip']]);
                    $data['pembinaan'][$badal]['nama_kpq'] = $kpq['nama_kpq'];
                    $badal++;
                }
            }
        // kbm pembinaan badal 

        // sidebar
            $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
            $data['kpq'] = $this->Civitas_model->get_all_kpq();
            $data['program'] = $this->Civitas_model->get_all_program();
            $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
            $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip)) + $badal;
            $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip)) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif"]));
            $data['jml'] = [
                "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "senin"])),
                "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "selasa"])),
                "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "rabu"])),
                "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "kamis"])),
                "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "jumat"])),
                "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "sabtu"])),
                "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "ahad"]))
            ];
        // sidebar

        $data['kelas'] = $this->Civitas_model->get_all_jadwal_badal_kpq($nip);
        
        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/badal", $data);
        $this->load->view("templates/footer", $data);

    }

    public function wl(){
        $data['title'] = "Waiting List";
        $nip = $this->session->userdata('nip');
        
        // kbm pembinaan badal 
            $data['pembinaan'] = [];
            $badal = 0;
            $kbm = $this->Main_model->get_all("kbm_pembinaan", ["MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]);
            foreach ($kbm as $kbm) {
                $cek = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $kbm['id_kbm'], "rekap" => 0, "nip_badal" => $nip]);
                if($cek) {
                    $data['pembinaan'][$badal] = $kbm;
                    $kpq = $this->Main_model->get_one("kpq", ["nip" => $kbm['nip']]);
                    $data['pembinaan'][$badal]['nama_kpq'] = $kpq['nama_kpq'];
                    $badal++;
                }
            }
        // kbm pembinaan badal 

        // sidebar
            $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
            $data['kpq'] = $this->Civitas_model->get_all_kpq();
            $data['program'] = $this->Civitas_model->get_all_program();
            $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
            $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip)) + $badal;
            $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip)) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif"]));
            $data['jml'] = [
                "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "senin"])),
                "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "selasa"])),
                "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "rabu"])),
                "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "kamis"])),
                "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "jumat"])),
                "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "sabtu"])),
                "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "ahad"]))
            ];
        // sidebar

        $data['kelas'] = [];
        $urut = 0;
        $konfirm = $this->Civitas_model->get_wl_konfirm($nip);
        
        foreach ($konfirm as $konfirm) {
            $data['kelas'][$urut] = $konfirm;
            $urut ++;
        }

        $wl = $this->Civitas_model->get_all_wl();
        foreach ($wl as $wl) {
            $data['kelas'][$urut] = $wl;
            $urut ++;
        }

        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/wl", $data);
        $this->load->view("templates/footer", $data);

    }

    public function pembinaan($id){
        $data['title'] = "Kelas Pembinaan";
        $nip = $this->session->userdata('nip');

        // kbm pembinaan badal 
            $badal = 0;
            $kbm = $this->Main_model->get_all("kbm_pembinaan", ["MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]);
            foreach ($kbm as $kbm) {
                $cek = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $kbm['id_kbm']]);
                if($cek) $badal++;
            }
        // kbm pembinaan badal 
        // sidebar
            $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
            $data['kpq'] = $this->Civitas_model->get_all_kpq();
            $data['program'] = $this->Civitas_model->get_all_program();
            $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
            $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip)) + $badal;
            $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip)) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif"]));
            $data['jml'] = [
                "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "senin"])),
                "selasa" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'selasa')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "selasa"])),
                "rabu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'rabu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "rabu"])),
                "kamis" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'kamis')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "kamis"])),
                "jumat" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'jumat')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "jumat"])),
                "sabtu" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'sabtu')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "sabtu"])),
                "ahad" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'ahad')) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif", "hari" => "ahad"]))
            ];
        // sidebar

        $data['kelas'] = $this->Main_model->get_one("kelas_pembinaan", ["md5(id_kelas)" => $id, "nip" => $nip]);
        $data['kelas']['kbm'] = COUNT($this->Main_model->get_all("kbm_pembinaan", ["md5(id_kelas)" => $id, "nip" => $nip, "MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]));

        // var_dump($data);
        $this->load->view("templates/header", $data);
        $this->load->view("page/kelas/detail-kelas-pembinaan", $data);
        $this->load->view("templates/footer", $data);
        
    }

    // edit
        public function edit_program(){
            // $this->Civitas_model->edit_program();
            $id = $this->input->post("id_kelas");
            $data = [
                "program" => $this->input->post("program")
            ];
            $result = $this->Main_model->edit_data("kelas", ["id_kelas" => $id], $data);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengubah program<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal mengubah program<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_kbm_pembinaan(){
            $tgl = $this->input->post("tgl");
            if(date("mY", strtotime($tgl)) == date("mY")){
                $id_kbm = $this->input->post("id_kbm");
                $materi = $this->input->post("materi");
                $tugas = $this->input->post("tugas");
    
                $data = [
                    "tgl" => $tgl,
                    "materi" => $materi,
                    "tugas" => $tugas,
                ];
    
                $this->Main_model->edit_data("kbm_pembinaan", ["id_kbm" => $id_kbm], $data);
    
                $peserta = $this->input->post("nip");
                $keterangan = $this->input->post("keterangan");
                foreach ($peserta as $i => $peserta) {
                    if($keterangan[$i] == "hadir") $hadir = 1;
                    else $hadir = 0;
    
                    $data = [
                        "hadir" => $hadir,
                        "keterangan" => $keterangan[$i]
                    ];
    
                    $this->Main_model->edit_data("presensi_kpq", ["id_presensi" => $peserta], $data);
                }
    
                $kelas = $this->Main_model->get_one("kbm_pembinaan", ["id_kbm" => $id_kbm]);
                echo json_encode($kelas['id_kelas']);
            } else {
                echo json_encode(0);
            }
        }
    // edit

    // add
        public function add_badal(){
            $tgl = $this->input->post("tgl");
            $id = $this->session->userdata('nip');
            $id_jadwal = $this->input->post("id_jadwal");
            $data = $this->Main_model->get_one("kbm", ["tgl" => $tgl, "nip" => $id, "id_jadwal" => $id_jadwal]);
            if($data){
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal mengajukan badal, Anda telah melakukan KBM di tanggal yang Anda masukkan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->Civitas_model->add_badal();
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengajukan badal, silahkan tunggu konfirmasi di inbox<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_kbm(){
            $tgl = $this->input->post("tgl");
            $id = $this->session->userdata('nip');
            $id_jadwal = $this->input->post("id_jadwal");
            $data = $this->Main_model->get_one("kbm", ["tgl" => $tgl, "nip" => $id, "id_jadwal" => $id_jadwal]);
            if($data){
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan KBM, Anda telah melakukan KBM di tanggal yang Anda masukkan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                if(date('my', strtotime($tgl)) == date('my')){
                    $this->Civitas_model->add_kbm();
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan KBM, Tgl KBM yang Anda masukkan tidak sesuai dengan periode saat ini<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        // public function add_kbm_pembinaan(){
        //     $tgl = $this->input->post("tgl");
        //     $id = $this->session->userdata('nip');
        //     $id_kelas = $this->input->post("id_kelas");
        //     $data = $this->Main_model->get_one("kbm_pembinaan", ["tgl" => $tgl, "id_kelas" => $id_kelas]);
        //     if($data){
        //         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan KBM, Anda telah melakukan KBM di tanggal yang Anda masukkan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        //     } else {
        //         if(date('my', strtotime($tgl)) == date('my')){
        //             $this->Civitas_model->add_kbm_pembinaan();
        //             $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        //         } else {
        //             $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan KBM, Tgl KBM yang Anda masukkan tidak sesuai dengan periode saat ini<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        //         }
        //     }
        //     redirect($_SERVER['HTTP_REFERER']);
        // }

        public function add_kbm_pembinaan(){
            $tgl = $this->input->post("tgl");
            if(date("mY", strtotime($tgl)) == date("mY")){

                $nip = $this->session->userdata('nip');
                $kpq = $this->Main_model->get_one("kpq", ["nip" => $nip]);
                $day = array('Sunday' => 'Ahad','Monday' => 'Senin','Tuesday' => 'Selasa','Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat','Saturday' => 'Sabtu');
    
                // kbm terakhir 
                $id = $this->Main_model->get_one("kbm_pembinaan", "", "id_kbm", "DESC");
                $id = $id['id_kbm'] + 1;
    
                // jadwal            
                $data = $this->Main_model->get_one("kelas_pembinaan", ["id_kelas" => $this->input->post("id_kelas")]);
                $hari = $data['hari'];
                $jam = $data['jam'];
    
                // honor 
                $gol = $this->Main_model->get_one("golongan", ["gol" => $kpq['golongan'], "tipe_kelas" => "reguler"]);
    
                // jumlah peserta 
                $jum_peserta = COUNT($this->Main_model->get_all("kelas_kpq", ["id_kelas" => $data['id_kelas']]));
    
                $kbm = [
                    "id_kbm" => $id,
                    "tgl" => $this->input->post("tgl"),
                    "hari" => $hari,
                    "jam" => $jam,
                    "keterangan" => "sesuai",
                    "id_kelas" => $this->input->post("id_kelas"),
                    "nip" => $this->session->userdata("nip"),
                    "biaya" => $gol['honor'],
                    "ot" => 0,
                    "program_kbm" => $data['program'],
                    "jum_peserta" => $jum_peserta,
                    "peserta" => "LKP TAR-Q",
                    "tugas" => $this->input->post("tugas"),
                    "materi" => $this->input->post("materi"),
                ];
    
                $cek = $this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $data['id_kelas'], "tgl" => $this->input->post("tgl")]);
                if($cek){
                    echo json_encode(0);
                } else {
                    $this->Main_model->add_data("kbm_pembinaan", $kbm);
                    
                    $nip = $this->input->post("nip");
                    $keterangan = $this->input->post("keterangan");
        
                    foreach ($nip as $i => $nip) {
                        if($keterangan[$i] == 'hadir') $hadir = 1;
                        else $hadir = 0;
        
                        $data = [
                            "id_kbm" => $id,
                            "nip" => $nip,
                            "hadir" => $hadir,
                            "keterangan" => $keterangan[$i]
                        ];
        
                        $this->db->insert("presensi_kpq", $data);
                    }
        
                    $jum_kbm = COUNT($this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $this->input->post("id_kelas"), "MONTH(tgl)" => date("m"), "YEAR(tgl)" => date("Y")]));
                    echo json_encode($jum_kbm);
                }
            } else {
                echo json_encode(0);
            }
        }
        
        public function add_kbm_badal_pembinaan(){
            $id_kelas = $this->input->post("id_kelas");
            $koor = "LKP TAR-Q";
            $tgl = $this->input->post("tgl");
            $nip_badal = $this->input->post("nip");
            
            $id = $this->session->userdata('nip');

            $hari = array('Sunday' => 'Ahad','Monday' => 'Senin','Tuesday' => 'Selasa','Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat','Saturday' => 'Sabtu');

            $data = $this->Main_model->get_one("kbm_pembinaan", ["id_kelas" => $id_kelas, "tgl" => $tgl]);
            if($data){
                echo json_encode(0);
            } else {
                if(date("mY", strtotime($tgl)) == date("mY")){
                    $kelas = $this->Main_model->get_one("kelas_pembinaan", ["id_kelas" => $id_kelas]);
                    // kbm terakhir
                        $kbm = $this->Main_model->get_last_id("kbm_pembinaan", "id_kbm");
                        $id_kbm = $kbm['id_kbm'] + 1;
                    // kbm terakhir
    
                    // jumlah peserta 
                        $jum_peserta = COUNT($this->Main_model->get_all("kelas_kpq", ["id_kelas" => $id_kelas]));
                    // jumlah peserta 
    
                    $data = [
                        "id_kbm" => $id_kbm,
                        "peserta" => $koor,
                        "tgl" => $tgl,
                        "hari" => $hari[date('l', strtotime($tgl))],
                        "jam" => $kelas['jam'],
                        "biaya" => 0,
                        "ot" => "0",
                        "keterangan" => "badal",
                        "program_kbm" => $kelas['program'],
                        "jum_peserta" => $jum_peserta,
                        "id_kelas" => $id_kelas,
                        "nip" => $id,
                    ];
    
                    // tambah kbm 
                        $this->Main_model->add_data("kbm_pembinaan", $data);
                    // tambah kbm 
    
                    $data = [
                        "id_kbm" => $id_kbm,
                        "catatan" => "",
                        "status" => "on",
                        "nip_badal" => $nip_badal,
                        "rekap" => 0
                    ];         
                    
                    // tambah kbm badal
                        $this->Main_model->add_data("kbm_badal_pembinaan", $data);
                    // tambah kbm badal       
                    
                    $jum_kbm = COUNT($this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $id_kelas, "MONTH(tgl)" => date("m"), "YEAR(tgl)" => date("Y")]));
                    echo json_encode($jum_kbm);
                    
                } else {
                    echo json_encode(0);
                }
            }
            // redirect($_SERVER['HTTP_REFERER']);
        }

        public function rekap_badal_pembinaan(){
            // var_dump($_POST);
            $nip = $this->session->userdata('nip');
            $id_kelas = $this->input->post("id_kelas");
            $id_kbm = $this->input->post("id_kbm");
            $materi = $this->input->post("materi");
            $tugas = $this->input->post("tugas");
            $keterangan_badal = $this->input->post("keterangan_badal");
            $peserta = $this->input->post("nip");

            $kpq = $this->Main_model->get_one("kpq", ["nip" => $nip]);

            // biaya
                $kelas = $this->Main_model->get_one("kelas_pembinaan", ["id_kelas" => $id_kelas]);
                // tinjau ulang 
                $gol = $this->Main_model->get_one("golongan", ["gol" => $kpq['golongan'], "tipe_kelas" => "reguler"]);
                
                if($keterangan_badal == "badal"){
                    $biaya = $gol['honor'];
                } else {
                    $biaya = 0;
                }
                // update kbm
                    $kbm = [
                        "biaya" => $biaya,
                        "jum_peserta" => COUNT($peserta),
                        "materi" => $materi,
                        "tugas" => $tugas
                    ];

                    $this->Main_model->edit_data("kbm_pembinaan", ["id_kbm" => $id_kbm], $kbm);
                    $this->Main_model->edit_data("kbm_badal_pembinaan", ["id_kbm" => $id_kbm], ["rekap" => 1]);
                // update kbm

                $keterangan = $this->input->post("keterangan");
    
                foreach ($peserta as $i => $peserta) {
                    if($keterangan[$i] == 'hadir') $hadir = 1;
                    else $hadir = 0;
    
                    $data = [
                        "id_kbm" => $id_kbm,
                        "nip" => $peserta,
                        "hadir" => $hadir,
                        "keterangan" => $keterangan[$i]
                    ];
    
                    $this->db->insert("presensi_kpq", $data);
                }
            // biaya 
            
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merekap badal<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function rekap_badal(){
            $nip = $this->session->userdata('nip');
            $tipe = $this->input->post("tipe");
            $id_kelas = $this->input->post("id_kelas");
            $id_kbm = $this->input->post("id_kbm");
            $peserta = $this->input->post("peserta");
            
            // $gol = $this->get_data_kpq($this->session->userdata("nip"));
            $kpq = $this->Main_model->get_one("kpq", ["nip" => $nip]);

            // biaya
                if($tipe == "kelas") {
                    $kelas = $this->Main_model->get_one("kelas", ["id_kelas" => $id_kelas]);
                    $gol = $this->Main_model->get_one("golongan", ["gol" => $kpq['golongan'], "tipe_kelas" => $kelas['tipe_kelas']]);

                    // update kbm
                        $kbm = [
                            "biaya" => $gol['honor'],
                            "jum_peserta" => COUNT($peserta)
                        ];

                        $this->Main_model->edit_data("kbm", ["id_kbm" => $id_kbm], $kbm);
                        $this->Main_model->edit_data("kbm_badal", ["id_kbm" => $id_kbm], ["rekap" => 1]);
                    // update kbm

                    $murid = $this->Main_model->get_all("peserta", ["id_kelas" => $id_kelas]);
                    foreach ($murid as $murid) {
                        if(in_array($murid['id_peserta'], $peserta)){
                            $hadir = 1;
                        } else {
                            $hadir = 0;
                        }

                        $data = [
                            "id_kbm" => $id_kbm,
                            "id_peserta" => $murid['id_peserta'],
                            "hadir" => $hadir
                        ];
                        $this->Main_model->add_data("presensi_peserta", $data);
                    }

                } else {
                    $kelas = $this->Main_model->get_one("kelas_pembinaan", ["id_kelas" => $id_kelas]);
                    // tinjau ulang 
                    $gol = $this->Main_model->get_one("golongan", ["gol" => $kpq['golongan'], "tipe_kelas" => "reguler"]);
                    
                    // update kbm
                        $kbm = [
                            "biaya" => $gol['honor'],
                            "jum_peserta" => COUNT($peserta),
                        ];

                        $this->Main_model->edit_data("kbm_pembinaan", ["id_kbm" => $id_kbm], $kbm);
                        $this->Main_model->edit_data("kbm_badal_pembinaan", ["id_kbm" => $id_kbm], ["rekap" => 1]);
                    // update kbm

                    $murid = $this->Main_model->get_all("kelas_kpq", ["id_kelas" => $id_kelas]);
                    foreach ($murid as $murid) {
                        if(in_array($murid['nip'], $peserta)){
                            $hadir = 1;
                        } else {
                            $hadir = 0;
                        }

                        $data = [
                            "id_kbm" => $id_kbm,
                            "nip" => $murid['nip'],
                            "hadir" => $hadir
                        ];
                        $this->Main_model->add_data("presensi_kpq", $data);
                    }
                }
            // biaya 

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merekap badal<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function ambil_wl($id){
            $data = $this->Civitas_model->ambil_kelas_wl($id);
            
            if($data == 1){
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengambil waiting list. Cek Inbox Anda untuk mengetahui konfirmasi waiting list yang Anda ambil<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal mengambil waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    // add

    // get
        public function get_peserta_aktif(){
            $id = $this->input->post("id");
            if($this->input->post("tipe")){
                $tipe = $this->input->post("tipe");
            } else {
                $tipe = "kelas";
            }
            
            if($tipe == "kelas"){
                $data = $this->Main_model->get_all("peserta", ["id_kelas" => $id, "status" => "aktif"], "nama_peserta");
            } else {
                $peserta = $this->Main_model->get_all("kelas_kpq", ["id_kelas" => $id]);
                foreach ($peserta as $i => $peserta) {
                    $kpq = $this->Main_model->get_one("kpq", ["nip" => $peserta['nip']]);
                    $data[$i]['nama_peserta'] = $kpq['nama_kpq'];
                    $data[$i]['id_peserta'] = $kpq['nip'];
                }
            }

            echo json_encode($data);
        }
        
        public function get_peserta_pembinaan_aktif(){
            $id = $this->input->post("id");
            $kpq = $this->Main_model->get_all("kelas_kpq", ["id_kelas" => $id]);
            $data = [];
            foreach ($kpq as $i => $kpq) {
                $detail = $this->Main_model->get_one("kpq", ["nip" => $kpq['nip']]);
                $data[$i] = $detail;
            }
             
            usort($data, function($a, $b) {
                return $a['nama_kpq'] <=> $b['nama_kpq'];
            });

            echo json_encode($data);
        }

        public function get_detail_kbm(){
            $id = $this->input->post("id");

            $data = $this->Civitas_model->get_detail_kbm($id);
            echo json_encode($data);
        }

        // public function get_detail_kbm_pembinaan(){
        //     $data = [];
        //     $id = $this->input->post("id");
        //     $bulan = date("m");
        //     $tahun = date("Y");
            
        //     $kbm = $this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $id, "MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun]);
        //     foreach ($kbm as $i => $kbm) {
        //         $badal = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $kbm['id_kbm']]);
        //         if($badal) {
        //             $data[$i]['badal'] = $this->Main_model->get_one("kpq", ["nip" => $badal['nip_badal']]);
        //         } 
        //         else {
        //             $data[$i]['badal'] = "";
        //         }

        //         $data[$i]['kbm'] = $kbm;
        //         $data[$i]['peserta_hadir'] = COUNT($this->Main_model->get_all("presensi_kpq", ["id_kbm" => $kbm['id_kbm'], "hadir" => 1]));
        //         $data[$i]['peserta_tidak_hadir'] = COUNT($this->Main_model->get_all("presensi_kpq", ["id_kbm" => $kbm['id_kbm'], "hadir" => 0]));
        //     }
        //     echo json_encode($data);
        // }

        public function get_catatan_badal(){
            $id = $this->input->post("id");
            $tipe = $this->input->post("tipe");

            if($tipe == "kelas"){
                $data = $this->Main_model->get_one("kbm_badal", ["id_kbm" => $id]);
            } else {
                $data = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $id]);
            }

            echo json_encode($data);
        }

        public function get_catatan_kelas(){
            $id = $this->input->post("id");

            $data = $this->Civitas_model->get_catatan_kelas($id);
            echo json_encode($data);
        }

        public function get_list_kbm_pembinaan(){
            $id_kelas = $this->input->post("id_kelas");
            $kbm = $this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $id_kelas, "MONTH(tgl)" => date("m"), "YEAR(tgl)" => date("Y")], "tgl", "ASC");
            $data['kbm'] = [];
            foreach ($kbm as $i => $kbm) {
                $data['kbm'][$i] = $kbm;
                $data['kbm'][$i]['tgl'] = date("d-m-Y", strtotime($kbm['tgl']));
            }
            echo json_encode($data);
        }

        public function get_detail_kbm_pembinaan(){
            $id_kbm = $this->input->post("id_kbm");
            $data['kbm'] = $this->Main_model->get_one("kbm_pembinaan", ["id_kbm" => $id_kbm]);
            $data['badal'] = [];
            $badal = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $id_kbm]);
            if($badal){
                $data['badal'] = $badal;
                $kpq = $this->Main_model->get_one("kpq", ["nip" => $badal['nip_badal']]);
                $data['badal']['kpq'] = $kpq['nama_kpq'];
            }
            $peserta = $this->Main_model->get_all("presensi_kpq", ["id_kbm" => $id_kbm]);
            $data['peserta'] = [];
            foreach ($peserta as $i => $peserta) {
                $kpq = $this->Main_model->get_one("kpq", ["nip" => $peserta['nip']]);
                $data['peserta'][$i] = $kpq;
                $data['peserta'][$i]['keterangan'] = $peserta['keterangan'];
                $data['peserta'][$i]['id_presensi'] = $peserta['id_presensi'];
            }

            echo json_encode($data);
        }
    // get

    // delete
        public function delete_kbm($id){
            $nip = $this->session->userdata('nip');
            // $data = $this->Civitas_model->delete_kbm($id);
            $data = $this->Main_model->delete_data("kbm", ["id_kbm" => $id, "nip" => $nip]);
            if($data){
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menghapus KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }

        // public function delete_kbm_pembinaan($id){
        //     $nip = $this->session->userdata('nip');
        //     // $data = $this->Civitas_model->delete_kbm($id);
        //     $data = $this->Main_model->delete_data("kbm_pembinaan", ["id_kbm" => $id, "nip" => $nip]);
        //     if($data){
        //         $this->Main_model->delete_data("kbm_badal_pembinaan", ["id_kbm" => $id]);
        //         $this->Main_model->delete_data("presensi_kpq", ["id_kbm" => $id]);
        //     }
        //     $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        //     redirect($_SERVER['HTTP_REFERER']);
        // }

        public function delete_kbm_pembinaan(){
            $nip = $this->session->userdata('nip');
            $id_kbm = $this->input->post("id_kbm");
            $id_kelas = $this->input->post("id_kelas");

            $data = $this->Main_model->delete_data("kbm_pembinaan", ["id_kbm" => $id_kbm, "nip" => $nip]);
            if($data){
                $this->Main_model->delete_data("kbm_badal_pembinaan", ["id_kbm" => $id_kbm]);
                $this->Main_model->delete_data("presensi_kpq", ["id_kbm" => $id_kbm]);
            }

            $jum_kbm = COUNT($this->Main_model->get_all("kbm_pembinaan", ["id_kelas" => $id_kelas, "MONTH(tgl)" => date("m"), "YEAR(tgl)" => date("Y")]));
            echo json_encode($jum_kbm);
        }

        public function batal_wl($id){
            $this->Civitas_model->batal_wl($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil membatalkan waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // delete
}