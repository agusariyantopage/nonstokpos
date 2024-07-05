-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 09:05 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbeclipse`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(10) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `akun` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL DEFAULT '-',
  `saldo` decimal(17,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `kode`, `akun`, `tipe`, `keterangan`, `saldo`) VALUES
(1, '1.0.0', 'Aktiva', 'Asset', '-', '0.00'),
(2, '1.1.0', 'Aktiva Lancar', 'Asset', '-', '0.00'),
(3, '1.1.1', 'Kas Toko', 'Asset', '-', '0.00'),
(4, '1.1.2', 'Kas Besar', 'Asset', '-', '0.00'),
(5, '1.1.3', 'Bank BCA', 'Asset', 'Pembayaran Non Tunai', '0.00'),
(6, '1.1.4', 'Bank Mandiri', 'Asset', 'Pembayaran Non Tunai', '0.00'),
(7, '1.1.1', 'Asuransi Dibayar Dimuka', 'Asset', '-', '0.00'),
(8, '1.1.1', 'Peralatan', 'Asset', '-', '0.00'),
(9, '1.2.0', 'Persediaan', 'Asset', '-', '0.00'),
(10, '1.2.1', 'Persediaan Bahan Baku', 'Asset', '-', '0.00'),
(11, '1.2.2', 'Persediaan Barang Jadi', 'Asset', '-', '0.00'),
(12, '1.3.0', 'Aktiva Tetap', 'Asset', '-', '0.00'),
(13, '1.3.1', 'Peralatan', 'Asset', '-', '0.00'),
(14, '1.3.2', 'Akumulasi Penyusutan Peralatan', 'Asset', '-', '0.00'),
(15, '1.3.3', 'Kendaraan', 'Asset', '-', '0.00'),
(16, '1.3.4', 'Akumulasi Penyusutan Kendaraan', 'Asset', '-', '0.00'),
(17, '1.3.5', 'Gedung', 'Asset', '-', '0.00'),
(18, '1.3.6', 'Akumulasi Penyusutan Gedung', 'Asset', '-', '0.00'),
(19, '1.3.7', 'Tanah', 'Asset', '-', '0.00'),
(20, '1.4.0', 'Aktiva Lain - Lain', 'Asset', '-', '0.00'),
(21, '1.4.1', 'Beban Yang Ditangguhkan', 'Asset', '-', '0.00'),
(22, '1.4.2', 'Beban Emisi Saham', 'Asset', '-', '0.00'),
(23, '2.0.0', 'Kewajiban', 'Hutang', '-', '0.00'),
(24, '2.1.0', 'Kewajiban Jangka Pendek', 'Hutang', '-', '0.00'),
(25, '2.1.1', 'Utang Usaha', 'Hutang', '-', '0.00'),
(26, '2.1.2', 'Utang Wesel', 'Hutang', '-', '0.00'),
(27, '2.1.3', 'Utang Gaji', 'Hutang', '-', '0.00'),
(28, '2.1.4', 'Utang Sewa Gedung', 'Hutang', '-', '0.00'),
(29, '2.1.5', 'Beban Yang Masih Harus Dibayar', 'Hutang', '-', '0.00'),
(30, '2.1.6', 'Utang Pajak', 'Hutang', '-', '0.00'),
(31, '2.2.0', 'Kewajiban Jangka Panjang', 'Hutang', '-', '0.00'),
(32, '2.2.1', 'Utang Hipotek', 'Hutang', '-', '0.00'),
(33, '2.2.3', 'Utang Obligasi', 'Hutang', '-', '0.00'),
(34, '3.0.0', 'Modal', 'Modal', '-', '0.00'),
(35, '3.1.0', 'Modal Pemilik', 'Modal', '-', '0.00'),
(36, '3.2.0', 'Prive', 'Modal', '-', '0.00'),
(37, '3.3.0', 'Laba Ditahan', 'Modal', '-', '0.00'),
(38, '4.0.0', 'Pendapatan', 'Pendapatan', '-', '0.00'),
(39, '4.1.0', 'Pendapatan Usaha', 'Pendapatan', '-', '0.00'),
(40, '4.1.1', 'Pendapatan Penjualan', 'Pendapatan', '-', '0.00'),
(41, '4.1.2', 'Pendapatan Lain Lain', 'Pendapatan', '-', '0.00'),
(42, '4.2.0', 'Pendapatan Diluar Usaha', 'Pendapatan', '-', '0.00'),
(43, '4.2.1', 'Jasa Giro', 'Pendapatan', '-', '0.00'),
(44, '5.0.0', 'Biaya', 'Biaya', '-', '0.00'),
(45, '5.1.0', 'Biaya Variabel (Tidak Tetap)', 'Biaya', '-', '0.00'),
(46, '5.1.1', 'Biaya Bahan Baku', 'Biaya', '-', '0.00'),
(47, '5.1.2', 'Beban Tenaga Kerja Langsung', 'Biaya', '-', '0.00'),
(48, '5.1.3', 'Biaya Overhead', 'Biaya', '-', '0.00'),
(49, '5.2.0', 'Biaya Tetap', 'Biaya', '-', '0.00'),
(50, '5.2.1', 'Biaya Gaji Karyawan', 'Biaya', '-', '0.00'),
(51, '5.2.2', 'Biaya Lembur & Bonus', 'Biaya', '-', '0.00'),
(52, '5.2.3', 'Biaya Komisi & Insentif', 'Biaya', '-', '0.00'),
(53, '5.2.4', 'Biaya THR', 'Biaya', '-', '0.00'),
(54, '5.2.5', 'Biaya Makan / Minum Ditempat Kerja', 'Biaya', '-', '0.00'),
(55, '5.2.6', 'Biaya BPJS Kesehatan', 'Biaya', '-', '0.00'),
(56, '5.2.7', 'Biaya Kesejahteraan Lainnya', 'Biaya', '-', '0.00'),
(57, '5.2.8', 'Biaya Recruitment', 'Biaya', '-', '0.00'),
(58, '5.2.9', 'Biaya Konsumsi Rapat dan Pelatihan', 'Biaya', '-', '0.00'),
(59, '5.2.10', 'Biaya Perjalanan Dinas DL', 'Biaya', '-', '0.00'),
(60, '5.2.11', 'Biaya Perjalanan Dinas LN', 'Biaya', '-', '0.00'),
(61, '5.2.12', 'Biaya Entertainment', 'Biaya', '-', '0.00'),
(62, '5.2.13', 'Biaya Kendaraan', 'Biaya', '-', '0.00'),
(63, '5.2.14', 'Biaya BBM, Toll & Parkir', 'Biaya', '-', '0.00'),
(64, '5.2.15', 'Biaya STNK, KIR dan Kendaraan Lainnya', 'Biaya', '-', '0.00'),
(65, '5.2.16', 'Biaya Promosi', 'Biaya', '-', '0.00'),
(66, '5.2.17', 'Biaya Stationary (ATK)', 'Biaya', '-', '0.00'),
(67, '5.2.18', 'Biaya Supplies Komputer', 'Biaya', '-', '0.00'),
(68, '5.2.19', 'Biaya Sewa Gedung', 'Biaya', '-', '0.00'),
(69, '5.2.20', 'Biaya Perbaikan Gedung', 'Biaya', '-', '0.00'),
(70, '5.2.21', 'Biaya Peralatan Kantor', 'Biaya', '-', '0.00'),
(71, '5.2.22', 'Biaya Air', 'Biaya', '-', '0.00'),
(72, '5.2.23', 'Biaya Listrik', 'Biaya', '-', '0.00'),
(73, '5.2.24', 'Biaya Telepon & Internet', 'Biaya', '-', '0.00'),
(74, '5.2.25', 'Biaya Kirim Barang', 'Biaya', '-', '0.00'),
(75, '5.2.26', 'Biaya Sumbangan', 'Biaya', '-', '0.00'),
(76, '5.2.27', 'Biaya BPJS JHT dan JPN', 'Biaya', '-', '0.00'),
(77, '5.2.28', 'Biaya Penyusutan Peralatan', 'Biaya', '-', '0.00'),
(78, '5.2.29', 'Biaya Penyusutan Kendaraan', 'Biaya', '-', '0.00'),
(79, '5.2.30', 'Biaya Penyusutan Gedung', 'Biaya', '-', '0.00'),
(81, '5.2.31', 'Biaya Persembahyangan', 'biaya', '', '0.00'),
(82, '5.2.32', 'Biaya Gas ', 'biaya', '', '0.00'),
(83, '5.2.33', 'Biaya Lain Lain', 'biaya', '', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `akun_jurnal`
--

CREATE TABLE `akun_jurnal` (
  `id_akun_jurnal` int(10) NOT NULL,
  `nomor_jurnal` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL DEFAULT '-- KOSONG --',
  `tanggal_transaksi` date NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_jurnal`
