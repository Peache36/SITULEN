<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    // EDIT PROFILE
    public function edit()
    {
        $data['title'] = "Edit Profile";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $name = $this->input->post('name');


            // Jika ada gambar di upload
            $upload_image = $_FILES['image']['name'];


            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // HAPUS FOTO LAMA
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user');
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $_SESSION['name'] = $name;

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Profile has been Updated ! </div>');

            redirect('user');
        }
    }

    // GANTI PASSWORD

    public function changePassword()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');



        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('template/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post("new_password1");

            if (!password_verify($current_password, $data['user']['password'])) {
                // JIKA PASSWORD CURRENT SALAH
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                Wrong Current Password ! </div>');
                redirect('user/changepassword');
            } else {
                // JIKA CURRENT PW SAMA DENGAN NEW PW
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                    New Password cannot be same as current password! </div>');
                    redirect('user/changepassword');
                } else {
                    // JIKA SUDAH BENAR
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('name', $this->session->userdata('name'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
                    Password Changed</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
