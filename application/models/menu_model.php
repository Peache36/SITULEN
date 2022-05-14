<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu.* , user_menu.menu 
        FROM user_sub_menu JOIN user_menu
        ON user_sub_menu.menu_id = user_menu.id";

        return $this->db->query($query)->result_array();
    }

    public function getUserList()
    {
        $query = "SELECT user.image , user.name, user_role.role, user.id
        FROM user JOIN user_role
        ON user.role_id = user_role.id";

        return $this->db->query($query)->result_array();
    }

    public function getStatusSurat()
    {
        $query = "SELECT surat.* , status_surat.status
        FROM surat JOIN status_surat
        ON surat.status_id = status_surat.id";

        return $this->db->query($query)->result_array();
    }

    public function getOptionSurat()
    {
        $query = "SELECT * FROM jenis_surat";
        return $this->db->query($query)->result_array();
    }

    public function getOptionStatus()
    {
        $query = "SELECT * FROM status_surat";
        return $this->db->query($query)->result_array();
    }

    public function getRoles()
    {
        $query = "SELECT * FROM user_role";
        return $this->db->query($query)->result_array();
    }

    public function downloadSurat($id)
    {
        $query = "SELECT surat.dokumen
        FROM surat WHERE surat.id = $id";

        return $this->db->query($query)->result_array();
    }

    public function statistik()
    {
        $query = "SELECT surat.date_created 
        FROM surat ";

        return $this->db->query($query)->result_array();
    }
}
