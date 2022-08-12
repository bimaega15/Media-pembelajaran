<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VideoPembelajaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['VideoPembelajaran_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Video Pembelajaran', 'Admin/VideoPembelajaran?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Management Video Pembelajaran';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $materi_id = $this->input->get('materi_id');
        $data['result'] = $this->VideoPembelajaran_model->get(null, $materi_id)->result();
        $data['materi_id'] = $materi_id;
        $this->template->admin('admin/videopembelajaran/main', $data);
    }
    public function add()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Video Pembelajaran', 'Admin/VideoPembelajaran?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Data', 'Admin/VideoPembelajaran/add?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form VideoPembelajaran';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_video = null;
        $obj->judul_video = null;
        $obj->link_video = null;
        $obj->file_video = null;
        $obj->url_video = null;


        $data['row'] = $obj;
        $data['page'] = 'add';
        $data['materi_id'] = $materi_id;

        $this->template->admin('admin/videopembelajaran/form_data', $data);
    }
    public function process()
    {
        $materi_id = $this->input->post('materi_id', true);
        $link_video = $this->input->post('link_video', true);

        if ($link_video == '0') {
            $this->form_validation->set_rules('judul_video', 'Judul Video Materi', 'required|trim');
            $this->form_validation->set_rules('file_video', 'Judul Video Materi', 'callback_uploadVideoMateri');
        } else if ($link_video == '1') {
            $this->form_validation->set_rules('url_video', 'URL Video', 'required');
        }
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                if ($link_video == '0') {
                    $file_video = $this->uploadVideoPembelajaran();
                    $dataVideo = [
                        'judul_video' => $this->input->post('judul_video', true),
                        'file_video' => $file_video,
                        'link_video' => $link_video,
                        'tanggal_entri' => date('Y-m-d'),
                        'materi_id' => $materi_id
                    ];
                } else if ($link_video == '1') {
                    $dataVideo = [
                        'judul_video' => $this->input->post('judul_video', true),
                        'link_video' => $link_video,
                        'url_video' => $this->input->post('url_video', true),
                        'tanggal_entri' => date('Y-m-d'),
                        'materi_id' => $materi_id
                    ];
                }

                $insert_VideoPembelajaran = $this->VideoPembelajaran_model->insert($dataVideo);
                if ($insert_VideoPembelajaran > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/VideoPembelajaran?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/VideoPembelajaran?materi_id=' . $materi_id));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_video', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_video', true));
                if ($link_video == '0') {
                    $file_video = $this->uploadVideoPembelajaran($id);
                    $dataVideo = [
                        'judul_video' => $this->input->post('judul_video', true),
                        'file_video' => $file_video,
                        'link_video' => $link_video,
                        'tanggal_entri' => date('Y-m-d'),
                        'materi_id' => $materi_id
                    ];
                } else if ($link_video == '1') {
                    $dataVideo = [
                        'judul_video' => $this->input->post('judul_video', true),
                        'link_video' => $link_video,
                        'url_video' => $this->input->post('url_video', true),
                        'tanggal_entri' => date('Y-m-d'),
                        'materi_id' => $materi_id
                    ];
                }

                $update_VideoPembelajaran = $this->VideoPembelajaran_model->update($dataVideo, $id);
                if ($update_VideoPembelajaran > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/VideoPembelajaran?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/VideoPembelajaran?materi_id=' . $materi_id));
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
        $this->breadcrumbs->push('Video Pembelajaran', 'Admin/VideoPembelajaran?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Video Pembelajaran', 'Admin/VideoPembelajaran/edit/' . $id . '?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form Video Pembelajaran';
        $get = $this->VideoPembelajaran_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Video Pembelajaran',
            'materi_id' => $materi_id
        ];
        $this->template->admin('admin/videopembelajaran/form_data', $data);
    }
    public function detail($id)
    {
        $materi_id = $this->input->get('materi_id');

        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Video Pembelajaran', 'Admin/VideoPembelajaran?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Detail Video Pembelajaran', 'Admin/VideoPembelajaran/edit/' . $id . '?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Detail Video Pembelajaran';
        $get = $this->VideoPembelajaran_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'detail',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Detail Video Pembelajaran',
            'materi_id' => $materi_id
        ];
        $this->template->admin('admin/videopembelajaran/detail', $data);
    }
    public function delete($id_video)
    {
        $this->removeVideoPembelajaran($id_video);
        $materi_id = $this->input->get('materi_id');
        $delete = $this->VideoPembelajaran_model->delete($id_video);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/VideoPembelajaran?materi_id=' . $materi_id));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/VideoPembelajaran?materi_id=' . $materi_id));
        }
    }
    public function uploadVideoMateri()
    {
        $check = TRUE;
        if (isset($_FILES['file_video']) && $_FILES['file_video']['size'] != 0) {
            $allowedExts = array("mp4", "mkv", "3gp", 'flv', 'FLV', 'webm', 'Vob', 'MOV', 'AVI');
            $extension = pathinfo($_FILES["file_video"]["name"], PATHINFO_EXTENSION);

            if (filesize($_FILES['file_video']['tmp_name']) > 50000000) {
                $this->form_validation->set_message('uploadVideoMateri', 'Video Pembelajaran melebihi 50 MB');
                $check = FALSE;
            }

            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('uploadVideoMateri', "Tidak didukung format {$extension}");
                $check = FALSE;
            }
        } else {
            if (isset($_POST['add'])) {
                if (!$_FILES['file_video']['name']) {
                    $this->form_validation->set_message('uploadVideoMateri', "Video Pembelajaran materi harus diupload");
                    $check = FALSE;
                }
            }
        }
        return $check;
    }


    private function uploadVideoPembelajaran($id_video = '')
    {
        $VideoPembelajaran = $_FILES["file_video"]['name'];
        if ($VideoPembelajaran != null) {
            $this->removeVideoPembelajaran($id_video);
            $config['upload_path'] = './public/image/video';
            $config['allowed_types'] = 'mp4|mkv|3gp|flv|FLV|webm|Vob|MOV|AVI';
            $config['overwrite'] = true;
            $new_name = rand(1000, 100000) . time() . str_replace(' ', '_', $_FILES["file_video"]['name']);
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file_video')) {
                $VideoPembelajaran = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/image/video/' . $VideoPembelajaran['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 600;
                $config['height'] = 600;
                $config['new_image'] = './public/image/video/' . $VideoPembelajaran['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                return $VideoPembelajaran['file_name'];
            }
        } else {
            $data = $this->VideoPembelajaran_model->get($id_video)->row();
            if ($data->file_video != null) {
                return $data->file_video;
            }
        }
    }

    private function removeVideoPembelajaran($id)
    {
        if ($id != null) {
            $data = $this->VideoPembelajaran_model->get($id)->row();
            if ($data->file_video != null) {
                $VideoPembelajaranname = explode('.', $data->file_video)[0];
                return array_map('unlink', glob(FCPATH . "public/image/video/" . $VideoPembelajaranname . '.*'));
            }
        }
    }
}
