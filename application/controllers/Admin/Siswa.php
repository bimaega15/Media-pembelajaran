<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_model',  'Jurusan_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    { // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Siswa', 'Admin/Siswa');
        // output
        $data['title'] = 'Management Siswa';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $id_users = $this->session->userdata('id_users');
        $data['result'] = $this->Users_model->joinProfile(null, $id_users, 'siswa', 1)->result();

        $otkp_sql = "SELECT COUNT(*) as total FROM `profile` WHERE `jurusan_id`= 1 AND `verifikasi`=1";
        $jum_otkp = $this->db->query($otkp_sql)->row();
        $data['jum_otkp'] = $jum_otkp->total;

        $bdp_sql = "SELECT COUNT(*) as total FROM `profile` WHERE `jurusan_id`= 2 AND `verifikasi`=1";
        $jum_bdp = $this->db->query($bdp_sql)->row();
        $data['jum_bdp'] = $jum_bdp->total;

        $akl_sql = "SELECT COUNT(*) as total FROM `profile` WHERE `jurusan_id`= 3 AND `verifikasi`=1";
        $jum_akl = $this->db->query($akl_sql)->row();
        $data['jum_akl'] = $jum_akl->total;

        $rpl_sql = "SELECT COUNT(*) as total FROM `profile` WHERE `jurusan_id`= 4 AND `verifikasi`=1";
        $jum_rpl = $this->db->query($rpl_sql)->row();
        $data['jum_rpl'] = $jum_rpl->total;

        $mm_sql = "SELECT COUNT(*) as total FROM `profile` WHERE `jurusan_id`= 5 AND `verifikasi`=1";
        $jum_mm = $this->db->query($mm_sql)->row();
        $data['jum_mm'] = $jum_mm->total;

        $this->template->admin('admin/siswa/main', $data);
    }
    public function add()
    {

        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Siswa', 'Admin/Siswa');
        $this->breadcrumbs->push('Form Data', 'Admin/Siswa/add');
        // output
        $data['title'] = 'Form Siswa';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_users = null;
        $obj->username = null;
        $obj->password = null;
        $obj->level = null;
        $obj->nama_profile = null;
        $obj->jenis_kelamin = null;
        $obj->no_hp = null;
        $obj->email = null;
        $obj->alamat = null;
        $obj->sekolah_asal = null;
        $obj->gambar_profile = null;
        $obj->akta = null;
        $obj->ijazah = null;
        $obj->nomor_induk = null;
        //$obj->agama_id = null;
        $obj->jurusan_id = null;

        $obj->nama_ayah = null;
        $obj->no_hp_ayah = null;
        $obj->alamat_ayah = null;

        $obj->nama_ibu = null;
        $obj->no_hp_ibu = null;
        $obj->alamat_ibu = null;

        //$data['agama'] = $this->Agama_model->get()->result();
        $data['row'] = $obj;
        $data['page'] = 'add';
        $data['jurusan'] = $this->Jurusan_model->get()->result();
        $this->template->admin('admin/siswa/form_data', $data);
    }
    public function process()
    {
        if (isset($_POST['add'])) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]|matches[password]');
        } else {
            $password = htmlspecialchars($this->input->post('password', true));
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            if ($password != null) {
                $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]|matches[password]');
            }
        }
        $this->form_validation->set_rules('nama_profile', 'Nama profile', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. handphone', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('nomor_induk', 'Nomor induk', 'required|trim');
        $this->form_validation->set_rules('sekolah_asal', 'Sekolah Asal', 'required|trim');
        //$this->form_validation->set_rules('agama_id', 'Agama', 'required|trim');

        $this->form_validation->set_rules('nama_ayah', 'Nama ayah', 'required|trim');
        $this->form_validation->set_rules('no_hp_ayah', 'No. handphone ayah', 'required|trim');
        $this->form_validation->set_rules('alamat_ayah', 'Alamat ayah', 'required|trim');

        $this->form_validation->set_rules('nama_ibu', 'Nama ibu', 'required|trim');
        $this->form_validation->set_rules('no_hp_ibu', 'No. handphone ibu', 'required|trim');
        $this->form_validation->set_rules('alamat_ibu', 'Alamat ibu', 'required|trim');

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
                $gambar_profile = $this->uploadGambar($jenis_kelamin);
                $akta = $this->uploadAkta();
                $ijazah = $this->uploadIjazah();
                $data_Siswa = [
                    'username' => htmlspecialchars($this->input->post('username', true)),
                    'password' => md5(htmlspecialchars($this->input->post('password', true))),
                    'level' =>  'siswa',
                ];
                $insert_users = $this->Users_model->insert_users($data_Siswa);

                $data_profile = [
                    'jenis_kelamin' =>  $jenis_kelamin,
                    'nama_profile' =>  htmlspecialchars($this->input->post('nama_profile', true)),
                    'no_hp' =>  htmlspecialchars($this->input->post('no_hp', true)),
                    'email' =>  htmlspecialchars($this->input->post('email', true)),
                    'alamat' =>  htmlspecialchars($this->input->post('alamat', true)),
                    'nomor_induk' =>  htmlspecialchars($this->input->post('nomor_induk', true)),
                    'gambar_profile' =>  $gambar_profile,
                    'akta' =>  $akta,
                    'ijazah' =>  $ijazah,
                    'users_id' => $insert_users,
                    //'agama_id' => htmlspecialchars($this->input->post('agama_id', true)),
                    'sekolah_asal' => htmlspecialchars($this->input->post('sekolah_asal', true)),
                    'jurusan_id' => htmlspecialchars($this->input->post('jurusan_id', true)),
                    'nama_ayah' => htmlspecialchars($this->input->post('nama_ayah', true)),
                    'alamat_ayah' => htmlspecialchars($this->input->post('alamat_ayah', true)),
                    'no_hp_ayah' => htmlspecialchars($this->input->post('no_hp_ayah', true)),
                    'nama_ibu' => htmlspecialchars($this->input->post('nama_ibu', true)),
                    'alamat_ibu' => htmlspecialchars($this->input->post('alamat_ibu', true)),
                    'no_hp_ibu' => htmlspecialchars($this->input->post('no_hp_ibu', true)),
                    'verifikasi' => 1
                ];
                $insert_profile = $this->Users_model->insert_profile($data_profile);
                if ($insert_profile > 0 || $insert_users > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/Siswa'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/Siswa'));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_users', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_users', true));
                $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
                $gambar_profile = $this->uploadGambar($jenis_kelamin, $id);
                $akta = $this->uploadAkta();
                $ijazah = $this->uploadIjazah();
                $password = htmlspecialchars($this->input->post('password', true));
                if ($password != null) {
                    $password_fix = md5($password);
                } else {
                    $password_fix = htmlspecialchars($this->input->post('password_old', true));
                }
                $data_Siswa = [
                    'username' => htmlspecialchars($this->input->post('username', true)),
                    'password' => $password_fix,
                    'level' =>  'siswa',
                ];
                $update_users = $this->Users_model->update_users($data_Siswa, $id);

                $data_profile = [
                    'jenis_kelamin' =>  $jenis_kelamin,
                    'nama_profile' =>  htmlspecialchars($this->input->post('nama_profile', true)),
                    'no_hp' =>  htmlspecialchars($this->input->post('no_hp', true)),
                    'email' =>  htmlspecialchars($this->input->post('email', true)),
                    'alamat' =>  htmlspecialchars($this->input->post('alamat', true)),
                    'nomor_induk' =>  htmlspecialchars($this->input->post('nomor_induk', true)),
                    'gambar_profile' =>  $gambar_profile,
                    'akta' =>  $akta,
                    'ijazah' =>  $ijazah,
                    //'agama_id' => htmlspecialchars($this->input->post('agama_id', true)),
                    'sekolah_asal' => htmlspecialchars($this->input->post('sekolah_asal', true)),
                    'jurusan_id' => htmlspecialchars($this->input->post('jurusan_id', true)),
                    'nama_ayah' => htmlspecialchars($this->input->post('nama_ayah', true)),
                    'alamat_ayah' => htmlspecialchars($this->input->post('alamat_ayah', true)),
                    'no_hp_ayah' => htmlspecialchars($this->input->post('no_hp_ayah', true)),
                    'nama_ibu' => htmlspecialchars($this->input->post('nama_ibu', true)),
                    'alamat_ibu' => htmlspecialchars($this->input->post('alamat_ibu', true)),
                    'no_hp_ibu' => htmlspecialchars($this->input->post('no_hp_ibu', true)),
                    'verifikasi' => 1
                ];
                $update_profile = $this->Users_model->update_profile($data_profile, $id);
                if ($update_users > 0 || $update_profile > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Siswa'));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Siswa'));
                }
            }
        }
    }

    public function edit($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Siswa', 'Admin/Siswa');
        $this->breadcrumbs->push('Form Siswa', 'Admin/Siswa/edit/' . $id);
        // output
        $data['title'] = 'Form Siswa';
        $get = $this->Users_model->joinProfile($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Siswa',
            'jurusan' => $this->Jurusan_model->get()->result()
        ];
        $this->template->admin('admin/siswa/form_data', $data);
    }

    public function delete($id_users)
    {
        $this->removeImage($id_users);
        $delete = $this->Users_model->delete($id_users);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/Siswa'));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/Siswa'));
        }
    }

    private function uploadAkta()
    {
        $akta = $_FILES["akta_siswa"]['name'];

        $config['upload_path'] = './public/image/akta';
        $config['allowed_types'] = 'pdf';
        $new_name = time() . $_FILES["akta_siswa"]['name'];
        $config['overwrite'] = true;
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('akta_siswa')) {
            echo $this->upload->display_errors();
        } else {
            $akta = $this->upload->data();
            return $akta['file_name'];
        }
    }

    private function uploadIjazah()
    {
        $ijazah = $_FILES["ijazah_siswa"]['name'];

        $config['upload_path'] = './public/image/ijazah';
        $config['allowed_types'] = 'pdf';
        $new_name = time() . $_FILES["ijazah_siswa"]['name'];
        $config['overwrite'] = true;
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('ijazah_siswa')) {
            echo $this->upload->display_errors();
        } else {
            $ijazah = $this->upload->data();
            return $ijazah['file_name'];
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
            $Siswa = $this->Users_model->joinProfile($id_users)->row();
            if ($Siswa->gambar_profile != 'male.png' && $Siswa->gambar_profile != 'female.png') {
                return $Siswa->gambar_profile;
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
    public function detail($id)
    {
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Siswa', 'Admin/Siswa');
        $this->breadcrumbs->push('Form Siswa', 'Admin/Siswa/detail/' . $id);
        // output
        $data['title'] = 'Form Siswa';
        $get = $this->Users_model->joinProfile($id)->row();

        $data = [
            'row' => $get,
            "page" => 'detail',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Detail Siswa',
            'jurusan' => $this->Jurusan_model->get()->result()
        ];
        $this->template->admin('admin/siswa/form_data_detail', $data);
    }
}
