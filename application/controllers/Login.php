<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }
    public function index()
    {
        check_already_login();
        $data['title'] = 'Login Session';
        $this->template->login('login', $data);
    }
    public function process()
    {
        check_already_login();
        $this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric_spaces|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim|alpha_numeric_spaces');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if ($this->form_validation->run() == false) {
            return $this->index();
        } else {
            $url = $this->input->post('url', true);
            $username = htmlspecialchars($this->input->post('username', true));
            $password = htmlspecialchars($this->input->post('password', true));
            $remember = htmlspecialchars($this->input->post('remember', true));
            $model = $this->Users_model->login($username, $password);
            if ($model->num_rows() > 0) {
                $row = $model->row();
                if ($row->level == 'siswa') {
                    $users = check_users($row->id_users);
                    if ($users->verifikasi == 0) {
                        $this->session->set_flashdata('error', 'Account belum diverifikasi harap sabar menunggu admin');
                        return redirect('/Login');
                    }
                }
                if ($remember != null) {
                    $key = hash('sha256', $row->username);
                    $this->db->update('users', ['cookie' => $key], ['id_users' => $row->id_users]);
                    set_cookie('cookie', $key, 60 * 60 * 24);
                }
                $this->session->set_userdata(['id_users' => $row->id_users,]);
                $this->session->set_flashdata('success', 'Selamat login! ' . $row->nama_users);

                $url = $this->session->userdata('url');
                if ($url != null) {
                    $this->session->unset_userdata('url');
                    return redirect($url);
                } else {
                    return redirect(base_url('Admin/Home'));
                }
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah');
                return redirect('/Login');
            }
        }
    }
}
