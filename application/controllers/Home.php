<?php
class Home extends CI_CONTROLLER{
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
        $gol = $this->session->userdata('gol');
        
        $data['bulan'] = ["1" => "Januari", "2" => "Februari", "3" => "Maret", "4" => "April", "5" => "Mei", "6" => "Juni", "7" => "Juli", "8" => "Agustus", "9" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];
        
        $data['kelas'] = COUNT($this->Civitas_model->get_all_kelas_kpq($nip));
        
        $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
        $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
        $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
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

        // hitung ot
            $data['ot'] = 0;
            $kelas = $this->Civitas_model->get_all_jadwal_kpq($nip);
            foreach ($kelas as $i => $kelas) {
                $ot = $this->Civitas_model->get_total_kbm_by_jadwal_now($kelas['id_jadwal']);
                $x = $this->ot($gol, $ot['kbm'], $kelas['ot']);
                $data['ot'] += $x;
            }
            // badal
                $kelas = $this->Civitas_model->get_badal_now($nip);
                foreach ($kelas as $kelas) {
                    $jadwal = $this->Civitas_model->get_data_jadwal($kelas['id_jadwal']);
                    $x = $this->ot($gol, 1, $jadwal['ot']);
                    $data['ot'] += $x;
                }
            // badal
        // 

        $data['kpq'] = $this->Civitas_model->get_data_kpq($nip);
        $data['kbm'] = $this->Civitas_model->get_kbm_now($nip);
        $data['badal'] = $this->Civitas_model->get_badal_now($nip);
        $data['dibadal'] = $this->Civitas_model->get_dibadal_now($nip);
        $data['honor_badal'] = 0;
        $data['honor_kbm'] = 0;
        
        foreach ($data['kbm'] as $kbm) {
            $data['honor_kbm'] += $kbm['biaya'];
            // $data['honor_kbm'] += $kbm['ot'];
        }
        
        foreach ($data['badal'] as $kbm) {
            $data['honor_badal'] += $kbm['biaya'];
            // $data['honor_badal'] += $kbm['ot'];
        }

        $data['title'] = "Beranda";
        $this->load->view("templates/header", $data);
        $this->load->view("page/beranda", $data);
        $this->load->view("templates/footer", $data);
    }


    // get
        public function get_detail_golongan(){
            $id = $this->input->post("id");
            $data = $this->Civitas_model->get_detail_golongan($id);
            echo json_encode($data);
        }

        public function get_detail_ot(){
            $id = $this->input->post("id");
            $data = $this->Civitas_model->get_detail_ot($id);

            $data = $data['detail'];
            // ini_set('xdebug.var_display_max_depth', '10');
            // ini_set('xdebug.var_display_max_children', '256');
            // ini_set('xdebug.var_display_max_data', '1024');
            // var_dump($data);
            echo json_encode($data);
        }
    // get

    // other function
        public function ot($gol, $kbm, $oot){
            if($gol != 'E'){
                if($oot == '3'){
                    if($kbm == '5'){
                        return $ot = 62500;
                    } else if($kbm == '4'){
                        return $ot = 50000;
                    } else if($kbm == '3'){
                        return $ot = 37500;
                    } else if($kbm == '2'){
                        return $ot = 25000;
                    } else if($kbm == '1'){
                        return $ot = 12500;
                    } else {
                        return $ot = 0;
                    }
                } else if($oot == '2'){
                    if($kbm == '5'){
                        return $ot = 42000;
                    } else if($kbm == '4'){
                        return $ot = 33500;
                    } else if($kbm == '3'){
                        return $ot = 25000;
                    } else if($kbm == '2'){
                        return $ot = 17000;
                    } else if($kbm == '1'){
                        return $ot = 8500;
                    } else {
                        return $ot = 0;
                    }
                } else if($oot == '1'){
                    if($kbm == '5'){
                        return $ot = 21000;
                    } else if($kbm == '4'){
                        return $ot = 17000;
                    } else if($kbm == '3'){
                        return $ot = 12500;
                    } else if($kbm == '2'){
                        return $ot = 8500;
                    } else if($kbm == '1'){
                        return $ot = 4500;
                    } else {
                        return $ot = 0;
                    }
                } 
            } else {
                if($oot == '3'){
                    if($kbm == '5'){
                        return $ot = 262500;
                    } else if($kbm == '4'){
                        return $ot = 210000;
                    } else if($kbm == '3'){
                        return $ot = 157500;
                    } else if($kbm == '2'){
                        return $ot = 105000;
                    } else if($kbm == '1'){
                        return $ot = 52500;
                    } else {
                        return $ot = 0;
                    }
                } else if($oot == '2'){
                    if($kbm == '5'){
                        return $ot = 175000;
                    } else if($kbm == '4'){
                        return $ot = 140000;
                    } else if($kbm == '3'){
                        return $ot = 105000;
                    } else if($kbm == '2'){
                        return $ot = 70000;
                    } else if($kbm == '1'){
                        return $ot = 35000;
                    } else {
                        return $ot = 0;
                    }
                } else if($oot == '1'){
                    if($kbm == '5'){
                        return $ot = 87500;
                    } else if($kbm == '4'){
                        return $ot = 70000;
                    } else if($kbm == '3'){
                        return $ot = 52500;
                    } else if($kbm == '2'){
                        return $ot = 35000;
                    } else if($kbm == '1'){
                        return $ot = 17500;
                    } else {
                        return $ot = 0;
                    }
                } 
            }
        }
    // other function
}