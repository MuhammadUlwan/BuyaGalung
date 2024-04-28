-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 09:48 PM
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
-- Database: `proyek_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(25) NOT NULL,
  `id_nama` int(25) DEFAULT NULL,
  `id_menu` int(25) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_harga` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_nama`, `id_menu`, `quantity`, `total_harga`) VALUES
(77, 5, 18, 4, 140000);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(25) NOT NULL,
  `kategori_menu` enum('paketan','prasmanan') NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga_menu` int(25) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto_menu_path` varchar(255) DEFAULT NULL,
  `status_menu` enum('tersedia','kosong') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `kategori_menu`, `nama_menu`, `harga_menu`, `deskripsi`, `foto_menu_path`, `status_menu`) VALUES
(1, 'paketan', 'Ayam Geprek', 25000, '- Ayam Geprek\r\n- Nasi\r\n- Lalapan', 'Geprek.png', 'tersedia'),
(2, 'prasmanan', 'Prasmanan 1', 75000, 'Prasmanan', 'Menu1.png', 'tersedia'),
(3, 'paketan', 'Ayam Bistik', 35000, '- Ayam Bistik\r\n- Nasi\r\n- Telur Balado\r\n- Kentang Balado\r\n- Capcay', 'Bis.png', 'tersedia'),
(5, 'prasmanan', 'Prasmanan 2', 90000, 'Prasmanan', 'Menu2.png', 'tersedia'),
(18, 'paketan', 'Opor Ayam', 35000, 'Opor Ayam', 'OpAy.jpeg', 'tersedia'),
(19, 'paketan', 'Nasi Kuning Ayam Goreng', 30000, '- Nasi Kuning\r\n- Ayam Goreng', 'nasning.jpeg', 'tersedia'),
(20, 'paketan', 'Daging Bistik', 35000, '- Nasi Putih\r\n- Daging Bistik', 'AyStik.jpeg', 'tersedia'),
(21, 'paketan', 'Ayam Bakar', 30000, '- Ayam Bakar\r\n- Nasi Putih\r\n- Tahu & Tempe\r\n- Lalapan\r\n\r\n', 'AyBak.jpeg', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_nama` int(11) DEFAULT NULL,
  `total_harga` int(25) DEFAULT NULL,
  `gambar_transfer` varchar(255) DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_transaksi` enum('pending','ditolak','selesai') DEFAULT NULL,
  `metode_pembayaran` enum('DP','LUNAS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_nama`, `total_harga`, `gambar_transfer`, `tanggal_pesan`, `tanggal_transaksi`, `status_transaksi`, `metode_pembayaran`) VALUES
(10, 5, 150000, 'Menu2.png', '2023-12-27', '2023-12-12 20:38:56', 'ditolak', 'DP'),
(11, 5, 0, 'Geprek.png', NULL, '2023-12-12 21:26:00', 'pending', NULL),
(12, 5, 0, 'Menu2.png', NULL, '2023-12-12 21:57:52', 'ditolak', NULL),
(13, 5, 0, 'Menu2.png', NULL, '2023-12-12 22:09:46', 'pending', NULL),
(14, 5, 0, 'OpAy.jpeg', NULL, '2024-01-02 20:40:38', 'ditolak', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(25) NOT NULL,
  `id_nama` int(25) DEFAULT NULL,
  `id_menu` int(25) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `foto_menu_path` varchar(255) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_nama`, `id_menu`, `rating`, `komentar`, `foto_menu_path`, `tgl`) VALUES
(1, 5, 1, 4, 'WaW', '../../admin/uploads/656e8efebfaf4-Geprek.png', '2023-12-05 03:46:22'),
(2, 4, 2, 5, 'Hemat!', '../../admin/uploads/656e928e17f05-Menu1.png', '2023-12-05 04:01:34'),
(3, 5, 1, 5, 'Hu\'Hah', '../../admin/uploads/656f63bba9907-Geprek.png', '2023-12-05 18:54:03'),
(4, 5, 1, 4, 'Mantap!', '../../admin/uploads/656f63d146768-Geprek.png', '2023-12-05 18:54:25'),
(5, 5, 21, 5, 'Mantap, Murah, Mewah!!!', '../../admin/uploads/659474253097d-AyBak.jpeg', '2024-01-02 21:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nama` varchar(100) DEFAULT NULL,
  `id_nama` int(25) NOT NULL,
  `telepon` int(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','user','','') NOT NULL,
  `createat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updateeat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nama`, `id_nama`, `telepon`, `email`, `password`, `role`, `createat`, `updateeat`) VALUES
('abiyyu', 1, 1234567, 'abiyyu123@email.com', 'abiyyu123', 'admin', '2023-12-05 21:20:10', NULL),
('ndaru', 4, 13579, 'ndaru123@email.com', 'ndaru123', 'user', '2023-12-05 11:41:53', NULL),
('ulwan', 5, 98765, 'ulwan123@email.com', 'ulwan123', 'user', '2023-12-10 14:08:36', NULL),
('Ridhanss', 6, 987321, 'ridhan123@gmail.com', 'ridhan123', 'user', '2023-12-05 23:01:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `fk_keranjang_user` (`id_nama`),
  ADD KEY `fk_keranjang_menu` (`id_menu`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_nama` (`id_nama`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_nama` (`id_nama`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_nama` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `fk_keranjang_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `fk_keranjang_user` FOREIGN KEY (`id_nama`) REFERENCES `user` (`id_nama`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_nama`) REFERENCES `user` (`id_nama`);

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_nama`) REFERENCES `user` (`id_nama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
