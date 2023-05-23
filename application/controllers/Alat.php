<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Alat_Model');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function update_qq()
    {
        $data['title']  = 'Update QQ';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $data['data_qq'] = $this->Alat_Model->GetQq();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('alat/qq/index', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('keyword');
    }

    public function filter_qq()
    {
        $data['title']  = 'Update QQ';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $noacc              = $this->input->post('noacc');
        $data['result_qq']  = $this->Alat_Model->filter_qq($noacc);
        $data['data_qq']    = $this->Alat_Model->GetQq();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('alat/qq/filter_qq', $data);
        $this->load->view('templates/footer');
    }

    public function edit_qq()
    {
        $this->Alat_Model->UpdateMtabunganB();
        $this->Alat_Model->UpdateMtabunganC();
        $this->Alat_Model->InsertLogQq();
        $this->session->set_flashdata('message', 'Changed');
        redirect('alat/update_qq');
    }

    public function update_nomor()
    {
        $data['title']  = 'Update Nomor';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $data['data_nomor'] = $this->Alat_Model->GetNomor();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('alat/nomor/index', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('keyword');
    }

    public function filter_nomor()
    {
        $data['title']  = 'Update Nomor';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $nocif                 = $this->input->post('nocif');
        $data['result_nomor']  = $this->Alat_Model->filter_nomor($nocif);
        $data['data_nomor']    = $this->Alat_Model->GetNomor();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('alat/nomor/filter_nomor', $data);
        $this->load->view('templates/footer');
    }

    public function edit_nomor()
    {
        $this->Alat_Model->UpdateMcif();
        $this->Alat_Model->InsertLogNomor();
        $this->session->set_flashdata('message', 'Changed');
        redirect('alat/update_nomor');
    }
}
