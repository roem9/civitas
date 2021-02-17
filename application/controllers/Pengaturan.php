<?php

class Pengaturan extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Civitas_model');
        $this->load->model('Main_model');
        if(!$this->session->userdata('nip')){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
			redirect(base_url("auth"));
		}
    }

    public function password(){
        $data = $this->Main_model->sidebar();
        $nip = $this->session->userdata('nip');

        $data['title'] = "Pengaturan Password";
        
        $data['kpq'] = $this->Civitas_model->get_data_kpq($nip);
        
        $this->load->view("templates/header", $data);
        $this->load->view("page/pengaturan", $data);
        $this->load->view("templates/footer");
    }
    
    public function profil(){
        $data = $this->Main_model->sidebar();
        $nip = $this->session->userdata('nip');
        $data['title'] = "Pengaturan Profil";

        // $data['kpq'] = $this->Civitas_model->get_data_kpq($nip);
        $data['kpq'] = $this->Main_model->get_one("kpq", ["nip" => $nip]);
        
        // var_dump($data['sedia']);
        $this->load->view("templates/header", $data);
        $this->load->view("page/profil", $data);
        $this->load->view("templates/footer");
    }

    public function foto(){
        $data = $this->Main_model->sidebar();
        $nip = $this->session->userdata('nip');
        $data['title'] = "Upload Foto";

        // $data['kpq'] = $this->Civitas_model->get_data_kpq($nip);
        $data['kpq'] = $this->Main_model->get_one("kpq", ["nip" => $nip]);
        
        // var_dump($data['sedia']);
        $this->load->view("templates/header", $data);
        $this->load->view("page/foto", $data);
        $this->load->view("templates/footer");
    }

    // edit
        public function edit_kpq(){
            $nip = $this->session->userdata('nip');
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
                $nip = $this->session->userdata('nip');
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

        public function edit_foto(){
            $nip = $this->session->userdata('nip');
            
            if(isset($_FILES['gambar'])) {
                $nama_gambar = $_FILES['gambar'] ['name']; // Nama Gambar
                $size        = $_FILES['gambar'] ['size'];// Size Gambar
                $error       = $_FILES['gambar'] ['error'];
                $tipe_video  = $_FILES['gambar'] ['type']; //tipe gambar untuk filter
                $folder      = "./assets/img/foto/"; //folder tujuan upload
                $valid       = array('jpg','JPG','png','PNG','jpeg','JPEG'); //Format File yang di ijinkan Masuk ke server
                
                if(strlen($nama_gambar)){   
                     // Perintah untuk mengecek format gambar
                     list($txt, $ext) = explode(".", $nama_gambar);
                     if(in_array($ext,$valid)){   
                         // Perintah untuk mengupload gambar dan memberi nama baru
            
                         $gambarnya = $nip.".".$ext;
                         $gmbr  = $folder.$gambarnya;
                         
                         $tmp = $_FILES['gambar']['tmp_name'];
                        
                        //  hapus foto 
                        $hapus = $this->Main_model->get_one("kpq", ["nip" => $nip]);
                        unlink('./assets/img/foto/'.$hapus['foto']);
                         
                        if(move_uploaded_file($tmp, $folder.$gambarnya)){   
                            $this->Main_model->edit_data("kpq", ["nip" => $nip], ["foto" => $gambarnya]);
                            echo '<script>
                              alert("gambar Berhasil di upload");
                              </script>';
                        
                        }
                            else{ // Jika Gambar Gagal Di upload 
                        echo '<script>
                              alert("gambar Gagal di upload");
                           </script>';
                        }
                     } else{ // Jika File Gambar Yang di Upload tidak sesuai eksistensi yang sudah di tetapkan
                        echo '<script>
                              alert("Format Gambar Tidak valid , Format Gambar Harus (JPG, Jpeg, png) ");
                           </script>';  
                    }
            
                }         
            }
        }
    // edit

    // add
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