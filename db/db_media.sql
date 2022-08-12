-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2022 pada 10.47
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_media`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_pustaka`
--

CREATE TABLE `daftar_pustaka` (
  `id_pustaka` int(11) NOT NULL,
  `jenis_pustaka` enum('buku','jurnal artikel','internet') NOT NULL,
  `judul` varchar(200) NOT NULL,
  `penulis` varchar(200) NOT NULL,
  `penerbit` varchar(200) DEFAULT NULL,
  `kota_penerbit` varchar(200) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `judul_artikel` varchar(200) DEFAULT NULL,
  `tanggal_tayang` date DEFAULT NULL,
  `waktu_akses_tanggal` date DEFAULT NULL,
  `waktu_akses_time` time DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `materi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `judul_file` varchar(200) NOT NULL,
  `lampiran_file` varchar(200) NOT NULL,
  `tanggal_entri` datetime NOT NULL,
  `materi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file`
--

INSERT INTO `file` (`id_file`, `judul_file`, `lampiran_file`, `tanggal_entri`, `materi_id`) VALUES
(1, 'bilangan berpangkat', '517271652344567Perpangkatan_.pdf', '2022-05-12 15:36:07', 2),
(2, 'PERPANGKATAN DAN BENTUK AKAR', '532871652344588bilangan_berpangkat.pptx', '2022-05-12 15:36:28', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `siswa_ujian_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `tidak_menjawab` int(11) DEFAULT NULL,
  `total_soal` int(11) NOT NULL,
  `skor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_detail`
--

CREATE TABLE `hasil_detail` (
  `id_hasil_detail` int(11) NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `pilihan` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `hari` varchar(200) NOT NULL,
  `dari_waktu` time NOT NULL,
  `sampai_waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `dari_waktu`, `sampai_waktu`) VALUES
(1, 'Senin', '10:00:00', '12:30:00'),
(2, 'Selasa', '11:00:00', '13:00:00'),
(3, 'Rabu', '14:00:00', '15:00:00'),
(4, 'Kamis', '11:30:00', '12:30:00'),
(5, 'Jumat', '13:00:00', '15:00:00'),
(6, 'Sabtu', '09:00:00', '10:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kompetensi`
--

CREATE TABLE `kompetensi` (
  `id_kompetensi` int(11) NOT NULL,
  `judul_kompetensi` varchar(200) NOT NULL,
  `keterangan_kompetensi` text NOT NULL,
  `file_kompetensi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `nama_aplikasi` varchar(300) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar_konfigurasi` varchar(300) NOT NULL,
  `created_by` varchar(300) NOT NULL,
  `facebook` varchar(300) DEFAULT NULL,
  `instagram` varchar(300) DEFAULT NULL,
  `youtube` varchar(300) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `nama_aplikasi`, `keterangan`, `gambar_konfigurasi`, `created_by`, `facebook`, `instagram`, `youtube`, `alamat`, `no_hp`) VALUES
(1, 'Media Pembelajaran', 'aplikasi untuk sekolah', '76971636972621logo.png', 'Sasmita Syahni', 'www.facebook.com/sasmitasyahni', 'www.instagram.com/sasmitasyahni', 'www.youtube.com/sasmitasyahni', 'Jalan pendidikan', '082370595453');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `judul_materi` varchar(200) NOT NULL,
  `tanggal_materi` date NOT NULL,
  `users_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `judul_materi`, `tanggal_materi`, `users_id`, `jadwal_id`) VALUES
(2, 'Bilangan Berpangkat', '2022-05-12', 5, 5),
(4, 'Materi kalkulus 1', '2022-01-31', 6, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petunjuk`
--

CREATE TABLE `petunjuk` (
  `id_petunjuk` int(11) NOT NULL,
  `judul_petunjuk` varchar(200) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `nama_profile` varchar(200) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `gambar_profile` varchar(200) DEFAULT NULL,
  `nomor_induk` varchar(200) NOT NULL,
  `users_id` int(11) NOT NULL,
  `verifikasi` enum('1','0') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id_profile`, `nama_profile`, `jenis_kelamin`, `no_hp`, `alamat`, `gambar_profile`, `nomor_induk`, `users_id`, `verifikasi`) VALUES
(1, 'Sasmita Syahni', 'P', '082370595453', 'JL. Pendidikan', '920851637042444slider1.png', '129289302380', 1, '1'),
(3, 'Nama siswa125', 'L', '92384097', 'alamat siswa125', '920851637042444slider1.png', '93462347332', 4, '1'),
(4, 'Guru 123', 'P', '0823984832', 'alamat guru 123', '684801643623434Asset_1.png', '023894023', 5, '1'),
(5, 'Guru 124', 'L', '082394823', 'alamat guru 124', '447981643623465Asset_1.png', 'Guru 124', 6, '1'),
(6, 'Guru 125', 'L', '0823984928', 'alamat guru 125', '529501643623490Asset_1.png', '02839482', 7, '1'),
(7, 'guru 126', 'L', '0829348237', 'alamat guru 126', '920851637042444slider1.png', '0239849287', 8, '1'),
(8, 'Guru 127', 'L', '0238948237', 'alamat guru 127', '838991643623612Asset_1.png', '02384928', 9, '1'),
(9, 'guru 128', 'P', '032894827', 'alamat guru 128', 'female.png', '352323', 10, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `judul_quiz` varchar(200) NOT NULL,
  `tipe_soal` enum('A-C','A-D','A-E') NOT NULL,
  `tanggal_entri` date NOT NULL,
  `waktu_pengerjaan` varchar(20) NOT NULL,
  `materi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `judul_quiz`, `tipe_soal`, `tanggal_entri`, `waktu_pengerjaan`, `materi_id`) VALUES
(2, 'PERPANGKATAN', 'A-D', '2022-05-12', '10', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_jawab`
--

CREATE TABLE `siswa_jawab` (
  `id_siswa_jawab` int(11) NOT NULL,
  `siswa_ujian_id` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `pilihan` int(11) NOT NULL,
  `koreksi` enum('1','0') NOT NULL,
  `hasil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_ujian`
--

CREATE TABLE `siswa_ujian` (
  `id_siswa_ujian` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `status_ujian` enum('belum selesai','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `judul_soal` text NOT NULL,
  `jawaban_soal` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `quiz_id`, `judul_soal`, `jawaban_soal`) VALUES
(4, 2, '<p>&lt;math xmlns=\"http://www.w3.org/1998/Math/MathML\"&gt;<mn>2</mn><msqrt><mn>25</mn></msqrt>&lt;/math&gt;</p>', 'B'),
(5, 2, '<p>&lt;math xmlns=\"http://www.w3.org/1998/Math/MathML\"&gt;<msqrt><mn>25</mn></msqrt>&lt;/math&gt;</p>', 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_detail`
--

CREATE TABLE `soal_detail` (
  `id_soal_detail` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `pilihan` enum('A','B','C','D','E') NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal_detail`
--

INSERT INTO `soal_detail` (`id_soal_detail`, `soal_id`, `pilihan`, `jawaban`) VALUES
(9, 4, 'A', '<p>5</p>\r\n'),
(10, 4, 'B', '<p>4</p>\r\n'),
(11, 4, 'C', '<p>3</p>\r\n'),
(12, 4, 'D', '<p>21</p>\r\n'),
(13, 5, 'A', '<p>34</p>\r\n'),
(14, 5, 'B', '<p>89</p>\r\n'),
(15, 5, 'C', '<p>90</p>\r\n'),
(16, 5, 'D', '<p>98</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('admin','siswa','guru') NOT NULL,
  `cookie` varchar(200) NOT NULL,
  `forgot` enum('iya','tidak') NOT NULL DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `level`, `cookie`, `forgot`) VALUES
(1, 'admin123', '0192023a7bbd73250516f069df18b500', 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'tidak'),
(4, 'siswa125', '2b61ec51e2d2052fe90ffc8a221d16f0', 'siswa', 'f9640170d233dc7d1e362d5ce04f0a55cf081a1d0e6d34d417cf8bf2cacf3cfb', 'tidak'),
(5, 'guru123', '9310f83135f238b04af729fec041cca8', 'guru', '', 'tidak'),
(6, 'guru124', '33dbd004d18bf8203aee1803c0f828dd', 'guru', '', 'tidak'),
(7, 'guru125', 'ae2f75a573f2e34078d6c6524271c4c4', 'guru', '', 'tidak'),
(8, 'guru126', 'cb7b31419cef8edae63ad417ae2cff73', 'guru', '', 'tidak'),
(9, 'guru127', '43a927dca89d9bd2364d3ed95a5f086b', 'guru', '', 'tidak'),
(10, 'guru128', '118037fcb2449cfa1e26263902e84043', 'guru', '', 'tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_materi`
--

CREATE TABLE `video_materi` (
  `id_video` int(11) NOT NULL,
  `judul_video` varchar(200) NOT NULL,
  `link_video` enum('1','0') NOT NULL,
  `file_video` varchar(200) DEFAULT NULL,
  `url_video` text DEFAULT NULL,
  `tanggal_entri` date NOT NULL,
  `materi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_pustaka`
--
ALTER TABLE `daftar_pustaka`
  ADD PRIMARY KEY (`id_pustaka`),
  ADD KEY `materi_id` (`materi_id`);

--
-- Indeks untuk tabel `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `materi_id` (`materi_id`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `siswa_ujian_id` (`siswa_ujian_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indeks untuk tabel `hasil_detail`
--
ALTER TABLE `hasil_detail`
  ADD PRIMARY KEY (`id_hasil_detail`),
  ADD KEY `hasil_id` (`hasil_id`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`id_kompetensi`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `guru_mengajar_id` (`users_id`),
  ADD KEY `jadwal_id` (`jadwal_id`);

--
-- Indeks untuk tabel `petunjuk`
--
ALTER TABLE `petunjuk`
  ADD PRIMARY KEY (`id_petunjuk`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`),
  ADD KEY `users_id` (`users_id`);

--
-- Indeks untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `materi_id` (`materi_id`);

--
-- Indeks untuk tabel `siswa_jawab`
--
ALTER TABLE `siswa_jawab`
  ADD PRIMARY KEY (`id_siswa_jawab`),
  ADD KEY `siswa_ujian_id` (`siswa_ujian_id`),
  ADD KEY `soal_id` (`soal_id`),
  ADD KEY `hasil_id` (`hasil_id`);

--
-- Indeks untuk tabel `siswa_ujian`
--
ALTER TABLE `siswa_ujian`
  ADD PRIMARY KEY (`id_siswa_ujian`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indeks untuk tabel `soal_detail`
--
ALTER TABLE `soal_detail`
  ADD PRIMARY KEY (`id_soal_detail`),
  ADD KEY `soal_id` (`soal_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `video_materi`
--
ALTER TABLE `video_materi`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `materi_id` (`materi_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar_pustaka`
--
ALTER TABLE `daftar_pustaka`
  MODIFY `id_pustaka` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hasil_detail`
--
ALTER TABLE `hasil_detail`
  MODIFY `id_hasil_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `id_kompetensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `petunjuk`
--
ALTER TABLE `petunjuk`
  MODIFY `id_petunjuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `siswa_jawab`
--
ALTER TABLE `siswa_jawab`
  MODIFY `id_siswa_jawab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa_ujian`
--
ALTER TABLE `siswa_ujian`
  MODIFY `id_siswa_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `soal_detail`
--
ALTER TABLE `soal_detail`
  MODIFY `id_soal_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `video_materi`
--
ALTER TABLE `video_materi`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_pustaka`
--
ALTER TABLE `daftar_pustaka`
  ADD CONSTRAINT `daftar_pustaka_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`siswa_ujian_id`) REFERENCES `siswa_ujian` (`id_siswa_ujian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id_quiz`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_detail`
--
ALTER TABLE `hasil_detail`
  ADD CONSTRAINT `hasil_detail_ibfk_1` FOREIGN KEY (`hasil_id`) REFERENCES `hasil` (`id_hasil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_detail_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa_jawab`
--
ALTER TABLE `siswa_jawab`
  ADD CONSTRAINT `siswa_jawab_ibfk_1` FOREIGN KEY (`siswa_ujian_id`) REFERENCES `siswa_ujian` (`id_siswa_ujian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_jawab_ibfk_2` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_jawab_ibfk_3` FOREIGN KEY (`hasil_id`) REFERENCES `hasil` (`id_hasil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa_ujian`
--
ALTER TABLE `siswa_ujian`
  ADD CONSTRAINT `siswa_ujian_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ujian_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id_quiz`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id_quiz`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal_detail`
--
ALTER TABLE `soal_detail`
  ADD CONSTRAINT `soal_detail_ibfk_1` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `video_materi`
--
ALTER TABLE `video_materi`
  ADD CONSTRAINT `video_materi_ibfk_1` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
