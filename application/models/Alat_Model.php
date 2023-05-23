<?php defined('BASEPATH') or exit('No direct script access allowed');
class Alat_Model extends ci_Model
{
    public function GetQq()
    {
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get('_log_update_qq')->result_array();
    }

    public function filter_qq($noacc)
    {
        // Load database
        $db2 = $this->load->database('sqlsrv', TRUE);

        return $db2->get_where('m_tabunganb', ['noacc' => $noacc])->row_array();
    }

    public function UpdateMtabunganB()
    {
        // Load database
        $db2 = $this->load->database('sqlsrv', TRUE);

        $data = [
            "fnama" => $this->input->post('fnama', true),
        ];

        $db2->where("noacc", $this->input->post('noacc', true));
        return $db2->update("m_tabunganb", $data);
    }

    public function UpdateMtabunganC()
    {
        // Load database
        $db2 = $this->load->database('sqlsrv', TRUE);

        $data = [
            "fnama" => $this->input->post('fnama', true),
        ];

        $db2->where("noacc", $this->input->post('noacc', true));
        return $db2->update("m_tabunganc", $data);
    }

    public function InsertLogQq()
    {
        $petugas =  $this->session->userdata('name');
        $data = [
            "noacc"   => $this->input->post('noacc', true),
            "debitur" => $this->input->post('fnama', true),
            "petugas" => $petugas,
        ];

        $this->db->insert('_log_update_qq', $data);
    }

    public function filter_nomor($nocif)
    {
        // Load database
        $db2 = $this->load->database('sqlsrv', TRUE);

        return $db2->get_where('m_cif', ['nocif' => $nocif])->row_array();
    }

    public function GetNomor()
    {
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get('_log_update_nomor')->result_array();
    }

    public function UpdateMcif()
    {
        // Load database
        $db2 = $this->load->database('sqlsrv', TRUE);

        $data = [
            "nohp" => $this->input->post('nohp', true),
        ];

        $db2->where("nocif", $this->input->post('nocif', true));
        return $db2->update("m_cif", $data);
    }

    public function InsertLogNomor()
    {
        $petugas =  $this->session->userdata('name');
        $data = [
            "nocif"   => $this->input->post('nocif', true),
            "debitur" => $this->input->post('fname', true),
            "nohp"    => $this->input->post('nohp', true),
            "petugas" => $petugas,
        ];

        $this->db->insert('_log_update_nomor', $data);
    }
}
