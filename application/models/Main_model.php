<?php
class Main_model extends CI_MODEL{
    public function add_data($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function get_one($table, $where = "", $order = "", $by = "ASC"){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($order)
            $this->db->order_by($order, $by);
        return $this->db->get()->row_array();
    }

    public function get_all($table, $where = "", $order = "", $by = "ASC"){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($order)
            $this->db->order_by($order, $by);
        return $this->db->get()->result_array();
    }

    public function get_all_group_by($table, $where = "", $group = ""){
        $this->db->from($table);
        if($where)
            $this->db->where($where);
        if($group)
            $this->db->group_by($group);
        return $this->db->get()->result_array();
    }

    public function edit_data($table, $where, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function delete_data($table, $where){
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function nominal($nominal){
        $nominal = str_replace("Rp. ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);
        return $nominal;
    }

    public function get_last_id($table, $col){
        $this->db->select($col);
        $this->db->from($table);
        $this->db->order_by($col, "DESC");
        return $this->db->get()->row_array();
    }
    
    public function get_last_id_transfer(){
        $bulan = date("m", strtotime($this->input->post("tgl")));
        $tahun = date("Y", strtotime($this->input->post("tgl")));
        $this->db->select("substr(id_transfer, 1, 3) as id");
        $this->db->from("transfer");
        $this->db->where("MONTH(tgl_transfer)", $bulan);
        $this->db->where("YEAR(tgl_transfer)", $tahun);
        $this->db->order_by("id", "DESC");
        return $this->db->get()->row_array();
    }

    public function get_all_join_table($table1, $table2, $key, $where, $join="right"){
        $this->db->from($table1);
        $this->db->join($table2, "$table1.$key = $table2.$key", $join);
        if($where)
            $this->db->where($where);
        return $this->db->get()->result_array();
    }

    // sidebar 
        public function sidebar(){
            $nip = $this->session->userdata('nip');

            // kbm pembinaan badal 
                $badal = 0;
                $kbm = $this->Main_model->get_all("kbm_pembinaan", ["MONTH(tgl)" => date('m'), "YEAR(tgl)" => date('Y')]);
                foreach ($kbm as $kbm) {
                    $cek = $this->Main_model->get_one("kbm_badal_pembinaan", ["id_kbm" => $kbm['id_kbm'], "rekap" => 0]);
                    if($cek) $badal++;
                }
            // kbm pembinaan badal 

            // sidebar
                $data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
                $data['kpq'] = $this->Civitas_model->get_all_kpq();
                $data['program'] = $this->Civitas_model->get_all_program();
                $data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
                $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip)) + $badal;
                // $data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip));
                $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip)) + COUNT($this->Main_model->get_all("kelas_pembinaan", ["nip" => $nip, "status" => "aktif"]));
                // $data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
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

            return $data;
        }

    // sidebar 
}