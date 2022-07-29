-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2022 at 01:50 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_baut`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telpon` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `nama`, `email`, `telpon`, `alamat`, `password`, `level`) VALUES
(1, 'ss', 'ss', 's@s.com', '11', 's', '3691308f2a4c2f6983f2880d32e29c84', 'admin'),
(2, 'admin', 'admin', 'sss@sa.c', '123123', 'sas', 'fae0b27c451c728867a567e8c1bb4e53', 'admin'),
(3, 'jabrik', 'jabrik', 'sa@sa.com', '081250653005', 'sas', 'fae0b27c451c728867a567e8c1bb4e53', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah_stok` varchar(100) NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `harga` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `nama_barang`, `jumlah_stok`, `lokasi`, `harga`) VALUES
(3, 'tes', '1', '101b01012', '1000000'),
(4, 'baut k 19 x 50 mm', '211', '104b101', '1000000'),
(5, 'Baut 12 x 40 mm', '10100', '101B0204', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `data_order`
--

CREATE TABLE `data_order` (
  `id_order` int(10) NOT NULL,
  `id_keranjang` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `harga_barang` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `qty_order` varchar(255) NOT NULL,
  `tanggal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_order`
--

INSERT INTO `data_order` (`id_order`, `id_keranjang`, `id_barang`, `harga_barang`, `user_id`, `qty_order`, `tanggal`) VALUES
(93, '1', '1', '2', 'eddy adha saputra', '4', '2021-08-06'),
(102, '2', '2', '1000000', 'jabrik', '1', '2022-07-14'),
(103, '3', '2', '1000000', 'jabrik', '1', '2022-07-14'),
(105, '5', '2', '1000000', 'jabrik', '1', '2022-07-14'),
(106, '6', '2', '1000000', 'jabrik', '1', '2022-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id_usr` int(11) NOT NULL,
  `status` int(12) NOT NULL,
  `user` varchar(50) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id_usr`, `status`, `user`, `tanggal`, `ket`) VALUES
(1, 1, 'eddy adha saputra', '2021-08-06', ''),
(2, 2, 'jabrik', '2022-07-14', ''),
(3, 2, 'jabrik', '2022-07-14', ''),
(5, 3, 'jabrik', '2022-07-14', ''),
(6, 4, 'jabrik', '2022-07-23', '');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_stok_masuk` int(11) NOT NULL,
  `barang` varchar(11) NOT NULL,
  `stok_masuk` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `waktu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id_stok_masuk`, `barang`, `stok_masuk`, `date`, `waktu`) VALUES
(3, '4', '90', '2022-06-18', ''),
(4, '5', '100', '2022-06-18', ''),
(6, '4', '11', '2022-07-29', '13:49:10 pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `data_order`
--
ALTER TABLE `data_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id_usr`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_stok_masuk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_order`
--
ALTER TABLE `data_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_stok_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
