-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2026 at 05:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orinamia`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `harga_beli` decimal(12,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `no_bahan`, `nama_bahan`, `satuan`, `harga_beli`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'BB-001', 'Kain Marbella', 'yard', 45000.00, 1, '2026-10-15 02:52:31', '2026-10-15 02:54:57'),
(2, 'BB-002', 'Kain Voal', 'yard', 35000.00, 1, '2026-10-15 02:52:31', '2026-10-15 02:54:57'),
(3, 'BB-003', 'Benang Jahit Premium', 'roll', 8000.00, 1, '2026-10-15 02:52:31', '2026-10-15 02:54:57'),
(4, 'BB-004', 'Kancing Baju', 'pak', 12000.00, 1, '2026-10-15 02:52:31', '2026-10-15 02:54:57'),
(5, 'BB-005', 'Kain Katun Toyobo', 'yard', 38000.00, 1, '2026-10-15 02:52:31', '2026-10-15 02:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `detail_beli`
--

CREATE TABLE `detail_beli` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pembelian_id` bigint(20) UNSIGNED NOT NULL,
  `bahan_id` bigint(20) UNSIGNED NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT 1.00,
  `harga_satuan_saat_transaksi` decimal(12,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_beli`
--

INSERT INTO `detail_beli` (`id`, `pembelian_id`, `bahan_id`, `qty`, `harga_satuan_saat_transaksi`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100.00, 45000.00, 4500000.00, '2026-10-15 02:57:09', '2026-10-15 02:57:09'),
(2, 1, 3, 10.00, 8000.00, 80000.00, '2026-10-15 02:57:09', '2026-10-15 02:57:09'),
(3, 2, 2, 80.50, 35000.00, 2817500.00, '2026-10-15 02:57:09', '2026-10-15 02:57:09'),
(4, 3, 4, 20.00, 12000.00, 240000.00, '2026-10-15 02:57:09', '2026-10-15 02:57:09'),
(5, 3, 3, 15.00, 8000.00, 120000.00, '2026-10-15 02:57:09', '2026-10-15 02:57:09'),
(6, 4, 5, 60.00, 38000.00, 2280000.00, '2026-10-15 02:57:09', '2026-10-15 02:57:09'),
(7, 4, 1, 40.00, 45000.00, 1800000.00, '2026-10-15 02:57:09', '2026-10-15 02:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penjualan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_item` varchar(150) NOT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `harga_satuan` decimal(12,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `nama_item`, `ukuran`, `qty`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kemeja Kerja', 'L', 50, 120000.00, 6000000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37'),
(2, 1, 'Kemeja Kerja', 'M', 50, 120000.00, 6000000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37'),
(3, 2, 'Scrub Medis Atasan', 'M', 30, 150000.00, 4500000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37'),
(4, 2, 'Scrub Medis Bawahan', 'M', 30, 100000.00, 3000000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37'),
(5, 3, 'Seragam Kantor', 'L', 40, 125000.00, 5000000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37'),
(6, 3, 'Seragam Kantor', 'M', 40, 125000.00, 5000000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37'),
(7, 4, 'Kaos Olahraga', 'S', 20, 150000.00, 3000000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37'),
(8, 4, 'Kaos Olahraga', 'M', 20, 150000.00, 3000000.00, '2026-10-15 02:55:37', '2026-10-15 02:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penjualan_id` bigint(20) UNSIGNED NOT NULL,
  `jenis` enum('DP','PELUNASAN') NOT NULL,
  `nomor` varchar(30) NOT NULL,
  `jumlah` decimal(12,2) NOT NULL DEFAULT 0.00,
  `jatuh_tempo` date NOT NULL,
  `status` enum('BELUM_BAYAR','LUNAS') NOT NULL DEFAULT 'BELUM_BAYAR',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `penjualan_id`, `jenis`, `nomor`, `jumlah`, `jatuh_tempo`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'DP', 'INV-DP-202609-001', 6000000.00, '2026-09-24', 'LUNAS', '2026-10-15 02:56:05', '2026-10-15 02:56:05'),
(2, 1, 'PELUNASAN', 'INV-LN-202609-001', 6000000.00, '2026-10-08', 'LUNAS', '2026-10-15 02:56:05', '2026-10-15 02:56:05'),
(3, 2, 'DP', 'INV-DP-202609-002', 3750000.00, '2026-10-06', 'LUNAS', '2026-10-15 02:56:05', '2026-10-15 02:56:05'),
(4, 2, 'PELUNASAN', 'INV-LN-202609-002', 3750000.00, '2026-10-20', 'LUNAS', '2026-10-15 02:56:05', '2026-10-15 02:56:05'),
(5, 3, 'DP', 'INV-DP-202610-001', 5000000.00, '2026-10-19', 'LUNAS', '2026-10-15 02:56:05', '2026-10-15 02:56:05'),
(6, 3, 'PELUNASAN', 'INV-LN-202610-001', 5000000.00, '2026-11-02', 'BELUM_BAYAR', '2026-10-15 02:56:05', '2026-10-15 02:56:05'),
(7, 4, 'DP', 'INV-DP-202610-002', 3000000.00, '2026-10-27', 'BELUM_BAYAR', '2026-10-15 02:56:05', '2026-10-15 02:56:05'),
(8, 4, 'PELUNASAN', 'INV-LN-202610-002', 3000000.00, '2026-11-10', 'BELUM_BAYAR', '2026-10-15 02:56:05', '2026-10-15 02:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_pelanggan` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tlp` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `no_pelanggan`, `nama`, `tlp`, `alamat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PL-001', 'PT Berkah Sejahtera', '021-5556789', 'Jakarta Selatan', 1, '2026-10-15 02:51:41', '2026-10-15 02:51:41'),
(2, 'PL-002', 'RS Sari Asih', '021-5551234', 'Tangerang', 1, '2026-10-15 02:51:41', '2026-10-15 02:51:41'),
(3, 'PL-003', 'CV Maju Bersama', '021-8821100', 'Bekasi', 1, '2026-10-15 02:51:41', '2026-10-15 02:51:41'),
(4, 'PL-004', 'SMK Negeri 5', '021-7770456', 'Depok', 1, '2026-10-15 02:51:41', '2026-10-15 02:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(12,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `invoice_id`, `tanggal`, `jumlah`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-09-11', 6000000.00, 1, '2026-10-15 02:56:29', '2026-10-15 02:56:29'),
(2, 2, '2026-09-30', 6000000.00, 1, '2026-10-15 02:56:29', '2026-10-15 02:56:29'),
(3, 3, '2026-09-23', 3750000.00, 1, '2026-10-15 02:56:29', '2026-10-15 02:56:29'),
(4, 4, '2026-10-10', 3750000.00, 1, '2026-10-15 02:56:29', '2026-10-15 02:56:29'),
(5, 5, '2026-10-06', 5000000.00, 1, '2026-10-15 02:56:29', '2026-10-15 02:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_beli` varchar(30) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_beli` date NOT NULL,
  `total_beli` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `no_beli`, `supplier_id`, `user_id`, `no_faktur`, `tgl_beli`, `total_beli`, `created_at`, `updated_at`) VALUES
(1, 'PB-202609-001', 1, 1, 'FK-0908', '2026-09-08', 4580000.00, '2026-09-08 01:45:00', '2026-10-15 02:56:50'),
(2, 'PB-202609-002', 2, 1, 'FK-2009', '2026-09-20', 2817500.00, '2026-09-20 06:10:00', '2026-10-15 02:56:50'),
(3, 'PB-202610-001', 3, 1, 'FK-0310', '2026-10-03', 360000.00, '2026-10-03 03:05:00', '2026-10-15 02:56:50'),
(4, 'PB-202610-002', 1, 1, 'FK-1210', '2026-10-12', 4080000.00, '2026-10-12 02:40:00', '2026-10-15 02:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_jual` varchar(30) NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_jual` date NOT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `paid` decimal(12,2) NOT NULL DEFAULT 0.00,
  `balance_due` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('BELUM_BAYAR','DP_LUNAS','LUNAS','TERKIRIM') NOT NULL DEFAULT 'BELUM_BAYAR',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `no_jual`, `pelanggan_id`, `user_id`, `tgl_jual`, `total`, `paid`, `balance_due`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PJ-202609-001', 1, 1, '2026-09-10', 12000000.00, 12000000.00, 0.00, 'TERKIRIM', '2026-09-10 02:15:00', '2026-10-15 02:55:15'),
(2, 'PJ-202609-002', 2, 1, '2026-09-22', 7500000.00, 7500000.00, 0.00, 'LUNAS', '2026-09-22 03:30:00', '2026-10-15 02:55:15'),
(3, 'PJ-202610-001', 3, 1, '2026-10-05', 10000000.00, 5000000.00, 5000000.00, 'DP_LUNAS', '2026-10-05 04:00:00', '2026-10-15 02:55:15'),
(4, 'PJ-202610-002', 4, 1, '2026-10-13', 6000000.00, 0.00, 6000000.00, 'BELUM_BAYAR', '2026-10-13 07:20:00', '2026-10-15 02:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_supplier` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(30) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `no_supplier`, `nama`, `alamat`, `tlp`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'SP-001', 'Toko Kain Makmur', 'Pasar Jatinegara, Jakarta Timur', '021-1234567', 1, '2026-10-15 02:52:11', '2026-10-15 02:52:11'),
(2, 'SP-002', 'Supplier Voal A', 'Kebon Jeruk, Jakarta Barat', '021-7890123', 1, '2026-10-15 02:52:11', '2026-10-15 02:52:11'),
(3, 'SP-003', 'Toko Aksesoris Jaya', 'Tanah Abang, Jakarta Pusat', '021-3456789', 1, '2026-10-15 02:52:11', '2026-10-15 02:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('admin','owner') NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin Orinamia', 'admin', NULL, '2026-10-15 02:50:56', '2026-10-15 02:50:56'),
(2, 'owner', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Owner Orinamia', 'owner', NULL, '2026-10-15 02:50:56', '2026-10-15 02:50:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_bahan` (`no_bahan`);

--
-- Indexes for table `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_beli_pembelian` (`pembelian_id`),
  ADD KEY `fk_detail_beli_bahan` (`bahan_id`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_penjualan_penjualan` (`penjualan_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor` (`nomor`),
  ADD UNIQUE KEY `uq_invoice_penjualan_jenis` (`penjualan_id`,`jenis`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_pelanggan` (`no_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembayaran_invoice` (`invoice_id`),
  ADD KEY `fk_pembayaran_user` (`user_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_beli` (`no_beli`),
  ADD KEY `fk_pembelian_supplier` (`supplier_id`),
  ADD KEY `fk_pembelian_user` (`user_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_jual` (`no_jual`),
  ADD KEY `fk_penjualan_pelanggan` (`pelanggan_id`),
  ADD KEY `fk_penjualan_user` (`user_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_supplier` (`no_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_beli`
--
ALTER TABLE `detail_beli`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_beli`
--
ALTER TABLE `detail_beli`
  ADD CONSTRAINT `fk_detail_beli_bahan` FOREIGN KEY (`bahan_id`) REFERENCES `bahan_baku` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_beli_pembelian` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `fk_detail_penjualan_penjualan` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_penjualan` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pembayaran_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_pembelian_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pembelian_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `fk_penjualan_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penjualan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
