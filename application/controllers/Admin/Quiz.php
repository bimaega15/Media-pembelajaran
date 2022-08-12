<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quiz extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Quiz_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Management Quiz';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $materi_id = $this->input->get('materi_id');
        $data['result'] = $this->Quiz_model->get(null, $materi_id)->result();
        $data['materi_id'] = $materi_id;
        $this->template->admin('admin/quiz/main', $data);
    }
    public function add()
    {
        $materi_id = $this->input->get('materi_id');
        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Data', 'Admin/Quiz/add?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form Quiz';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        // add breadcrumbs
        $obj = new stdClass();
        $obj->id_quiz = null;
        $obj->judul_quiz = null;
        $obj->tipe_soal = null;
        $obj->waktu_pengerjaan = null;


        $data['row'] = $obj;
        $data['page'] = 'add';
        $data['materi_id'] = $materi_id;

        $this->template->admin('admin/quiz/form_data', $data);
    }
    public function process()
    {
        $materi_id = $this->input->post('materi_id', true);
        $this->form_validation->set_rules('judul_quiz', 'Judul Quiz', 'required|trim');
        $this->form_validation->set_rules('tipe_soal', 'Tipe Soal', 'required|trim');
        $this->form_validation->set_rules('waktu_pengerjaan', 'Waktu Pengerjaan', 'required|trim');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if (isset($_POST['add'])) {
            if ($this->form_validation->run() == false) {
                return $this->add();
            } else {
                $data_Quiz = [
                    'judul_quiz' => htmlspecialchars($this->input->post('judul_quiz', true)),
                    'tipe_soal' => htmlspecialchars($this->input->post('tipe_soal', true)),
                    'tanggal_entri' => date('Y-m-d'),
                    'waktu_pengerjaan' => htmlspecialchars($this->input->post('waktu_pengerjaan', true)),
                    'materi_id' => $materi_id,
                ];
                $insert_Quiz = $this->Quiz_model->insert($data_Quiz);

                if ($insert_Quiz > 0) {
                    $this->session->set_flashdata('success', 'Berhasil tambah data');
                    return redirect(base_url('Admin/Quiz?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('error', 'Gagal tambah data');
                    return redirect(base_url('Admin/Quiz?materi_id=' . $materi_id));
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_quiz', true));
                return $this->edit($id);
            } else {
                $id = htmlspecialchars($this->input->post('id_quiz', true));
                $data_Quiz = [
                    'judul_quiz' => htmlspecialchars($this->input->post('judul_quiz', true)),
                    'tipe_soal' => htmlspecialchars($this->input->post('tipe_soal', true)),
                    'tanggal_entri' => date('Y-m-d'),
                    'waktu_pengerjaan' => htmlspecialchars($this->input->post('waktu_pengerjaan', true)),
                    'materi_id' => $materi_id,
                ];
                $update_Quiz = $this->Quiz_model->update($data_Quiz, $id);
                if ($update_Quiz > 0) {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Quiz?materi_id=' . $materi_id));
                } else {
                    $this->session->set_flashdata('success', 'Berhasil update data');
                    return redirect(base_url('Admin/Quiz?materi_id=' . $materi_id));
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
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Form Quiz', 'Admin/Quiz/edit/' . $id . '?materi_id=' . $materi_id);
        // output
        $data['title'] = 'Form Quiz';
        $get = $this->Quiz_model->get($id)->row();

        $data = [
            'row' => $get,
            "page" => 'edit',
            'breadcrumb' => $this->breadcrumbs->show(),
            'title' => 'Edit Quiz',
            'materi_id' => $materi_id
        ];
        $this->template->admin('admin/quiz/form_data', $data);
    }
    public function delete($id_quiz)
    {
        $materi_id = $this->input->get('materi_id');
        $delete = $this->Quiz_model->delete($id_quiz);
        if ($delete) {
            $this->session->set_flashdata('success', 'Berhasil hapus data');
            return redirect(base_url('Admin/Quiz?materi_id=' . $materi_id));
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus data');
            return redirect(base_url('Admin/Quiz?materi_id=' . $materi_id));
        }
    }
}
