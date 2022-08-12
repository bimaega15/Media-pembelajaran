<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kompetensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Kompetensi_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Kompetensi Mengajar', 'Admin/Kompetensi');
        // output
        $data['title'] = 'Management Kompetensi Mengajar';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['result'] = $this->Kompetensi_model->get()->result();

        $this->template->admin('admin/kompetensi/main', $data);
    }
    public function add()
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Form Data', 'Admin/Kompetensi/add/');
        // output
        $data['title'] = 'Form Kompetensi';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_kompetensi = null;
        $obj->judul_kompetensi = null;
        $obj->keterangan_kompetensi = null;
        $obj->file_kompetensi = null;


        $data['row'] = $obj;
        $data['page'] = 'add';

        $this->template->admin('admin/kompetensi/form_data', $data);
    }
    public function process()
    {
        $this->form_validation->set_rules('judul_kompetensi', 'Nama Kompetensi', 'required|trim');
        $this->form_validation->set_rules('keterangan_kompetensi', 'Keterangan Kompetensi', 'required|trim');
        $this->form_validation->set_rules('file_kompetensi', 'File Kompetensi', 'callback_fileKompetensi');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                $uploadFile = $this->uploadFile();
                $data_Kompetensi = [
                    'judul_kompetensi' => htmlspecialchars($this->input->post('judul_kompetensi', true)),
                    'keterangan_kompetensi' => htmlspecialchars($this->input->post('keterangan_kompetensi', true)),
                    'file_kompetensi' => $uploadFile
                ];
                $insert_Kompetensi = $this->Kompetensi_model->insert($data_Kompetensi);

                if ($insert_Kompetensi > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/Kompetensi/'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/Kompetensi/'));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_kompetensi', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_kompetensi', true));
                $uploadFile = $this->uploadFile($id);
                $data_Kompetensi = [
                    'judul_kompetensi' => htmlspecialchars($this->input->post('judul_kompetensi', true)),
                    'keterangan_kompetensi' => htmlspecialchars($this->input->post('keterangan_kompetensi', true)),
                    'file_kompetensi' => $uploadFile
                ];

                $update_Kompetensi = $this->Kompetensi_model->update($data_Kompetensi, $id);
                if ($update_Kompetensi > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Kompetensi/'));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Kompetensi/'));
                }
            }
        }
    }
    public function edit($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Kompetensi Mengajar', 'Admin/Kompetensi/index/');
        $this->breadcrumbs->push('Form Kompetensi Mengajar', 'Admin/Kompetensi/edit/' . $id);
        // output
        $data['title'] = 'Form Kompetensi';
        $get = $this->Kompetensi_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Kompetensi Mengajar',
        ];
        $this->template->admin('admin/kompetensi/form_data', $data);
    }
    public function detail($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Kompetensi Mengajar', 'Admin/Kompetensi/index/');
        $this->breadcrumbs->push('Form Kompetensi Mengajar', 'Admin/Kompetensi/detail/' . $id);
        // output
        $data['title'] = 'Detail Kompetensi';
        $get = $this->Kompetensi_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'detail',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'detail Kompetensi Mengajar',
        ];
        $this->template->admin('admin/kompetensi/detail', $data);
    }
    public function delete($id_kompetensi)
    {
        $this->removeFile($id_kompetensi);
        $delete = $this->Kompetensi_model->delete($id_kompetensi);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/Kompetensi/'));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/Kompetensi/'));
        }
    }
    public function fileKompetensi()
    {
        $check = TRUE;
        if (isset($_FILES['file_kompetensi']) && $_FILES['file_kompetensi']['size'] != 0) {
            $allowedExts = array("docx", "pptx", "pdf", 'xlsx', 'csv', 'xls');
            $extension = pathinfo($_FILES["file_kompetensi"]["name"], PATHINFO_EXTENSION);

            if (filesize($_FILES['file_kompetensi']['tmp_name']) > 5000000) {
                $this->form_validation->set_message('fileKompetensi', 'file melebihi 5 MB');
                $check = FALSE;
            }

            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('fileKompetensi', "Tidak didukung format {$extension}");
                $check = FALSE;
            }
        } else {
            if (isset($_POST['add'])) {
                if (!$_FILES['file_kompetensi']['name']) {
                    $this->form_validation->set_message('fileKompetensi', "File materi harus diupload");
                    $check = FALSE;
                }
            }
        }
        return $check;
    }


    private function uploadFile($id_file = '')
    {
        $file = $_FILES["file_kompetensi"]['name'];
        if ($file != null) {
            $this->removeFile($id_file);
            $config['upload_path'] = './public/image/file';
            $config['allowed_types'] = 'docx|pptx|pdf|xlsx|xls|csv';
            $config['overwrite'] = true;
            $new_name = rand(1000, 100000) . time() . str_replace(' ', '_', $_FILES["file_kompetensi"]['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file_kompetensi')) {
                $file = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/image/file/' . $file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 600;
                $config['height'] = 600;
                $config['new_image'] = './public/image/file/' . $file['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                return $file['file_name'];
            }
        } else {
            $data = $this->Kompetensi_model->get($id_file)->row();
            if ($data != null) {
                return $data->file_kompetensi;
            }
        }
    }

    private function removeFile($id)
    {
        if ($id != null) {
            $data = $this->Kompetensi_model->get($id)->row();
            if ($data != null) {
                $filename = explode('.', $data->file_kompetensi)[0];
                return array_map('unlink', glob(FCPATH . "public/image/file/" . $filename . '.*'));
            }
        }
    }
}
