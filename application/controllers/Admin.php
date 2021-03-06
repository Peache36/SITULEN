<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = "My Dashboard";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['surat'] = $this->db->get('surat')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }

    // FUNGSI TAMPILAN ROLE
    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('template/footer');
    }

    // FUNGSI ROLE ACCESS
    public function roleaccess($role_id)
    {
        $data['title'] = "Role Access";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('template/footer');
    }

    // FUNGSI GANTI AKSES
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changes</div>');
    }

    // HAPUS ROLE
    public function hapusRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Role has been deleted</div>');
        redirect('admin/role');
    }

    //  TAMBAH ROLE
    public function addRole()
    {
        $data['title'] = "Submenu Management";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('menu/role', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'role' => $this->input->post('role'),
            ];

            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Role Added</div>');
            redirect('admin/role');
        }
    }

    // USER LIST
    public function userList()
    {
        $data['title'] = "User List";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->menu->getUserList();

        $this->load->model('Menu_model', 'roles');
        $data['roles'] = $this->roles->getRoles();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/userlist', $data);
        $this->load->view('template/footer');
    }

    // ADD USER
    public function addUser()
    {
        $data['title'] = "User List";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->menu->getUserList();

        $this->load->model('Menu_model', 'roles');
        $data['roles'] = $this->roles->getRoles();


        $this->form_validation->set_rules('name', 'Username', 'required|is_unique[user.name]');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Pasword', 'required');
        $this->form_validation->set_rules('role_id', 'Role Id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/userlist', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id' => 'NULL',
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id'),
                'is_active' => 1,
                'date_created' => time(),
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                New User Added</div>');
            redirect('admin/userlist');
        }
    }

    // EDIT USER
    public function editUser($id)
    {
        $data['title'] = "User List";
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->menu->getUserList();

        $this->load->model('Menu_model', 'roles');
        $data['roles'] = $this->roles->getRoles();

        $this->form_validation->set_rules('roles', 'role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/userlist', $data);
            $this->load->view('template/footer');
        } else {
            $role_id = $this->input->post('roles');

            $this->db->set('role_id', $role_id);
            $this->db->where('id', $id);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Role Updated </div>');
            redirect('admin/userlist');
        }
    }

    // HAPUS ROLE
    public function hapusUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            User has been deleted</div>');
        redirect('admin/userlist');
    }

    // RESET PASSWORD
    public function resetPassword($id)
    {
        $pass = password_hash('default123', PASSWORD_DEFAULT);
        $this->db->set('password', $pass);
        $this->db->where('id', $id);
        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Password has been reset</div>');
        redirect('admin/userlist');
    }
}
