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
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('template/auth-header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth-footer');
        } else {
            $this->_login();
        }
    }

    // LOGIN
    private function _login()
    {
        $name = $this->input->post('name');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['name' => $name])->row_array();
        // JIKA ADA USER
        if ($user) {
            // JIKA AKTIF
            if ($user['is_active'] == 1) {
                // CEK PASSWORD
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'name' => $user['name'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password !</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your account has not been actived ! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Username is not registered ! </div>');
            redirect('auth');
        }
    }

    // END LOGIN

    // REGISTRASI
    // public function registrasi()
    // {
    //     if ($this->session->userdata('email')) {
    //         redirect('user');
    //     }

    //     $this->form_validation->set_rules('name', 'Name', 'required|trim');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|valid_email|is_unique[user.email]', [
    //         'is_unique' => 'This email has already registered'
    //     ]);

    //     $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
    //         'matches' => 'Password dont match !',
    //         'min_length' => 'Password to short!'
    //     ]);
    //     $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Registration';
    //         $this->load->view('template/auth-header', $data);
    //         $this->load->view('auth/registrasi');
    //         $this->load->view('template/auth-footer');
    //     } else {
    //         $data = [
    //             'name' => htmlspecialchars($this->input->post('name', true)),
    //             'email' => htmlspecialchars($this->input->post('email', true)),
    //             'image' => 'default.jpg',
    // 'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
    //             'role_id' => 2,
    //             'is_active' => 1,
    //             'date_created' => time()
    //         ];

    //         $this->db->insert('user', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Your account has been created ! Please Login </div>');

    //         redirect('auth');
    //     }
    // }

    // // END REGISTRASI

    // LOGOUT
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You has been log out </div>');
        redirect('auth');
    }
    // END LOGOUT

    // BLOCKED
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
