<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != TRUE) {
            $url = base_url();
            redirect($url);
        }
        $this->load->model('Dashboard_Model');
    }

    public function index()
    {
        $id = $this->session->userdata('role_id');
        if ($id == '1' || $id == '2' || $id == '3') {
            $data['title']  = 'Dashboard';
            $data['site']   = $this->Site_Model->GetData();
            $data['user']   = $this->User_Model->GetProfile();

            $data['total_qq']    = $this->Dashboard_Model->CountQq();
            $data['total_nomor'] = $this->Dashboard_Model->CountNomor();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('blocked');
        }
    }
}
