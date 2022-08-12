<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['File_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('File', 'Admin/File?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Management File';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $materi_id = $this->input->get('materi_id');
        $data['result'] = $this->File_model->get(null, $materi_id)->result();
        $data['materi_id'] = $materi_id;
        $this->template->admin('admin/file/main', $data);
    }
    public function add()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('File', 'Admin/File?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Data', 'Admin/File/add?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form File';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_file = null;
        $obj->judul_file = null;
        $obj->lampiran_file = null;


        $data['row'] = $obj;
        $data['page'] = 'add';
        $data['materi_id'] = $materi_id;

        $this->template->admin('admin/file/form_data', $data);
    }
    public function process()
    {
        $materi_id = $this->input->post('materi_id', true);
        $this->form_validation->set_rules('judul_file', 'Nama File', 'required|trim');
        $this->form_validation->set_rules('lampiran_file', 'Nama File', 'callback_lampiranFile');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                $lampiran_file = $this->uploadFile();
                $data_File = [
                    'judul_file' => htmlspecialchars($this->input->post('judul_file', true)),
                    'lampiran_file' => $lampiran_file,
                    'tanggal_entri' => date('Y-m-d H:i:s'),
                    'materi_id' => $materi_id,
                ];
                $insert_File = $this->File_model->insert($data_File);

                if ($insert_File > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/File?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/File?materi_id=' . $materi_id));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_file', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_file', true));
                $lampiran_file = $this->uploadFile($id);
                $data_File = [
                    'judul_file' => htmlspecialchars($this->input->post('judul_file', true)),
                    'lampiran_file' => $lampiran_file,
                    'tanggal_entri' => date('Y-m-d H:i:s'),
                    'materi_id' => $materi_id,
                ];

                $update_File = $this->File_model->update($data_File, $id);
                if ($update_File > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/File?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/File?materi_id=' . $materi_id));
                }
            }
        }
    }
    public function edit($id)
    {
        $materi_id = $this->input->get('materi_id');

        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('File', 'Admin/File?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form File', 'Admin/File/edit/' . $id . '?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form File';
        $get = $this->File_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit File',
            'materi_id' => $materi_id
        ];
        $this->template->admin('admin/file/form_data', $data);
    }
    public function delete($id_file)
    {
        $this->removeFile($id_file);
        $materi_id = $this->input->get('materi_id');
        $delete = $this->File_model->delete($id_file);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/File?materi_id=' . $materi_id));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/File?materi_id=' . $materi_id));
        }
    }
    public function lampiranFile()
    {
        $check = TRUE;
        if (isset($_FILES['lampiran_file']) && $_FILES['lampiran_file']['size'] != 0) {
            $allowedExts = array("docx", "pptx", "pdf");
            $extension = pathinfo($_FILES["lampiran_file"]["name"], PATHINFO_EXTENSION);

            if (filesize($_FILES['lampiran_file']['tmp_name']) > 5000000) {
                $this->form_validation->set_message('lampiranFile', 'file melebihi 5 MB');
                $check = FALSE;
            }

            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('lampiranFile', "Tidak didukung format {$extension}");
                $check = FALSE;
            }
        } else {
            if (isset($_POST['add'])) {
                if (!$_FILES['lampiran_file']['name']) {
                    $this->form_validation->set_message('lampiranFile', "File materi harus diupload");
                    $check = FALSE;
                }
            }
        }
        return $check;
    }


    private function uploadFile($id_file = '')
    {
        $file = $_FILES["lampiran_file"]['name'];
        if ($file != null) {
            $this->removeFile($id_file);
            $config['upload_path'] = './public/image/lampiran';
            $config['allowed_types'] = 'docx|pptx|pdf';
            $config['overwrite'] = true;
            $new_name = rand(1000, 100000) . time() . str_replace(' ', '_', $_FILES["lampiran_file"]['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('lampiran_file')) {
                $file = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/image/lampiran/' . $file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 600;
                $config['height'] = 600;
                $config['new_image'] = './public/image/lampiran/' . $file['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                return $file['file_name'];
            }
        } else {
            $data = $this->File_model->get($id_file)->row();
            if ($data != null) {
                return $data->lampiran_file;
            }
        }
    }

    private function removeFile($id)
    {
        if ($id != null) {
            $data = $this->File_model->get($id)->row();
            if ($data != null) {
                $filename = explode('.', $data->lampiran_file)[0];
                return array_map('unlink', glob(FCPATH . "public/image/lampiran/" . $filename . '.*'));
            }
        }
    }
}
