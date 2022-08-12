<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    }
    public function index()
    {
        $data['title'] = 'Forgot Password';
        $url = null;
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        }
        $data['url'] = $url;
        $this->template->login('forgot', $data);
    }
    public function process()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric_spaces|required');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if ($this->form_validation->run() == false) {
            return $this->index();
        } else {
            $url = $this->input->post('url', true);
            $username = $this->input->post('username', true);
            $model = $this->Users_model->login($username);
            if ($model->num_rows() > 0) {
                $row = $model->row();
                $data = [
                    'forgot' => 'iya'
                ];
                $update = $this->Users_model->update_users($data, $row->id_users);
                if ($update > 0) {
                    $this->session->set_flashdata('success', 'Silahkan menunggu untuk direset password dengan <strong>Admin</strong>');
                } else {
                    $this->session->set_flashdata('success', 'Silahkan menunggu password sedang di proses');
                }
                return redirect('/Forgot');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah');
                return redirect('/Forgot');
            }
        }
    }
}
