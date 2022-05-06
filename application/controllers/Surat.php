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

        $this->load->model('Menu_model', 'optionstatus');
        $data['optionstatus'] = $this->status->getOptionstatus();

        $data['surat'] = $this->db->get('surat')->result_array();

        $this->form_validation->set_rules('nama', 'Name', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('surat/index', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'user_id' => $data['user']['id'],
                'nama_lengkap' => $this->input->post('nama'),
                'jenis_id' => $this->input->post('jenis'),
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

    public function terima()
    {
        $data['title'] = "Diterima";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Menu_model', 'status');
        $data['status'] = $this->status->getStatusSurat();


        $this->load->model('Menu_model', 'option');
        $data['option'] = $this->status->getOptionSurat();

        $this->load->model('Menu_model', 'optionstatus');
        $data['optionstatus'] = $this->status->getOptionstatus();


        $data['surat'] = $this->db->get('surat')->result_array();

        $this->form_validation->set_rules('name', 'Menu', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('surat/terima', $data);
            $this->load->view('template/footer');
        }
    }

    public function tolak()
    {
        $data['title'] = "Ditolak";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Menu_model', 'status');
        $data['status'] = $this->status->getStatusSurat();

        $this->load->model('Menu_model', 'option');
        $data['option'] = $this->status->getOptionSurat();

        $this->load->model('Menu_model', 'optionstatus');
        $data['optionstatus'] = $this->status->getOptionstatus();


        $data['surat'] = $this->db->get('surat')->result_array();

        $this->form_validation->set_rules('name', 'Menu', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('surat/tolak', $data);
            $this->load->view('template/footer');
        }
    }

    public function hapusSurat($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('Surat');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Surat has been deleted</div>');
        redirect('surat');
    }

    public function editSurat($id)
    {
        $data['surat'] = $this->db->get_where('surat')->result_array();


        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('jenis', 'Nama Lengkap', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('surat', $data);
            $this->load->view('template/footer');
        } else {
            $masuk = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'jenis_id' => $this->input->post('jenis'),
                'status_id' => $this->input->post('status'),
                'perihal' => $this->input->post('perihal'),
                'keterangan' => $this->input->post('keterangan'),
            ];

            $data['surat'] = $this->db->get_where('surat')->result_array();
            $upload_dokumen = $_FILES['dokumen']['name'];

            if ($upload_dokumen) {
                $config['allowed_types']        = 'pdf|doc|docx';
                $config['max_size']             = '10240';
                $config['upload_path']          = './assets/dokumen/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('dokumen')) {

                    $old_dokumen = $data['surat'][$id - 1]['dokumen'];

                    if ($old_dokumen != 'default.docx') {
                        unlink(FCPATH . 'assets/dokumen/' . $old_dokumen);
                    }

                    $new_dokumen = $this->upload->data('file_name');
                    $this->db->set('dokumen', $new_dokumen);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('surat');
                }
            }

            $this->db->set($masuk);
            $this->db->where('id', $id);
            $this->db->update('surat');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Surat has been changes </div>');
            redirect('surat');
        }
    }

    public function downloadSurat($id)
    {
        $this->load->helper('download');

        $this->load->model('Menu_model', 'download');
        $data['download'] = $this->download->downloadSurat($id);

        $file = $data['download'][0]['dokumen'];
        force_download($file, FALSE);
    }
}
