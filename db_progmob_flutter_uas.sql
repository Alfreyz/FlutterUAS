-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2021 pada 17.50
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_progmob_flutter_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `tittle` text NOT NULL,
  `descriptio` text NOT NULL,
  `url_img` text NOT NULL,
  `origin` text NOT NULL,
  `category` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `tittle`, `descriptio`, `url_img`, `origin`, `category`, `date`) VALUES
(1, 'Covid - 19 Kota Sintang', 'Tingkat Penyebaran yang terjadi di Kota Sintang', 'img.jpg', 'Ferry', 'Kesehatan', '2021-12-01'),
(2, 'Teknologi Terbaru Tahun 2020/2021', 'Perkembangan teknologi makin maju', 'imgteknologi.jpg', 'Ferry', 'Teknologi', '2021-12-17'),
(3, 'Kompetesisi Nyanyi', 'di Kota Jakarta terdapat audisi nyanyi', 'img1.jpg', 'Ferry', 'Bisnis', '2021-12-01'),
(4, 'Teknologi 3', 'Proyek Perkembangan 3', 'url3.jpg', 'Ferry', 'Teknologi', '2021-12-24'),
(5, 'Teknologi 4', 'Proyek Perkembangan 4', 'url3.jpg', 'Ferry', 'Teknologi', '2021-12-27'),
(6, 'Teknologi 5', 'Proyek Perkembangan 5', 'url4.jpg', 'Ferry', 'Teknologi', '2021-12-29'),
(7, 'Teknologi 6', 'Proyek Perkembangan 6', 'url4.jpg', 'Ferry', 'Teknologi', '2021-12-30'),
(8, 'Teknologi 7', 'Proyek Perkembangan 7', 'url4.jpg', 'Ferry', 'Teknologi', '2021-12-31'),
(9, 'Kesehatan 7', 'Proyek Perkembangan Kesehatan', 'url4.jpg', 'Ferry', 'Keseshatan', '2021-12-01'),
(10, 'Kesehatan 1', 'Proyek Perkembangan Kesehatan', 'url4.jpg', 'Ferry', 'Kesehatan', '2021-12-01'),
(11, 'Kesehatan 2', 'Proyek Perkembangan Kesehatan', 'url4.jpg', 'Ferry', 'Kesehatan', '2021-12-01'),
(12, 'Kesehatan 3', 'Proyek Perkembangan Kesehatan', 'url4.jpg', 'Ferry', 'Kesehatan', '2021-12-01'),
(13, 'Kesehatan 4', 'Proyek Perkembangan Kesehatan', 'url4.jpg', 'Ferry', 'Kesehatan', '2021-12-11'),
(15, 'Olahraga 1', 'Proyek Perkembangan Bisnis', 'url4.jpg', 'Ferry', 'Olahraga', '2021-12-11'),
(16, 'Olahraga 2', 'Proyek Perkembangan Bisnis', 'url4.jpg', 'Ferry', 'Olahraga', '2021-12-11'),
(17, 'Olahraga 3', 'Proyek Perkembangan Bisnis', 'url4.jpg', 'Ferry', 'Olahraga', '2021-12-11'),
(18, 'Bisnis 4', 'Proyek Perkembangan Bisnis', 'url4.jpg', 'Ferry', 'Olahraga', '2021-12-11'),
(19, 'Olahraga 4', 'Proyek Perkembangan Bisnis', 'url4.jpg', 'Ferry', 'Olahraga', '2021-12-11'),
(20, 'Olahraga 5', 'Proyek Perkembangan Bisnis', 'url4.jpg', 'Ferry', 'Olahraga', '2021-12-11'),
(21, 'Hiburan 1', 'Proyek Perkembangan Hiburan', 'url4.jpg', 'Ferry', 'Hiburan', '2021-12-11'),
(22, 'Hiburan 2', 'Proyek Perkembangan Hiburan', 'url4.jpg', 'Ferry', 'Hiburan', '2021-12-11'),
(23, 'Hiburan 3', 'Proyek Perkembangan Hiburan', 'url4.jpg', 'Ferry', 'Hiburan', '2021-12-11'),
(24, 'Hiburan 4', 'Proyek PerkembanganHiburanBisnis', 'url4.jpg', 'Ferry', 'Hiburan', '2021-12-11'),
(25, 'Hiburan 4', 'Proyek Perkembangan Hiburan', 'url4.jpg', 'Ferry', 'Hiburan', '2021-12-11'),
(26, 'Hiburan 5', 'Proyek Perkembangan Hiburan', 'url4.jpg', 'Ferry', 'Hiburan', '2021-12-11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
