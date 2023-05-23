<?php defined('BASEPATH') or exit('No direct script access allowed');
class Site_Model extends ci_Model
{

    public function GetData()
    {
        return $this->db->query("SELECT * FROM site WHERE id = '1'")->row_array();
    }
}
