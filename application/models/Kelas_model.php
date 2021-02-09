<?php

class Kelas_model extends CI_Model{    
    public function __construct(){
        parent::__construct();
        $this->load->model('Main_model');
    }

    public function get_peserta(){
        $no_peserta = $this->input->post("no_peserta");
        $data = $this->Main_model->get_one("peserta", ["no_peserta" => $no_peserta]);
        return $data;
    }

    public function add_setoran(){
        $nip = $this->session->userdata('nip');

        $kpq = $this->Main_model->get_one("kpq", ["nip" => $nip]);

        $data = [
            "no_peserta" => $this->input->post('no_peserta'),
            "id_kelas" => $this->input->post('id_kelas'),
            "jenis" => $this->input->post('jenis'),
            "tgl_setor" => $this->input->post('tgl_setor'),
            "setoran" => $this->input->post('setoran'),
            "nilai" => $this->input->post('nilai'),
            "keterangan" => $this->input->post('keterangan'),
            "nama_kpq" => $kpq['nama_kpq']
        ];

        $this->Main_model->add_data("setoran_tahfidz", $data);
        
        return "1";
    }

    public function add_laporan(){
        $nip = $this->session->userdata('nip');

        $kpq = $this->Main_model->get_one("kpq", ["nip" => $nip]);

        $data = [
            "no_peserta" => $this->input->post('no_peserta'),
            "id_kelas" => $this->input->post('id_kelas'),
            "program" => $this->input->post('program'),
            "tgl_awal" => $this->input->post('tgl_awal'),
            "tgl_akhir" => $this->input->post('tgl_akhir'),
            "tilawah" => $this->input->post('tilawah'),
            "materi" => $this->input->post('materi'),
            "keterangan" => $this->input->post('keterangan'),
            "nama_kpq" => $kpq['nama_kpq']
        ];

        $this->Main_model->add_data("laporan_tahsin", $data);
        
        return "1";
    }
    
    public function add_laporan_arab(){
        $nip = $this->session->userdata('nip');

        $kpq = $this->Main_model->get_one("kpq", ["nip" => $nip]);

        $data = [
            "no_peserta" => $this->input->post('no_peserta'),
            "id_kelas" => $this->input->post('id_kelas'),
            "program" => $this->input->post('program'),
            "tgl_awal" => $this->input->post('tgl_awal'),
            "tgl_akhir" => $this->input->post('tgl_akhir'),
            "nilai" => $this->input->post('nilai'),
            "keterangan" => $this->input->post('keterangan'),
            "nama_kpq" => $kpq['nama_kpq']
        ];

        $this->Main_model->add_data("laporan_arab", $data);
        
        return "1";
    }


}