<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Soal_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
        $profile = check_profile();
        if ($profile->level == 'siswa') {
            $this->session->set_userdata('url_login', base_url('Admin/Home'));
            show_error('AUTHENTICATION', 403);
        }
    }
    public function index()
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Soal', 'Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);
        // output
        $data['title'] = 'Management Soal';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['result'] = $this->Soal_model->get(null, $quiz_id)->result();
        $data['materi_id'] = $materi_id;
        $data['quiz_id'] = $quiz_id;
        $this->template->admin('admin/soal/main', $data);
    }
    public function add()
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Soal', 'Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);
        $this->breadcrumbs->push('Form Data', 'Admin/Soal/add?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);
        // output
        $data['title'] = 'Form Soal';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_soal = null;
        $obj->judul_soal = null;
        $obj->jawaban_soal = null;
        $obj->jawaban_soal_text = null;
        $obj->soal_id = null;
        $obj->pilihan = null;
        $obj->jawaban = null;


        $data['row'] = $obj;
        $data['page'] = 'add';
        $data['materi_id'] = $materi_id;
        $data['quiz_id'] = $quiz_id;
        $data['get_quiz'] = check_quiz($quiz_id)->row();


        $this->template->admin('admin/soal/form_data', $data);
    }
    public function process()
    {
        $materi_id = $this->input->post('materi_id', true);
        $quiz_id = $this->input->post('quiz_id', true);

        $this->form_validation->set_rules('judul_soal', 'Judul Soal', 'required|trim');
        $this->form_validation->set_rules('jawaban_soal', 'Jawaban Soal', 'required|trim');
        $this->form_validation->set_rules('jawaban', 'Jawaban', 'callback_JawabanPilihan');

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                // data soal
                $data_Soal = [
                    'judul_soal' => $this->input->post('judul_soal', true),
                    'jawaban_soal' => $this->input->post('jawaban_soal', true),
                    'quiz_id' => htmlspecialchars($this->input->post('quiz_id', true)),
                ];

                $insert_Soal = $this->Soal_model->insert($data_Soal);

                // data soal detail
                $jawaban = $this->input->post('jawaban', true);
                $pilihan = $this->input->post('pilihan', true);
                foreach ($jawaban as $key => $value) {
                    $data_SoalDetail[] = [
                        'soal_id' => $insert_Soal,
                        'pilihan' => $pilihan[$key],
                        'jawaban ' => $jawaban[$key],
                    ];
                }
                $insert_SoalDetail = $this->Soal_model->insertBatch($data_SoalDetail);

                if ($insert_Soal || $insert_SoalDetail) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_soal', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_soal', true));
                $id_soal_detail = $this->input->post('soal_detail_id', true);
                // data soal
                $data_Soal = [
                    'judul_soal' => $this->input->post('judul_soal', true),
                    'jawaban_soal' => $this->input->post('jawaban_soal', true),
                    'quiz_id' => htmlspecialchars($this->input->post('quiz_id', true)),
                ];
                $updateSoal = $this->Soal_model->update($data_Soal, $id);


                // data soal detail
                $jawaban = $this->input->post('jawaban', true);
                $pilihan = $this->input->post('pilihan', true);
                foreach ($jawaban as $key => $value) {
                    $data_SoalDetail = [
                        'soal_id' => $id,
                        'pilihan' => $pilihan[$key],
                        'jawaban ' => $jawaban[$key],
                    ];
                    $updateSoalDetail = $this->Soal_model->updateSoalDetail($data_SoalDetail, $id_soal_detail[$key]);
                }
                if ($updateSoal || $updateSoalDetail) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id));
                }
            }
        }
    }
    public function edit($id)
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');

        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Soal', 'Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);
        $this->breadcrumbs->push('Form Soal', 'Admin/Soal/edit/' . $id . '?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);

        // output
        $data['title'] = 'Form Soal';
        $get = $this->Soal_model->get($id)->row();
        $get_quiz = check_quiz($quiz_id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Soal',
            'materi_id' => $materi_id,
            'quiz_id' => $quiz_id,
            'get_quiz' => $get_quiz,
        ];
        $this->template->admin('admin/soal/form_data', $data);
    }
    public function delete($id_soal)
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');
        $delete = $this->Soal_model->delete($id_soal);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id));
        }
    }
    public function JawabanPilihan()
    {
        $check = TRUE;
        $jawaban = $this->input->post('jawaban');
        foreach ($jawaban as $key => $value) {
            if ($value == null) {
                $this->form_validation->set_message('JawabanPilihan', 'Jawaban tidak boleh ada yang kosong');
                $check = FALSE;
            }
        }
        return $check;
    }
}
