<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');
class Menu_Model extends ci_Model
{
    // QUERY FOR MENU
    public function GetMenu($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('menu', $keyword);
            $this->db->like('icon_menu', $keyword);
        }
        return $this->db->get('user_menu', $limit, $start)->result_array();
    }

    public function InsertMenu()
    {
        $data = [
            "menu"      => $this->input->post('menu', true),
            "icon_menu" => $this->input->post('icon', true),
        ];

        $this->db->insert('user_menu', $data);
    }

    public function GetMenuId($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function UpdateMenu()
    {
        $data = [
            "menu"      => $this->input->post('menu', true),
            "icon_menu" => $this->input->post('icon', true),
        ];

        $this->db->where("id", $this->input->post('id', true));
        return $this->db->update("user_menu", $data);
    }

    public function DeleteMenu($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete("user_menu");
    }

    // QUERY FOR SUBMENU
    public function GetSubmenu($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('title', $keyword);
            $this->db->or_like('url', $keyword);
            $this->db->or_like('icon', $keyword);
            $this->db->or_like('menu', $keyword);
        }
        $this->db->select('user_submenu.id, title, url, icon, is_active, menu');
        $this->db->join('user_menu', 'user_menu.id=user_submenu.menu_id');
        return $this->db->get('user_submenu', $limit, $start)->result_array();
    }

    public function ListMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function GetSubmenuEdit()
    {
        return $this->db->get('user_submenu')->result_array();
    }

    public function InsertSubmenu()
    {
        $data = [
            "menu_id"   => $this->input->post('menu_id', true),
            "title"     => $this->input->post('title', true),
            "url"       => $this->input->post('url', true),
            "icon"      => $this->input->post('icon', true),
            "is_active" => $this->input->post('is_active', true),
        ];

        $this->db->insert('user_submenu', $data);
    }

    public function UpdateSubmenu()
    {
        $data = [
            "id"        => $this->input->post('id', true),
            "menu_id"   => $this->input->post('menu_id', true),
            "title"     => $this->input->post('title', true),
            "url"       => $this->input->post('url', true),
            "icon"      => $this->input->post('icon', true),
            "is_active" => $this->input->post('is_active', true),
        ];

        $this->db->where("id", $this->input->post('id', true));
        return $this->db->update("user_submenu", $data);
    }

    public function DeleteSubmenu($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete("user_submenu");
    }
}
