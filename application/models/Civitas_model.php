<?php

class Civitas_model extends CI_Model{    
    public function __construct(){
        parent::__construct();
        $this->load->model('Main_model');
    }

    // hapus?
    public function get_data_kpq($nip){
        $this->db->from("kpq");
        $this->db->where("nip", $nip);
        return $this->db->get()->row_array();
    }

    // hapus?
    public function get_all_kelas_kpq($nip){
        $this->db->from("kelas");
        $this->db->where("nip", $nip);
        $this->db->where("status", "aktif");
        return $this->db->get()->result_array();
    }

    public function get_all_jadwal_kpq($nip){
        $kelas = [];
        $urut = 0;
        // $nip = '012.0717.033';
        
        $this->db->from("kelas_reguler");
        $this->db->where("nip", $nip);
        $this->db->where("status", "aktif");
        $reguler = $this->db->get()->result_array();

        foreach ($reguler as $i => $reguler) {
            $kelas[$urut] = $reguler;
            $kelas[$urut]['nama_peserta'] = "LKP TAR-Q";
            $kelas[$urut]['tipe'] = "R";
            $kelas[$urut]['kbm'] = COUNT($this->get_kbm_by_id_jadwal($reguler['id_jadwal']));
            $kelas[$urut]['ot'] = 0;
            $urut++;
        }

        $this->db->select("id_kelas, status, program, nip, nama_kpq, pengajar, nama_peserta");
        $this->db->from("kelas_pv_khusus");
        $this->db->where("nip", $nip);
        $this->db->where("status", "aktif");
        $data = $this->db->get()->result_array();

        foreach ($data as $i => $data) {
            $this->db->from("jadwal");
            $this->db->where("id_kelas", $data['id_kelas']);
            $this->db->where("status", "aktif");
            $jadwal = $this->db->get()->result_array();
            foreach ($jadwal as $i => $jadwal) {
                $kelas[$urut] = $data;
                $kelas[$urut]['hari'] = $jadwal['hari'];
                $kelas[$urut]['jam'] = $jadwal['jam'];
                $kelas[$urut]['tempat'] = $jadwal['tempat'];
                $kelas[$urut]['tipe'] = 'PK';
                $kelas[$urut]['id_jadwal'] = $jadwal['id_jadwal'];
                $kelas[$urut]['kbm'] = COUNT($this->get_kbm_by_id_jadwal($jadwal['id_jadwal']));
                $kelas[$urut]['ot'] = $jadwal['ot'];
                $urut++;
            }
        }

        $this->db->select("id_kelas, status, program, nip, nama_kpq, pengajar, nama_peserta");
        $this->db->from("kelas_pv_luar");
        $this->db->where("nip", $nip);
        $this->db->where("status", "aktif");
        $data = $this->db->get()->result_array();

        foreach ($data as $i => $data) {
            $this->db->from("jadwal");
            $this->db->where("id_kelas", $data['id_kelas']);
            $this->db->where("status", "aktif");
            $jadwal = $this->db->get()->result_array();
            foreach ($jadwal as $i => $jadwal) {
                $kelas[$urut] = $data;
                $kelas[$urut]['hari'] = $jadwal['hari'];
                $kelas[$urut]['jam'] = $jadwal['jam'];
                $kelas[$urut]['tempat'] = $jadwal['tempat'];
                $kelas[$urut]['tipe'] = 'PL';
                $kelas[$urut]['id_jadwal'] = $jadwal['id_jadwal'];
                $kelas[$urut]['kbm'] = COUNT($this->get_kbm_by_id_jadwal($jadwal['id_jadwal']));
                $kelas[$urut]['ot'] = $jadwal['ot'];
                $urut++;
            }
        }

        
        // ini_set('xdebug.var_display_max_depth', '10');
        // ini_set('xdebug.var_display_max_children', '256');
        // ini_set('xdebug.var_display_max_data', '1024');

        // var_dump($kelas);
        usort($kelas, function($a, $b) {
            return $a['jam'] <=> $b['jam'];
        });

        return $kelas;
    }
    
