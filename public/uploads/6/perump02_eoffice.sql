-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2022 at 11:18 AM
-- Server version: 5.6.51
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perump02_eoffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_credential`
--

CREATE TABLE `t_credential` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_asmen` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_credential`
--

INSERT INTO `t_credential` (`id_user`, `id_role`, `id_departemen`, `id_jabatan`, `id_asmen`, `id_divisi`, `username`, `password`, `nama_lengkap`, `no_telp`, `email`, `id_pegawai`) VALUES
(1, 1, 0, 0, 0, 0, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Superadmin', '', 'superadmin@ppd.co.id', 0),
(7, 1, 0, 10, 0, 0, 'resepsionis', '3aeff485f68b360d076de3d73f9247ad', 'Resep Sionis', '', '', 0),
(8, 1, 0, 1, 0, 0, 'direkturutama', 'a79924be855f431f39a0628fbc415f1d', 'Direktur Utama', '', '', 0),
(9, 1, 0, 2, 0, 0, 'direkturoperasional', '1b196e4f33d57b0e9624c8c513235f46', 'Direktur Operasional', '', '', 0),
(10, 1, 0, 3, 0, 0, 'direkturkeuangan', '6d7913178f75376d69740c3a80e37b7d', 'Direktur Keuangan', '', '', 0),
(11, 1, 0, 4, 0, 5, 'komersial', 'b30f1523cc62afd049aed787d0c4fc14', 'GM Komersial', '', '', 0),
(12, 1, 10, 5, 0, 5, 'sigit', '223a0fa8f15933d622b3c7a13f186027', 'Sigit Irawan', '', '', 0),
(13, 1, 33, 5, 0, 0, 'ester', 'fa258e7e7a0d43c4266a01029dc2bdfa', 'Staf IT', '', '', 0),
(14, 0, 25, 11, 0, 0, 'ciputat', '1e0edfa6b9580b84ab808e7f4ef4a5d3', '', '', '', 0),
(15, 1, 18, 12, 18, 0, 'adminkeuangan', '95759b45a617b3d9e91b9a4a3a37dbbf', 'Administrasi Keuangan', '', '', 0),
(16, 1, 0, 13, 0, 1, 'sekretariat', '593277eb017ecbe3d5bc8e552d68ff53', 'Maudy Ayunda', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_departemen`
--

