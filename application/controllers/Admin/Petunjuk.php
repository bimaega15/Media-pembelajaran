<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petunjuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Petunjuk_model');
        $this->session->set_userdata('url_login', current_url());

        $profile = check_profile();
        if ($profile->level == 'siswa' || $profile->level == 'guru') {
            $this->session->set_userdata('url_login', base_url('Admin/Home'));
            show_error('403 AUTHENTICATION', 403);
        }
    }
    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Petunjuk', 'Admin/Petunjuk');
        // output
        $data['title'] = 'Dashboard';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $Petunjuk = check_petunjuk();
        if ($Petunjuk != null) {
            $data['row'] = $Petunjuk;
            $data['page'] = 'edit';
        } else {
            $obj = new stdClass();
            $obj->id_petunjuk = null;
            $obj->judul_petunjuk = null;
            $obj->keterangan = null;
            $data['page'] = 'add';
            $data['row'] = $obj;
        }
        $this->template->admin('admin/petunjuk/main', $data);
    }
    public function process()
    {
        $this->form_validation->set_rules('judul_petunjuk', 'Judul Petunjuuk', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->index();
            } else {
                $data_Petunjuk = [
                    'judul_petunjuk' => htmlspecialchars($this->input->post('judul_petunjuk', true)),
                    'keterangan' => ($this->input->post('keterangan', true)),
                ];
                $insert_Petunjuk = $this->Petunjuk_model->insert($data_Petunjuk);
                if ($insert_Petunjuk > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/Petunjuk'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/Petunjuk'));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                return $this->index();
            } else {
                $id = htmlspecialchars($this->input->post('id_petunjuk', true));
                $data_Petunjuk = [
                    'judul_petunjuk' => htmlspecialchars($this->input->post('judul_petunjuk', true)),
                    'keterangan' => ($this->input->post('keterangan', true)),
                ];
                $update_Petunjuk = $this->Petunjuk_model->update($data_Petunjuk, $id);

                if ($update_Petunjuk > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Petunjuk'));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Petunjuk'));
                }
            }
        }
    }
}
