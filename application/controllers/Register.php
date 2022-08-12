<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_model', 'Profile_model']);
    }
    public function index()
    {
        $data['title'] = 'Register Siswa';

        $obj = new stdClass();
        $obj->id_users = null;
        $obj->username = null;
        $obj->password = null;
        $obj->level = null;
        $obj->nama_profile = null;
        $obj->jenis_kelamin = null;
        $obj->no_hp = null;
        $obj->alamat = null;
        $obj->gambar_profile = null;
        $obj->nomor_induk = null;
        // $obj->agama_id = null;

        // $data['agama'] = $this->Agama_model->get()->result();
        $data['row'] = $obj;
        $data['page'] = 'add';
        $this->template->login('register', $data);
    }
    public function process()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]|matches[password]');
        $this->form_validation->set_rules('gambar_profile', 'Gambar Profile', 'callback_validate_image');
        $this->form_validation->set_rules('nama_profile', 'Nama profile', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. handphone', 'required|trim');
        $this->form_validation->set_rules('nomor_induk', 'Nomor induk', 'required|trim');

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

        if ($this->form_validation->run() == false) {
            return $this->index();
        } else {
            $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
            $gambar_profile = $this->uploadGambar($jenis_kelamin);
            $data_users = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => md5(htmlspecialchars($this->input->post('password', true))),
                'level' =>  'siswa',
            ];
            $insert_users = $this->Users_model->insert($data_users);

            $data_profile = [
                'jenis_kelamin' =>  $jenis_kelamin,
                'nama_profile' =>  htmlspecialchars($this->input->post('nama_profile', true)),
                'no_hp' =>  htmlspecialchars($this->input->post('no_hp', true)),
                'alamat' =>  htmlspecialchars($this->input->post('alamat', true)),
                'nomor_induk' =>  htmlspecialchars($this->input->post('nomor_induk', true)),
                'gambar_profile' =>  $gambar_profile,
                'users_id' => $insert_users,
                //'agama_id' => htmlspecialchars($this->input->post('agama_id', true)),
                'verifikasi' => 0
            ];
            $insert_profile = $this->Profile_model->insert($data_profile);
            if ($insert_profile > 0 || $insert_users > 0) {
                $this->session->set_flashdata('success', 'Berhasil tambah data');
                return redirect(base_url('Login'));
            } else {
                $this->session->set_flashdata('error', 'Gagal tambah data');
                return redirect(base_url('Login'));
            }
        }
    }
    private function uploadGambar($jenis_kelamin = '', $id_users = '')
    {
        $gambar = $_FILES["gambar_profile"]['name'];
        if ($gambar != null) {
            $this->removeImage($id_users);
            $config['upload_path'] = './public/image/users';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = true;
            $new_name = rand(1000, 100000) . time() . $_FILES["gambar_profile"]['name'];
            $config['file_name'] = $new_name;
            // $config['max_size'] = 1024;
            // $config['max_width'] = 1024;
            // $config['max_height'] = 768;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar_profile')) {
                echo $this->upload->display_errors();
            } else {
                $gambar = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/image/users/' . $gambar['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 600;
                $config['height'] = 600;
                $config['new_image'] = './public/image/users/' . $gambar['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                return $gambar['file_name'];
            }
        } else {
            $users = $this->Users_model->joinProfile($id_users)->row();
            if ($users->gambar_profile != 'male.png' && $users->gambar_profile != 'female.png') {
                return $users->gambar_profile;
            } else {
                if ($jenis_kelamin == 'L') {
                    return 'male.png';
                } else {
                    return 'female.png';
                }
            }
        }
    }

    private function removeImage($id)
    {
        if ($id != null) {
            $img = $this->Users_model->joinProfile($id)->row();
            if ($img->gambar_profile != 'female.png' && $img->gambar_profile != 'male.png') {
                $filename = explode('.', $img->gambar_profile)[0];
                return array_map('unlink', glob(FCPATH . "public/image/users/" . $filename . '.*'));
            }
        }
    }

    public function validate_image()
    {
        $check = TRUE;
        if (isset($_FILES['gambar_profile']) && $_FILES['gambar_profile']['size'] != 0) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $extension = pathinfo($_FILES["gambar_profile"]["name"], PATHINFO_EXTENSION);
            $detectedType = exif_imagetype($_FILES['gambar_profile']['tmp_name']);
            $type = $_FILES['gambar_profile']['type'];
            if (!in_array($detectedType, $allowedTypes)) {
                $this->form_validation->set_message('validate_image', 'Type gambar tidak didukung');
                $check = FALSE;
            }
            if (filesize($_FILES['gambar_profile']['tmp_name']) > 1000000) {
                $this->form_validation->set_message('validate_image', 'Gambar melebihi 1 MB');
                $check = FALSE;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('validate_image', "Tidak didukung format {$extension}");
                $check = FALSE;
            }
        }
        return $check;
    }
}
