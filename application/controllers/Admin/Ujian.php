<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Soal_model', 'Siswa_ujian_model', 'Hasil_model']);
        check_not_login();
        $this->session->set_userdata('url_login', current_url());
    }
    public function index()
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');
        $getQuiz = check_quiz($quiz_id)->row();

        // waktu sekarang
        $time_sekarang = time();
        $batas_waktu = date("Y-m-d H:i:s", strtotime("+" . $getQuiz->waktu_pengerjaan . " minutes", $time_sekarang));

        // data ujian
        $dataUjian = [
            'users_id' => $this->session->userdata('id_users'),
            'batas_waktu' => $batas_waktu,
            'quiz_id' => $quiz_id,
            'status_ujian' => 'belum selesai',
        ];
        $siswaUjian = $this->Siswa_ujian_model->insert($dataUjian);
        if ($siswaUjian > 0) {
            return redirect(base_url('Admin/Ujian/mulai?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id . '&siswa_ujian=' . $siswaUjian));
        }
    }
    public function mulai()
    {
        $materi_id = $this->input->get('materi_id');
        $quiz_id = $this->input->get('quiz_id');
        $siswa_ujian = $this->input->get('siswa_ujian');

        if ($siswa_ujian == null) {
            $this->session->set_flashdata('error', 'Anda belum submit ujian');
            return redirect(base_url('Admin/Quiz?materi_id=' . $quiz_id));
        }

        // add breadcrumbs
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Materi', 'Admin/Materi');
        $this->breadcrumbs->push('Quiz', 'Admin/Quiz?materi_id=' . $materi_id);
        $this->breadcrumbs->push('Ujian', 'Admin/Ujian?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id);

        // siswa ujian
        $siswaUjian = $this->Siswa_ujian_model->get($siswa_ujian)->row();
        $batas_waktu = strtotime($siswaUjian->batas_waktu);
        $waktu_ujian = $batas_waktu - time();

        // output
        $data['title'] = 'Management Quiz';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['materi_id'] = $materi_id;
        $data['quiz_id'] = $quiz_id;
        $data['siswa_ujian'] = $siswa_ujian;
        $data['id_soal'] = $this->session->userdata('id_soal');
        $data['tab_navigation'] = $this->Soal_model->get(null, $quiz_id)->result();
        $data['waktu_ujian'] = $waktu_ujian;
        $this->template->admin('admin/ujian/main', $data);
    }

    public function loadUjian()
    {
        $quiz_id  = $this->input->get('quiz_id', true);
        $id_soal  = $this->input->get('soal_id', true);
        $type  = $this->input->get('type', true);
        $tab  = $this->input->get('tab', true);


        // check jika tidak ada session soal
        $row = $this->Soal_model->getUjian()->row();
        if (!$this->session->has_userdata("id_soal")) {
            $this->session->set_userdata('number_soal', 1);
            $this->session->set_userdata('id_soal', $row->id_soal);
        }
        if ($type != null) {
            $row = $this->Soal_model->getUjian(null, null, $type, $id_soal)->row();
            if ($row != null) {
                $this->session->set_userdata('id_soal', $row->id_soal);
                if ($type == 'next') {
                    $number_soal = $this->session->userdata('number_soal');
                    $number_soal += 1;
                    $this->session->set_userdata('number_soal', $number_soal);
                }
                if ($type == 'back') {
                    $number_soal = $this->session->userdata('number_soal');
                    $number_soal -= 1;
                    $this->session->set_userdata('number_soal', $number_soal);
                }
            }
        }

        if ($tab != null) {
            $number_soal = $tab;
            $this->session->set_userdata('number_soal', $number_soal);
            $this->session->set_userdata('id_soal', $id_soal);
        }

        $id_soal = $this->session->userdata('id_soal');
        $soal = $this->Soal_model->getUjian($id_soal)->row();

        $output = '
                <div class="card-body">';

        $no = $this->session->userdata('number_soal');
        $soalDetail = check_soal_detail($soal->id_soal)->result();

        $raguString = '';
        if ($this->session->has_userdata('ragu_jawaban')) {
            $sessRagu = $this->session->userdata('ragu_jawaban');
            $idSoalRagu = array_column($sessRagu, 'id_soal');
            if (in_array($soal->id_soal, $idSoalRagu)) {
                $raguString = '<span class="text-dark badge badge-warning float-right">JAWABAN RAGU</span>';
            }
        }

        $output .= '
                    <strong> ' . $no . '.  ' . htmlspecialchars_decode($soal->judul_soal) . '&emsp; ' . $raguString . '</strong>
                    <div class="btn-group btn-group-toggle mb-1" data-toggle="buttons" style="min-width: 50%; display:block;">';

        $dataSess = $this->session->userdata('pilihan_jawaban');
        foreach ($soalDetail as $key => $vSoalDetail) {

            $output .= '
                            <label class="
                            btn btn-light 
                            shadow-lg 
                            text-left 
                            d-flex align-items-center
                            border-left-info
                            ';

            if ($dataSess != null) {
                foreach ($dataSess as $key => $value) {
                    if ($value['id_soal'] == $soal->id_soal) {
                        if ($value['pilihan'] == $vSoalDetail->pilihan) {
                            $output .= 'border-left-success';
                        }
                    }
                }
            }

            $output .= '
                            mb-1" style="min-height: 80px;">
                                <input class="btn_choose" type="radio" data-id_soal="' . $soal->id_soal . '" name="pilihan[' . $soal->id_soal . ']" id="pilihan ' . $soal->id_soal . $vSoalDetail->id_soal_detail . '" value="' . $vSoalDetail->pilihan . '"
                                ';

            if ($dataSess != null) {
                foreach ($dataSess as $key => $value) {
                    if ($value['id_soal'] == $soal->id_soal) {
                        if ($value['pilihan'] == $vSoalDetail->pilihan) {
                            $output .= 'checked';
                        }
                    }
                }
            }

            $output .= '>
                                    ' . $vSoalDetail->pilihan . '. &nbsp;  ' . htmlspecialchars_decode($vSoalDetail->jawaban) . '
                            </label>';
        }
        $output .= '</div>';
        $output .= ' 
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="#" class="btn btn-light text-dark border border-dark btn_back" data-id_soal="' . $soal->id_soal . '"><i class="fas fa-backward"></i> Sebelumnya</a>
                            <a data-id_soal="' . $soal->id_soal . '" href="#" class="btn btn-light text-dark border border-dark btn_forward"><i class="fas fa-forward"></i> Selanjutnya</a>
                            <a data-id_soal="' . $soal->id_soal . '" href="#" class="btn btn-warning btn_ragu"><i class="fas fa-question"></i> Ragu</a>
                        </div>
                        <div>
                            <a href="#" class="btn btn-success btn_finish"><i class="fas fa-flag"></i> Selesai</a>
                        </div>
                    </div>
                </div>
        ';
        echo json_encode($output);
    }

    public function pilihJawaban()
    {
        $id_soal = $this->input->post('id_soal', true);
        $pilihan = $this->input->post('pilihan', true);

        if (!$this->session->has_userdata('pilihan_jawaban')) {
            $data[] = [
                'id_soal' => $id_soal,
                'pilihan' => $pilihan
            ];
            $this->session->set_userdata('pilihan_jawaban', $data);
        } else {
            $dataSess = $this->session->userdata('pilihan_jawaban');
            // id_soal
            $in_idSoal = array_column($dataSess, 'id_soal');
            if (in_array($id_soal, $in_idSoal)) {
                foreach ($dataSess as $index => $value) {
                    if ($value['id_soal'] == $id_soal) {
                        $data[] = [
                            'id_soal' => $value['id_soal'],
                            'pilihan' => $pilihan
                        ];
                    } else {
                        $data[] = [
                            'id_soal' => $value['id_soal'],
                            'pilihan' => $value['pilihan']
                        ];
                    }
                }
                $this->session->set_userdata('pilihan_jawaban', $data);
            } else {
                $data[] = [
                    'id_soal' => $id_soal,
                    'pilihan' => $pilihan
                ];
                $data = array_merge($dataSess, $data);
                $this->session->set_userdata('pilihan_jawaban', $data);
            }
        }
        $pilihan_jawaban = $this->session->userdata('pilihan_jawaban');
        $ragu_jawaban = $this->session->userdata('ragu_jawaban');

        if ($ragu_jawaban != null) {
            $dataRagu = [];
            foreach ($ragu_jawaban as $key => $value) {
                if ($value['id_soal'] != $id_soal) {
                    $dataRagu[] = [
                        'id_soal' => $value['id_soal']
                    ];
                }
            }
            $this->session->set_userdata('ragu_jawaban', $dataRagu);
        }

        echo json_encode([
            'id_soal' => $id_soal
        ]);
    }

    public function raguAnswer()
    {
        $id_soal = $this->input->post('id_soal', true);
        if (!$this->session->has_userdata('ragu_jawaban')) {
            $data[] = [
                'id_soal' => $id_soal,
            ];
            $this->session->set_userdata('ragu_jawaban', $data);
        } else {
            $dataSess = $this->session->userdata('ragu_jawaban');
            // id_soal
            $in_idSoal = array_column($dataSess, 'id_soal');
            if (!in_array($id_soal, $in_idSoal)) {
                $data[] = [
                    'id_soal' => $id_soal,
                ];
                $data = array_merge($dataSess, $data);
                $this->session->set_userdata('ragu_jawaban', $data);
            }
        }
        $ragu_jawaban = $this->session->userdata('ragu_jawaban');
        echo json_encode([
            'id_soal' => $id_soal
        ]);
    }

    public function loadTab()
    {
        $quiz_id = $this->input->post('quiz_id', true);
        $tab_navigation = $this->Soal_model->get(null, $quiz_id)->result();

        $output = '
        <div class="p-3">';

        $dataSess = $this->session->userdata('pilihan_jawaban');
        $sessRagu = $this->session->userdata('ragu_jawaban');

        foreach ($tab_navigation as $key => $value) {
            $btnBoolChoose = false;
            $btnBoolRagu = false;

            if ($dataSess != null) {
                $idSoal = array_column($dataSess, 'id_soal');

                if (in_array($value->id_soal, $idSoal)) {
                    $btnTab = 'btn-success';
                    $btnBoolChoose = true;
                }
            }

            if ($sessRagu != null) {
                $idSoalRagu = array_column($sessRagu, 'id_soal');
                if (in_array($value->id_soal, $idSoalRagu)) {
                    $btnTab = 'btn-warning';
                    $btnBoolRagu = true;
                }
            }

            if ($btnBoolChoose == false && $btnBoolRagu == false) {
                $btnTab = 'btn-info';
            }
            $output .= '<a href="#" data-soal_id="' . $value->id_soal . '" class="btn ' . $btnTab . ' mr-1 mb-1 btn_tab">' . ($key + 1) . '</a>';
        }

        $output .= '</div>';

        echo json_encode($output);
    }
    public function insertUjian()
    {
        // data siswa menjawab
        $quiz_id = $this->input->post('quiz_id', true);
        $siswa_ujian = $this->input->post('siswa_ujian', true);
        $materi_id = $this->input->post('materi_id', true);

        // soal
        $getSoal = $this->db->get_where(
            'soal',
            [
                'quiz_id' => $quiz_id
            ]
        )->result();

        // jawaban user
        $jawabanUser = $this->session->userdata('pilihan_jawaban');
        $pilihanUser = array_column($jawabanUser, 'pilihan');
        $countPilihan = count($pilihanUser);
        $countDbPilihan = count(array_column($getSoal, 'jawaban_soal'));

        // banding
        $benar = 0;
        $salah = 0;
        $tidak_menjawab = $countDbPilihan - $countPilihan;
        $point = 100 / $countDbPilihan;
        foreach ($getSoal as $key1 => $value1) {
            foreach ($jawabanUser as $key2 => $value2) {
                if ($value1->id_soal == $value2['id_soal']) {
                    if ($value1->jawaban_soal == $value2['pilihan']) {
                        $benar++;
                    } else {
                        $salah++;
                    }
                }
            }
        }
        $skor = $benar * $point;

        // data hasil
        $dataHasil = [
            'siswa_ujian_id' => $siswa_ujian,
            'quiz_id' => $quiz_id,
            'benar' => $benar,
            'salah' => $salah,
            'tidak_menjawab' => $tidak_menjawab,
            'total_soal' => $countDbPilihan,
            'skor' => $skor,
        ];
        $insertHasil = $this->Hasil_model->insert($dataHasil);

        // data hasil detail
        foreach ($jawabanUser as $key => $value) {
            $dataHasilDetail[] = [
                'hasil_id' => $insertHasil,
                'soal_id' => $value['id_soal'],
                'pilihan' => $value['pilihan']
            ];
        }
        $insertHasilDetail = $this->Hasil_model->insertBatch($dataHasilDetail);

        // update siswa ujian
        $dataSiswaUjian = [
            'status_ujian' => 'selesai'
        ];
        $updateSiswaUjian = $this->Siswa_ujian_model->update($dataSiswaUjian, $siswa_ujian);

        if (
            $insertHasil  || $insertHasilDetail || $updateSiswaUjian
        ) {
            $this->session->unset_userdata('pilihan_jawaban');
            $this->session->unset_userdata('id_soal');
            $this->session->unset_userdata('number_soal');
            $this->session->unset_userdata('ragu_jawaban');

            $data_encode = [
                'status' => 200,
                'message' => 'Berhasil menyelesaikan ujian',
                'url' => base_url('Admin/Quiz?materi_id=' . $materi_id),
                'session' => $this->session->set_flashdata('success', 'Berhasil menyelesaikan ujian')
            ];
        } else {
            $data_encode = [
                'status' => 401,
                'message' => 'Gagal menyelesaikan ujian',
                'url' => base_url('Admin/Quiz?materi_id=' . $materi_id),
                'session' => $this->session->set_flashdata('error', 'Gagal menyelesaikan ujian')
            ];
        }
        echo json_encode($data_encode);
    }
}
