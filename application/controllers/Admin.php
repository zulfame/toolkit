<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Role_Model');
        $this->load->model('Menu_Model');
        $this->load->model('Admin_Model');
    }

    public function index()
    {
        $data['title']  = 'Dashboard';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    // QUERY ROLE ACCESS
    public function role()
    {
        $data['user']    = $this->User_Model->GetProfile();

        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('role', $data['keyword']);
        $this->db->from('user_role');

        $config['base_url']         = site_url('admin/role');
        $config['total_rows']       = $this->db->count_all_results();
        $config['per_page']         = 10;
        $choice                     = $config["total_rows"] / $config["per_page"];
        $config["num_links"]        = floor($choice);
        $data['total_rows']         =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['role']       = $this->Role_Model->GetRole($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Access Rights';
        $data['site']       = $this->Site_Model->GetData();
        $data['edit']       = $this->Role_Model->GetRoleEdit();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/role/role', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('keyword');

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->Role_Model->InsertRole();
            $this->session->set_flashdata('message', 'Added');
            $this->session->unset_userdata('keyword');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function role_edit()
    {
        $data['title']  = 'Access Rights';
        $data['user']   = $this->User_Model->GetProfile();

        $this->form_validation->set_rules('id', 'Id', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('admin/role');
        } else {
            $this->Role_Model->UpdateRole();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', 'Changed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function role_access($id)
    {
        $data['title']  = 'Access Rights';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['role']   = $this->Role_Model->GetRoleId($id);
        $data['menu']   = $this->Role_Model->GetMenu($id);

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/role/access', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', 'Changed');
            redirect('admin/role');
        }
    }

    public function role_changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', 'Changed');
    }

    public function role_delete($id)
    {
        $this->Role_Model->DeleteRole($id);
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function configuration()
    {
        $data['title']  = 'Configuration';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/config/index', $data);
        $this->load->view('templates/footer');
        $this->session->unset_userdata('keyword');
    }

    // QUERY FOR CONTROL
    public function control()
    {
        $data['title']      = 'Control Panel';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['time']       = $this->Admin_Model->GetTime();
        $data['activity']   = $this->Admin_Model->GetActivity();
        $data['online']     = $this->Admin_Model->GetOnline();
        $data['c_online']   = $this->Admin_Model->CountOnline();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/control/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function backup()
    {

        $this->load->dbutil();

        // Backup database dan dijadikan variable
        $backup = $this->dbutil->backup();
        $namafile = "backup_simontok" . "_" . date("Ymd") . ".gz";

        // Load file helper dan menulis ke server untuk keperluan restore
        $this->load->helper('file');
        write_file(FCPATH . 'database/' . $namafile, $backup);

        // Load the download helper dan melalukan download ke komputer
        $this->load->helper('download');
        force_download($namafile, $backup);
    }

    // QUERY USERS
    public function user()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword', true);
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('name', $data['keyword']);
        $this->db->or_like('email', $data['keyword']);
        $this->db->or_like('role', $data['keyword']);
        $this->db->or_like('region', $data['keyword']);
        $this->db->or_like('user_code', $data['keyword']);
        $this->db->join('region', 'region.id=user.region_id');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        $this->db->from('user');

        $config['base_url']     = site_url('admin/user');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $choice                 = $config["total_rows"] / $config["per_page"];
        $config["num_links"]    = floor($choice);
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['all_user']   = $this->Admin_Model->GetUser($config["per_page"], $data['page'], $data['keyword']);

        $data['active']     = ['1', '0'];
        $data['m_access']   = ['1', '0'];
        $data['edit']       = $this->Admin_Model->GetUserEdit();

        $data['title']      = 'Data User';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['position']   = $this->Admin_Model->ListRole();
        $data['wilayah']    = $this->Admin_Model->ListRegion();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/user/index', $data);
        $this->load->view('templates/footer');
    }

    public function user_add()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('role_id', 'Role', 'required|trim');
        $this->form_validation->set_rules('region_id', 'Region', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');

        if ($this->form_validation->run() == true) {
            $this->Admin_Model->InsertUser();
            $this->session->set_flashdata('message', 'Added');
            $this->session->unset_userdata('keyword');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function user_edit()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('role_id', 'Role', 'required|trim');
        $this->form_validation->set_rules('region_id', 'Region', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message_failed', 'Failed to Change');
            redirect('master/user');
        } else {
            $this->Admin_Model->UpdateUser();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', 'Changed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function user_delete($id)
    {
        $this->Admin_Model->DeleteUser($id);
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function user_import()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path     = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow        = $worksheet->getHighestRow();
                $highestColumn     = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $id              = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $name            = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $email           = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $image           = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $password        = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $role_id         = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $region_id       = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $user_code       = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $is_active       = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $m_access        = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $data_user[]       = array(
                        'id'           => $id,
                        'name'         => $name,
                        'email'        => $email,
                        'image'        => $image,
                        'password'     => $password,
                        'role_id'      => $role_id,
                        'region_id'    => $region_id,
                        'user_code'    => $user_code,
                        'is_active'    => $is_active,
                        'm_access'     => $m_access,
                        'date_created' => time()
                    );
                }
            }
            $insert = $this->Admin_Model->UserImport($data_user);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('master/user');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('master/user');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }
}
