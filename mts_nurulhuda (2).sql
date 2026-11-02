-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2026 at 08:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mts_nurulhuda`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `recovery_code_hash` varchar(255) DEFAULT NULL,
  `password_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `recovery_code_hash`, `password_updated_at`) VALUES
(123, 'administrator', '$2y$10$UwiMf/1qH4li4iftC7wSAOXzOfulqacUNAGPYyl7jM7wSHYTYaktK', '$2y$10$yb69nPNYkVIIPXCBassgm.ecNEudbByvaVAQbro7/oP9Lbeqobdqu', '2026-08-19 23:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `judul`, `tanggal`, `waktu`, `tempat`, `deskripsi`) VALUES
(4, 'Jalan Sehat', '2026-08-29', '08:00', 'Madrasah Nurul Huda ', 'Kegiatan Jalan Sehat MTs Nurul Huda merupakan kegiatan yang bertujuan untuk menjaga kesehatan dan kebugaran tubuh sekaligus mempererat kebersamaan antara siswa dan guru. Kegiatan dilaksanakan dengan berjalan bersama melalui rute yang telah ditentukan dalam suasana yang sehat, ceria, dan penuh semangat.\r\n\r\nSebagai bentuk menambah kemeriahan kegiatan, setelah jalan sehat juga dilaksanakan Lucky Draw dengan berbagai hadiah menarik. Kegiatan ini memberikan kesempatan kepada peserta untuk mendapatkan hadiah sekaligus menciptakan suasana yang lebih menyenangkan dan penuh antusiasme.');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `isi`, `tanggal`, `gambar`) VALUES
(138, 'Semarak Kemerdekaan, Siswa MTs Nurul Huda Ikuti Lomba Memasukkan Pipet ke Botol', 'Lomba Memasukkan Pipet ke Botol merupakan salah satu kegiatan perlombaan yang dilaksanakan di MTs Nurul Huda. Dalam permainan ini, peserta ditantang untuk memasukkan pipet ke dalam botol dengan menggunakan kayu yang mirip pancing  sebagai alat bantu. Kegiatan ini berlangsung dengan penuh semangat dan keceriaan. Selain menjadi hiburan, lomba ini juga melatih ketelitian, konsentrasi, keseimbangan, dan kesabaran para peserta. Setiap peserta berusaha menyelesaikan tantangan dengan cepat dan tepat. Melalui kegiatan ini, diharapkan dapat tercipta suasana kebersamaan, sportivitas, dan kekompakan di lingkungan MTs Nurul Huda.', '2026-08-28', '1788190360_WhatsApp Image 2026-08-31 at 22.28.40.jpeg'),
(139, 'MTs Nurul Huda Pematang Cengal Kembali mendapatkan Kunjungan  Dari Direktorat kesehatan keluarga kemenkes RI Dalam Rangka Pemeriksaan kesehatan Siswa-Siswi.', 'Alhamdulillah, MTs Nurul Huda Pematang Cengal kembali mendapat kunjungan dari Direktorat Kesehatan Keluarga Kementerian Kesehatan Republik Indonesia (Kemenkes RI) Jakarta beserta tim dalam rangka kegiatan pemeriksaan kesehatan bagi siswa-siswi.\r\nKegiatan ini merupakan bentuk perhatian dan kepedulian terhadap kesehatan serta tumbuh kembang peserta didik. Para siswa-siswi MTs Nurul Huda mengikuti kegiatan pemeriksaan dengan antusias dan tertib.Kunjungan ini menjadi momen yang sangat berarti bagi madrasah, terlebih sebelumnya MTs Nurul Huda juga mendapat kunjungan dari Menteri ESDM dan Menteri Kebudayaan.Pihak MTs Nurul Huda mengucapkan terima kasih kepada Bapak/Ibu dari Kemenkes RI atas kehadiran, perhatian, dan kepedulian yang diberikan kepada siswa-siswi.Semoga kegiatan pemeriksaan kesehatan ini memberikan manfaat dan menjadi langkah positif dalam mendukung kesehatan serta kesejahteraan siswa-siswi MTs Nurul Huda. Aamiin. ', '2026-08-20', 'WhatsApp Image 2026-08-31 at 22.37.21.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id_ekskul` int(11) NOT NULL,
  `nama_ekskul` varchar(100) NOT NULL,
  `pembina` varchar(100) NOT NULL,
  `jadwal` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id_ekskul`, `nama_ekskul`, `pembina`, `jadwal`, `deskripsi`, `gambar`) VALUES
(5, 'Pramuka', 'Muhammad Rafly', 'sabtu, 13.20', 'Ekstrakurikuler Pramuka di MTs Nurul Huda merupakan kegiatan yang bertujuan untuk membentuk karakter peserta didik agar lebih disiplin, mandiri, bertanggung jawab, serta mampu bekerja sama dengan baik. Melalui berbagai kegiatan kepramukaan, siswa dilatih untuk memiliki jiwa kepemimpinan, keterampilan, keberanian, dan kepedulian terhadap lingkungan.\r\n\r\nKegiatan Pramuka dilaksanakan melalui berbagai aktivitas seperti latihan baris-berbaris, permainan edukatif, kegiatan kelompok, keterampilan kepramukaan, serta kegiatan yang menumbuhkan rasa kebersamaan dan kedisiplinan.', '1787845169_WhatsApp Image 2026-08-15 at 09.23.23.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `penjelasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `gambar`, `nama_fasilitas`, `penjelasan`) VALUES
(2, 'fasilitas_1787843036_761.jpeg', 'Mushola', 'Mushola MTs Nurul Huda merupakan fasilitas yang digunakan untuk mendukung kegiatan ibadah dan pembinaan keagamaan siswa. Mushola dilengkapi dengan Al-Qur’an, buku Yasin, sajadah, kipas angin, serta tempat wudhu, sehingga dapat digunakan dengan nyaman untuk melaksanakan salat dan berbagai kegiatan keagamaan.'),
(3, 'fasilitas_1787843084_811.jpeg', 'Pentas Kreasi', 'Pentas Kreasi MTs Nurul Huda merupakan fasilitas yang digunakan untuk mendukung kegiatan kreativitas dan pengembangan bakat siswa. Tempat ini dapat digunakan untuk berbagai kegiatan seperti pertunjukan seni, kegiatan keagamaan, perlombaan, acara sekolah, dan kegiatan siswa lainnya. Di area ini juga terdapat berbagai piala dan penghargaan sebagai dokumentasi prestasi siswa.');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `judul`, `gambar`, `keterangan`, `tanggal`) VALUES
(4, 'Upacara bendera ', 'galeri_6a905e2f5d372.jpeg', '', '2026-08-10'),
(7, 'Foto Kepala yaspen Nurul Huda dan Beberapa  Guru Bersama Keluarga Kemenkes RI Jakarta', 'galeri_6a95a20f7d308.jpeg', '', '2026-08-20'),
(8, 'Foto Kepala yaspen Nurul Huda, Guru, Dan Siswi MTs Bersama Keluarga Kemenkes RI Jakarta ', 'galeri_6a95a2b14cb1e.jpeg', '', '2026-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `pendidikan_terakhir` varchar(50) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_guru`, `jenis_kelamin`, `agama`, `pendidikan_terakhir`, `mata_pelajaran`, `jabatan`, `no_hp`, `email`, `alamat`, `gambar`) VALUES
(138, '', 'Novia Robeitah Irham, m.pd.', 'Laki-laki', '', '', '', 'Kepala Madrasah', NULL, NULL, NULL, 'guru_1788316552_775.jpeg'),
(139, '', 'Wahyuni,S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(140, '', 'Taupiq, S.Pd.I', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(141, '', 'Misno, S.pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(142, '', 'Wahyu Candra dewi, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(143, '', 'Lailan Thawila, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(144, '', 'yunisa Indriyani, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(145, '', 'M. Ariffandi, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(146, '', 'Mariam Kalsum, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(147, '', 'Desi Arnita, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(148, '', 'Khairunnisa, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(149, '', 'Dinda Mulyana', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(150, '', 'Windy aulia', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, ''),
(151, '', 'Helpi Tiana, S.Pd', 'Laki-laki', '', '', 'None', 'wali kelas', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `no_pendaftaran` varchar(30) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nik_ayah` varchar(20) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `no_hp_ayah` varchar(20) DEFAULT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `nik_ibu` varchar(20) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `no_hp_ibu` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `dokumen_surat_kelulusan` varchar(255) DEFAULT NULL,
  `dokumen_skhu` varchar(255) DEFAULT NULL,
  `dokumen_akte_kelahiran` varchar(255) DEFAULT NULL,
  `dokumen_kartu_keluarga` varchar(255) DEFAULT NULL,
  `dokumen_ktp_ayah` varchar(255) DEFAULT NULL,
  `dokumen_ktp_ibu` varchar(255) DEFAULT NULL,
  `dokumen_pkh` varchar(255) DEFAULT NULL,
  `dokumen_kks` varchar(255) DEFAULT NULL,
  `dokumen_kip` varchar(255) DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT current_timestamp(),
  `status` enum('Menunggu Verifikasi','Diverifikasi','Diterima','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `alasan_ditolak` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `no_pendaftaran`, `nama_lengkap`, `nik`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `no_hp`, `asal_sekolah`, `tahun_lulus`, `nama_ayah`, `nik_ayah`, `pekerjaan_ayah`, `no_hp_ayah`, `nama_ibu`, `nik_ibu`, `pekerjaan_ibu`, `no_hp_ibu`, `foto`, `dokumen_surat_kelulusan`, `dokumen_skhu`, `dokumen_akte_kelahiran`, `dokumen_kartu_keluarga`, `dokumen_ktp_ayah`, `dokumen_ktp_ibu`, `dokumen_pkh`, `dokumen_kks`, `dokumen_kip`, `tanggal_daftar`, `status`, `alasan_ditolak`) VALUES
(9, 'PPDB-2026-76438', 'reza', '1223455', '04847789123', 'medan', '2026-08-05', 'Laki-laki', 'Islam', 'medan', '12345465', 'smp langkat', '2026', 'adi', '1223455', 'doktor', '', 'urepi', '1223455', 'doktor', '', 'ppdb_6a906fab5e37f1.98389709_1787850667.png', 'ppdb_6a906fab5eb2b3.02428927_1787850667.png', 'ppdb_6a906fab5f24b8.76357145_1787850667.png', '', 'ppdb_6a906fab5f6d17.86184589_1787850667.png', 'ppdb_6a906fab5fb2c9.44541836_1787850667.png', 'ppdb_6a906fab5ff524.76288679_1787850667.png', '', '', '', '2026-08-28 00:11:07', 'Diterima', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ppdb_alur`
--

CREATE TABLE `ppdb_alur` (
  `id_alur` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ppdb_alur`
--

INSERT INTO `ppdb_alur` (`id_alur`, `nomor`, `judul`, `keterangan`, `status`, `created_at`) VALUES
(1, 1, 'Mengisi Formulir Pendaftaran', 'Calon siswa mengisi data pendaftaran secara lengkap melalui website.', 'Aktif', '2026-08-17 14:32:39'),
(2, 2, 'Upload Berkas', 'Mengunggah dokumen persyaratan yang diperlukan.', 'Aktif', '2026-08-17 14:32:39'),
(3, 3, 'Verifikasi Berkas', 'Admin melakukan pemeriksaan terhadap data dan dokumen calon siswa.', 'Aktif', '2026-08-17 14:32:39'),
(4, 4, 'Pengumuman Hasil Seleksi', 'Hasil verifikasi dan seleksi dapat dilihat melalui website.', 'Aktif', '2026-08-17 14:32:39'),
(5, 5, 'Daftar Ulang', 'Peserta yang diterima melakukan proses daftar ulang sesuai ketentuan madrasah.', 'Aktif', '2026-08-17 14:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `ppdb_info`
--

CREATE TABLE `ppdb_info` (
  `id_ppdb` int(11) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `judul_hero` varchar(255) NOT NULL,
  `subjudul_hero` varchar(255) NOT NULL,
  `nama_yayasan` varchar(255) DEFAULT NULL,
  `periode_pendaftaran` varchar(100) NOT NULL,
  `tingkat_pendidikan` varchar(100) NOT NULL,
  `biaya_pendidikan` varchar(100) NOT NULL,
  `deskripsi_biaya` text DEFAULT NULL,
  `tanggal_pendaftaran` varchar(100) NOT NULL,
  `keterangan_jadwal` text DEFAULT NULL,
  `judul_persyaratan` varchar(255) DEFAULT 'Persyaratan Pendaftaran Tingkat MTs',
  `judul_alur` varchar(255) DEFAULT 'Alur Pendaftaran',
  `judul_biaya` varchar(255) DEFAULT 'BIAYA PENDIDIKAN',
  `keterangan_biaya` text DEFAULT NULL,
  `judul_cta` varchar(255) DEFAULT 'Siap Mendaftar?',
  `keterangan_cta` text DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ppdb_info`
--

INSERT INTO `ppdb_info` (`id_ppdb`, `tahun_ajaran`, `judul_hero`, `subjudul_hero`, `nama_yayasan`, `periode_pendaftaran`, `tingkat_pendidikan`, `biaya_pendidikan`, `deskripsi_biaya`, `tanggal_pendaftaran`, `keterangan_jadwal`, `judul_persyaratan`, `judul_alur`, `judul_biaya`, `keterangan_biaya`, `judul_cta`, `keterangan_cta`, `status`, `created_at`, `updated_at`) VALUES
(1, '2026/2027', 'PPDB Online 2026/2027', 'Penerimaan Peserta Didik Baru', 'Daftarkan putra-putri Anda menjadi bagian dari keluarga besar MIS Nurul Huda Pematang Cengal. Proses pendaftaran sekarang lebih mudah, cepat, dan dapat dilakukan langsung melalui HP tanpa harus datang ke sekolah.', '01 April - 10 Juli 2026', 'MTs', 'GRATIS', 'Pendidikan di MTs Nurul Huda GRATIS.', '01 April - 10 Juli 2026', 'Pendaftaran Peserta Didik Baru Tahun Ajaran 2026/2027.', 'Persyaratan Pendaftaran Tingkat MTs', 'Alur Pendaftaran', 'BIAYA PENDIDIKAN', 'Pendidikan berkualitas untuk masa depan peserta didik MTs Nurul Huda Pematang Cengal.', 'Siap Mendaftar?', 'Pastikan data dan dokumen yang diperlukan sudah dipersiapkan sebelum melakukan pendaftaran online.', 'Aktif', '2026-08-17 14:28:04', '2026-08-31 13:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `ppdb_persyaratan`
--

CREATE TABLE `ppdb_persyaratan` (
  `id_persyaratan` int(11) NOT NULL,
  `persyaratan` text NOT NULL,
  `keterangan` enum('WAJIB','OPSIONAL') DEFAULT 'WAJIB',
  `urutan` int(11) DEFAULT 1,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ppdb_persyaratan`
--

INSERT INTO `ppdb_persyaratan` (`id_persyaratan`, `persyaratan`, `keterangan`, `urutan`, `status`, `created_at`) VALUES
(1, 'Mengisi formulir pendaftaran. ', 'WAJIB', 1, 'Aktif', '2026-08-17 14:31:45'),
(2, 'Fotokopi Surat Kelulusan sebanyak 1 lembar.', 'WAJIB', 2, 'Aktif', '2026-08-17 14:31:45'),
(3, 'Fotokopi SKHU SD/MI sebanyak 1 lembar.', 'WAJIB', 3, 'Aktif', '2026-08-17 14:31:45'),
(4, 'Fotokopi Akte Kelahiran sebanyak 2 lembar jika ada.', 'OPSIONAL', 4, 'Aktif', '2026-08-17 14:31:45'),
(5, 'Fotokopi Kartu Keluarga sebanyak 2 lembar.', 'WAJIB', 5, 'Aktif', '2026-08-17 14:31:45'),
(6, 'Fotokopi KTP Ayah dan Ibu sebanyak 2 lembar.', 'WAJIB', 6, 'Aktif', '2026-08-17 14:31:45'),
(7, 'Fotokopi Kartu PKH, KKS dan KIP sebanyak 2 lembar jika ada.', 'OPSIONAL', 7, 'Aktif', '2026-08-17 14:31:45'),
(8, 'Foto 3x4 sebanyak 2 lembar dengan latar belakang biru.', 'WAJIB', 8, 'Aktif', '2026-08-17 14:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `nama_prestasi` varchar(200) NOT NULL,
  `tingkat` varchar(50) NOT NULL,
  `penyelenggara` varchar(150) NOT NULL,
  `tahun` year(4) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id_prestasi`, `nama_prestasi`, `tingkat`, `penyelenggara`, `tahun`, `deskripsi`, `gambar`) VALUES
(5, 'juara lomba pramuka', 'kabupaten', 'bupati', '2024', 'Anak MTs nurul huda memenangkan Lomba pramuka  yang di selenggarakan bupati', '1788316826_WhatsApp Image 2026-08-15 at 09.23.23.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sambutan`
--

CREATE TABLE `sambutan` (
  `id_sambutan` int(11) NOT NULL,
  `nama_kepala` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `isi_sambutan` text NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sambutan`
--

INSERT INTO `sambutan` (`id_sambutan`, `nama_kepala`, `jabatan`, `foto`, `isi_sambutan`, `status`, `tanggal_update`) VALUES
(1, 'Novia Robeitah Irham,  M.Pd.', 'Kepala Madrasah', 'kepala_1788275281_6a96ea51babcf.jpeg', 'Assalamu\'alaikum Wr. Wb.\r\n\r\nSelamat datang di Website Resmi MTs Nurul Huda Pematang Cengal.\r\n\r\nWebsite ini dibuat sebagai media informasi sekolah kepada siswa, orang tua, guru, maupun masyarakat. Semoga website ini dapat memberikan informasi yang bermanfaat mengenai kegiatan, prestasi, agenda, serta perkembangan MTs Nurul Huda Pematang Cengal.\r\n\r\nWassalamu\'alaikum Wr. Wb.', 'Aktif', '2026-09-01 15:08:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id_ekskul`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD UNIQUE KEY `no_pendaftaran` (`no_pendaftaran`);

--
-- Indexes for table `ppdb_alur`
--
ALTER TABLE `ppdb_alur`
  ADD PRIMARY KEY (`id_alur`);

--
-- Indexes for table `ppdb_info`
--
ALTER TABLE `ppdb_info`
  ADD PRIMARY KEY (`id_ppdb`);

--
-- Indexes for table `ppdb_persyaratan`
--
ALTER TABLE `ppdb_persyaratan`
  ADD PRIMARY KEY (`id_persyaratan`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`);

--
-- Indexes for table `sambutan`
--
ALTER TABLE `sambutan`
  ADD PRIMARY KEY (`id_sambutan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id_ekskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ppdb_alur`
--
ALTER TABLE `ppdb_alur`
  MODIFY `id_alur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ppdb_info`
--
ALTER TABLE `ppdb_info`
  MODIFY `id_ppdb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ppdb_persyaratan`
--
ALTER TABLE `ppdb_persyaratan`
  MODIFY `id_persyaratan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sambutan`
--
ALTER TABLE `sambutan`
  MODIFY `id_sambutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
