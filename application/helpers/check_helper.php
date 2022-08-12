<?php
function timeZone()
{
    $ci = &get_instance();
    date_default_timezone_set('Asia/Jakarta');
}

function check_not_login()
{
    $ci = &get_instance();
    $url = current_url();

    if (!$ci->session->has_userdata('id_users')) {
        $ci->session->set_userdata('url', $url);
        $ci->session->userdata('url');
        redirect(base_url('Login'));
    }
}
function check_already_login()
{
    $ci = &get_instance();
    $ci->load->model('Users_model');
    if (get_cookie('cookie')) {
        $cookie = get_cookie('cookie');
        $get = $ci->Users_model->getCookie($cookie)->row();
        $data = [
            'id_users' => $get->id_users
        ];
        $ci->session->set_userdata($data);
    }
    if ($ci->session->has_userdata('id_users')) {
        $ci->session->set_flashdata('success', 'Anda sudah login');
        $url_login = $ci->session->userdata('url_login');
        if ($url_login == null) {
            $url_login = base_url('Admin/Home');
        }
        return redirect($url_login);
    }
}
function check_konfigurasi()
{
    $ci = &get_instance();
    $ci->load->model('Konfigurasi_model');
    $row = $ci->Konfigurasi_model->get()->row();
    return $row;
}
function check_petunjuk()
{
    $ci = &get_instance();
    $ci->load->model('Petunjuk_model');
    $row = $ci->Petunjuk_model->get()->row();
    return $row;
}
function check_profile($id_siswa = null)
{
    $ci = &get_instance();
    $id_users = $ci->session->userdata('id_users');
    if ($id_siswa != null) {
        $id_users = $id_siswa;
    }
    $ci->load->model('Users_model');
    $row = $ci->Users_model->joinProfile($id_users)->row();
    return $row;
}
function rupiah($nominal)
{
    return number_format($nominal, 2, '.', ',');
}
function check_users($id_users)
{
    $ci = &get_instance();
    $ci->load->model('Users_model');
    $row = $ci->Users_model->joinProfile($id_users)->row();
    return $row;
}

function check_materi($id_materi = null)
{
    $ci = &get_instance();
    $ci->load->model('Materi_model');
    $row = $ci->Materi_model->get($id_materi);
    return $row;
}


function check_quiz($id_quiz = null)
{
    $ci = &get_instance();
    $ci->load->model('Quiz_model');
    $row = $ci->Quiz_model->get($id_quiz);
    return $row;
}

function check_soal_detail($soal_id = null)
{
    $ci = &get_instance();
    $ci->load->model('Soal_model');
    $row = $ci->db->get_where('soal_detail', [
        'soal_id' => $soal_id
    ]);
    return $row;
}


function checkJawabanSoalDetail($id_soal, $jawaban)
{
    $ci = &get_instance();
    $get = $ci->db->get_where('soal_detail', [
        'soal_id' => $id_soal,
        'pilihan' => $jawaban
    ])->row();
    return $get->pilihan . '. ' . htmlspecialchars_decode($get->jawaban);
}

function convert_number_answer($number)
{
    switch ($number) {
        case 1:
            return 'A';
            break;
        case 2:
            return 'B';
            break;
        case 3:
            return 'C';
            break;
        case 4:
            return 'D';
            break;
        case 5:
            return 'E';
            break;
        default:
            return null;
            break;
    }
}

function check_hasil($quiz_id)
{
    $ci = &get_instance();
    $siswaUjian = $ci->db->get_where('siswa_ujian', [
        'users_id' => $ci->session->userdata('id_users'),
        'quiz_id' => $quiz_id
    ])->row();

    if ($siswaUjian != null) {
        $get = $ci->db->get_where('hasil', [
            'siswa_ujian_id' => $siswaUjian->id_siswa_ujian
        ])->num_rows();
        if ($get > 0 && $siswaUjian->status_ujian == 'selesai') {
            return true;
        } else {
            return $siswaUjian->id_siswa_ujian;
        }
    } else {
        return false;
    }
}
function time_show($value)
{
    $exp = explode(':', $value);
    $tanggal[0] = $exp[0];
    $tanggal[1] = $exp[1];
    $imp = implode(':', $tanggal);
    return $imp;
}

function check_jadwal($jadwal = null)
{
    $ci = &get_instance();
    $ci->load->model('Jadwal_model');
    $jadwal = $ci->Jadwal_model->get($jadwal);
    return $jadwal;
}