CREATE TABLE `t_departemen` (
  `id` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `departemen_name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_departemen`
--

INSERT INTO `t_departemen` (`id`, `id_divisi`, `departemen_name`, `description`) VALUES
(1, 1, 'Hukum dan Kepatuhan Korporat', ''),
(2, 1, 'Humas', ''),
(3, 1, 'Asisstant Manager Kesekretariatan', ''),
(4, 2, 'Auditor', ''),
(5, 3, 'Pengendalian Operasi', ''),
(6, 3, 'Produksi dan Evaluasi', ''),
(7, 4, 'Perencanaan dan\r\nPengadaan Teknik', ''),
(8, 4, 'Bengkel', ''),
(9, 4, 'Pemeliharaan\r\n', ''),
(10, 5, 'Teknologi\r\nInformasi', ''),
(11, 5, 'Pemasaran\r\ndan Pelayanan\r\nPelanggan', ''),
(12, 5, 'Perencanaan dan\r\nPengembangan\r\nUsaha', ''),
(13, 7, 'Rekrutmen\r\ndan Pengembangan\r\nSDM ', ''),
(14, 7, 'Kompensasi dan\r\nKesejahteraan', ''),
(15, 7, 'Umum', ''),
(16, 8, 'Evaluasi\r\nKinerja Korporat', ''),
(17, 6, 'Akuntansi', ''),
(18, 6, 'Perencanaan\r\nKeuangan', ''),
(21, 0, 'Wisata\r\nArea Jakarta\r\n', ''),
(22, 0, 'Wisata\r\nArea Bali', ''),
(23, 0, 'Wisata\r\nArea Bali', ''),
(24, 0, 'Wisata\r\nArea Jakarta\r\n', ''),
(25, 0, 'Wisata\r\nArea Ciputat\r\n', ''),
(26, 0, 'Wisata\r\nArea Tangerang', ''),
(27, 0, 'Wisata\r\nArea Depok', ''),
(28, 0, 'Wisata\r\nArea Cawang', ''),
(29, 0, 'Wisata\r\nArea Pulogadung', ''),
(30, 0, 'Wisata\r\nArea Cakung', ''),
(31, 0, 'Wisata\r\nArea Klender', ''),
(32, 0, 'Wisata\r\nArea Jelambar', ''),
(33, 0, 'Wisata\r\nArea Transjabodetabek', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_disposisi`
--

CREATE TABLE `t_disposisi` (
  `id` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `catatan_disposisi` varchar(250) NOT NULL,
  `status_disposisi` varchar(100) NOT NULL,
  `user_disposisi` int(11) NOT NULL,
  `user_asal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_disposisi`
--

INSERT INTO `t_disposisi` (`id`, `id_surat`, `id_jabatan`, `id_divisi`, `id_departemen`, `catatan_disposisi`, `status_disposisi`, `user_disposisi`, `user_asal`) VALUES
(3, 35, 5, 5, 10, '', '', 12, 0),
(4, 35, 2, 0, 0, '', '', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_divisi`
--

CREATE TABLE `t_divisi` (
  `id` int(11) NOT NULL,
  `divisi_name` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_divisi`
--

INSERT INTO `t_divisi` (`id`, `divisi_name`, `description`) VALUES
(1, 'Divisi Sekretaris Perusahaan', ''),
(2, 'Divisi Satuan Pengawasan Intern', ''),
(3, 'Divisi Operasi', ''),
(4, 'Divisi Teknik', ''),
(5, 'Divisi Komersial', ''),
(6, 'Divisi Keuangan', ''),
(7, 'Divisi SDM dan Umum', ''),
(8, 'Divisi Perencanaan Strategis dan Management Resiko', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_dokumen_upload`
--

CREATE TABLE `t_dokumen_upload` (
  `id` int(11) NOT NULL,
  `id_surat_dokumen` int(11) NOT NULL,
  `dokumen_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_dokumen_upload`
--

INSERT INTO `t_dokumen_upload` (`id`, `id_surat_dokumen`, `dokumen_name`) VALUES
(52, 34, 'Icon Penguji.png'),
(53, 34, 'Logo 2.png'),
(54, 35, 'Icon Home.png'),
(55, 35, 'Backgroun Admin.png'),
(56, 35, 'Icon admin.png'),
(57, 36, '65242443_10217539109046956_3797768021955575808_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `t_jabatan`
--

CREATE TABLE `t_jabatan` (
  `id` int(11) NOT NULL,
  `jabatan_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jabatan`
--

INSERT INTO `t_jabatan` (`id`, `jabatan_name`, `description`) VALUES
(1, 'Direktur Utama', ''),
(2, 'Direktur Operasional dan Pemasaran', ''),
(3, 'Direktur Keuangan dan Manajemen Resiko', ''),
(4, 'General Manager', ''),
(5, 'Manager', 'Dalam divisi'),
(6, 'Supervisor/Assistant Manager', 'Dibawah GM'),
(7, 'Staf', ''),
(8, 'Sekretaris Direktur', ''),
(9, 'Sekretaris Direktur Utama', ''),
(10, 'Resepsionis', ''),
(12, 'Supervisor/Assistant Manager', 'Dibawah Manager'),
(13, 'Staf Sekretariat', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`id_role`, `role_name`, `description`) VALUES
(1, 'Super Admin', 'Developers and high-Administrator'),
(2, 'Direktur Utama', ''),
(3, 'Direktur Keuangan\r\n', ''),
(4, 'Direktur Operasional', ''),
(5, 'General Manager', 'Kepala Divisi'),
(6, 'Manager', 'Kepala Departemen'),
(7, 'Staf', 'Staf Divisi/Departemen'),
(8, 'Resepsionis', 'Resepsionis Perusahaan');

-- --------------------------------------------------------

--
-- Table structure for table `t_surat_eksternal`
--

CREATE TABLE `t_surat_eksternal` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `dari` varchar(100) NOT NULL,
  `kepada` varchar(100) NOT NULL,
  `perihal` varchar(300) NOT NULL,
  `confidentiality` varchar(100) NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `status_by` varchar(50) NOT NULL,
  `catatan_disposisi` longtext NOT NULL,
  `cek` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `dikoreksi` varchar(100) NOT NULL,
  `created_user` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_surat_eksternal`
--

INSERT INTO `t_surat_eksternal` (`id`, `no_surat`, `tanggal_surat`, `no_agenda`, `dari`, `kepada`, `perihal`, `confidentiality`, `sifat`, `status`, `status_by`, `catatan_disposisi`, `cek`, `file`, `dikoreksi`, `created_user`, `created_date`) VALUES
(34, 'xx/BI/2021', '0000-00-00', '', 'Bank Indonesia', '1', 'Undangan Meeting Elektronisasi', 'Non Confidential', 'Segera', 'SELESAI', 'direkturutama', '', '', '', '', '8', '2021-10-19 04:29:34'),
(35, 'xx/BI/2021', '2021-10-19', '', 'Dana', '1', 'Undangan Meeting Elektronisasi', 'Confidential', 'Penting', 'TERDISPOSISI', 'direkturutama', '<p>tolong di fu yaaa</p>\r\n', 'Diperhatikan', 'Untuk Ditangani', 'Dilaporkan', '8', '2021-10-19 04:30:34'),
(36, '125819101', '0000-00-00', '', 'Bank DKI', '1', 'Pembahasan Skema Investasi', 'Confidential', 'Penting', 'TERKIRIM', 'sekretariat', '', '', '', '', '16', '2021-10-24 23:05:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_credential`
--
ALTER TABLE `t_credential`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_jabatan_2` (`id_jabatan`),
  ADD KEY `id_role_2` (`id_role`,`id_departemen`,`id_jabatan`);

--
-- Indexes for table `t_departemen`
--
ALTER TABLE `t_departemen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `t_disposisi`
--
ALTER TABLE `t_disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_divisi`
--
ALTER TABLE `t_divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_dokumen_upload`
--
ALTER TABLE `t_dokumen_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `t_surat_eksternal`
--
ALTER TABLE `t_surat_eksternal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_credential`
--
ALTER TABLE `t_credential`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_departemen`
--
ALTER TABLE `t_departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `t_disposisi`
--
ALTER TABLE `t_disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_divisi`
--
ALTER TABLE `t_divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_dokumen_upload`
--
ALTER TABLE `t_dokumen_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_surat_eksternal`
--
ALTER TABLE `t_surat_eksternal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
