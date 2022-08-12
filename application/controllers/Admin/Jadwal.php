<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Jadwal_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Jadwal Mengajar', 'Admin/Jadwal');
        // output
        $data['title'] = 'Management Jadwal Mengajar';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['result'] = $this->Jadwal_model->get()->result();

        $this->template->admin('admin/jadwal/main', $data);
    }
    public function add()
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Jadwal', 'Admin/Jadwal');
        $this->breadcrumbs->push('Form Data', 'Admin/Jadwal/add/');
        // output
        $data['title'] = 'Form Jadwal';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_jadwal = null;
        $obj->hari = null;
        $obj->dari_waktu = null;
        $obj->sampai_waktu = null;

        $data['row'] = $obj;
        $data['page'] = 'add';

        $this->template->admin('admin/jadwal/form_data', $data);
    }
    public function process()
    {
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');
        $this->form_validation->set_rules('dari_waktu', 'Dari Jam', 'required|callback_validateWaktu');
        $this->form_validation->set_rules('sampai_waktu', 'Sampai Jam', 'required|callback_validateWaktu');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                $data_Jadwal = [
                    'hari' => htmlspecialchars($this->input->post('hari', true)),
                    'dari_waktu' => htmlspecialchars($this->input->post('dari_waktu', true)),
                    'sampai_waktu' => htmlspecialchars($this->input->post('sampai_waktu', true)),
                ];
                $insert_Jadwal = $this->Jadwal_model->insert($data_Jadwal);

                if ($insert_Jadwal > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/Jadwal/'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/Jadwal/'));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_jadwal', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_jadwal', true));
                $data_Jadwal = [
                    'hari' => htmlspecialchars($this->input->post('hari', true)),
                    'dari_waktu' => htmlspecialchars($this->input->post('dari_waktu', true)),
                    'sampai_waktu' => htmlspecialchars($this->input->post('sampai_waktu', true)),
                ];

                $update_Jadwal = $this->Jadwal_model->update($data_Jadwal, $id);
                if ($update_Jadwal > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Jadwal/'));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Jadwal/'));
                }
            }
        }
    }
    public function edit($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Jadwal Mengajar', 'Admin/Jadwal/index/');
        $this->breadcrumbs->push('Form Jadwal Mengajar', 'Admin/Jadwal/edit/' . $id);
        // output
        $data['title'] = 'Form Jadwal';
        $get = $this->Jadwal_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Jadwal Mengajar',
        ];
        $this->template->admin('admin/jadwal/form_data', $data);
    }
    public function delete($id_jadwal)
    {
        $delete = $this->Jadwal_model->delete($id_jadwal);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/Jadwal/'));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/Jadwal/'));
        }
    }
    public function validateWaktu()
    {
        $check = true;
        $dari_waktu = strtotime($this->input->post('dari_waktu', true));
        $sampai_waktu = strtotime($this->input->post('sampai_waktu', true));
        if ($dari_waktu > $sampai_waktu) {
            $this->form_validation->set_message('validateWaktu', 'Waktu tidak sesuai, periksa kembali setting waktu anda');
            $check = false;
        }
        return $check;
    }
}
