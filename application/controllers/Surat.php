<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "Buat Surat";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Menu_model', 'status');
        $data['status'] = $this->status->getStatusSurat();

        $this->load->model('Menu_model', 'option');
        $data['option'] = $this->status->getOptionSurat();





        $this->form_validation->set_rules('name', 'Menu', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        //    CEK ROLE , USER ID DAN STATUS
        // if ($data['user']['role_id'] != 1) {
        //     $data['surat'] = $this->db->get_where('surat', ['user_id' => $data['id'][0]['id']])->result_array();
        // } else {
        //     $data['surat'] = $this->db->get_where('surat', ['status_id' => 1])->result_array();
        // }

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('surat/index', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'user_id' => $data['user']['id'],
                'nama_lengkap' => $this->input->post('name'),
                'jenis_id' => 1,
                'status_id' => 1,
                'perihal' => $this->input->post('perihal'),
                'date_created' => time(),
            ];

            $this->db->insert('surat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Surat Added</div>');
            redirect('surat');
        }
    }

    public function proses()
    {
    }
}
