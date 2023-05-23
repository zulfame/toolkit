<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Menu_Model');
    }

    // QUERY MENU
    public function index()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('menu', $data['keyword']);
        $this->db->like('icon_menu', $data['keyword']);
        $this->db->from('user_menu');

        $config['base_url']     = site_url('menu/index');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $choice                 = $config["total_rows"] / $config["per_page"];
        $config["num_links"]    = floor($choice);
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['menu']       = $this->Menu_Model->GetMenu($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Menu';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('menu/menu', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('keyword');

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->Menu_Model->InsertMenu();
            $this->session->set_flashdata('message', 'Added');
            $this->session->unset_userdata('keyword');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function edit($id)
    {
        $data['title']  = 'Menu';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['menu']   = $this->Menu_Model->GetMenuId($id);

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/menu-edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_Model->UpdateMenu();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', 'Changed');
            redirect('menu');
        }
    }

    public function delete($id)
    {
        $this->Menu_Model->DeleteMenu($id);
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // QUERY SUBMENU
    public function submenu()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('title', $data['keyword']);
        $this->db->or_like('url', $data['keyword']);
        $this->db->or_like('icon', $data['keyword']);
        $this->db->or_like('menu', $data['keyword']);
        $this->db->join('user_menu', 'user_menu.id=user_submenu.menu_id');
        $this->db->from('user_submenu');

        $config['base_url']     = site_url('menu/submenu');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $choice                 = $config["total_rows"] / $config["per_page"];
        $config["num_links"]    = floor($choice);
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['submenu']    = $this->Menu_Model->GetSubmenu($config["per_page"], $data['page'], $data['keyword']);

        $data['active']     = ['1', '0'];
        $data['edit']       = $this->Menu_Model->GetSubmenuEdit();

        $data['title']  = 'Submenu';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['menu']   = $this->Menu_Model->ListMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('keyword');

        $this->form_validation->set_rules('menu_id', 'Menu ID', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->Menu_Model->InsertSubmenu();
            $this->session->set_flashdata('message', 'Added');
            $this->session->unset_userdata('keyword');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function submenu_edit()
    {
        $data['title']  = 'Menu';

        $this->form_validation->set_rules('menu_id', 'Menu ID', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('menu/submenu');
        } else {
            $this->Menu_Model->UpdateSubmenu();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', 'Changed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function submenu_delete($id)
    {
        $this->Menu_Model->DeleteSubmenu($id);
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
