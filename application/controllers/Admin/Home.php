<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Users_model']);
        $this->session->set_userdata('url_login', current_url());
    }

    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        // output
        $data['title'] = 'Dashboard';
        $data['breadcrumb'] = $this->breadcrumbs->show();

        $data['admin'] = $this->db->get_where('users', ['level' => 'admin'])->num_rows();
        $data['guru'] = $this->db->get_where('users', ['level' => 'guru'])->num_rows();
        $data['siswa'] = $this->db->get_where('users', ['level' => 'siswa'])->num_rows();
        $data['materi'] = $this->db->get_where('materi')->num_rows();

        $this->template->admin('admin/home/main', $data);
    }
}
