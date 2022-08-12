<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Materi_model', 'Users_model', 'Jadwal_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi Mengajar', 'Admin/Materi');
        // output
        $data['title'] = 'Management Materi Mengajar';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['result'] = $this->Materi_model->get()->result();

        $this->template->admin('admin/materi/main', $data);
    }
    public function add()
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Form Data', 'Admin/Materi/add/');
        // output
        $data['title'] = 'Form Materi';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_materi = null;
        $obj->judul_materi = null;
        $obj->tanggal_materi = null;
        $obj->users_id = null;
        $obj->jadwal_id = null;

        $data['users'] = $this->Users_model->joinProfile(null, null, 'guru')->result();
        $data['jadwal'] = $this->Jadwal_model->get()->result();
        $data['row'] = $obj;
        $data['page'] = 'add';

        $this->template->admin('admin/materi/form_data', $data);
    }
    public function process()
    {

        $this->form_validation->set_rules('judul_materi', 'Nama Materi', 'required|trim');
        $this->form_validation->set_rules('users_id', 'Guru', 'required|trim');
        $this->form_validation->set_rules('jadwal_id', 'Jadwal', 'required|trim');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                $data_Materi = [
                    'judul_materi' => htmlspecialchars($this->input->post('judul_materi', true)),
                    'tanggal_materi' => htmlspecialchars(date('Y-m-d')),
                    'users_id' => htmlspecialchars($this->input->post('users_id', true)),
                    'jadwal_id' => htmlspecialchars($this->input->post('jadwal_id', true)),
                ];
                $insert_Materi = $this->Materi_model->insert($data_Materi);

                if ($insert_Materi > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/Materi/'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/Materi/'));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_materi', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_materi', true));
                $data_Materi = [
                    'judul_materi' => htmlspecialchars($this->input->post('judul_materi', true)),
                    'tanggal_materi' => htmlspecialchars(date('Y-m-d')),
                    'users_id' => htmlspecialchars($this->input->post('users_id', true)),
                    'jadwal_id' => htmlspecialchars($this->input->post('jadwal_id', true)),
                ];

                $update_Materi = $this->Materi_model->update($data_Materi, $id);
                if ($update_Materi > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Materi/'));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Materi/'));
                }
            }
        }
    }
    public function edit($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi Mengajar', 'Admin/Materi/index/');
        $this->breadcrumbs->push('Form Materi Mengajar', 'Admin/Materi/edit/' . $id);
        // output
        $data['title'] = 'Form Materi';
        $get = $this->Materi_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Materi Mengajar',
            'users' => $this->Users_model->joinProfile(null, null, 'guru')->result(),
            'jadwal' => $this->Jadwal_model->get()->result()
        ];
        $this->template->admin('admin/materi/form_data', $data);
    }
    public function detail($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi Mengajar', 'Admin/Materi/index/');
        $this->breadcrumbs->push('Form Materi Mengajar', 'Admin/Materi/detail/' . $id);
        // output
        $data['title'] = 'Detail Materi';
        $get = $this->Materi_model->get($id)->row();
        $data = [
            'row' => $get,
            "page" => 'detail',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Detail Materi Mengajar',
            'users' => $this->Users_model->joinProfile(null, null, 'guru')->result(),
            'jadwal' => $this->Jadwal_model->get()->result()
        ];
        $this->template->admin('admin/materi/detail', $data);
    }
    public function delete($id_materi)
    {
        $delete = $this->Materi_model->delete($id_materi);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/Materi/'));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/Materi/'));
        }
    }
}
