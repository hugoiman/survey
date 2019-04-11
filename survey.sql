-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2019 pada 01.36
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_direktorat`
--

CREATE TABLE `tb_direktorat` (
  `id_direktorat` int(11) NOT NULL,
  `direktorat` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_direktorat`
--

INSERT INTO `tb_direktorat` (`id_direktorat`, `direktorat`) VALUES
(1, 'Direktorat Utama'),
(2, 'Direktorat Teknik dan Pengembangan'),
(3, 'Direktorat Operasi'),
(4, 'Direktorat Keuangan dan Administrasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_divisi`
--

CREATE TABLE `tb_divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL,
  `id_direktorat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_divisi`
--

INSERT INTO `tb_divisi` (`id_divisi`, `nama_divisi`, `id_direktorat`) VALUES
(1, 'Divisi K3PL & Pengamanan Perusahaan', 1),
(2, 'Sekretaris Perusahaan', 1),
(3, 'Divisi Audit', 1),
(4, 'Divisi Manajemen Proyek EPC', 2),
(5, 'Koordinator Pelaksana Proyek EPC', 2),
(6, 'Divisi Komersial', 2),
(7, 'Divisi Pelaksana Proyek Operasi', 3),
(8, 'Divisi Manajemen Proyek Operasi', 3),
(9, 'Divisi Kalibrasi Instrumentasi & Manufaktur', 3),
(10, 'Divisi Keuangan', 4),
(11, 'Divisi Logistik & Administrasi', 4),
(12, 'Divisi SDM', 4),
(13, 'Divisi Informasi, Komunikasi & Telekomunikasi', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `nipg` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `grade` varchar(20) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_direktorat` int(11) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`nipg`, `name`, `gender`, `tgl_lahir`, `grade`, `id_divisi`, `id_direktorat`, `status`) VALUES
('0005802119', 'Fathurrahman', 'L', '1980-03-01', 'Staff', 2, 1, 'Aktif'),
('0005832167', 'Raiso', 'P', '1983-11-22', 'AVP', 10, 4, 'Aktif'),
('0010882478', 'Yuliansyah', 'L', '1998-11-30', 'AVP', 5, 2, 'Aktif'),
('0010882621', 'Lukman', 'L', '1987-09-24', 'Staff', 11, 4, 'Aktif'),
('001110004', 'Zia Ulhaq', 'P', '1978-11-04', 'Assistant Manager', 13, 4, 'Aktif'),
('0011902635', 'Septiani', 'P', '1990-09-15', 'Supervisor', 1, 1, 'Aktif'),
('001210031', 'Halimah', 'P', '1987-10-02', 'Staff', 6, 2, 'Aktif'),
('001210034', 'Priyo Sunu', 'L', '1982-05-05', 'Supervisor', 12, 4, 'Aktif'),
('001210037', 'Vita', 'P', '1987-10-06', 'Manager', 4, 2, 'Aktif'),
('0012902725', 'Yunus', 'L', '1990-08-15', 'Manager', 9, 3, 'Aktif'),
('001310052', 'Ricky', 'L', '1972-12-12', 'Assistant Manager', 3, 1, 'Aktif'),
('001410091', 'Apriyani', 'P', '1989-09-04', 'Assistant Manager', 8, 3, 'Aktif'),
('0014932766', 'Dionisius', 'L', '1993-10-15', 'Supervisor', 7, 3, 'Aktif'),
('111224', 'aaa', 'L', '2000-04-12', 'Supervisor', 9, 3, 'Aktif'),
('admin', 'Admin', '', '2018-09-04', '', 1, 1, 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kuesioner`
--

CREATE TABLE `tb_kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `judul_kuesioner` varchar(50) NOT NULL,
  `periode` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kuesioner`
--

INSERT INTO `tb_kuesioner` (`id_kuesioner`, `judul_kuesioner`, `periode`, `status`) VALUES
(201, 'Survey Engagement', 'September 2018', 'aktif'),
(202, 'Survey Kepuasan Pekerja', 'September 2018', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_respon_kuesioner`
--

CREATE TABLE `tb_respon_kuesioner` (
  `id_rk` int(11) NOT NULL,
  `nipg` varchar(15) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `jawaban` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saran`
--

CREATE TABLE `tb_saran` (
  `id_saran` int(10) NOT NULL,
  `nipg` varchar(15) NOT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `saran` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_saran`
--

INSERT INTO `tb_saran` (`id_saran`, `nipg`, `subjek`, `saran`, `waktu`) VALUES
(27, '0011902635', 'Recruitment', 'hallo', '2019-04-11 09:46:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_soal_kuesioner`
--

CREATE TABLE `tb_soal_kuesioner` (
  `id_sk` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `soal_kuesioner` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_soal_kuesioner`
--

INSERT INTO `tb_soal_kuesioner` (`id_sk`, `id_kuesioner`, `id_sub`, `soal_kuesioner`) VALUES
(267, 201, 82, 'Persyaratan administrasi yang telah ditetapkan perusahaan dalam menseleksi calon pekerjaannya telah disaring dengan benar.'),
(268, 201, 82, 'Media yang digunakan perusahaan saya pada saat rekrutmen berlangsung sangat memadai.'),
(269, 201, 83, 'Saya tahu pasti apa yang menjadi tugas-tugas saya, bagaimana urutan pengerjaannya, kapan harus mengerjakan yang satu dan kapan harus mengerjakan yang lain'),
(270, 201, 83, 'Saya mendapatkan gambaran / pengarahan yang jelas mengenai baik buruknya hasil pekerjaan saya'),
(271, 201, 84, 'Perusahaan dalam melakukan promosi jabatan dilakukan berdasarkan penilaian kinerja karyawan'),
(272, 201, 84, 'Perusahaan melakukan kajian secara individu terhadap karier karyawan'),
(273, 201, 85, 'Saya mendapat apresiasi dari atasan saya ketika saya berhasil menyelesaikan tugas dengan baik'),
(274, 201, 85, 'Saya menerima umpan balik dan bimbingan yang jelas dari atasan mengenai hasil pekerjaan'),
(275, 201, 86, 'Pekerjaan yang saya kerjakan adalah penting dan menjadi tanggung jawab saya untuk menyelesaikannya'),
(276, 201, 86, 'Saya mendapat kesempatan berkreasi dalam menyelesaikan pekerjaan'),
(277, 201, 87, 'Saya diperlakukan sama tanpa melihat posisi jabatan/latar belakang pendidikan, pengalaman, dll.'),
(278, 201, 87, 'Saya mendapatkan informasi terkait perusahaan sesuai dengan kebutuhan.'),
(279, 201, 88, 'Saya mendapat pelatihan yang cukup dari perusahaan dan sesuai dengan pekerjaan saya'),
(280, 201, 88, 'Perusahaan merencanakan kebutuhan sarana dan prasarana pelatihan dengan baik.'),
(281, 201, 89, 'Pengetahuan dan keterampilan yang saya miliki membantu dalam peningkatan kinerja perusahaan'),
(282, 201, 89, 'Sistem manajemen yang diterapkan perusahaan mampu menunjang pencapaian kinerja secara optimal'),
(283, 201, 90, 'Saya diberi imbalan gaji sesuai dengan kinerja dan kecakapan saya'),
(284, 201, 90, 'Insentif yang saya terima mampu meningkatkan motivasi dan produktivitas saya'),
(285, 201, 91, 'Saya mendapatkan pemahaman yang cukup mengenai keselamatan, keamanan dan kesehatan kerja yang cukup dari perusahaan'),
(286, 201, 91, 'Perusahaan saya memiliki ketersediaan alat pelindung / pengaman pada saat melaksanakan pekerjaan untuk menghindari terjadinya kecelakaan kerja'),
(287, 201, 92, 'Saya diberikan pekerjaan oleh perusahaan yang menarik dan menantang dari waktu ke waktu'),
(288, 201, 92, 'Pekerjaan saya memberi peluang kepada saya untuk belajar keterampilan baru tentang peningkatan karir'),
(289, 201, 93, 'Saya mendapat informasi dengan mudah dari kelompok kerja saya dalam perusahaan'),
(290, 201, 93, 'Saya merasa komunikasi saya dengan atasan berjalan dengan baik'),
(291, 201, 94, 'Saya dapat menjaga keseimbangan antara urusan pekerjaan dangan kehidupan pribadi saya '),
(292, 201, 94, 'Saya memiliki kehidupan sosial yang baik diluar kantor'),
(293, 202, 95, 'Lingkungan rekan-rekan kerja mendukung saya untuk dapat menyelesaikan pekerjaan'),
(294, 202, 95, 'Saya merasa puas dengan cara-cara anggota kelompok kerja saya memecahkan masalah'),
(295, 202, 95, 'Saya merasa puas dengan kerjasama antar pekerja di lingkungan kerja saya'),
(296, 202, 96, 'Saya memiliki peralatan, sarana dan bahan baku yang diperlukan untuk melaksanakan tugas saya dengan baik'),
(297, 202, 96, 'Saya merasa nyaman dengan kondisi fisik di lingkungan kerja saya, seperti penerangan, AC, meja kursi, dll'),
(298, 202, 96, 'Saya merasa aman dengan implementasi K3 di lingkungan perusahaan'),
(299, 202, 97, 'Saya mendapat apresiasi dari atasan saya ketika saya berhasil menyelesaikan tugas dengan baik'),
(300, 202, 97, 'Saya mendapat kesempatan untuk maju dan berkembang di dalam pekerjaan'),
(301, 202, 97, 'Saya menerima umpan balik dan bimbingan yang jelas dari atasan mengenai hasil pekerjaan'),
(302, 202, 97, 'Atasan saya memberikan kesempatan kepada saya untuk berdiskusi dengannya ketika saya memiliki permasalahan pekerjaan'),
(303, 202, 97, 'Saya mendapatkan kesempatan pengembangan diri melalui Training yang mendukung peningkatan kompetensi saya'),
(304, 202, 97, 'Atasan saya memberikan kesempatan kepada saya untuk berdiskusi dengannya ketika saya memiliki permasalahan di luar pekerjaan'),
(305, 202, 98, 'Pekerjaan saya menantang dan menarik'),
(306, 202, 98, 'Saya mendapat kesempatan berkreasi dalam menyelesaikan pekerjaan'),
(307, 202, 98, 'Pekerjaan yang saya kerjakan adalah penting dan menjadi tanggung jawab saya untuk menyelesaikannya'),
(308, 202, 98, 'Saya puas dengan pekerjaan dan jenis tugas yang saya kerjakan.'),
(309, 202, 98, 'Saya memiliki tugas pokok dan fungsi sesuai dengan Jabatan yang saya emban'),
(310, 202, 99, 'Saya merasa puas dengan imbalan gaji yang saya terima sesuai dengan kinerja dan kecakapan saya'),
(311, 202, 99, 'Saya merasa puas dengan benefit kesehatan yang saya terima'),
(312, 202, 99, 'Saya mendapatkan hak cuti sesuai ketentuan dan dapat saya gunakan ketika butuh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sub_kuesioner`
--

CREATE TABLE `tb_sub_kuesioner` (
  `id_sub` int(11) NOT NULL,
  `sub_kuesioner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_sub_kuesioner`
--

INSERT INTO `tb_sub_kuesioner` (`id_sub`, `sub_kuesioner`) VALUES
(82, 'Recruitment'),
(83, 'Job Designing'),
(84, 'Career Development Opportunities'),
(85, 'Leadership'),
(86, 'Empowerment'),
(87, 'Equal Opportunities and Fair Treatment'),
(88, 'Training and Development'),
(89, 'Performance Management'),
(90, 'Compensation'),
(91, 'Health and Safety'),
(92, 'Job Satisfaction'),
(93, 'Communication'),
(94, 'Family Friendliness'),
(95, 'Aspek Rekan Kerja'),
(96, 'Aspek Kondisi Kerja'),
(97, 'Aspek Penyeliaan (Pembinaan dan Pengembangan)'),
(98, 'Aspek Pekerjaan'),
(99, 'Aspek Imbalan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_target_kuesioner`
--

CREATE TABLE `tb_target_kuesioner` (
  `id_kuesioner` int(11) DEFAULT NULL,
  `id_divisi` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_target_kuesioner`
--

INSERT INTO `tb_target_kuesioner` (`id_kuesioner`, `id_divisi`) VALUES
(201, 1),
(201, 2),
(201, 3),
(201, 4),
(201, 5),
(201, 6),
(201, 7),
(201, 8),
(201, 9),
(201, 10),
(201, 11),
(201, 12),
(201, 13),
(202, 1),
(202, 2),
(202, 3),
(202, 4),
(202, 5),
(202, 6),
(202, 7),
(202, 8),
(202, 9),
(202, 10),
(202, 11),
(202, 12),
(202, 13),
(NULL, 1),
(NULL, 2),
(NULL, 4),
(NULL, 5),
(NULL, 6),
(NULL, 7),
(NULL, 8),
(NULL, 10),
(NULL, 11),
(NULL, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `nipg` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`nipg`, `password`, `level`) VALUES
('admin', '7e4f8df1d7034bb70e83adae2bf3e765', 'admin'),
('0011902635', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('0005802119', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('001310052', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('001210037', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('0010882478', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('001210031', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('0014932766', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('001410091', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('0012902725', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('0005832167', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('0010882621', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('001210034', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('001110004', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan'),
('111224', '7e4f8df1d7034bb70e83adae2bf3e765', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_direktorat`
--
ALTER TABLE `tb_direktorat`
  ADD PRIMARY KEY (`id_direktorat`);

--
-- Indeks untuk tabel `tb_divisi`
--
ALTER TABLE `tb_divisi`
  ADD PRIMARY KEY (`id_divisi`),
  ADD KEY `id_direktorat` (`id_direktorat`);

--
-- Indeks untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`nipg`),
  ADD KEY `id_divisi` (`id_divisi`),
  ADD KEY `id_direktorat` (`id_direktorat`);

--
-- Indeks untuk tabel `tb_kuesioner`
--
ALTER TABLE `tb_kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`);

--
-- Indeks untuk tabel `tb_respon_kuesioner`
--
ALTER TABLE `tb_respon_kuesioner`
  ADD PRIMARY KEY (`id_rk`),
  ADD KEY `tb_respon_quisioner_ibfk_1` (`nipg`),
  ADD KEY `id_quisioner` (`id_kuesioner`),
  ADD KEY `id_sq` (`id_sk`),
  ADD KEY `id_sub` (`id_sub`);

--
-- Indeks untuk tabel `tb_saran`
--
ALTER TABLE `tb_saran`
  ADD PRIMARY KEY (`id_saran`),
  ADD KEY `tb_saran_ibfk_1` (`nipg`);

--
-- Indeks untuk tabel `tb_soal_kuesioner`
--
ALTER TABLE `tb_soal_kuesioner`
  ADD PRIMARY KEY (`id_sk`),
  ADD KEY `tb_soal_kuisioner_ibfk_1` (`id_kuesioner`),
  ADD KEY `id_sub` (`id_sub`);

--
-- Indeks untuk tabel `tb_sub_kuesioner`
--
ALTER TABLE `tb_sub_kuesioner`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indeks untuk tabel `tb_target_kuesioner`
--
ALTER TABLE `tb_target_kuesioner`
  ADD KEY `id_kuesioner` (`id_kuesioner`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD KEY `nipg` (`nipg`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_direktorat`
--
ALTER TABLE `tb_direktorat`
  MODIFY `id_direktorat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_divisi`
--
ALTER TABLE `tb_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_kuesioner`
--
ALTER TABLE `tb_kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT untuk tabel `tb_respon_kuesioner`
--
ALTER TABLE `tb_respon_kuesioner`
  MODIFY `id_rk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_saran`
--
ALTER TABLE `tb_saran`
  MODIFY `id_saran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_soal_kuesioner`
--
ALTER TABLE `tb_soal_kuesioner`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- AUTO_INCREMENT untuk tabel `tb_sub_kuesioner`
--
ALTER TABLE `tb_sub_kuesioner`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_divisi`
--
ALTER TABLE `tb_divisi`
  ADD CONSTRAINT `tb_divisi_ibfk_1` FOREIGN KEY (`id_direktorat`) REFERENCES `tb_direktorat` (`id_direktorat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD CONSTRAINT `tb_karyawan_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `tb_divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_karyawan_ibfk_2` FOREIGN KEY (`id_direktorat`) REFERENCES `tb_direktorat` (`id_direktorat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_respon_kuesioner`
--
ALTER TABLE `tb_respon_kuesioner`
  ADD CONSTRAINT `tb_respon_kuesioner_ibfk_1` FOREIGN KEY (`nipg`) REFERENCES `tb_karyawan` (`nipg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_respon_kuesioner_ibfk_2` FOREIGN KEY (`id_kuesioner`) REFERENCES `tb_kuesioner` (`id_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_respon_kuesioner_ibfk_3` FOREIGN KEY (`id_sk`) REFERENCES `tb_soal_kuesioner` (`id_sk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_respon_kuesioner_ibfk_4` FOREIGN KEY (`id_sub`) REFERENCES `tb_sub_kuesioner` (`id_sub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_saran`
--
ALTER TABLE `tb_saran`
  ADD CONSTRAINT `tb_saran_ibfk_1` FOREIGN KEY (`nipg`) REFERENCES `tb_karyawan` (`nipg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_soal_kuesioner`
--
ALTER TABLE `tb_soal_kuesioner`
  ADD CONSTRAINT `tb_soal_kuesioner_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `tb_kuesioner` (`id_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_soal_kuesioner_ibfk_2` FOREIGN KEY (`id_kuesioner`) REFERENCES `tb_kuesioner` (`id_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_soal_kuesioner_ibfk_3` FOREIGN KEY (`id_sub`) REFERENCES `tb_sub_kuesioner` (`id_sub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_target_kuesioner`
--
ALTER TABLE `tb_target_kuesioner`
  ADD CONSTRAINT `tb_target_kuesioner_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `tb_kuesioner` (`id_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_target_kuesioner_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `tb_divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`nipg`) REFERENCES `tb_karyawan` (`nipg`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
