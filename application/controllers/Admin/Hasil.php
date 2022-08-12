<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Hasil_model', 'Soal_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Hasil', 'Admin/Hasil?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);
        // output
        $data['title'] = 'Management Hasil';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['result'] = $this->Hasil_model->get(null, $quiz_id)->result();
        $data['materi_id'] = $materi_id;
        $data['quiz_id'] = $quiz_id;
        $this->template->admin('admin/hasil/main', $data);
    }
    public function detail($id)
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');

        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Hasil', 'Admin/Hasil?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);
        $this->breadcrumbs->push('Detail Hasil', 'Admin/Hasil/edit/' . $id . '?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);

        // output
        $data['title'] = 'Detail Hasil';
        $get = $this->Hasil_model->getDetail($id)->result();
        $soal = $this->Soal_model->get(null, $quiz_id)->result();

        // check jawaban
        foreach ($soal as $key1 => $v_soal) {
            foreach ($get as $key => $v_detail) {
                if ($v_soal->id_soal == $v_detail->soal_id) {
                    if ($v_soal->jawaban_soal == $v_detail->pilihan) {
                        $dataJawaban[] = [
                            'id_soal' => $v_soal->id_soal,
                            'judul_soal' => $v_soal->judul_soal,
                            'jawaban_soal' => $v_detail->pilihan,
                            'status' => '<span class="text-success"> <i class="fas fa-check"></i> </span>'
                        ];
                    } else {
                        $dataJawaban[] = [
                            'id_soal' => $v_soal->id_soal,
                            'judul_soal' => $v_soal->judul_soal,
                            'jawaban_soal' => $v_detail->pilihan,
                            'status' => '<span class="text-danger"> <i class="fas fa-window-close"></i> </span>'

                        ];
                    }
                }
            }
        }
        $data = [
            'result' => $dataJawaban,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Hasil',
            'materi_id' => $materi_id,
            'quiz_id' => $quiz_id,
        ];
        $this->template->admin('admin/hasil/detail', $data);
    }
}