    public function get_jadwal_hari_kpq($nip, $hari){
        $kelas = [];
        $urut = 0;
        // $nip = '012.0717.033';
        
        $this->db->from("kelas_reguler");
        $this->db->where("nip", $nip);
        $this->db->where("status", "aktif");
        $this->db->where("hari", $hari);
        $reguler = $this->db->get()->result_array();

        foreach ($reguler as $i => $reguler) {
            $kelas[$urut] = $reguler;
            $kelas[$urut]['nama_peserta'] = "LKP TAR-Q";
            $kelas[$urut]['tipe'] = "R";
            $kelas[$urut]['kbm'] = COUNT($this->get_kbm_by_id_jadwal($reguler['id_jadwal']));
            $kelas[$urut]['ot'] = 0;
            $urut++;
        }

        $this->db->select("id_kelas, status, program, nip, nama_kpq, pengajar, nama_peserta");
        $this->db->from("kelas_pv_khusus");
        $this->db->where("nip", $nip);
        $this->db->where("status", "aktif");
        $data = $this->db->get()->result_array();

        foreach ($data as $i => $data) {
            $this->db->from("jadwal");
            $this->db->where("id_kelas", $data['id_kelas']);
            $this->db->where("status", "aktif");
            $this->db->where("hari", $hari);
            $jadwal = $this->db->get()->result_array();
            foreach ($jadwal as $i => $jadwal) {
                $kelas[$urut] = $data;
                $kelas[$urut]['hari'] = $jadwal['hari'];
                $kelas[$urut]['jam'] = $jadwal['jam'];
                $kelas[$urut]['tempat'] = $jadwal['tempat'];
                $kelas[$urut]['tipe'] = 'PK';
                $kelas[$urut]['id_jadwal'] = $jadwal['id_jadwal'];
                $kelas[$urut]['kbm'] = COUNT($this->get_kbm_by_id_jadwal($jadwal['id_jadwal']));
                $kelas[$urut]['ot'] = $jadwal['ot'];
                $urut++;
            }
        }

        $this->db->select("id_kelas, status, program, nip, nama_kpq, pengajar, nama_peserta");
        $this->db->from("kelas_pv_luar");
        $this->db->where("nip", $nip);
        $this->db->where("status", "aktif");
        $data = $this->db->get()->result_array();

        foreach ($data as $i => $data) {
            $this->db->from("jadwal");
            $this->db->where("id_kelas", $data['id_kelas']);
            $this->db->where("status", "aktif");
            $this->db->where("hari", $hari);
            $jadwal = $this->db->get()->result_array();
            foreach ($jadwal as $i => $jadwal) {
                $kelas[$urut] = $data;
                $kelas[$urut]['hari'] = $jadwal['hari'];
                $kelas[$urut]['jam'] = $jadwal['jam'];
                $kelas[$urut]['tempat'] = $jadwal['tempat'];
                $kelas[$urut]['tipe'] = 'PL';
                $kelas[$urut]['id_jadwal'] = $jadwal['id_jadwal'];
                $kelas[$urut]['kbm'] = COUNT($this->get_kbm_by_id_jadwal($jadwal['id_jadwal']));
                $kelas[$urut]['ot'] = $jadwal['ot'];
                $urut++;
            }
        }
        
        // ini_set('xdebug.var_display_max_depth', '10');
        // ini_set('xdebug.var_display_max_children', '256');
        // ini_set('xdebug.var_display_max_data', '1024');

        // var_dump($kelas);
        usort($kelas, function($a, $b) {
            return $a['jam'] <=> $b['jam'];
        });

        return $kelas;
    }

    public function get_kbm_now($nip){
        $bulan = date("m");
        $tahun = date("Y");
        $this->db->from("kbm");
        $where = "id_kbm NOT IN(SELECT id_kbm FROM kbm_badal)";
        $this->db->where($where);
        $this->db->where("nip", $nip);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        return $this->db->get()->result_array();
    }
    
    public function get_kbm_pm_now($nip){
        $bulan = date("m");
        $tahun = date("Y");
        $this->db->from("kbm_pembinaan");
        $where = "id_kbm NOT IN(SELECT id_kbm FROM kbm_badal_pembinaan)";
        $this->db->where($where);
        $this->db->where("nip", $nip);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        return $this->db->get()->result_array();
    }

    public function get_kbm_by_id_jadwal($id){
        $bulan = date("m");
        $tahun = date("Y");
        $this->db->from("kbm");
        $this->db->where("id_jadwal", $id);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        return $this->db->get()->result_array();
    }
    
