-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2025 at 06:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsc`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_bsc`
--

CREATE TABLE `anggota_bsc` (
  `id_anggota` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` enum('Senior','Anggota') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggota_bsc`
--

INSERT INTO `anggota_bsc` (`id_anggota`, `nama`, `status`, `kelas`, `deskripsi`, `created_at`) VALUES
(26, 'Andi Rian Pratama', 'Anggota', 'X IPA 1', 'Aktif', '2025-06-20 02:48:15'),
(27, 'Nabila Rahmawati', 'Senior', 'XII IPA 2', 'Alumni', '2025-06-20 02:48:15'),
(28, 'Fajar Nugroho', 'Anggota', 'XI IPS 1', 'Aktif', '2025-06-20 02:48:15'),
(29, 'Siti Khadijah', 'Anggota', 'X IPA 3', 'Anggota', '2025-06-20 02:48:15'),
(30, 'Dimas Alamsyah', 'Senior', 'XII IPS 2', 'Alumni', '2025-06-20 02:48:15'),
(31, 'Lestari Salsabila', 'Anggota', 'XI IPA 2', 'Aktif', '2025-06-20 02:48:15'),
(32, 'Muhammad Reza', 'Anggota', 'X IPS 1', 'Bendahara', '2025-06-20 02:48:15'),
(33, 'Nurul Aini', 'Senior', 'XII IPA 1', 'Alumni', '2025-06-20 02:48:15'),
(34, 'Faisal Maulana', 'Anggota', 'XI IPA 3', 'Anggota', '2025-06-20 02:48:15'),
(35, 'Dewi Amelia', 'Anggota', 'X IPA 4', 'Aktif', '2025-06-20 02:48:15'),
(36, 'Rafi Ramadhan', 'Anggota', 'XI IPS 3', 'Sekretaris', '2025-06-20 02:48:15'),
(37, 'Ayu Lestari', 'Senior', 'XII IPS 1', 'Alumni', '2025-06-20 02:48:15'),
(38, 'Hana Zahira', 'Anggota', 'X IPS 2', 'Anggota', '2025-06-20 02:48:15'),
(39, 'Irfan Nugraha', 'Anggota', 'XI IPA 4', 'Aktif', '2025-06-20 02:48:15'),
(40, 'Zahra Kusuma', 'Senior', 'XII IPA 3', 'Alumni', '2025-06-20 02:48:15'),
(41, 'Wawan Saputra', 'Anggota', 'XI IPA 1', 'Anggota', '2025-06-20 02:48:15'),
(42, 'Aulia Ramadhani', 'Anggota', 'X IPA 2', 'Aktif', '2025-06-20 02:48:15'),
(43, 'Aldi Kurniawan', 'Senior', 'XII IPS 3', 'Alumni', '2025-06-20 02:48:15'),
(44, 'Melati Putri', 'Anggota', 'XI IPS 2', 'Anggota', '2025-06-20 02:48:15'),
(45, 'Ahmad Fadhil', 'Anggota', 'X IPA 1', 'Aktif', '2025-06-20 02:48:15'),
(46, 'Nadya Salma', 'Anggota', 'XI IPA 2', 'Wakil Ketua', '2025-06-20 02:48:15'),
(47, 'Rio Dwi Cahyo', 'Senior', 'XII IPA 4', 'Alumni', '2025-06-20 02:48:15'),
(48, 'Sari Maharani', 'Anggota', 'X IPS 3', 'Aktif', '2025-06-20 02:48:15'),
(49, 'Rendi Aditya', 'Anggota', 'XI IPA 3', 'Anggota', '2025-06-20 02:48:15'),
(50, 'Syifa Nur Azizah', 'Anggota', 'X IPA 5', 'Aktif', '2025-06-20 02:48:15'),
(51, 'Bagus Prasetyo', 'Anggota', 'XI IPS 1', 'Anggota', '2025-06-20 02:48:15'),
(52, 'Tiara Melani', 'Senior', 'XII IPS 2', 'Alumni', '2025-06-20 02:48:15'),
(53, 'Kevin Ardiansyah', 'Anggota', 'XI IPA 2', 'Anggota', '2025-06-20 02:48:15'),
(54, 'Lala Nirmala', 'Anggota', 'X IPA 1', 'Aktif', '2025-06-20 02:48:15'),
(55, 'Indah Mawar', 'Senior', 'XII IPA 1', 'Alumni', '2025-06-20 02:48:15'),
(56, 'Yoga Tri Saputra', 'Anggota', 'XI IPS 4', 'Anggota', '2025-06-20 02:48:15'),
(57, 'Rina Wulandari', 'Anggota', 'X IPA 3', 'Aktif', '2025-06-20 02:48:15'),
(58, 'Ikhsan Maulana', 'Anggota', 'XI IPA 4', 'Anggota', '2025-06-20 02:48:15'),
(59, 'Dinda Aprilia', 'Senior', 'XII IPA 3', 'Alumni', '2025-06-20 02:48:15'),
(60, 'Arif Gunawan', 'Anggota', 'XI IPS 3', 'Aktif', '2025-06-20 02:48:15'),
(61, 'Nia Anggraini', 'Anggota', 'X IPA 2', 'Bendahara', '2025-06-20 02:48:15'),
(62, 'Aldi Firmansyah', 'Senior', 'XII IPS 1', 'Alumni', '2025-06-20 02:48:15'),
(63, 'Vina Safitri', 'Anggota', 'XI IPA 1', 'Anggota', '2025-06-20 02:48:15'),
(64, 'Raka Septian', 'Anggota', 'X IPS 1', 'Aktif', '2025-06-20 02:48:15'),
(65, 'Clara Natalia', 'Anggota', 'XI IPA 2', 'Sekretaris', '2025-06-20 02:48:15'),
(66, 'Galang Hidayat', 'Senior', 'XII IPA 2', 'Alumni', '2025-06-20 02:48:15'),
(67, 'Ayuni Sabrina', 'Anggota', 'XI IPS 2', 'Anggota', '2025-06-20 02:48:15'),
(68, 'Reza Prabowo', 'Anggota', 'X IPA 4', 'Ketua', '2025-06-20 02:48:15'),
(69, 'Mega Lestari', 'Anggota', 'XI IPA 3', 'Aktif', '2025-06-20 02:48:15'),
(70, 'Rizki Fauzan', 'Anggota', 'X IPS 2', 'Anggota', '2025-06-20 02:48:15'),
(71, 'Fitria Azzahra', 'Senior', 'XII IPS 3', 'Alumni', '2025-06-20 02:48:15'),
(72, 'Gibran Permana', 'Anggota', 'XI IPA 1', 'Anggota', '2025-06-20 02:48:15'),
(73, 'Shinta Aprilia', 'Anggota', 'X IPA 2', 'Aktif', '2025-06-20 02:48:15'),
(74, 'Dimas Nurhadi', 'Anggota', 'XI IPS 1', 'Bendahara', '2025-06-20 02:48:15'),
(75, 'Olivia Maharani', 'Anggota', 'X IPA 3', 'Aktif', '2025-06-20 02:48:15'),
(76, 'Uli Wijaya', 'Anggota', 'X IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(77, 'Zara Anggraeni', 'Senior', 'XII IPS 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(78, 'Nina Anggraeni', 'Senior', 'X IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(79, 'Oscar Handayani', 'Anggota', 'XI IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(80, 'Sari Anggraeni', 'Senior', 'XII IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(81, 'Yoga Utami', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(82, 'Andi Sari', 'Anggota', 'XII IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(83, 'Uli Handayani', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(84, 'Rizki Yulianto', 'Senior', 'XII IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(85, 'Indah Utami', 'Senior', 'X IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(86, 'Sari Handayani', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(87, 'Oscar Anggraeni', 'Senior', 'X IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(88, 'Oscar Wijaya', 'Senior', 'XI IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(89, 'Putri Sari', 'Anggota', 'XII IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(90, 'Oscar Sari', 'Senior', 'XI IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(91, 'Rizki Saputra', 'Senior', 'XII IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(92, 'Lina Utami', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(93, 'Joko Saputra', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(94, 'Andi Wijaya', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(95, 'Joko Anggraeni', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(96, 'Fajar Utami', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(97, 'Lina Rahma', 'Anggota', 'X IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(98, 'Kiki Anggraeni', 'Anggota', 'XII IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(99, 'Zara Handayani', 'Anggota', 'XII IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(100, 'Nina Rahma', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(101, 'Vina Rahma', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(102, 'Joko Yulianto', 'Senior', 'X IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(103, 'Wawan Yulianto', 'Anggota', 'XII IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(104, 'Kiki Yulianto', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(105, 'Uli Saputra', 'Anggota', 'XI IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(106, 'Oscar Handayani', 'Senior', 'X IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(107, 'Vina Wijaya', 'Senior', 'XI IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(108, 'Wawan Nugroho', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(109, 'Lina Handayani', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(110, 'Wawan Rahma', 'Anggota', 'XII IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(111, 'Joko Sari', 'Senior', 'XII IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(112, 'Yoga Saputra', 'Senior', 'XII IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(113, 'Sari Yulianto', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(114, 'Kiki Utami', 'Senior', 'XI IPS 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(115, 'Hari Yulianto', 'Senior', 'XI IPS 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(116, 'Kiki Sari', 'Anggota', 'XII IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(117, 'Zara Nugroho', 'Anggota', 'X IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(118, 'Uli Yulianto', 'Senior', 'X IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(119, 'Nina Rahma', 'Anggota', 'XII IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(120, 'Maya Handayani', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(121, 'Xena Utami', 'Anggota', 'XII IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(122, 'Budi Yulianto', 'Senior', 'XII IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(123, 'Yoga Sari', 'Senior', 'X IPS 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(124, 'Dewi Handayani', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(125, 'Sari Yulianto', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(126, 'Tono Nugroho', 'Anggota', 'XI IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(127, 'Andi Saputra', 'Senior', 'XII IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(128, 'Tono Wijaya', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(129, 'Budi Utami', 'Anggota', 'XI IPA 1', 'anggota', '2025-06-20 02:51:37'),
(130, 'Vina Yulianto', 'Senior', 'XI IPS 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(131, 'Uli Anggraeni', 'Anggota', 'X IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(132, 'Uli Putra', 'Senior', 'XI IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(133, 'Putri Utami', 'Anggota', 'X IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(134, 'Budi Wijaya', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(135, 'Fajar Anggraeni', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(136, 'Hari Saputra', 'Anggota', 'XII IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(137, 'Oscar Rahma', 'Senior', 'X IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(138, 'Tono Anggraeni', 'Anggota', 'XI IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(139, 'Kiki Saputra', 'Anggota', 'XI IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(140, 'Tono Sari', 'Senior', 'X IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(141, 'Sari Putra', 'Senior', 'X IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(142, 'Sari Wijaya', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(143, 'Citra Wijaya', 'Senior', 'X IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(144, 'Oscar Handayani', 'Senior', 'XII IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(145, 'Nina Rahma', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(146, 'Indah Nugroho', 'Anggota', 'XII IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(147, 'Nina Nugroho', 'Anggota', 'XII IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(148, 'Rizki Anggraeni', 'Anggota', 'X IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(149, 'Kiki Wijaya', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(150, 'Zara Putra', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(151, 'Uli Rahma', 'Anggota', 'XI IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(152, 'Citra Nugroho', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(153, 'Xena Nugroho', 'Anggota', 'XII IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(154, 'Andi Rahma', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(155, 'Indah Sari', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(156, 'Xena Saputra', 'Senior', 'XI IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(157, 'Zara Wijaya', 'Anggota', 'XII IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(158, 'Joko Saputra', 'Senior', 'X IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(159, 'Hari Wijaya', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(160, 'Uli Utami', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(161, 'Uli Yulianto', 'Senior', 'X IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(162, 'Joko Yulianto', 'Senior', 'XI IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(163, 'Joko Wijaya', 'Anggota', 'X IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(164, 'Wawan Anggraeni', 'Anggota', 'XII IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(165, 'Putri Wijaya', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(166, 'Vina Rahma', 'Anggota', 'XII IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(167, 'Lina Saputra', 'Senior', 'XII IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(168, 'Maya Nugroho', 'Senior', 'XI IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(169, 'Sari Utami', 'Anggota', 'XI IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(170, 'Dewi Wijaya', 'Anggota', 'X IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(171, 'Joko Rahma', 'Senior', 'X IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(172, 'Nina Saputra', 'Anggota', 'XI IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(173, 'Yoga Wijaya', 'Senior', 'XI IPS 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(174, 'Sari Saputra', 'Senior', 'X IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(175, 'Yoga Utami', 'Anggota', 'XII IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(176, 'Indah Putra', 'Anggota', 'XII IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(177, 'Gita Nugroho', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(178, 'Rizki Utami', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(179, 'Fajar Wijaya', 'Anggota', 'X IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(180, 'Fajar Wijaya', 'Senior', 'XII IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(181, 'Zara Wijaya', 'Senior', 'XII IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(182, 'Gita Rahma', 'Anggota', 'X IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(183, 'Lina Wijaya', 'Senior', 'X IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(184, 'Oscar Saputra', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(185, 'Putri Saputra', 'Anggota', 'X IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(186, 'Wawan Handayani', 'Senior', 'XII IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(187, 'Joko Handayani', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(188, 'Xena Anggraeni', 'Anggota', 'X IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(189, 'Vina Handayani', 'Anggota', 'X IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(190, 'Uli Putra', 'Anggota', 'XII IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(191, 'Xena Utami', 'Senior', 'XII IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(192, 'Eka Handayani', 'Senior', 'XII IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(193, 'Citra Rahma', 'Senior', 'XI IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(194, 'Andi Anggraeni', 'Anggota', 'XI IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(195, 'Andi Anggraeni', 'Senior', 'X IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(196, 'Hari Anggraeni', 'Anggota', 'XI IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(197, 'Gita Wijaya', 'Anggota', 'XI IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(198, 'Andi Wijaya', 'Senior', 'XII IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(199, 'Hari Rahma', 'Anggota', 'XI IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(200, 'Indah Sari', 'Anggota', 'XII IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(201, 'Wawan Wijaya', 'Senior', 'X IPS 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(202, 'Rizki Handayani', 'Anggota', 'X IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(203, 'Maya Sari', 'Anggota', 'X IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(204, 'Rizki Nugroho', 'Senior', 'X IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(205, 'Citra Sari', 'Anggota', 'XI IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(206, 'Eka Handayani', 'Senior', 'XI IPA 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(207, 'Dewi Rahma', 'Anggota', 'XI IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(208, 'Nina Saputra', 'Senior', 'X IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(209, 'Kiki Yulianto', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(210, 'Budi Wijaya', 'Anggota', 'XII IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(211, 'Oscar Putra', 'Anggota', 'XI IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(212, 'Xena Saputra', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(213, 'Sari Putra', 'Anggota', 'X IPS 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(214, 'Andi Anggraeni', 'Anggota', 'XII IPA 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(215, 'Indah Anggraeni', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(216, 'Uli Saputra', 'Anggota', 'XII IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(217, 'Fajar Nugroho', 'Senior', 'XI IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(218, 'Yoga Putra', 'Anggota', 'X IPA 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(219, 'Joko Saputra', 'Senior', 'X IPA 1', 'Alumni BSC', '2025-06-20 02:51:37'),
(220, 'Oscar Sari', 'Anggota', 'XI IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(221, 'Eka Saputra', 'Anggota', 'X IPS 2', 'Anggota BSC', '2025-06-20 02:51:37'),
(222, 'Xena Utami', 'Senior', 'XI IPS 2', 'Alumni BSC', '2025-06-20 02:51:37'),
(223, 'Hari Yulianto', 'Anggota', 'X IPA 1', 'Anggota BSC', '2025-06-20 02:51:37'),
(224, 'Indah Yulianto', 'Anggota', 'XII IPS 3', 'Anggota BSC', '2025-06-20 02:51:37'),
(225, 'Kiki Yulianto', 'Senior', 'X IPA 3', 'Alumni BSC', '2025-06-20 02:51:37'),
(226, 'komang', 'Anggota', 'X IPS !', 'Anggota', '2025-06-20 05:12:01'),
(227, 'dicky', 'Anggota', 'X IPS 2', 'Anggota', '2025-06-20 05:12:42'),
(228, 'mamayu', 'Senior', 'XII IPA $', 'Keamanan', '2025-06-20 05:13:58'),
(229, 'muh. adam', 'Senior', 'XII IPA 1', 'Alumni', '2025-06-21 10:13:11'),
(230, 'Nur Icha', 'Senior', 'XII IPA 1', 'Alumni', '2025-06-22 13:44:58'),
(231, 'wahyu dwi', 'Senior', 'XII IPA 7', 'Alumni', '2025-06-22 13:46:05'),
(232, 'Kiki', 'Anggota', 'X IPA 6', 'Anggota', '2025-06-22 13:46:28'),
(233, 'budiarsa', 'Senior', 'XII IPA 3', 'PDD', '2025-06-22 15:39:33'),
(234, 'Nordin', 'Anggota', 'XII IPA 4', 'Perlengkapan', '2025-06-22 15:50:31'),
(235, 'anggi', 'Senior', 'XII IPS 3', 'Alumni', '2025-06-22 16:06:16'),
(236, 'Acong', 'Anggota', 'X IPA 1', 'Anggota', '2025-06-22 16:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `coach_bsc`
--

CREATE TABLE `coach_bsc` (
  `id_coach` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `motto` text NOT NULL,
  `prestasi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coach_bsc`
--

INSERT INTO `coach_bsc` (`id_coach`, `nama`, `jabatan`, `status`, `motto`, `prestasi`, `foto`, `created_at`) VALUES
(2, 'Muh Idham Chaliq', 'Pembina', 'Guru Olahraga SMAN 10 Makassar', '&quot;Membentuk karakter melalui olahraga adalah investasi untuk masa depan yang lebih baik&quot;', '15+ tahun pengalaman mengajar\r\nPembina BSC sejak 2024\r\nKoordinator Ekskul Olahraga', '1750613454_Gemini_Generated_Image_PembinaCowok.png', '2025-01-11 03:42:10'),
(3, 'Rezky Ramahdan', 'Senior Coach', 'Alumni BSC Angkatan 2', '&quot;Berlatih dengan disiplin dan konsisten adalah kunci untuk menjadi atlet bulutangkis yang handal&quot;', 'Juara 1 Ganda Putra POPDA 2019\r\nPelatih BSC sejak 2021\r\nPembina 20+ atlet berprestasi', '1750613056_Gemini_Generated_Image_PembinaCowok.png', '2025-01-11 03:58:55'),
(4, 'Nur Ulfa Indah', 'Senior Coach', 'Alumni BSC Angkatan 2', '&quot;Menginspirasi lewat semangat dan kerja keras di setiap pertandingan.&quot;', 'Finalis Kejuaraan Antar Club se-Sulsel 2021\r\nPelatih aktif di BSC sejak 2022\r\nMendampingi Tim BSC Junior meraih Juara 1 Ganda P\r\nPelatih terbaik versi internal BSC tahun 2024', '1750613431_Gemini_Generated_Image_hmoyuhhmoyuhhmoy.png', '2025-06-22 17:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE `data_admin` (
  `id_admin` int NOT NULL,
  `username_admin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `username_admin`, `password_admin`, `created_at`) VALUES
(1, 'admin', '$2y$10$wCeME98CzcUz9F9zOyOUH.s7e9n4yrXVuB/70a0.zpiIg7xGfWSVy', '2025-01-11 01:10:40'),
(8, 'trisna', '$2y$10$dq5.fbormz4ybVym2gHdNe3Xhkjj2tDnx5XqXAoSOmAod2dLTaYI6', '2025-06-21 08:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `data_pengurus`
--

CREATE TABLE `data_pengurus` (
  `id_pengurus` int NOT NULL,
  `username_pengurus` varchar(100) NOT NULL,
  `password_pengurus` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_pengurus`
--

INSERT INTO `data_pengurus` (`id_pengurus`, `username_pengurus`, `password_pengurus`, `created_at`) VALUES
(8, 'Nyoman', '$2y$10$ZehWcqdlVauHdy1hP3Etx.FJtW9Wwf3J928MFWI6HrYQB6TTIYS6y', '2025-06-21 09:06:26'),
(9, 'pengurus', '$2y$10$IACkNjX80nQKiwfJ6tp2yOnz0i.0XY.2mmeKabXebfc7fj21ac00i', '2025-06-21 10:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `no_whatsapp` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alasan_masuk` text NOT NULL,
  `status` enum('Pending','Diterima','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `tanggal_masuk`, `no_whatsapp`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `kelas`, `alasan_masuk`, `status`, `tanggal_daftar`) VALUES
(9, '2025-06-20', '089704559202', 'Putri Purwanti', 'Makassar', '2007-12-05', 'Laki-laki', 'X MIPA 1', 'Ingin lebih aktif di luar sekolah', 'Diterima', '2025-06-20 04:06:05'),
(10, '2025-06-20', '087355263718', 'Ade Santoso', 'Parepare', '2006-11-16', 'Laki-laki', 'X MIPA 2', 'Tertarik dengan klub BSC SMAPUL', 'Ditolak', '2025-06-20 04:06:05'),
(11, '2025-06-20', '081968551894', 'Radika Wibisono', 'Palopo', '2008-02-26', 'Perempuan', 'X MIPA 3', 'Suka olahraga bulutangkis', 'Diterima', '2025-06-20 04:06:05'),
(12, '2025-06-20', '081483861880', 'Salsabila Tamba', 'Bone', '2009-06-11', 'Perempuan', 'X MIPA 4', 'Untuk mengisi waktu luang dengan kegiatan positif', 'Diterima', '2025-06-20 04:06:05'),
(13, '2025-06-20', '084546290921', 'Ana Pratama', 'Gowa', '2008-07-08', 'Perempuan', 'X MIPA 5', 'Suka olahraga bulutangkis', 'Pending', '2025-06-20 04:06:05'),
(14, '2025-06-20', '088063366989', 'Natalia Uwais', 'Maros', '2006-09-21', 'Perempuan', 'X MIPA 6', 'Tertarik dengan klub BSC SMAPUL', 'Diterima', '2025-06-20 04:06:05'),
(15, '2025-06-20', '083245357717', 'Jane Hartati', 'Pangkep', '2008-04-18', 'Laki-laki', 'X MIPA 7', 'Ingin mengembangkan bakat bulutangkis', 'Diterima', '2025-06-20 04:06:05'),
(16, '2025-06-20', '086163691216', 'Puti Jane Dongoran', 'Luwu', '2008-11-05', 'Laki-laki', 'X MIPA 8', 'Tertarik dengan klub BSC SMAPUL', NULL, '2025-06-20 04:06:05'),
(17, '2025-06-20', '082942055646', 'Restu Mustofa', 'Soppeng', '2007-05-23', 'Laki-laki', 'X IPS 1', 'Ingin lebih aktif di luar sekolah', 'Ditolak', '2025-06-20 04:06:05'),
(19, '2025-06-20', '083458063971', 'Surya Marpaung', 'Jeneponto', '2008-12-31', 'Perempuan', 'X IPS 3', 'Melatih fisik dan disiplin', 'Diterima', '2025-06-20 04:06:05'),
(20, '2025-06-20', '089712257153', 'Puti Yuliarti', 'Barru', '2008-04-26', 'Laki-laki', 'X IPS 4', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(21, '2025-06-20', '081208448628', 'Rahmi Purwanti', 'Takalar', '2007-10-13', 'Perempuan', 'XI MIPA 1', 'Ingin lebih aktif di luar sekolah', NULL, '2025-06-20 04:06:05'),
(22, '2025-06-20', '089244026655', 'Olivia Sudiati', 'Bulukumba', '2007-03-31', 'Laki-laki', 'XI MIPA 2', 'Rekomendasi dari teman', NULL, '2025-06-20 04:06:05'),
(23, '2025-06-20', '084901823508', 'Cici Haryanti', 'Bantaeng', '2007-07-13', 'Perempuan', 'XI MIPA 3', 'Tertarik dengan klub BSC SMAPUL', NULL, '2025-06-20 04:06:05'),
(24, '2025-06-20', '085639340751', 'Salman Pratama', 'Selayar', '2009-06-08', 'Laki-laki', 'XI MIPA 4', 'Ingin lebih aktif di luar sekolah', NULL, '2025-06-20 04:06:05'),
(25, '2025-06-20', '085708163552', 'Sadina Wahyudin', 'Enrekang', '2007-05-13', 'Laki-laki', 'XI MIPA 5', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(26, '2025-06-20', '084584528515', 'Umi Astuti', 'Pinrang', '2007-08-21', 'Laki-laki', 'XI MIPA 6', 'Melatih fisik dan disiplin', NULL, '2025-06-20 04:06:05'),
(27, '2025-06-20', '081009816945', 'Wirda Permadi', 'Wajo', '2009-09-20', 'Perempuan', 'XI MIPA 7', 'Untuk mengisi waktu luang dengan kegiatan positif', NULL, '2025-06-20 04:06:05'),
(28, '2025-06-20', '088934459913', 'Cut Novi Nugroho', 'Tana Toraja', '2010-05-30', 'Laki-laki', 'XI MIPA 8', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(29, '2025-06-20', '087949396304', 'Nasim Pratama', 'Toraja Utara', '2010-03-19', 'Laki-laki', 'XI IPS 1', 'Ingin mengembangkan bakat bulutangkis', NULL, '2025-06-20 04:06:05'),
(30, '2025-06-20', '086983866526', 'Emin Marpaung', 'Mamuju', '2009-03-02', 'Perempuan', 'XI IPS 2', 'Rekomendasi dari teman', NULL, '2025-06-20 04:06:05'),
(31, '2025-06-20', '087924343305', 'Ina Mahendra', 'Majene', '2009-07-11', 'Laki-laki', 'XI IPS 3', 'Tertarik dengan klub BSC SMAPUL', NULL, '2025-06-20 04:06:05'),
(32, '2025-06-20', '085569673138', 'Ciaobella Nainggolan', 'Polewali Mandar', '2008-03-01', 'Perempuan', 'XI IPS 4', 'Suka olahraga bulutangkis', NULL, '2025-06-20 04:06:05'),
(33, '2025-06-20', '083883260548', 'Cahyanto Purnawati', 'Palu', '2007-08-27', 'Perempuan', 'XII MIPA 1', 'Rekomendasi dari teman', NULL, '2025-06-20 04:06:05'),
(34, '2025-06-20', '088186751968', 'Ana Samosir', 'Donggala', '2009-05-13', 'Perempuan', 'XII MIPA 2', 'Ingin lebih aktif di luar sekolah', NULL, '2025-06-20 04:06:05'),
(35, '2025-06-20', '086592397046', 'Hardana Prabowo', 'Parigi Moutong', '2009-08-30', 'Laki-laki', 'XII MIPA 3', 'Suka olahraga bulutangkis', NULL, '2025-06-20 04:06:05'),
(36, '2025-06-20', '088336288240', 'Kenari Najmudin', 'Banggai', '2006-07-06', 'Laki-laki', 'XII MIPA 4', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(37, '2025-06-20', '089667850443', 'Ifa Siregar', 'Tolitoli', '2009-04-13', 'Perempuan', 'XII MIPA 5', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(38, '2025-06-20', '086001858147', 'Gada Tamba', 'Poso', '2008-06-15', 'Laki-laki', 'XII MIPA 6', 'Ingin lebih aktif di luar sekolah', NULL, '2025-06-20 04:06:05'),
(39, '2025-06-20', '088822606592', 'Fathonah Handayani', 'Buol', '2007-03-09', 'Laki-laki', 'XII MIPA 7', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(40, '2025-06-20', '088613663875', 'Halima Permata', 'Luwuk', '2009-10-21', 'Laki-laki', 'XII MIPA 8', 'Rekomendasi dari teman', NULL, '2025-06-20 04:06:05'),
(41, '2025-06-20', '083193667354', 'Ifa Nuraini', 'Kolaka', '2007-11-15', 'Laki-laki', 'XII IPS 1', 'Untuk mengisi waktu luang dengan kegiatan positif', NULL, '2025-06-20 04:06:05'),
(42, '2025-06-20', '088439842235', 'Salsabila Usamah', 'Kendari', '2007-10-17', 'Perempuan', 'XII IPS 2', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(43, '2025-06-20', '083169869420', 'Tira Saptono', 'Bau-Bau', '2007-07-24', 'Perempuan', 'XII IPS 3', 'Ingin mengembangkan bakat bulutangkis', NULL, '2025-06-20 04:06:05'),
(44, '2025-06-20', '085242689246', 'Zahra Simbolon', 'Raha', '2009-01-16', 'Perempuan', 'XII IPS 4', 'Ingin lebih aktif di luar sekolah', NULL, '2025-06-20 04:06:05'),
(45, '2025-06-20', '081707088805', 'Catur Natsir', 'Konawe', '2006-08-15', 'Laki-laki', 'X MIPA 1', 'Untuk mengisi waktu luang dengan kegiatan positif', NULL, '2025-06-20 04:06:05'),
(46, '2025-06-20', '081204444844', 'Sutan Mahdi Astuti', 'Bombana', '2007-12-16', 'Laki-laki', 'X MIPA 2', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(47, '2025-06-20', '085741486399', 'Hesti Napitupulu', 'Wakatobi', '2010-04-30', 'Perempuan', 'X MIPA 3', 'Untuk mengisi waktu luang dengan kegiatan positif', NULL, '2025-06-20 04:06:05'),
(48, '2025-06-20', '086385324732', 'Ganep Permadi', 'Buton', '2007-08-22', 'Perempuan', 'X MIPA 4', 'Suka olahraga bulutangkis', NULL, '2025-06-20 04:06:05'),
(49, '2025-06-20', '086230448418', 'Tasdik Sihotang', 'Morowali', '2009-04-13', 'Laki-laki', 'X MIPA 5', 'Melatih fisik dan disiplin', NULL, '2025-06-20 04:06:05'),
(50, '2025-06-20', '082157341965', 'Latif Budiman', 'Muna', '2008-01-11', 'Laki-laki', 'XI MIPA 1', 'Rekomendasi dari teman', NULL, '2025-06-20 04:06:05'),
(51, '2025-06-20', '089550488507', 'Ratih Suartini', 'Luwu Timur', '2009-03-09', 'Perempuan', 'XI MIPA 2', 'Rekomendasi dari teman', NULL, '2025-06-20 04:06:05'),
(52, '2025-06-20', '083504020209', 'Calista Haryanti', 'Muna Barat', '2010-04-22', 'Laki-laki', 'XI MIPA 3', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(53, '2025-06-20', '089663446771', 'Puti Amalia Rahayu', 'Toraja Barat', '2009-10-06', 'Perempuan', 'XI IPS 1', 'Ingin menjadi atlet profesional', NULL, '2025-06-20 04:06:05'),
(54, '2025-06-20', '083362724217', 'Vivi Samosir', 'Mamasa', '2009-12-06', 'Laki-laki', 'XI IPS 2', 'Ingin lebih aktif di luar sekolah', NULL, '2025-06-20 04:06:05'),
(55, '2025-06-20', '085755288613', 'Gandewa Suryatmi', 'Makale', '2007-11-18', 'Laki-laki', 'XII IPS 1', 'Untuk mengisi waktu luang dengan kegiatan positif', NULL, '2025-06-20 04:06:05'),
(56, '2025-06-20', '087131537906', 'Tari Aryani', 'Kolaka Timur', '2006-06-21', 'Perempuan', 'XII IPS 2', 'Rekomendasi dari teman', NULL, '2025-06-20 04:06:05'),
(57, '2025-06-20', '084971015141', 'Cici Maryati', 'Kolaka Utara', '2008-07-29', 'Laki-laki', 'XII IPS 3', 'Untuk mengisi waktu luang dengan kegiatan positif', NULL, '2025-06-20 04:06:05'),
(58, '2025-06-20', '085378537326', 'Qori Napitupulu', 'Sigi', '2006-06-28', 'Laki-laki', 'XII IPS 4', 'Untuk mengisi waktu luang dengan kegiatan positif', NULL, '2025-06-20 04:06:05'),
(59, '2025-06-21', '085399101184', 'icang', 'makassar', '2010-11-11', 'Laki-laki', 'X IPA 6', 'mau mengasah sklil bukutangkis', 'Diterima', '2025-06-20 16:00:00'),
(60, '2025-06-22', '085399101184', 'Komang ardi', 'Palu', '2003-01-23', 'Laki-laki', 'X IPA 1', 'mau mengembangkan hobi saya', NULL, '2025-06-21 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `juara_bsc`
--

CREATE TABLE `juara_bsc` (
  `id_juara` int NOT NULL,
  `nama_juara` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Anonim',
  `kejuaraan` varchar(200) NOT NULL,
  `tingkat` enum('Sekolah','Kecamatan','Kabupaten','Provinsi','Nasional','Internasional') NOT NULL,
  `peringkat` enum('1','2','3') NOT NULL,
  `tahun` year NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `juara_bsc`
--

INSERT INTO `juara_bsc` (`id_juara`, `nama_juara`, `kejuaraan`, `tingkat`, `peringkat`, `tahun`, `foto`, `created_at`) VALUES
(2, '', 'SMATION (Smansa Badminton Competition) VOL II', 'Sekolah', '1', 2018, '1736564031_portfolio-04.jpg', '2025-01-08 07:45:37'),
(3, 'Anonim', 'Tournament Sport UIN Alaudin Makassar', 'Sekolah', '3', 2018, '1736563955_portfolio-01.jpg', '2025-01-11 02:52:35'),
(4, 'Anonim', 'Turnamen UIN Alauddin Antar Pelajar SMA Se Sul-Sel', 'Provinsi', '3', 2018, '1736564126_portfolio-02.jpg', '2025-01-11 02:55:26'),
(5, 'Anonim', 'SMATION (Smansa Badminton Competition) VOL III', 'Sekolah', '2', 2018, '1736564288_portfolio-03.jpg', '2025-01-11 02:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus_bsc`
--

CREATE TABLE `pengurus_bsc` (
  `id_pengurus` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengurus_bsc`
--

INSERT INTO `pengurus_bsc` (`id_pengurus`, `nama`, `kelas`, `jabatan`, `periode`, `foto`, `deskripsi`, `created_at`) VALUES
(4, 'Alfat Suritma', 'XII', 'Ketua', '2024/2025', '1750612197_Gemini_Generated_Image_PemainCowok.png', 'Anggota', '2025-01-10 12:44:31'),
(6, 'Andi Iqbal Rahman', 'XII', 'Wakil Ketua', '2024/2025', '1750612213_Gemini_Generated_Image_PemainCowok.png', 'Anggota', '2025-01-11 04:34:34'),
(7, 'Sitti Nurhaliza', 'XII', 'Sekretaris', '2024/2025', '1750612225_Gemini_Generated_Image_PemainCewek.png', 'Anggota', '2025-01-11 04:38:37'),
(8, 'Ria Anggraeni', 'XII', 'Bendahara', '2024/2025', '1750612237_Gemini_Generated_Image_PemainCewek.png', 'Anggota', '2025-01-11 04:39:17'),
(9, 'Syahrul Ramadhan', 'XI', 'Sesi Perlengkapan', '2024/2025', '1750612125_Gemini_Generated_Image_PemainCowok.png', 'Anggota', '2025-01-11 05:00:25'),
(10, 'Irfan Abdullah', 'XI', 'Sesi Kepelatihan', '2024/2025', '1750612159_Gemini_Generated_Image_PemainCowok.png', 'Anggota', '2025-01-11 05:01:16'),
(11, 'Nurhidayah Andini', 'XII', 'Sesi Konsumsi', '2024/2025', '1750612172_Gemini_Generated_Image_PemainCewek.png', 'Anggota', '2025-01-11 05:01:44'),
(12, 'Riswan Akbar', 'XII', 'Sesi Keamanan', '2024/2025', '1750612184_Gemini_Generated_Image_PemainCowok.png', 'Anggota', '2025-01-11 05:02:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_bsc`
--
ALTER TABLE `anggota_bsc`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `coach_bsc`
--
ALTER TABLE `coach_bsc`
  ADD PRIMARY KEY (`id_coach`);

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username_admin`);

--
-- Indexes for table `data_pengurus`
--
ALTER TABLE `data_pengurus`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD UNIQUE KEY `username_pengurus` (`username_pengurus`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `juara_bsc`
--
ALTER TABLE `juara_bsc`
  ADD PRIMARY KEY (`id_juara`);

--
-- Indexes for table `pengurus_bsc`
--
ALTER TABLE `pengurus_bsc`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota_bsc`
--
ALTER TABLE `anggota_bsc`
  MODIFY `id_anggota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `coach_bsc`
--
ALTER TABLE `coach_bsc`
  MODIFY `id_coach` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_pengurus`
--
ALTER TABLE `data_pengurus`
  MODIFY `id_pengurus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `juara_bsc`
--
ALTER TABLE `juara_bsc`
  MODIFY `id_juara` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengurus_bsc`
--
ALTER TABLE `pengurus_bsc`
  MODIFY `id_pengurus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
