-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2026 pada 14.05
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serada`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `sraddha_adm_login`
--

CREATE TABLE `sraddha_adm_login` (
  `id_user` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sraddha_adm_login`
--

INSERT INTO `sraddha_adm_login` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'sraddhaadmin', 'srdcoffeeadm11111', 0),
(2, 'ghazi', '123', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sraddha_menu`
--

CREATE TABLE `sraddha_menu` (
  `id` int(10) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `kategori_produk` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `gambar_produk` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sraddha_menu`
--

INSERT INTO `sraddha_menu` (`id`, `nama_produk`, `deskripsi_produk`, `kategori_produk`, `harga`, `gambar_produk`) VALUES
(1, 'SWEET TEA', 'Minuman Tea dari beragai bunga yang menyegarkan', 'Minuman', 13000, '4a532badd7524b2c83d1b09c242d484a.jpg'),
(2, 'TALA LATTEE', 'Minuman Taro yang dicampur susu yang membuat segar', 'Minuman', 24000, '5b094fe4b6f14c40b3995411ee10d546.jpg'),
(3, 'CHOCO LATTEE', 'Cokelat klasik dengan rasa rich & creamy dari bubuk kakao berkualitas. Disajikan dengan susu segar dan es, cocok untuk semua umur!', 'Minuman', 24000, '8a253fd620d54f899ae05a0c1b9f76d5.jpg'),
(4, 'MALLA LATTEE', 'Rasa matcha Jepang yang khas, dikombinasikan dengan susu segar dan sedikit manis. Pilihan sehat untuk hari yang produktif.', 'Minuman', 25000, '31b913f0a0e349938258cd1f54a63462.jpg'),
(5, 'KOPSU GA', 'Racikan kopi robusta lokal dengan susu segar dan manisnya gula aren alami. Favorit semua kalangan!', 'Minuman', 23000, '40b89b1466ae401b9ece1730db78e171.jpg'),
(6, 'KOPSU DAN', 'Inovasi kopi kekinian yang menggabungkan aroma khas daun pandan dengan kopi dan susu. Wangi dan rasa unik, bikin penasaran!', 'Minuman', 24000, '49b79ea59f364293a02b0af1ff62c34a.jpg'),
(7, 'MASTRALA', 'Perpaduan unik dan menyegarkan dari matcha Jepang dan stroberi segar. Rasanya creamy, asam manis, dan bikin nagih!', 'Minuman', 28000, '106a83256f354f39b595534c3f16bb2d.jpg'),
(9, 'MIX PLATTER 1', 'Mix Platter 1 adalah kombinasi sempurna dari tiga camilan favorit:\r\n\r\nKentang goreng crispy yang renyah di luar, lembut di dalam,\r\n\r\nSosis goreng yang juicy dan gurih,\r\n\r\nserta otak-otak goreng dengan aroma ikan yang khas dan nikmat.\r\n\r\nSemua disajikan hangat dengan saus sambal dan mayonnaise/keju sebagai pelengkap yang bikin makin nagih!\r\n\r\nCocok dinikmati sendiri maupun bareng teman — pas banget buat temani waktu santai atau ngobrol bareng.', 'Makanan', 35000, 'IMG-20250623-WA0008.jpg'),
(10, 'DIMSUM', 'Dimsum khas oriental dengan isian daging ayam cincang yang lembut, dibumbui rempah pilihan.', 'Makanan', 25000, 'IMG-20250623-WA0009.jpg'),
(11, 'FRENCH FRIES', 'Kentang goreng renyah dan gurih, digoreng sempurna hingga keemasan.\r\nCocok dinikmati sebagai camilan ringan atau teman ngobrol.\r\nDisajikan dengan saus sambal dan mayonnaise yang bikin makin nikmat', 'Makanan', 20000, 'IMG-20250623-WA0010.jpg'),
(12, 'DONAT KENTANG', 'Donat klasik berbahan dasar kentang yang lembut dan empuk, ditaburi gula halus yang manis dan menggoda.\r\nTeksturnya fluffy, aromanya harum, dan rasanya bikin nostalgia!', 'Makanan', 15000, 'IMG-20250623-WA0011.jpg'),
(13, 'MIX PLATTER 2', 'Paket camilan praktis dengan rasa yang maksimal!\r\nMix Platter 2 menghadirkan kombinasi gurih dan renyah dalam satu sajian:\r\n\r\nKentang goreng crispy – renyah di luar, lembut di dalam\r\n\r\nChicken nugget – nugget ayam pilihan, gurih dan crunchy\r\n\r\nSiomay goreng – isian daging yang padat dan berbumbu, dibalut kulit tipis yang digoreng garing\r\n\r\nDisajikan dengan saus sambal dan mayo/keju yang creamy dan bikin nagih.\r\n\r\nPilihan pas untuk ngemil sendiri atau dinikmati bareng teman.', 'Makanan', 35000, 'IMG-20250623-WA0012.jpg'),
(14, 'CIRENG RUJAK', 'Cireng (aci digoreng) yang crispy di luar dan kenyal di dalam, disajikan dengan sambal rujak khas yang pedas, manis, dan segar.\r\nPerpaduan tekstur dan rasa yang unik, bikin susah berhenti ngunyah!', 'Makanan', 24000, 'IMG-20250623-WA0013.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sraddha_order`
--

CREATE TABLE `sraddha_order` (
  `id_order` int(11) NOT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `produk_dipesan` text DEFAULT NULL,
  `pembayaran` varchar(20) DEFAULT NULL,
  `harga` text NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `total_harga` int(11) NOT NULL DEFAULT 0,
  `tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `sraddha_adm_login`
--
ALTER TABLE `sraddha_adm_login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `sraddha_menu`
--
ALTER TABLE `sraddha_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sraddha_order`
--
ALTER TABLE `sraddha_order`
  ADD PRIMARY KEY (`id_order`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `sraddha_adm_login`
--
ALTER TABLE `sraddha_adm_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sraddha_menu`
--
ALTER TABLE `sraddha_menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `sraddha_order`
--
ALTER TABLE `sraddha_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
