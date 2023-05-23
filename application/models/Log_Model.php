<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Log_Model extends CI_Model
{

    public function LogAuth($param)
    {
        $sql        = $this->db->insert_string('_log_auth', $param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }
}