--

INSERT INTO `akun_jurnal` (`id_akun_jurnal`, `nomor_jurnal`, `deskripsi`, `tanggal_transaksi`, `dibuat_pada`, `diubah_pada`) VALUES
(3, '', 'Transaksi Penjualan #3', '2023-05-30', '2023-05-30 03:27:05', '2023-05-30 03:27:05'),
(4, '', 'Transaksi Penjualan #4', '2023-05-30', '2023-05-30 03:28:17', '2023-05-30 03:28:17'),
(6, '', 'Transaksi Penjualan #6', '2023-05-30', '2023-05-30 03:33:14', '2023-05-30 03:33:14'),
(7, '', 'Transaksi Penjualan #7', '2023-05-30', '2023-05-30 03:33:43', '2023-05-30 03:33:43'),
(8, '', 'Transaksi Penjualan #8', '2023-05-30', '2023-05-30 03:34:09', '2023-05-30 03:34:09'),
(9, '', 'Transaksi Penjualan #9', '2023-05-30', '2023-05-30 04:01:28', '2023-05-30 04:01:28'),
(10, '', 'Transaksi Penjualan #10', '2023-05-30', '2023-05-30 04:03:35', '2023-05-30 04:03:35'),
(11, '', 'Transaksi Penjualan #11', '2023-05-30', '2023-05-30 04:04:04', '2023-05-30 04:04:04'),
(12, '', 'Transaksi Penjualan #12', '2023-05-31', '2023-05-31 03:38:33', '2023-05-31 03:38:33'),
(13, '', 'Transaksi Penjualan #13', '2023-05-31', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(14, '', 'Transaksi Penjualan #14', '2023-05-31', '2023-05-31 03:41:05', '2023-05-31 03:41:05'),
(15, '', 'Transaksi Penjualan #15', '2023-06-01', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(16, '', 'Transaksi Penjualan #16', '2023-06-01', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(17, '', 'Transaksi Penjualan #17', '2023-06-01', '2023-06-01 01:42:09', '2023-06-01 01:42:09'),
(18, '', 'Transaksi Penjualan #18', '2023-06-02', '2023-06-02 02:01:15', '2023-06-02 02:01:15'),
(19, '', 'Transaksi Penjualan #19', '2023-06-02', '2023-06-02 02:02:21', '2023-06-02 02:02:21'),
(20, '', 'Transaksi Penjualan #20', '2023-06-02', '2023-06-02 02:03:00', '2023-06-02 02:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `akun_jurnal_template`
--

CREATE TABLE `akun_jurnal_template` (
  `id_akun_jurnal_template` int(10) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `id_akun_debet` int(10) NOT NULL,
  `id_akun_kredit` int(10) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_jurnal_template`
--

INSERT INTO `akun_jurnal_template` (`id_akun_jurnal_template`, `deskripsi`, `id_akun_debet`, `id_akun_kredit`, `dibuat_pada`, `diubah_pada`) VALUES
(1, 'Bayar Gaji Karyawan Melalui Bank Mandiri', 50, 6, '2023-05-25 03:25:57', '2023-05-25 06:10:04'),
(2, 'Bayar Gaji Karyawan Melalui Kas Toko', 50, 3, '2023-05-25 06:12:16', '2023-06-01 05:54:30'),
(4, 'Bayar Gaji Karyawan Melalui Bank BCA', 50, 5, '2023-05-25 06:28:09', '2023-05-25 06:29:40'),
(5, 'Bayar Listrik Via Kas Toko', 72, 3, '2023-05-25 15:54:22', '2023-06-01 05:54:16'),
(6, 'Bayar Air Via Kas Toko', 71, 3, '2023-05-25 15:54:46', '2023-06-01 05:53:54'),
(7, 'Setor Kas Toko Ke Bank BCA', 5, 3, '2023-05-26 06:19:26', '2023-05-26 06:19:26'),
(8, 'Biaya Persembahyangan', 81, 3, '2023-05-27 07:31:14', '2023-06-01 05:53:31'),
(9, 'Belanja Alat Tulis Kantor', 66, 3, '2023-05-27 07:33:29', '2023-06-01 05:53:22'),
(10, 'Biaya Telepon Internet Via Kas', 73, 3, '2023-05-27 07:34:47', '2023-06-01 05:53:01'),
(11, 'Biaya Telepon Internet Via BCA', 73, 5, '2023-05-27 07:35:18', '2023-05-27 07:35:18'),
(12, 'Biaya Sampah Via Kas', 75, 3, '2023-05-27 07:36:46', '2023-06-01 05:52:51'),
(13, 'Biaya Sumbangan Lingkungan Via Kas', 75, 3, '2023-05-27 07:37:24', '2023-06-01 05:52:35'),
(14, 'Komisi Produk Konsinyasi Via Kas Toko', 52, 3, '2023-06-09 06:50:56', '2023-06-09 06:50:56'),
(15, 'Komisi Produk Konsinyasi Via BCA Pak Tamin', 52, 5, '2023-06-09 06:51:32', '2023-06-09 06:51:32'),
(16, 'Beli Gas Via Kas Toko', 82, 3, '2023-06-09 06:55:58', '2023-06-09 06:55:58'),
(17, 'Beli Gas Via BCA Pak Tamin', 82, 5, '2023-06-09 07:00:53', '2023-06-09 07:00:53'),
(18, 'Biaya Lain Lain Via Kas Toko', 83, 3, '2023-06-09 07:05:06', '2023-06-09 07:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `akun_mutasi`
--

CREATE TABLE `akun_mutasi` (
  `id_akun_mutasi` int(10) NOT NULL,
  `id_akun_jurnal` int(10) NOT NULL,
  `id_akun` int(10) NOT NULL,
  `debet` decimal(17,2) NOT NULL,
  `kredit` decimal(17,2) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_mutasi`
--

INSERT INTO `akun_mutasi` (`id_akun_mutasi`, `id_akun_jurnal`, `id_akun`, `debet`, `kredit`, `dibuat_pada`, `diubah_pada`) VALUES
(5, 3, 5, '300000.00', '0.00', '2023-05-30 03:27:05', '2023-05-30 03:27:05'),
(6, 3, 40, '0.00', '300000.00', '2023-05-30 03:27:05', '2023-05-30 03:27:05'),
(7, 4, 5, '175000.00', '0.00', '2023-05-30 03:28:17', '2023-05-30 03:28:17'),
(8, 4, 40, '0.00', '175000.00', '2023-05-30 03:28:17', '2023-05-30 03:28:17'),
(11, 6, 3, '200000.00', '0.00', '2023-05-30 03:33:14', '2023-05-30 03:33:14'),
(12, 6, 40, '0.00', '200000.00', '2023-05-30 03:33:14', '2023-05-30 03:33:14'),
(13, 7, 3, '450000.00', '0.00', '2023-05-30 03:33:43', '2023-05-30 03:33:43'),
(14, 7, 40, '0.00', '450000.00', '2023-05-30 03:33:43', '2023-05-30 03:33:43'),
(15, 8, 3, '85000.00', '0.00', '2023-05-30 03:34:10', '2023-05-30 03:34:10'),
(16, 8, 40, '0.00', '85000.00', '2023-05-30 03:34:10', '2023-05-30 03:34:10'),
(17, 9, 5, '330000.00', '0.00', '2023-05-30 04:01:28', '2023-05-30 04:01:28'),
(18, 9, 40, '0.00', '330000.00', '2023-05-30 04:01:28', '2023-05-30 04:01:28'),
(19, 10, 5, '485000.00', '0.00', '2023-05-30 04:03:35', '2023-05-30 04:03:35'),
(20, 10, 40, '0.00', '485000.00', '2023-05-30 04:03:35', '2023-05-30 04:03:35'),
(21, 11, 5, '400000.00', '0.00', '2023-05-30 04:04:04', '2023-05-30 04:04:04'),
(22, 11, 40, '0.00', '400000.00', '2023-05-30 04:04:04', '2023-05-30 04:04:04'),
(23, 12, 3, '100000.00', '0.00', '2023-05-31 03:38:33', '2023-05-31 03:38:33'),
(24, 12, 40, '0.00', '100000.00', '2023-05-31 03:38:33', '2023-05-31 03:38:33'),
(25, 13, 3, '520000.00', '0.00', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(26, 13, 40, '0.00', '520000.00', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(27, 14, 3, '610000.00', '0.00', '2023-05-31 03:41:05', '2023-05-31 03:41:05'),
(28, 14, 40, '0.00', '610000.00', '2023-05-31 03:41:05', '2023-05-31 03:41:05'),
(29, 15, 5, '4425000.00', '0.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(30, 15, 40, '0.00', '4425000.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(31, 16, 5, '705000.00', '0.00', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(32, 16, 40, '0.00', '705000.00', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(33, 17, 3, '130000.00', '0.00', '2023-06-01 01:42:09', '2023-06-01 01:42:09'),
(34, 17, 40, '0.00', '130000.00', '2023-06-01 01:42:09', '2023-06-01 01:42:09'),
(35, 18, 5, '250000.00', '0.00', '2023-06-02 02:01:15', '2023-06-02 02:01:15'),
(36, 18, 40, '0.00', '250000.00', '2023-06-02 02:01:15', '2023-06-02 02:01:15'),
(37, 19, 5, '1050000.00', '0.00', '2023-06-02 02:02:21', '2023-06-02 02:02:21'),
(38, 19, 40, '0.00', '1050000.00', '2023-06-02 02:02:21', '2023-06-02 02:02:21'),
(39, 20, 5, '450000.00', '0.00', '2023-06-02 02:03:00', '2023-06-02 02:03:00'),
(40, 20, 40, '0.00', '450000.00', '2023-06-02 02:03:00', '2023-06-02 02:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(10) NOT NULL,
  `no_identitas` varchar(50) NOT NULL,
  `tanggal_bergabung` date NOT NULL DEFAULT current_timestamp(),
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `no_identitas`, `tanggal_bergabung`, `nama`, `alamat`, `telepon`, `email`, `dibuat_pada`, `diubah_pada`) VALUES
(1, '-', '2023-05-01', 'Publik', '-', '', '', '2023-05-23 08:58:59', '2023-05-23 09:00:00'),
(2, '-', '2023-05-24', 'Billy Garden', 'Gianyar', '087860265451', 'agus.arianto21@gmail.com', '2023-05-24 16:24:05', '2022-12-07 02:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `id_beli` int(10) NOT NULL,
  `jenis_transaksi` varchar(100) NOT NULL DEFAULT 'beli',
  `id_pemasok` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_akun` int(10) NOT NULL DEFAULT 10,
  `id_akun_jurnal` int(10) DEFAULT NULL,
  `metode_bayar` varchar(150) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` decimal(17,2) NOT NULL,
  `diskon` decimal(17,2) NOT NULL DEFAULT 0.00,
  `pajak` decimal(17,2) NOT NULL DEFAULT 0.00,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `beli_detail`
--

CREATE TABLE `beli_detail` (
  `id_beli_detail` int(10) NOT NULL,
  `id_beli` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `hpp` decimal(17,2) NOT NULL,
  `harga_beli` decimal(17,2) NOT NULL,
  `jumlah` decimal(17,2) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `id_jual` int(10) NOT NULL,
  `id_anggota` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_akun` int(10) NOT NULL,
  `id_akun_jurnal` int(10) DEFAULT NULL,
  `keterangan_non_tunai` varchar(200) NOT NULL DEFAULT '-',
  `tanggal_transaksi` date NOT NULL,
  `total` decimal(17,2) NOT NULL,
  `diskon` decimal(17,2) NOT NULL DEFAULT 0.00,
  `pajak` decimal(17,2) NOT NULL DEFAULT 0.00,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`id_jual`, `id_anggota`, `id_user`, `id_akun`, `id_akun_jurnal`, `keterangan_non_tunai`, `tanggal_transaksi`, `total`, `diskon`, `pajak`, `dibuat_pada`, `diubah_pada`) VALUES
(3, 1, 1, 5, 3, 'Card Visa/Clausen', '2023-05-30', '300000.00', '0.00', '0.00', '2023-05-30 03:27:05', '2023-05-30 03:27:05'),
(4, 1, 1, 5, 4, 'Qris BCA', '2023-05-30', '175000.00', '0.00', '0.00', '2023-05-30 03:28:17', '2023-05-30 03:28:17'),
(6, 1, 1, 3, 6, '-', '2023-05-30', '200000.00', '0.00', '0.00', '2023-05-30 03:33:14', '2023-05-30 03:33:14'),
(7, 1, 1, 3, 7, '-', '2023-05-30', '450000.00', '0.00', '0.00', '2023-05-30 03:33:43', '2023-05-30 03:33:43'),
(8, 1, 1, 3, 8, '-', '2023-05-30', '85000.00', '0.00', '0.00', '2023-05-30 03:34:09', '2023-05-30 03:34:09'),
(9, 1, 1, 5, 9, 'card/ Revathi Ananda', '2023-05-30', '330000.00', '0.00', '0.00', '2023-05-30 04:01:28', '2023-05-30 04:01:28'),
(10, 1, 1, 5, 10, 'Card/Bank Mega(Anton)', '2023-05-30', '485000.00', '0.00', '0.00', '2023-05-30 04:03:35', '2023-05-30 04:03:35'),
(11, 1, 1, 5, 11, 'Card BCA', '2023-05-30', '400000.00', '0.00', '0.00', '2023-05-30 04:04:04', '2023-05-30 04:04:04'),
(12, 1, 1, 3, 12, '-', '2023-05-31', '100000.00', '0.00', '0.00', '2023-05-31 03:38:33', '2023-05-31 03:38:33'),
(13, 1, 1, 3, 13, '-', '2023-05-31', '520000.00', '0.00', '0.00', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(14, 1, 1, 3, 14, '-', '2023-05-31', '610000.00', '0.00', '0.00', '2023-05-31 03:41:05', '2023-05-31 03:41:05'),
(15, 1, 1, 5, 15, 'Visa(ORJASETER/ASE)', '2023-06-01', '4425000.00', '0.00', '0.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(16, 1, 1, 5, 16, 'Visa(GRANEROD/NINA)', '2023-06-01', '705000.00', '0.00', '0.00', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(17, 1, 1, 3, 17, '-', '2023-06-01', '130000.00', '0.00', '0.00', '2023-06-01 01:42:09', '2023-06-01 01:42:09'),
(18, 1, 1, 5, 18, 'Qris', '2023-06-02', '250000.00', '0.00', '0.00', '2023-06-02 02:01:15', '2023-06-02 02:01:15'),
(19, 1, 1, 5, 19, 'Transfer', '2023-06-02', '1050000.00', '0.00', '0.00', '2023-06-02 02:02:21', '2023-06-02 02:02:21'),
(20, 1, 1, 5, 20, 'Transfer', '2023-06-02', '450000.00', '0.00', '0.00', '2023-06-02 02:03:00', '2023-06-02 02:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `jual_detail`
--

CREATE TABLE `jual_detail` (
  `id_jual_detail` int(10) NOT NULL,
  `id_jual` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `hpp` decimal(17,2) NOT NULL,
  `harga_jual` decimal(17,2) NOT NULL,
  `jumlah` decimal(17,2) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jual_detail`
--

INSERT INTO `jual_detail` (`id_jual_detail`, `id_jual`, `id_produk`, `hpp`, `harga_jual`, `jumlah`, `dibuat_pada`, `diubah_pada`) VALUES
(4, 3, 2, '0.00', '125000.00', '1.00', '2023-05-30 03:27:05', '2023-05-30 03:27:05'),
(5, 3, 65, '0.00', '175000.00', '1.00', '2023-05-30 03:27:05', '2023-05-30 03:27:05'),
(6, 4, 11, '0.00', '175000.00', '1.00', '2023-05-30 03:28:17', '2023-05-30 03:28:17'),
(8, 6, 1, '0.00', '100000.00', '2.00', '2023-05-30 03:33:14', '2023-05-30 03:33:14'),
(9, 7, 29, '0.00', '90000.00', '5.00', '2023-05-30 03:33:43', '2023-05-30 03:33:43'),
(10, 8, 69, '0.00', '85000.00', '1.00', '2023-05-30 03:34:09', '2023-05-30 03:34:09'),
(11, 9, 60, '0.00', '140000.00', '2.00', '2023-05-30 04:01:28', '2023-05-30 04:01:28'),
(12, 9, 70, '0.00', '50000.00', '1.00', '2023-05-30 04:01:28', '2023-05-30 04:01:28'),
(13, 10, 29, '0.00', '90000.00', '5.00', '2023-05-30 04:03:35', '2023-05-30 04:03:35'),
(14, 10, 51, '0.00', '7000.00', '5.00', '2023-05-30 04:03:35', '2023-05-30 04:03:35'),
(15, 11, 1, '0.00', '100000.00', '4.00', '2023-05-30 04:04:04', '2023-05-30 04:04:04'),
(16, 12, 71, '0.00', '100000.00', '1.00', '2023-05-31 03:38:33', '2023-05-31 03:38:33'),
(17, 13, 21, '0.00', '50000.00', '1.00', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(18, 13, 1, '0.00', '100000.00', '1.00', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(19, 13, 23, '0.00', '120000.00', '1.00', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(20, 13, 72, '0.00', '250000.00', '1.00', '2023-05-31 03:40:10', '2023-05-31 03:40:10'),
(21, 14, 73, '0.00', '100000.00', '2.00', '2023-05-31 03:41:05', '2023-05-31 03:41:05'),
(22, 14, 57, '0.00', '130000.00', '2.00', '2023-05-31 03:41:05', '2023-05-31 03:41:05'),
(23, 14, 22, '0.00', '75000.00', '2.00', '2023-05-31 03:41:05', '2023-05-31 03:41:05'),
(24, 15, 59, '0.00', '200000.00', '3.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(25, 15, 75, '0.00', '250000.00', '4.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(26, 15, 76, '0.00', '200000.00', '4.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(27, 15, 80, '0.00', '225000.00', '2.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(28, 15, 1, '0.00', '100000.00', '5.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(29, 15, 77, '0.00', '125000.00', '3.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(30, 15, 78, '0.00', '150000.00', '1.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(31, 15, 22, '0.00', '75000.00', '1.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(32, 15, 62, '0.00', '200000.00', '1.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(33, 15, 11, '0.00', '175000.00', '1.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(34, 15, 70, '0.00', '50000.00', '2.00', '2023-06-01 01:38:37', '2023-06-01 01:38:37'),
(35, 16, 60, '0.00', '140000.00', '2.00', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(36, 16, 64, '0.00', '150000.00', '1.00', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(37, 16, 1, '0.00', '100000.00', '2.00', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(38, 16, 79, '0.00', '75000.00', '1.00', '2023-06-01 01:40:38', '2023-06-01 01:40:38'),
(39, 17, 24, '0.00', '130000.00', '1.00', '2023-06-01 01:42:09', '2023-06-01 01:42:09'),
(40, 18, 81, '0.00', '250000.00', '1.00', '2023-06-02 02:01:15', '2023-06-02 02:01:15'),
(41, 19, 66, '0.00', '140000.00', '3.00', '2023-06-02 02:02:21', '2023-06-02 02:02:21'),
(42, 19, 24, '0.00', '130000.00', '1.00', '2023-06-02 02:02:21', '2023-06-02 02:02:21'),
(43, 19, 3, '0.00', '250000.00', '2.00', '2023-06-02 02:02:21', '2023-06-02 02:02:21'),
(44, 20, 81, '0.00', '250000.00', '1.00', '2023-06-02 02:03:00', '2023-06-02 02:03:00'),
(45, 20, 82, '0.00', '200000.00', '1.00', '2023-06-02 02:03:00', '2023-06-02 02:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `hpp` decimal(17,2) NOT NULL,
  `harga` decimal(17,2) NOT NULL,
  `jumlah` decimal(17,2) NOT NULL,
  `dibuat_pada` datetime DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_beli`
--

CREATE TABLE `keranjang_beli` (
  `id_keranjang_beli` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `hpp` decimal(17,2) NOT NULL,
  `harga` decimal(17,2) NOT NULL,
  `jumlah` decimal(17,0) NOT NULL,
  `dibuat_pada` datetime DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int(10) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama`, `alamat`, `telepon`, `email`, `dibuat_pada`, `diubah_pada`) VALUES
(1, 'Eclipse Pottery', '-', '', '', '2023-05-23 09:00:25', '2023-05-23 09:00:25'),
(2, 'Pak Agung Riyadhi', '-', '', '', '2022-12-07 03:09:22', '2022-12-07 03:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(20) NOT NULL,
  `barcode` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `id_produk_kategori` int(10) DEFAULT NULL,
  `nama` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `satuan` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT 'PCS',
  `keterangan` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `hpp` decimal(17,2) DEFAULT 0.00,
  `hpp_awal` decimal(17,2) DEFAULT 0.00,
  `qty` decimal(10,0) DEFAULT 0,
  `qty_awal` decimal(10,0) DEFAULT 0,
  `harga_jual` decimal(17,2) NOT NULL,
  `stok_min` decimal(10,2) DEFAULT 0.00,
  `servis` int(1) NOT NULL,
  `konsinyasi` int(1) NOT NULL DEFAULT 0,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `barcode`, `id_produk_kategori`, `nama`, `satuan`, `keterangan`, `gambar`, `hpp`, `hpp_awal`, `qty`, `qty_awal`, `harga_jual`, `stok_min`, `servis`, `konsinyasi`, `dibuat_pada`, `diubah_pada`) VALUES
(1, '-', 1, 'MUG/GELAS & CUP', 'PCS', '-', '', '0.00', '0.00', '-14', '0', '100000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-27 02:58:26'),
(2, '-', 1, 'Bowl 13 cm', 'PCS', '-', '', '0.00', '0.00', '-1', '0', '125000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-27 03:09:24'),
(3, '-', 1, 'Dinner Plate 29 cm', 'PCS', '-', '', '0.00', '0.00', '-2', '0', '250000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-30 01:40:51'),
(4, '', 1, 'PITCHERS', 'PCS', '-', '', '0.00', '0.00', '0', '0', '150000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-24 15:16:24'),
(5, '-', 1, 'VAS', 'PCS', '-', '', '0.00', '0.00', '0', '0', '450000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-27 03:12:07'),
(6, '-', 1, 'Tatara', 'PCS', '-', '', '0.00', '0.00', '0', '0', '175000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-30 01:52:02'),
(7, '-', 1, 'PAINT GUCCI/GUCCI LUKIS', 'PCS', '-', '', '0.00', '0.00', '0', '0', '1500000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2016-08-22 19:22:00'),
(8, '-', 1, 'Small Pot', 'PCS', '-', '', '0.00', '0.00', '0', '0', '50000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-27 03:10:24'),
(9, '-', 1, 'SAUCER/LEPEKAN', 'PCS', '-', '', '0.00', '0.00', '0', '0', '50000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2016-08-22 19:22:00'),
(10, '-', 1, 'DECORATION FROG/DEKORASI KODOK', 'PCS', '-', '', '0.00', '0.00', '0', '0', '150000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-24 15:15:28'),
(11, '-', 1, 'FILTER COFFEE', 'PCS', '-', '', '0.00', '0.00', '-2', '0', '175000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2004-04-22 10:57:00'),
(12, '-', 1, 'GLASS/KACA', 'PCS', '-', '', '0.00', '0.00', '0', '0', '115000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2016-08-22 16:59:00'),
(13, '-', 1, 'Paint Bowl', 'PCS', '-', '', '0.00', '0.00', '0', '0', '1000000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2023-05-30 01:54:48'),
(14, '-', 1, 'BIG GUCCI', 'PCS', '-', '', '0.00', '0.00', '0', '0', '1500000.00', '1.00', 0, 0, '2019-01-22 11:51:00', '2022-12-07 03:07:12'),
(31, '-', 2, 'Cooper Carbonat', 'PCS', '', '', '0.00', '0.00', '0', '0', '400000.00', '0.00', 0, 0, '2023-05-30 01:27:02', '2023-05-30 01:27:02'),
(21, '-', 1, 'Single Sauces', 'PCS', '', '', '0.00', '0.00', '-1', '0', '50000.00', '0.00', 0, 0, '2023-05-27 03:04:45', '2023-05-27 03:04:45'),
(17, '-', 2, 'Tanah Origine', 'PCS', '', '', '0.00', '0.00', '0', '0', '10000.00', '1.00', 0, 0, '2022-12-07 03:33:30', '2022-12-07 03:33:30'),
(18, '-', 2, 'Tanah Trim', 'PCS', '', '', '0.00', '0.00', '0', '0', '10000.00', '1.00', 0, 0, '2023-05-27 02:59:54', '2023-05-27 02:59:54'),
(19, '-', 2, 'Tanah Teracota/Merah', 'PCS', '', '', '0.00', '0.00', '0', '0', '10000.00', '0.00', 0, 0, '2023-05-27 03:01:20', '2023-05-27 03:01:20'),
(20, '-', 2, 'Tanah Patung', 'PCS', '', '', '0.00', '0.00', '0', '0', '12500.00', '0.00', 0, 0, '2023-05-27 03:02:11', '2023-05-27 03:02:11'),
(22, '-', 1, 'Double Sauce', 'PCS', '', '', '0.00', '0.00', '-3', '0', '75000.00', '0.00', 0, 0, '2023-05-27 03:05:30', '2023-05-27 03:05:30'),
(23, '-', 1, 'Big Mug Non Handel', 'PCS', '', '', '0.00', '0.00', '-1', '0', '120000.00', '0.00', 0, 0, '2023-05-27 03:07:15', '2023-05-27 03:07:15'),
(24, '-', 1, 'Big Mug Handel', 'PCS', '', '', '0.00', '0.00', '-2', '0', '130000.00', '0.00', 0, 0, '2023-05-27 03:07:39', '2023-05-27 03:07:39'),
(25, '-', 1, 'Meddium Pot', 'PCS', '', '', '0.00', '0.00', '0', '0', '75000.00', '0.00', 0, 0, '2023-05-27 03:10:51', '2023-05-27 03:10:51'),
(26, '-', 1, 'Big Pot', 'PCS', '', '', '0.00', '0.00', '0', '0', '100000.00', '0.00', 0, 0, '2023-05-27 03:11:14', '2023-05-27 03:11:14'),
(27, '-', 2, 'Pigment Merah/Red', 'PCS', '', '', '0.00', '0.00', '0', '0', '1000000.00', '0.00', 0, 0, '2023-05-27 03:13:01', '2023-05-27 03:13:01'),
(28, '-', 2, 'Pigment Hitam/Black Stain', 'PCS', '', '', '0.00', '0.00', '0', '0', '500000.00', '0.00', 0, 0, '2023-05-27 03:13:47', '2023-05-27 03:13:47'),
(29, '-', 2, 'Fritt 3134', 'PCS', '', '', '0.00', '0.00', '-10', '0', '90000.00', '0.00', 0, 0, '2023-05-27 03:14:29', '2023-05-30 01:26:04'),
(30, '-', 2, 'Potas', 'PCS', '', '', '0.00', '0.00', '0', '0', '7500.00', '0.00', 0, 0, '2023-05-27 03:23:21', '2023-05-30 01:28:00'),
(32, '-', 2, 'Kaolin', 'PCS', '', '', '0.00', '0.00', '0', '0', '8000.00', '0.00', 0, 0, '2023-05-30 01:27:35', '2023-05-30 01:27:35'),
(33, '-', 2, 'Silica', 'PCS', '', '', '0.00', '0.00', '0', '0', '7500.00', '0.00', 0, 0, '2023-05-30 01:28:44', '2023-05-30 01:28:44'),
(34, '-', 2, 'White Enggobe', 'PCS', '', '', '0.00', '0.00', '0', '0', '150000.00', '0.00', 0, 0, '2023-05-30 01:29:37', '2023-05-30 01:29:37'),
(35, '-', 2, 'cobalt', 'PCS', '', '', '0.00', '0.00', '0', '0', '1500000.00', '0.00', 0, 0, '2023-05-30 01:30:03', '2023-05-30 01:30:03'),
(36, '-', 2, 'Alumina', 'PCS', '', '', '0.00', '0.00', '0', '0', '50000.00', '0.00', 0, 0, '2023-05-30 01:30:50', '2023-05-30 01:30:50'),
(37, '-', 2, 'Zircon/Zircosil', 'PCS', '', '', '0.00', '0.00', '0', '0', '100000.00', '0.00', 0, 0, '2023-05-30 01:31:19', '2023-05-30 01:31:19'),
(38, '-', 2, 'Nepheline', 'PCS', '', '', '0.00', '0.00', '0', '0', '20000.00', '0.00', 0, 0, '2023-05-30 01:31:40', '2023-05-30 01:31:40'),
(39, '-', 2, 'Lithium', 'PCS', '', '', '0.00', '0.00', '0', '0', '600000.00', '0.00', 0, 0, '2023-05-30 01:32:09', '2023-05-30 01:32:09'),
(40, '-', 2, 'Sodium Felspat', 'PCS', '', '', '0.00', '0.00', '0', '0', '10000.00', '0.00', 0, 0, '2023-05-30 01:32:48', '2023-05-30 01:32:48'),
(41, '-', 2, 'Iron', 'PCS', '', '', '0.00', '0.00', '0', '0', '75000.00', '0.00', 0, 0, '2023-05-30 01:33:16', '2023-05-30 01:33:16'),
(42, '-', 2, 'Tithanium', 'PCS', '', '', '0.00', '0.00', '0', '0', '175000.00', '0.00', 0, 0, '2023-05-30 01:33:38', '2023-05-30 01:33:38'),
(43, '-', 2, 'Cooper Oxide', 'PCS', '', '', '0.00', '0.00', '0', '0', '750000.00', '0.00', 0, 0, '2023-05-30 01:33:59', '2023-05-30 01:33:59'),
(44, '-', 2, 'Magnesium Chloride/Pengencer Glaze', 'PCS', '', '', '0.00', '0.00', '0', '0', '50000.00', '0.00', 0, 0, '2023-05-30 01:34:46', '2023-05-30 01:34:46'),
(45, '-', 2, 'Felspat Kuning', 'PCS', '', '', '0.00', '0.00', '0', '0', '10000.00', '0.00', 0, 0, '2023-05-30 01:35:13', '2023-05-30 01:35:13'),
(46, '-', 2, 'Magnesium Carbonat', 'PCS', '', '', '0.00', '0.00', '0', '0', '75000.00', '0.00', 0, 0, '2023-05-30 01:35:36', '2023-05-30 01:35:36'),
(47, '-', 2, 'Dolomite', 'PCS', '', '', '0.00', '0.00', '0', '0', '15000.00', '0.00', 0, 0, '2023-05-30 01:35:56', '2023-05-30 01:35:56'),
(48, '-', 2, 'Zinx Oxide', 'PCS', '', '', '0.00', '0.00', '0', '0', '120000.00', '0.00', 0, 0, '2023-05-30 01:36:19', '2023-05-30 01:36:19'),
(49, '-', 2, 'Turqs Blue', 'PCS', '', '', '0.00', '0.00', '0', '0', '500000.00', '0.00', 0, 0, '2023-05-30 01:36:41', '2023-05-30 01:36:41'),
(50, '-', 2, 'Barium', 'PCS', '', '', '0.00', '0.00', '0', '0', '30000.00', '0.00', 0, 0, '2023-05-30 01:37:07', '2023-05-30 01:37:07'),
(51, '-', 2, 'Calcium Carbonat', 'KILOGRAM', '', '', '0.00', '0.00', '-5', '0', '7000.00', '0.00', 0, 0, '2023-05-30 01:37:51', '2023-05-31 22:30:37'),
(52, '-', 1, 'Small Pot', 'PCS', '', '', '0.00', '0.00', '0', '0', '50000.00', '0.00', 0, 0, '2023-05-30 01:39:15', '2023-05-30 01:39:15'),
(53, '-', 1, 'Meddium Teapot', 'PCS', '', '', '0.00', '0.00', '0', '0', '250000.00', '0.00', 0, 0, '2023-05-30 01:42:14', '2023-05-30 01:42:14'),
(54, '-', 1, 'High Teapot', 'PCS', '', '', '0.00', '0.00', '0', '0', '300000.00', '0.00', 0, 0, '2023-05-30 01:42:51', '2023-05-30 01:42:51'),
(55, '-', 1, 'Big/Long Tatara', 'PCS', '', '', '0.00', '0.00', '0', '0', '200000.00', '0.00', 0, 0, '2023-05-30 01:52:34', '2023-05-30 01:52:34'),
(56, '-', 1, 'Meddium Saucer/Lepekan', 'PCS', '', '', '0.00', '0.00', '0', '0', '100000.00', '0.00', 0, 0, '2023-05-30 01:54:09', '2023-05-30 01:54:09'),
(57, '-', 1, 'Rice Bowl/Bowl 11cm', 'PCS', '', '', '0.00', '0.00', '-2', '0', '130000.00', '0.00', 0, 0, '2023-05-30 01:55:26', '2023-05-31 03:37:12'),
(58, '-', 1, 'Plate Bowl 28cm', 'PCS', '', '', '0.00', '0.00', '0', '0', '225000.00', '0.00', 0, 0, '2023-05-30 01:55:59', '2023-05-30 01:55:59'),
(59, '-', 1, 'Plate Bowl 24cm', 'PCS', '', '', '0.00', '0.00', '-3', '0', '200000.00', '0.00', 0, 0, '2023-05-30 01:56:26', '2023-05-30 01:56:26'),
(60, '-', 1, 'meddium Bowl/14-15cm', 'PCS', '', '', '0.00', '0.00', '-4', '0', '140000.00', '0.00', 0, 0, '2023-05-30 01:57:03', '2023-05-30 01:57:03'),
(61, '-', 1, 'Meddium Plate 20cm', 'PCS', '', '', '0.00', '0.00', '0', '0', '150000.00', '0.00', 0, 0, '2023-05-30 01:57:32', '2023-05-30 01:57:32'),
(62, '-', 1, 'Meddium Bowl Rectangular 21cm', 'PCS', '', '', '0.00', '0.00', '-1', '0', '200000.00', '0.00', 0, 0, '2023-05-30 01:58:13', '2023-05-30 01:58:13'),
(63, '-', 1, 'Small Bowl Rectangular 20cm', 'PCS', '', '', '0.00', '0.00', '0', '0', '150000.00', '0.00', 0, 0, '2023-05-30 01:58:44', '2023-05-30 01:58:44'),
(64, '-', 1, 'Bowl 17cm', 'PCS', '', '', '0.00', '0.00', '-1', '0', '150000.00', '0.00', 0, 0, '2023-05-30 01:59:44', '2023-05-30 01:59:44'),
(65, '-', 1, 'High Bowl 17cm', 'PCS', '', '', '0.00', '0.00', '-1', '0', '175000.00', '0.00', 0, 0, '2023-05-30 02:00:13', '2023-05-30 02:00:13'),
(66, '-', 1, 'Salad Bowl 18cm', 'PCS', '', '', '0.00', '0.00', '-3', '0', '140000.00', '0.00', 0, 0, '2023-05-30 02:00:41', '2023-05-30 02:00:41'),
(67, '-', 1, 'Small Mug', 'PCS', '', '', '0.00', '0.00', '0', '0', '85000.00', '0.00', 0, 0, '2023-05-30 02:02:40', '2023-05-30 02:02:40'),
(68, '-', 1, 'Mug Espresso', 'PCS', '', '', '0.00', '0.00', '0', '0', '75000.00', '0.00', 0, 0, '2023-05-30 02:03:21', '2023-05-30 02:03:21'),
(69, '-', 1, 'Cup', 'PCS', '', '', '0.00', '0.00', '-1', '0', '85000.00', '0.00', 0, 0, '2023-05-30 03:25:43', '2023-05-30 03:25:43'),
(70, '-', 1, 'Cup/Mug Reject', 'PCS', '', '', '0.00', '0.00', '-3', '0', '50000.00', '0.00', 0, 0, '2023-05-30 04:00:40', '2023-05-30 04:00:40'),
(71, '-', 1, 'Big Mug Reject', 'PCS', '', '', '0.00', '0.00', '-1', '0', '100000.00', '0.00', 0, 0, '2023-05-31 03:33:06', '2023-05-31 03:33:06'),
(72, '-', 1, 'Wood Tatara', 'PCS', '', '', '0.00', '0.00', '-1', '0', '250000.00', '0.00', 0, 0, '2023-05-31 03:34:12', '2023-05-31 03:34:12'),
(73, '-', 1, 'Fish Mug', 'PCS', '', '', '0.00', '0.00', '-2', '0', '100000.00', '0.00', 0, 0, '2023-05-31 03:34:35', '2023-05-31 03:34:35'),
(74, '-', 1, 'Small Bowl 12cm', 'PCS', '', '', '0.00', '0.00', '0', '0', '125000.00', '0.00', 0, 0, '2023-05-31 03:37:31', '2023-05-31 03:37:31'),
(75, '-', 1, 'Bowl Plate ', 'PCS', '', '', '0.00', '0.00', '-4', '0', '250000.00', '0.00', 0, 0, '2023-06-01 01:28:33', '2023-06-01 01:28:33'),
(76, '-', 1, 'Bowl', 'PCS', '', '', '0.00', '0.00', '-4', '0', '200000.00', '0.00', 0, 0, '2023-06-01 01:29:30', '2023-06-01 01:29:30'),
(77, '-', 1, 'Small Pitchers', 'PCS', '', '', '0.00', '0.00', '-3', '0', '125000.00', '0.00', 0, 0, '2023-06-01 01:31:18', '2023-06-01 01:31:18'),
(78, '-', 1, 'Soy Sauce Bottle', 'PCS', '', '', '0.00', '0.00', '-1', '0', '150000.00', '0.00', 0, 0, '2023-06-01 01:31:47', '2023-06-01 01:31:47'),
(79, '-', 1, 'Filter Coffee Reject', 'PCS', '', '', '0.00', '0.00', '-1', '0', '75000.00', '0.00', 0, 0, '2023-06-01 01:32:56', '2023-06-01 01:32:56'),
(80, '-', 1, 'Plate Unrecgular', 'PCS', '', '', '0.00', '0.00', '-2', '0', '225000.00', '0.00', 0, 0, '2023-06-01 01:35:08', '2023-06-01 01:35:08'),
(81, '-', 1, 'Vas ', 'PCS', '', '', '0.00', '0.00', '-2', '0', '250000.00', '0.00', 0, 0, '2023-06-02 01:59:47', '2023-06-02 01:59:47'),
(82, '-', 1, 'Teapot', 'PCS', '', '', '0.00', '0.00', '-1', '0', '200000.00', '0.00', 0, 0, '2023-06-02 02:00:10', '2023-06-02 02:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `id_produk_kategori` int(10) NOT NULL,
  `produk_kategori` varchar(200) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_kategori`
--

INSERT INTO `produk_kategori` (`id_produk_kategori`, `produk_kategori`, `dibuat_pada`, `diubah_pada`) VALUES
(1, 'Retail', '2023-04-03 13:15:54', '2022-12-07 03:06:24'),
(2, 'Bahan Baku', '2023-05-23 08:35:35', '2023-05-23 08:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `produk_satuan`
--

CREATE TABLE `produk_satuan` (
  `id_produk_satuan` int(10) NOT NULL,
  `satuan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_satuan`
--

INSERT INTO `produk_satuan` (`id_produk_satuan`, `satuan`) VALUES
(1, 'PCS'),
(2, 'KILOGRAM'),
(3, 'GRAM'),
(4, 'SET');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` datetime NOT NULL DEFAULT current_timestamp(),
  `terakhir_login` datetime NOT NULL DEFAULT current_timestamp(),
  `akses` enum('Administrator','Toko','Simpan Pinjam','') NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'OFFLINE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `dibuat_pada`, `diubah_pada`, `terakhir_login`, `akses`, `status`) VALUES
(1, 'Admin', 'admin', 'admin', '2021-11-11 07:49:25', '2022-12-07 02:50:07', '2023-06-09 00:05:11', 'Administrator', 'OFFLINE'),
(5, 'kasir', 'kasir', 'kasir', '2022-12-07 03:02:11', '2022-12-07 03:02:11', '2022-12-07 03:02:20', 'Administrator', 'ONLINE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `akun_jurnal`
--
ALTER TABLE `akun_jurnal`
  ADD PRIMARY KEY (`id_akun_jurnal`);

--
-- Indexes for table `akun_jurnal_template`
--
ALTER TABLE `akun_jurnal_template`
  ADD PRIMARY KEY (`id_akun_jurnal_template`);

--
-- Indexes for table `akun_mutasi`
--
ALTER TABLE `akun_mutasi`
  ADD PRIMARY KEY (`id_akun_mutasi`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`id_beli`);

--
-- Indexes for table `beli_detail`
--
ALTER TABLE `beli_detail`
  ADD PRIMARY KEY (`id_beli_detail`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`id_jual`);

--
-- Indexes for table `jual_detail`
--
ALTER TABLE `jual_detail`
  ADD PRIMARY KEY (`id_jual_detail`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `keranjang_beli`
--
ALTER TABLE `keranjang_beli`
  ADD PRIMARY KEY (`id_keranjang_beli`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`id_produk_kategori`);

--
-- Indexes for table `produk_satuan`
--
ALTER TABLE `produk_satuan`
  ADD PRIMARY KEY (`id_produk_satuan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `akun_jurnal`
--
ALTER TABLE `akun_jurnal`
  MODIFY `id_akun_jurnal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `akun_jurnal_template`
--
ALTER TABLE `akun_jurnal_template`
  MODIFY `id_akun_jurnal_template` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `akun_mutasi`
--
ALTER TABLE `akun_mutasi`
  MODIFY `id_akun_mutasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `beli`
--
ALTER TABLE `beli`
  MODIFY `id_beli` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beli_detail`
--
ALTER TABLE `beli_detail`
  MODIFY `id_beli_detail` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jual`
--
ALTER TABLE `jual`
  MODIFY `id_jual` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jual_detail`
--
ALTER TABLE `jual_detail`
  MODIFY `id_jual_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7072;

--
-- AUTO_INCREMENT for table `keranjang_beli`
--
ALTER TABLE `keranjang_beli`
  MODIFY `id_keranjang_beli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=994;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `id_produk_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk_satuan`
--
ALTER TABLE `produk_satuan`
  MODIFY `id_produk_satuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