    public function get_badal_now($nip){
        $bulan = date("m");
        $tahun = date("Y");
        $this->db->from("kbm as a");
        $this->db->join("kbm_badal as b", "a.id_kbm = b.id_kbm");
        $this->db->where("nip_badal", $nip);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        return $this->db->get()->result_array();
    }

    public function get_badal_pm_now($nip){
        $bulan = date("m");
        $tahun = date("Y");
        $this->db->from("kbm_pembinaan as a");
        $this->db->join("kbm_badal_pembinaan as b", "a.id_kbm = b.id_kbm");
        $this->db->where("nip_badal", $nip);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        return $this->db->get()->result_array();
    }

    public function get_dibadal_now($nip){
        $bulan = date("m");
        $tahun = date("Y");
        $this->db->from("kbm as a");
        $this->db->join("kbm_badal as b", "a.id_kbm = b.id_kbm");
        $this->db->where("nip", $nip);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        return $this->db->get()->result_array();
    }
    
    public function get_dibadal_pm_now($nip){
        $bulan = date("m");
        $tahun = date("Y");
        $this->db->from("kbm_pembinaan as a");
        $this->db->join("kbm_badal_pembinaan as b", "a.id_kbm = b.id_kbm");
        $this->db->where("nip", $nip);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        return $this->db->get()->result_array();
    }

    public function get_detail_golongan($id){
        $this->db->from("golongan");
        $this->db->where("gol", $id);
        return $this->db->get()->result_array();
    }

    public function get_detail_ot($id){
        $gol[1]['gol'] = "kpq";
        $gol[1]['detail'] = [
            "0" => [
                        "ot" => "90",
                        "honor" => [
                            "0" => "12500",
                            "1" => "25000",
                            "2" => "37500",
                            "3" => "50000",
                            "4" => "62500"
                        ]
                    ],
            "1" => [
                        "ot" => "60",
                        "honor" => [
                            "0" => "8500",
                            "1" => "17000",
                            "2" => "25000",
                            "3" => "33500",
                            "4" => "42000"
                        ]
                    ],
            "2" => [
                        "ot" => "30",
                        "honor" => [
                            "0" => "4500",
                            "1" => "8500",
                            "2" => "12500",
                            "3" => "17000",
                            "4" => "21000"
                        ]
                    ]
        ];
        
        $gol[2]['gol'] = "karyawan";
        $gol[2]['detail'] = [
            "0" => [
                        "ot" => "90",
                        "honor" => [
                            "0" => "52500",
                            "1" => "105000",
                            "2" => "157500",
                            "3" => "210000",
                            "4" => "262500"
                        ]
                    ],
            "1" => [
                        "ot" => "60",
                        "honor" => [
                            "0" => "35000",
                            "1" => "70000",
                            "2" => "105000",
                            "3" => "140000",
                            "4" => "175000"
                        ]
                    ],
            "2" => [
                        "ot" => "30",
                        "honor" => [
                            "0" => "17500",
                            "1" => "35000",
                            "2" => "52500",
                            "3" => "70000",
                            "4" => "87500"
                        ]
                    ]
        ];

        if($id != 'E'){
            return $gol[1];
        } else {
            return $gol[2];
        }
    }

    public function get_all_program(){
        $this->db->from("program");
        return $this->db->get()->result_array();
    }

    public function get_all_kpq(){
        $this->db->from("kpq");
        $this->db->where("status", "aktif");
        $this->db->order_by("nama_kpq", "asc");
        return $this->db->get()->result_array();
    }

    public function get_peserta_aktif($id){
        $this->db->from("peserta");
        $this->db->where("id_kelas", $id);
        $this->db->where("status", "aktif");
        return $this->db->get()->result_array();
    }

    public function get_detail_kbm($id){
        $data = [];
        $bulan = date("m");
        $tahun = date("Y");

        $this->db->select("a.id_kbm, tgl, hari, jam, jum_peserta, nip_badal, nama_kpq");
        $this->db->from("kbm as a");
        $this->db->join("kbm_badal as b", "a.id_kbm = b.id_kbm", "left");
        $this->db->join("kpq as c", "b.nip_badal = c.nip", "left");
        $this->db->where("id_jadwal", $id);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);

