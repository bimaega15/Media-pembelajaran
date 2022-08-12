<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPustaka extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['DaftarPustaka_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('DaftarPustaka', 'Admin/DaftarPustaka?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Management DaftarPustaka';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $materi_id = $this->input->get('materi_id');
        $data['result'] = $this->DaftarPustaka_model->get(null, $materi_id)->result();
        $data['materi_id'] = $materi_id;
        $this->template->admin('admin/daftarpustaka/main', $data);
    }
    public function add()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('DaftarPustaka', 'Admin/DaftarPustaka?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Data', 'Admin/DaftarPustaka/add?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form DaftarPustaka';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_pustaka = null;
        $obj->jenis_pustaka = null;
        $obj->judul = null;
        $obj->penulis = null;
        $obj->penerbit = null;
        $obj->kota_penerbit = null;
        $obj->tahun_terbit = null;
        $obj->judul_artikel = null;
        $obj->tanggal_tayang = null;
        $obj->waktu_akses_tanggal = null;
        $obj->waktu_akses_time = null;
        $obj->url = null;


        $data['row'] = $obj;
        $data['page'] = 'add';
        $data['materi_id'] = $materi_id;

        $this->template->admin('admin/daftarpustaka/form_data', $data);
    }
    public function process()
    {
        $materi_id = $this->input->post('materi_id', true);
        $jenis_pustaka = $this->input->post('jenis_pustaka', true);

        if ($jenis_pustaka == 'buku') {
            $this->form_validation->set_rules('judul', 'Judul', 'required');
            $this->form_validation->set_rules('penulis', 'Penulis', 'required');
            $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
            $this->form_validation->set_rules('kota_penerbit', 'Kota penerbit', 'required');
            $this->form_validation->set_rules('tahun_terbit', 'Tahun terbit', 'required');
        } else if ($jenis_pustaka == 'jurnal artikel') {
            $this->form_validation->set_rules('judul', 'Judul', 'required');
            $this->form_validation->set_rules('judul_artikel', 'Judul artikel', 'required');
            $this->form_validation->set_rules('penulis', 'Penulis', 'required');
            $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
            $this->form_validation->set_rules('kota_penerbit', 'Kota penerbit', 'required');
            $this->form_validation->set_rules('tahun_terbit', 'Tahun terbit', 'required');
        } else if ($jenis_pustaka == 'internet') {
            $this->form_validation->set_rules('judul', 'Judul', 'required');
            $this->form_validation->set_rules('penulis', 'Penulis', 'required');
            $this->form_validation->set_rules('tanggal_tayang', 'Tanggal tayang', 'required');
            $this->form_validation->set_rules('waktu_akses_tanggal', 'Tanggal akses', 'required');
            $this->form_validation->set_rules('waktu_akses_time', 'Waktu akses', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required');
        }

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                if ($jenis_pustaka == 'buku') {
                    $dataPustaka = [
                        'judul' => $this->input->post('judul'),
                        'penulis' => $this->input->post('penulis'),
                        'penerbit' => $this->input->post('penerbit'),
                        'kota_penerbit' => $this->input->post('kota_penerbit'),
                        'tahun_terbit' => $this->input->post('tahun_terbit'),
                        'materi_id' => $materi_id,
                        'jenis_pustaka' => $jenis_pustaka

                    ];
                } else if ($jenis_pustaka == 'jurnal artikel') {
                    $dataPustaka = [
                        'judul' => $this->input->post('judul'),
                        'judul_artikel' => $this->input->post('judul_artikel'),
                        'penulis' => $this->input->post('penulis'),
                        'penerbit' => $this->input->post('penerbit'),
                        'kota_penerbit' => $this->input->post('kota_penerbit'),
                        'tahun_terbit' => $this->input->post('tahun_terbit'),
                        'materi_id' => $materi_id,
                        'jenis_pustaka' => $jenis_pustaka


                    ];
                } else if ($jenis_pustaka == 'internet') {
                    $dataPustaka = [
                        'judul' => $this->input->post('judul'),
                        'penulis' => $this->input->post('penulis'),
                        'tanggal_tayang' => $this->input->post('tanggal_tayang'),
                        'waktu_akses_tanggal' => $this->input->post('waktu_akses_tanggal'),
                        'waktu_akses_time' => $this->input->post('waktu_akses_time'),
                        'url' => $this->input->post('url'),
                        'materi_id' => $materi_id,
                        'jenis_pustaka' => $jenis_pustaka

                    ];
                }

                $insert_DaftarPustaka = $this->DaftarPustaka_model->insert($dataPustaka);

                if ($insert_DaftarPustaka > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/DaftarPustaka?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/DaftarPustaka?materi_id=' . $materi_id));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_pustaka', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_pustaka', true));
                if ($jenis_pustaka == 'buku') {
                    $dataPustaka = [
                        'judul' => $this->input->post('judul'),
                        'penulis' => $this->input->post('penulis'),
                        'penerbit' => $this->input->post('penerbit'),
                        'kota_penerbit' => $this->input->post('kota_penerbit'),
                        'tahun_terbit' => $this->input->post('tahun_terbit'),
                        'materi_id' => $materi_id,
                        'jenis_pustaka' => $jenis_pustaka


                    ];
                } else if ($jenis_pustaka == 'jurnal artikel') {
                    $dataPustaka = [
                        'judul' => $this->input->post('judul'),
                        'judul_artikel' => $this->input->post('judul_artikel'),
                        'penulis' => $this->input->post('penulis'),
                        'penerbit' => $this->input->post('penerbit'),
                        'kota_penerbit' => $this->input->post('kota_penerbit'),
                        'tahun_terbit' => $this->input->post('tahun_terbit'),
                        'materi_id' => $materi_id,
                        'jenis_pustaka' => $jenis_pustaka


                    ];
                } else if ($jenis_pustaka == 'internet') {
                    $dataPustaka = [
                        'judul' => $this->input->post('judul'),
                        'penulis' => $this->input->post('penulis'),
                        'tanggal_tayang' => $this->input->post('tanggal_tayang'),
                        'waktu_akses_tanggal' => $this->input->post('waktu_akses_tanggal'),
                        'waktu_akses_time' => $this->input->post('waktu_akses_time'),
                        'url' => $this->input->post('url'),
                        'materi_id' => $materi_id,
                        'jenis_pustaka' => $jenis_pustaka


                    ];
                }

                $update_DaftarPustaka = $this->DaftarPustaka_model->update($dataPustaka, $id);
                if ($update_DaftarPustaka > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/DaftarPustaka?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/DaftarPustaka?materi_id=' . $materi_id));
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
        $this->breadcrumbs->push('DaftarPustaka', 'Admin/DaftarPustaka?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Daftar Pustaka', 'Admin/DaftarPustaka/edit/' . $id . '?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form Daftar Pustaka';
        $get = $this->DaftarPustaka_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Daftar Pustaka',
            'materi_id' => $materi_id
        ];
        $this->template->admin('admin/daftarpustaka/form_data', $data);
    }

    public function detail($id)
    {
        $materi_id = $this->input->get('materi_id');

        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('DaftarPustaka', 'Admin/DaftarPustaka?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Daftar Pustaka', 'Admin/DaftarPustaka/detail/' . $id . '?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Detail Daftar Pustaka';
        $get = $this->DaftarPustaka_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'Detail',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Detail Daftar Pustaka',
            'materi_id' => $materi_id
        ];
        $this->template->admin('admin/daftarpustaka/detail', $data);
    }
    public function delete($id_pustaka)
    {
        $materi_id = $this->input->get('materi_id');
        $delete = $this->DaftarPustaka_model->delete($id_pustaka);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/DaftarPustaka?materi_id=' . $materi_id));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/DaftarPustaka?materi_id=' . $materi_id));
        }
    }
}
