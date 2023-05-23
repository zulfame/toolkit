<?php defined('BASEPATH') or exit('No direct script access allowed');
class User_Model extends ci_Model
{

    public function UpdateProfile()
    {
        $email = $this->session->userdata('email');
        $data = [
            "name"      => $this->input->post('name', true),
        ];

        $this->db->where("email", $email);
        return $this->db->update("user", $data);
    }

    public function GetProfile()
    {
        $email = $this->session->userdata('email');

        $this->db->join('region', 'region.id=user.region_id');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        $this->db->where("email", $email);
        return $this->db->get('user')->row_array();
    }
}
