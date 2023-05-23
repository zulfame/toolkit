<?php defined('BASEPATH') or exit('No direct script access allowed');
class Admin_Model extends ci_Model
{
    public function GetTime()
    {
        $id = 1;

        $this->db->where("idwaktu", $id);
        return $this->db->get('waktu')->row_array();
    }

    public function GetActivity()
    {
        $this->db->order_by('log_time', 'DESC');
        return $this->db->get('_log_auth')->result_array();
    }

    public function GetOnline()
    {
        $id = 1;

        $this->db->where("is_online", $id);
        return $this->db->get('user')->result_array();
    }

    public function CountOnline()
    {
        $id = 1;

        $this->db->where("is_online", $id);
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    public function TimeUpdate()
    {
        $data = [
            "tgl_awal"  => $this->input->post('date1', true),
            "tgl_akhir" => $this->input->post('date2', true),
        ];

        $this->db->where("idwaktu", $this->input->post('id', true));
        return $this->db->update("waktu", $data);
    }

    // QUERY USERS
    public function GetUser($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('name', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->or_like('role', $keyword);
            $this->db->or_like('region', $keyword);
            $this->db->or_like('user_code', $keyword);
        }
        $this->db->select('user.id, name, email, role, region, user_code, is_active, m_access, date_created');
        $this->db->join('region', 'region.id=user.region_id');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        return $this->db->get('user', $limit, $start)->result_array();
    }

    public function InsertUser()
    {
        $pass = 111;
        $data = [
            "name"          => $this->input->post('name', true),
            "email"         => $this->input->post('email', true),
            "password"      => password_hash($pass, PASSWORD_DEFAULT),
            "role_id"       => $this->input->post('role_id', true),
            "region_id"     => $this->input->post('region_id', true),
            "is_active"     => $this->input->post('is_active', true),
            "date_created"  => time()
        ];

        $this->db->insert('user', $data);
    }

    public function GetUserEdit()
    {
        return $this->db->get('user')->result_array();
    }

    public function ListRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function ListRegion()
    {
        return $this->db->get('region')->result_array();
    }

    public function ListPetugas()
    {
        $this->db->where('role_id', '5');
        $this->db->where('is_active', '1');
        return $this->db->get('user')->result_array();
    }

    public function UpdateUser()
    {
        $data = [
            "id"            => $this->input->post('id', true),
            "email"         => $this->input->post('email', true),
            "role_id"       => $this->input->post('role_id', true),
            "region_id"     => $this->input->post('region_id', true),
            "is_active"     => $this->input->post('is_active', true),
        ];

        $this->db->where("id", $this->input->post('id', true));
        return $this->db->update("user", $data);
    }

    public function DeleteUser($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete("user");
    }

    public function UserImport($data)
    {
        $insert = $this->db->insert_batch('user', $data);
        if ($insert) {
            return true;
        }
    }
}
