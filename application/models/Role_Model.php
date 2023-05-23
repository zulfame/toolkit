<?php defined('BASEPATH') or exit('No direct script access allowed');
class Role_Model extends ci_Model
{

    public function GetRole($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('role', $keyword);
        }
        return $this->db->get('user_role', $limit, $start)->result_array();
    }

    public function InsertRole()
    {
        $data = [
            "role" => $this->input->post('role', true),
        ];

        $this->db->insert('user_role', $data);
    }

    public function GetRoleEdit()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function UpdateRole()
    {
        $data = [
            "id"        => $this->input->post('id', true),
            "role"   => $this->input->post('role', true),
        ];

        $this->db->where("id", $this->input->post('id', true));
        return $this->db->update("user_role", $data);
    }

    public function GetRoleId($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    public function GetMenu()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('user_menu')->result_array();
    }

    public function DeleteRole($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete("user_role");
    }
}
