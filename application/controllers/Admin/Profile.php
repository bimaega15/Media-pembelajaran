<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_model', 'Profile_model']);
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Profile', 'Admin/Profile');
        // output ,'Agama_model'
        $data['title'] = 'Profile';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['profile'] = check_profile();
        //$data['agama'] = $this->Agama_model->get()->result();
        $this->template->admin('admin/profile/main', $data);
    }
    public function process()
    {
        $profile = check_profile();
        //$this->form_validation->set_rules('agama_id', 'Agama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('nama_profile', 'Nama profile', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. handphone', 'required|trim');
        $this->form_validation->set_rules('nomor_induk', 'Nomor induk', 'required|trim');
        $password = htmlspecialchars($this->input->post('password', true));
        if ($password != null) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]|matches[password]');
        }
        if ($profile->level == 'siswa') {
            $this->form_validation->set_rules('nama_ayah', 'Nama ayah', 'required|trim');
            $this->form_validation->set_rules('no_hp_ayah', 'No. handphone ayah', 'required|trim');
            $this->form_validation->set_rules('alamat_ayah', 'Alamat ayah', 'required|trim');
            //$this->form_validation->set_rules('agama_ayah', 'Agama ayah', 'required|trim');

            $this->form_validation->set_rules('nama_ibu', 'Nama ibu', 'required|trim');
            $this->form_validation->set_rules('no_hp_ibu', 'No. handphone ibu', 'required|trim');
            $this->form_validation->set_rules('alamat_ibu', 'Alamat ibu', 'required|trim');
            //$this->form_validation->set_rules('agama_ibu', 'Agama ibu', 'required|trim');
        }
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

        if ($this->form_validation->run() == false) {
            return $this->index();
        } else {
            $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
            $id = htmlspecialchars($this->input->post('id_users', true));
            $gambar_profile = $this->uploadGambar($jenis_kelamin, $id);
            $password = htmlspecialchars($this->input->post('password', true));
            if ($password != null) {
                $password_fix = md5($password);
            } else {
                $password_fix = htmlspecialchars($this->input->post('password_old', true));
            }
            $data_users = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => $password_fix,
            ];
            $update_users = $this->Users_model->update($data_users, $id);
            if ($profile->level != 'siswa') {
                $data_profile = [
                    'nama_profile' =>  htmlspecialchars($this->input->post('nama_profile', true)),
                    'no_hp' =>  htmlspecialchars($this->input->post('no_hp', true)),
                    'alamat' =>  htmlspecialchars($this->input->post('alamat', true)),
                    'nomor_induk' =>  htmlspecialchars($this->input->post('nomor_induk', true)),
                    'gambar_profile' =>  $gambar_profile,
                    //'agama_id' => htmlspecialchars($this->input->post('agama_id', true)),
                ];
            } else {
                $data_profile = [
                    'jenis_kelamin' =>  $jenis_kelamin,
                    'nama_profile' =>  htmlspecialchars($this->input->post('nama_profile', true)),
                    'no_hp' =>  htmlspecialchars($this->input->post('no_hp', true)),
                    'alamat' =>  htmlspecialchars($this->input->post('alamat', true)),
                    'nomor_induk' =>  htmlspecialchars($this->input->post('nomor_induk', true)),
                    'gambar_profile' =>  $gambar_profile,
                    //'agama_id' => htmlspecialchars($this->input->post('agama_id', true)),
                    'nama_ayah' => htmlspecialchars($this->input->post('nama_ayah', true)),
                    'alamat_ayah' => htmlspecialchars($this->input->post('alamat_ayah', true)),
                    'no_hp_ayah' => htmlspecialchars($this->input->post('no_hp_ayah', true)),
                    //'agama_ayah' => htmlspecialchars($this->input->post('agama_ayah', true)),
                    'nama_ibu' => htmlspecialchars($this->input->post('nama_ibu', true)),
                    'alamat_ibu' => htmlspecialchars($this->input->post('alamat_ibu', true)),
                    'no_hp_ibu' => htmlspecialchars($this->input->post('no_hp_ibu', true)),
                    //'agama_ibu' => htmlspecialchars($this->input->post('agama_ibu', true)),
                ];
            }
            $update_profile = $this->Profile_model->update($data_profile, $id);
            if ($update_users > 0 || $update_profile > 0) {
                $this->session->set_flashdata('success', 'Berhasil update data');
                return redirect(base_url('Admin/Profile'));
            } else {
                $this->session->set_flashdata('success', 'Berhasil update data');
                return redirect(base_url('Admin/Profile'));
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
}