        $kbm = $this->db->get()->result_array();
        foreach ($kbm as $i => $kbm) {
            $this->db->select("nama_peserta");
            $this->db->from("peserta as a");
            $this->db->join("presensi_peserta as b", "a.id_peserta = b.id_peserta");
            $this->db->where("id_kbm", $kbm['id_kbm']);
            $this->db->where("hadir", 1);
            $peserta = $this->db->get()->result_array();
            $data[$i]['kbm'] = $kbm;
            $data[$i]['peserta_hadir'] = $peserta;

            $this->db->select("nama_peserta");
            $this->db->from("peserta as a");
            $this->db->join("presensi_peserta as b", "a.id_peserta = b.id_peserta");
            $this->db->where("id_kbm", $kbm['id_kbm']);
            $this->db->where("hadir", 0);
            $peserta = $this->db->get()->result_array();
            $data[$i]['peserta_tidak_hadir'] = $peserta;
        }

        // ini_set('xdebug.var_display_max_depth', '10');
        // ini_set('xdebug.var_display_max_children', '256');
        // ini_set('xdebug.var_display_max_data', '1024');

        // var_dump($data);
        
        usort($data, function($a, $b) {
            return $a['kbm']['tgl'] <=> $b['kbm']['tgl'];
        });

        return $data;
    }
    
    public function get_detail_kbm_pembinaan($id){
        $data = [];
        $bulan = date("m");
        $tahun = date("Y");

        $this->db->select("a.id_kbm, tgl, hari, jam, jum_peserta, nip_badal, nama_kpq");
        $this->db->from("kbm_pembinaan as a");
        $this->db->join("kbm_badal_pembinaan as b", "a.id_kbm = b.id_kbm", "left");
        $this->db->join("kpq as c", "b.nip_badal = c.nip", "left");
        $this->db->where("id_kelas", $id);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);

        $kbm = $this->db->get()->result_array();
        foreach ($kbm as $i => $kbm) {
            $this->db->select("nama_kpq");
            $this->db->from("kpq as a");
            $this->db->join("presensi_kpq as b", "a.nip = b.nip");
            $this->db->where("id_kbm", $kbm['id_kbm']);
            $this->db->where("hadir", 1);
            $peserta = $this->db->get()->result_array();
            $data[$i]['kbm'] = $kbm;
            $data[$i]['peserta_hadir'] = $peserta;

            $this->db->select("nama_kpq");
            $this->db->from("kpq as a");
            $this->db->join("presensi_kpq as b", "a.kpq = b.kpq");
            $this->db->where("id_kbm", $kbm['id_kbm']);
            $this->db->where("hadir", 0);
            $peserta = $this->db->get()->result_array();
            $data[$i]['peserta_tidak_hadir'] = $peserta;
        }

        // ini_set('xdebug.var_display_max_depth', '10');
        // ini_set('xdebug.var_display_max_children', '256');
        // ini_set('xdebug.var_display_max_data', '1024');

        // var_dump($data);
        
        usort($data, function($a, $b) {
            return $a['kbm']['tgl'] <=> $b['kbm']['tgl'];
        });

        return $data;
    }

    public function get_all_inbox($nip){
        $this->db->from("inbox");
        $this->db->where("nip", $nip);
        $this->db->order_by("tgl_inbox", "DESC");
        return $this->db->get()->result_array();
    }

    // hapus?
    public function get_all_inbox_off($nip){
        $this->db->from("inbox");
        $this->db->where("nip", $nip);
        $this->db->where("status", "off");
        return $this->db->get()->result_array();
    }

    public function get_all_jadwal_badal_kpq($nip){
        $bulan = date("m");
        $tahun = date("Y");

        $this->db->select("*, a.id_kbm as id_kbm");
        $this->db->from("kbm as a");
        $this->db->join("kbm_badal as b", "a.id_kbm = b.id_kbm");
        $this->db->join("kpq as c", "a.nip = c.nip");
        $this->db->where("nip_badal", $nip);
        $this->db->where("MONTH(tgl)", $bulan);
        $this->db->where("YEAR(tgl)", $tahun);
        $this->db->where("b.status", "on");
        $this->db->where("rekap", 0);
        return $this->db->get()->result_array();
    }

    public function get_catatan_badal($id){
        $this->db->from("kbm_badal");
        $this->db->where("id_kbm", $id);
        return $this->db->get()->row_array();
    }

    public function get_all_wl(){
        $this->db->select("a.id_kelas, nama_peserta, tipe_kelas, a.program, a.status");
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas = b.id_kelas");
        $this->db->join("peserta as c", "b.id_peserta = c.id_peserta");
        $where = "(pengajar = '{$this->session->userdata('jk')}' OR pengajar = 'Pria&Wanita')";
        $this->db->where($where);
        $this->db->where("a.status", "wl");
        return $this->db->get()->result_array();
    }

    public function get_catatan_kelas($id){
        $this->db->from("kelas");
        $this->db->where("id_kelas", $id);
        return $this->db->get()->row_array();
    }

    public function get_all_kesediaan($nip){
        $this->db->from("kesediaan");
        $this->db->where("nip", $nip);
        return $this->db->get()->result_array();
    }
    
    public function get_total_kbm_by_jadwal_now($id_jadwal){
        $this->db->select("count(id_kbm) as kbm");
        $this->db->from("kbm");
        $where = "id_kbm NOT IN(SELECT id_kbm FROM kbm_badal)";
        $this->db->where($where);
        $this->db->where("id_jadwal", $id_jadwal);
        $this->db->where("MONTH(tgl)", date('m'));
        $this->db->where("YEAR(tgl)", date('Y'));
        $this->db->group_by("id_jadwal");
        return $this->db->get()->row_array();
    }

    public function get_data_jadwal($id_jadwal){
        $this->db->from("jadwal");
        $this->db->where("id_jadwal", $id_jadwal);
        return $this->db->get()->row_array();
    }

    public function get_wl_konfirm($nip){
        $this->db->select("a.id_kelas, nama_peserta, tipe_kelas, a.program, a.status");
        $this->db->from("kelas as a");
        $this->db->join("kelas_koor as b", "a.id_kelas = b.id_kelas");
        $this->db->join("peserta as c", "b.id_peserta = c.id_peserta");
        $where = "(pengajar = '{$this->session->userdata('jk')}' OR pengajar = 'Pria&Wanita')";
        $this->db->where($where);
        $this->db->where("a.status", "konfirm");
        $this->db->where("a.nip", $nip);
        return $this->db->get()->result_array();
    }

    // edit
        // hapus?
        public function edit_program(){
            $id = $this->input->post("id");
            $program = $this->input->post("program");
            $this->db->where("id_kelas", $id);
            $this->db->update("kelas", ["program" => $program]);
        }

        // hapus?
        public function edit_status_inbox($nip){
            $this->db->where("nip", $nip);
            $this->db->update("inbox", ["status" => "on"]);
        }

        // hapus?
        public function edit_kpq(){
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

            $this->db->where("nip", $this->session->userdata("nip"));
            $this->db->update("kpq", $data);
        }

        // hapus?
        public function edit_password(){
            $this->db->where("id_admin", $this->session->userdata("nip"));
            $this->db->update("admin", ["password" => $this->input->post("pass1")]);
        }

        public function batal_wl($id_kelas){
            $this->db->where("id_kelas", $id_kelas);
            $this->db->update("kelas", ["status" => "wl", "nip" => null]);
        }
    // edit

    // add
        public function add_badal(){
            // kbm terakhir
            $this->db->select("id_kbm");
            $this->db->from("kbm");
            $this->db->order_by("id_kbm", "desc");
            $id = $this->db->get()->row_array();
            $id = $id['id_kbm'] + 1;

            $jum_peserta = COUNT($this->get_peserta_aktif($this->input->post("id_kelas")));

            $hari = array(
                'Sunday' => 'Ahad',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
                );

            $data = [
                "id_kbm" => $id,
                "tgl" => $this->input->post("tgl"),
                "jam" => $this->input->post("waktu"),
                "hari" => $hari[date('l', strtotime($this->input->post("tgl")))],
                "keterangan" => "badal",
                "id_kelas" => $this->input->post("id_kelas"),
                "nip" => $this->session->userdata("nip"),
                "ot" => "0",
                "jum_peserta" => $jum_peserta,
                "id_jadwal" => $this->input->post("id_jadwal"),
                "program_kbm" => $this->input->post("program"),
                "peserta" => $this->input->post("koor")
            ];

            $this->db->insert("kbm", $data);

            $catatan = "Catatan : <br>" . $this->input->post("catatan") . "<br><br> Tempat : <br>" . $this->input->post("tempat");

            $data = [
                "id_kbm" => $id,
                "catatan" => $catatan,
                "status" => "konfirm",
                "nip_badal" => $this->input->post("nip"),
                "rekap" => 0
            ];

            $this->db->insert("kbm_badal", $data);
        }

        public function add_kbm(){
            $gol = $this->get_data_kpq($this->session->userdata("nip"));
            $day = array(
                'Sunday' => 'Ahad',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
                );

            // kbm terakhir
            $this->db->select("id_kbm");
            $this->db->from("kbm");
            $this->db->order_by("id_kbm", "desc");
            $id = $this->db->get()->row_array();
            $id = $id['id_kbm'] + 1;
            
            //jadwal
            $this->db->from("jadwal");
            $this->db->where("id_jadwal", $this->input->post("id_jadwal"));
            $jadwal = $this->db->get()->row_array();
            $hari = $jadwal['hari'];
            $jam = $jadwal['jam'];

            // biaya
            $this->db->from("kelas");
            $this->db->where("id_kelas", $this->input->post("id_kelas"));
            $kelas = $this->db->get()->row_array();

            $this->db->from("golongan");
            $this->db->where("gol", $gol['golongan']);
            $this->db->where("tipe_kelas", $kelas['tipe_kelas']);
            $gol = $this->db->get()->row_array();

            $keterangan = $this->input->post("keterangan");
            if($keterangan == "sesuai"){
                $peserta = $this->input->post("peserta_sesuai");
            } else {
                $peserta = $this->input->post("peserta_ganti");
                $hari = $day[date('l', strtotime($this->input->post("tgl")))];
                $jam = $this->input->post("jam");
            }

            $jum_peserta = COUNT($this->get_peserta_aktif($this->input->post("id_kelas")));

            $data = [
                "id_kbm" => $id,
                "tgl" => $this->input->post("tgl"),
                "hari" => $hari,
                "jam" => $jam,
                "keterangan" => $this->input->post("keterangan"),
                "id_kelas" => $this->input->post("id_kelas"),
                "nip" => $this->session->userdata("nip"),
                "biaya" => $gol['honor'],
                "ot" => 0,
                "id_jadwal" => $this->input->post("id_jadwal"),
                "program_kbm" => $kelas['program'],
                "jum_peserta" => $jum_peserta,
                "peserta" => $this->input->post("koor")
            ];

            $this->db->insert("kbm", $data);

            foreach ($peserta as $id_peserta) {
                $data = [
                    "id_kbm" => $id,
                    "id_peserta" => $id_peserta,
                    "hadir" => 1
                ];

                $this->db->insert("presensi_peserta", $data);
            }

            
            $this->db->select("id_peserta");
            $this->db->from("peserta");
            $this->db->where("id_kelas", $this->input->post("id_kelas"));
            $where = "id_peserta NOT IN( '" . implode( "', '" , $peserta ) . "' )";
            $this->db->where($where);
            $this->db->where("status", "aktif");
            $peserta = $this->db->get()->result_array();

            foreach ($peserta as $peserta) {
                $data = [
                    "id_kbm" => $id,
                    "id_peserta" => $peserta['id_peserta'],
                    "hadir" => 0
                ];

                $this->db->insert("presensi_peserta", $data);
            }
        }

        
        public function add_kbm_pembinaan(){
            $gol = $this->get_data_kpq($this->session->userdata("nip"));
            $day = array(
                'Sunday' => 'Ahad',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            );

            
                // kbm terakhir
            $this->db->select("id_kbm");
            $this->db->from("kbm_pembinaan");
            $this->db->order_by("id_kbm", "desc");
            $id = $this->db->get()->row_array();
            $id = $id['id_kbm'] + 1;
            

            //jadwal
            $data = $this->Main_model->get_one("kelas_pembinaan", ["id_kelas" => $this->input->post("id_kelas")]);
            $hari = $data['hari'];
            $jam = $data['jam'];
            // $this->db->from("jadwal");
            // $this->db->where("id_jadwal", $this->input->post("id_jadwal"));
            // $jadwal = $this->db->get()->row_array();
            // $hari = $jadwal['hari'];
            // $jam = $jadwal['jam'];

            // biaya
            // $this->db->from("kelas");
            // $this->db->where("id_kelas", $this->input->post("id_kelas"));
            // $kelas = $this->db->get()->row_array();

            $this->db->from("golongan");
            $this->db->where("gol", $gol['golongan']);
            $this->db->where("tipe_kelas", "reguler");
            $gol = $this->db->get()->row_array();

            // $keterangan = $this->input->post("keterangan");
            // if($keterangan == "sesuai"){
            //     $peserta = $this->input->post("peserta_sesuai");
            // } else {
            //     $peserta = $this->input->post("peserta_ganti");
            //     $hari = $day[date('l', strtotime($this->input->post("tgl")))];
            //     $jam = $this->input->post("jam");
            // }

            // $presensi = $this;
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
                "peserta" => "LKP TAR-Q"
            ];

            $this->db->insert("kbm_pembinaan", $kbm);
            
            $peserta = $this->Main_model->get_all("kelas_kpq", ["id_kelas" => $data['id_kelas']]);
            foreach ($peserta as $nip) {
                if(in_array($nip['nip'], $this->input->post("kpq")))
                    $hadir = 1;
                else
                    $hadir = 0;

                $data = [
                    "id_kbm" => $id,
                    "nip" => $nip['nip'],
                    "hadir" => $hadir
                ];
                $this->db->insert("presensi_kpq", $data);
            }
        }

        public function rekap_badal(){
            $gol = $this->get_data_kpq($this->session->userdata("nip"));
            // biaya
            $this->db->from("kelas");
            $this->db->where("id_kelas", $this->input->post("id_kelas"));
            $kelas = $this->db->get()->row_array();

            $this->db->from("golongan");
            $this->db->where("gol", $gol['golongan']);
            $this->db->where("tipe_kelas", $kelas['tipe_kelas']);
            $gol = $this->db->get()->row_array();

            $this->db->where("id_kbm", $this->input->post("id_kbm"));
            $this->db->update("kbm", ["biaya" => $gol['honor'], "jum_peserta" => COUNT($this->input->post("peserta"))]);

            $this->db->where("id_kbm", $this->input->post("id_kbm"));
            $this->db->update("kbm_badal", ["rekap" => 1]);

            $peserta = $this->input->post("peserta");
            foreach ($peserta as $id_peserta) {
                $data = [
                    "id_kbm" => $this->input->post("id_kbm"),
                    "id_peserta" => $id_peserta,
                    "hadir" => 1
                ];
                
                $this->db->insert("presensi_peserta", $data);
            }

            $this->db->select("id_peserta");
            $this->db->from("peserta");
            $this->db->where("id_kelas", $this->input->post("id_kelas"));
            $where = "id_peserta NOT IN( '" . implode( "', '" , $peserta ) . "' )";
            $this->db->where($where);
            $this->db->where("status", "aktif");
            $peserta = $this->db->get()->result_array();

            foreach ($peserta as $peserta) {
                $data = [
                    "id_kbm" => $this->input->post("id_kbm"),
                    "id_peserta" => $peserta['id_peserta'],
                    "hadir" => 0
                ];

                $this->db->insert("presensi_peserta", $data);
            }
        }

        public function ambil_kelas_wl($id){
            $this->db->select("nip");
            $this->db->from("kelas");
            $this->db->where("id_kelas", $id);
            $data = $this->db->get()->row_array();

            if($data['nip'] == null || $data['nip'] == ''){
                $this->db->where("id_kelas", $id);
                $this->db->update("kelas", ["nip" => $this->session->userdata("nip"), "status" => "konfirm"]);
                return $this->db->affected_rows();
            } else {
                return 0;
            }

        }

        // hapus?
        public function add_kesediaan(){
            $nip = $this->session->userdata('nip');
            $this->db->where("nip", $nip);
            $this->db->delete("kesediaan");

            $sedia = $this->input->post("sedia");
            if($sedia){
                foreach ($sedia as $sedia) {
                    $data = explode("|", $sedia);
                    $kesediaan = [
                        "hari" => $data[0],
                        "jam" => $data[1],
                        "nip" => $nip
                    ];
                    $this->db->insert("kesediaan", $kesediaan);
                }
            }
        }
    // add

    // delete
        // hapus?
        public function delete_kbm($id){
            $this->db->where("id_kbm", $id);
            $this->db->where("nip", $this->session->userdata("nip"));
            $this->db->delete("kbm");
            return $this->db->affected_rows();
        }

        // hapus?
        public function delete_inbox($id){
            $this->db->where("id_inbox", $id);
            $this->db->where("nip", $this->session->userdata("nip"));
            $this->db->delete("inbox");
            return $this->db->affected_rows();
        }
    // delete

}