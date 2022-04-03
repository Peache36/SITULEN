<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('template/auth-header');
        $this->load->view('auth/login');
        $this->load->view('template/auth-footer');
    }

    public function registrasi()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|valid_email');

        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match !',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('template/auth-header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('template/auth-footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'passsword' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->inserts('user', $data);
        }
    }
}
