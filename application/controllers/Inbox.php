<?php

class Inbox extends CI_CONTROLLER{
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
        
        // $this->Civitas_model->edit_status_inbox($nip);
        $this->Main_model->edit_data("inbox", ["nip" => $nip], ["status" => "on"]);

        $this->load->view("templates/header", $data);
        $this->load->view("page/inbox", $data);
        $this->load->view("templates/footer");
    }

    // delete
        public function delete_inbox($id){
            // $data = $this->Civitas_model->delete_inbox($id);
            $result = $this->Main_model->delete_data("inbox", ["id_inbox" => $id]);
            if($result)
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus pesan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            else
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menghapus pesan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    // delete
}