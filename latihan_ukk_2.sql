-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Apr 2021 pada 06.41
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latihan_ukk_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Naufal', 'admin', 'admin', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `asal_sekolah` varchar(255) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `nis`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `asal_sekolah`, `kelas`, `jurusan`) VALUES
(1, '11806792', 'Naufal Hammam Al mubarok', 'Laki-laki', 'Kuningan', '2021-04-01', 'Gunung putri selatan', 'MTs Al ikhlas', 'x', 'RPL'),
(2, '11806767', 'Tyan', 'Laki-laki', 'Bogor lahir', '2021-04-01', 'Bogor', 'Jauh sekolah', 'x', 'TKJ'),
(4, '11806729', 'karina amanda putri', 'Perempuan', 'Tajur bogor', '2021-04-01', 'Tajur', 'MTs jauh', 'xi', 'Multimedia'),
(6, '11800001', 'siti rahmawati', 'Perempuan', 'bogor', '2021-04-01', 'cibalok', 'SMP Bogor', 'xi', 'TBG'),
(7, '11800002', 'Bintang Yudha', 'Laki-laki', 'Bogor Cisarua', '2021-04-01', 'Cisarua', 'SMP Cisarua bogor', 'xi', 'RPL'),
(8, '11800003', 'Raja dollar', 'Laki-laki', 'Bogor', '2021-02-01', 'Tidak diketahui', 'SMP Bogor', 'xii', 'HTL'),
(9, '11800004', 'Eka ', 'Perempuan', 'Kota Bogor', '2021-03-11', 'Bogor', 'SMP Bogor', 'x', 'RPL'),
(10, '11800005', 'Maya ayu', 'Perempuan', 'Kota bogor 2', '2021-12-31', 'Bogor 2', 'SMP Bogor 2', 'xi', 'RPL'),
(11, '11800006', 'Dimas Tegar ', 'Laki-laki', 'Luar daerah bogor', '2021-04-02', 'Luar bogor', 'SMP luar bogor', 'x', 'TKJ'),
(12, '11800007', 'Ridwan', 'Laki-laki', 'Cicurug bogor', '2021-02-04', 'Cicurug', 'MA Amaliah', 'xi', 'Multimedia'),
(13, '11800008', 'Amanda ', 'Perempuan', 'Bogor kota', '2021-03-04', 'Bogor', 'SMP Bogor kota', 'xii', 'OTKP');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
