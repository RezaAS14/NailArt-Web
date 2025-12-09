-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 09 Des 2025 pada 01.47
-- Versi server: 8.0.30
-- Versi PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `db_nailart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accessories`
--

CREATE TABLE `accessories` (
  `id_produk` int NOT NULL,
  `gambar_produk` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_produk` decimal(12,2) NOT NULL,
  `diskon` decimal(5,2) DEFAULT '0.00',
  `deskripsi_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `stok_tersedia` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `accessories`
--

INSERT INTO `accessories` (`id_produk`, `gambar_produk`, `nama_produk`, `harga_produk`, `diskon`, `deskripsi_produk`, `stok_tersedia`) VALUES
(1, '1764825028_19e0cef00083a1ab34eb.png', 'NAIL FILE', 90800.00, 12.00, 'Nail file adalah alat perawatan kuku yang digunakan untuk membentuk, merapikan, dan menghaluskan ujung kuku agar tampak rapi dan bersih. Alat ini biasanya terbuat dari bahan seperti kertas amplas halus, kaca, logam, atau kristal, dan sering digunakan dalam perawatan manicure maupun pedicure. Dengan teksturnya yang abrasif, nail file membantu menghilangkan bagian kuku yang kasar atau tidak rata sehingga menghasilkan bentuk kuku yang lebih estetik dan nyaman.', 48),
(2, '1764825743_2a59f8391ba7a833565b.png', 'CUTICLE PUSHER', 30000.00, 10.00, 'Cuticle pusher adalah alat perawatan kuku yang digunakan untuk mendorong dan merapikan kutikula, yaitu lapisan tipis kulit di sekitar pangkal kuku. Alat ini biasanya terbuat dari stainless steel, kayu, atau plastik, dan memiliki dua ujung berbeda—satu untuk mendorong kutikula secara lembut, dan satu lagi untuk membersihkan kotoran serta sisa kulit mati di area kuku. Dalam proses manicure maupun pedicure, cuticle pusher membantu menciptakan tampilan kuku yang lebih bersih, rapi, dan siap untuk diaplikasikan cat kuku. Penggunaan alat ini secara teratur dapat mencegah penumpukan kutikula, mengurangi risiko iritasi, serta membuat kuku tampak lebih sehat dan terawat. Karena kepraktisannya, cuticle pusher menjadi salah satu perlengkapan wajib dalam rutinitas perawatan kuku di rumah maupun di salon profesional.', 49),
(3, '1764826961_7f1ed9e9ffd6e1bedd6a.png', 'CUTICLE NIPPER', 115000.00, 20.00, 'Cuticle nipper adalah alat perawatan kuku berbentuk tang kecil yang digunakan untuk memotong kutikula berlebih, kulit mati, maupun hangnail di sekitar pangkal kuku. Alat ini umumnya terbuat dari stainless steel dengan ujung yang tajam dan presisi, sehingga mampu membersihkan area kutikula dengan rapi tanpa merusak kulit sehat. Cuticle nipper membantu membuat kuku tampak lebih bersih, halus, dan siap untuk proses manicure atau pedicure.', 49),
(4, '1764832688_6466b4f9c89b5edbe3b9.png', 'NAIL BRUSH', 58000.00, 50.00, 'Nail brush adalah sikat kecil yang digunakan untuk membersihkan kuku dan area sekitarnya dari kotoran, debu, dan sisa-sisa produk perawatan. Dengan bulu sikat yang lembut namun efektif, alat ini membantu menjaga kebersihan kuku sebelum dan sesudah manicure atau pedicure. Nail brush juga berguna untuk membersihkan permukaan kuku agar lebih siap menerima produk seperti base coat atau nail polish, sehingga hasil akhirnya tampak lebih rapi dan higienis.', 50),
(5, '1764832819_d6089651f70ecc932b2f.png', 'BASE COAT', 78960.00, 50.00, 'Base coat adalah lapisan dasar yang diaplikasikan sebelum cat kuku untuk melindungi permukaan kuku dan meningkatkan daya rekat nail polish. Produk ini membantu mencegah pewarnaan kuku menjadi kusam atau menguning, sekaligus membuat hasil cat kuku lebih halus, rata, dan tahan lama. Dengan penggunaan base coat, manicure menjadi lebih rapi dan kuku tetap terlindungi dari kerusakan.', 50),
(6, '1764832900_c003e594f6ddcee4cb52.png', 'TOP COAT', 149950.00, 80.00, 'Top coat adalah lapisan akhir yang diaplikasikan di atas cat kuku untuk memberikan perlindungan ekstra sekaligus menambah kilau pada hasil manicure. Produk ini membantu mencegah cat kuku mudah terkelupas, menggores, atau pudar, sehingga warna tetap terlihat segar dan tahan lebih lama. Dengan top coat, hasil akhir kuku tampak lebih rapi, berkilau, dan profesional.', 50),
(7, '1765244262_083653bdde41ad4840f3.png', 'NAIL POLISHER', 49000.00, 12.00, 'Nail polisher adalah alat yang digunakan untuk menghaluskan permukaan kuku dan memberikan kilau alami tanpa perlu menggunakan cat kuku. Dengan beberapa sisi bertekstur berbeda, nail polisher membantu meratakan permukaan kuku yang bergelombang, mengangkat kusam, serta membuat kuku tampak lebih sehat dan berkilau. Alat ini ideal digunakan sebelum manicure agar hasilnya lebih rapi dan halus.', 50),
(8, '1765244330_3d3b4eced7af688299a0.png', 'GLITTERS', 199999.00, 57.00, 'Glitters adalah butiran berkilau berukuran kecil yang digunakan untuk menambah efek dekoratif pada nail art. Dengan berbagai bentuk, warna, dan tingkat kilap, glitters dapat memberikan tampilan kuku yang lebih menarik, glamor, dan penuh dimensi. Biasanya diaplikasikan di atas cat kuku atau gel, kemudian disegel dengan top coat agar hasilnya tahan lama dan tidak mudah rontok.', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int NOT NULL,
  `id_user` int NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `tanggal_checkout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `id_user`, `total_harga`, `tanggal_checkout`) VALUES
(20, 2, 92000.00, '2025-12-04 10:17:16'),
(23, 2, 92000.00, '2025-12-09 01:22:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_checkout`
--

CREATE TABLE `detail_checkout` (
  `id_detailco` int NOT NULL,
  `id_checkout` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah_checkout` int NOT NULL,
  `harga_checkout` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_checkout`
--

INSERT INTO `detail_checkout` (`id_detailco`, `id_checkout`, `id_produk`, `jumlah_checkout`, `harga_checkout`) VALUES
(2, 20, 3, 1, 92000.00),
(5, 23, 3, 1, 92000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int NOT NULL,
  `gambar_gallery` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_gallery` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `gambar_gallery`, `deskripsi_gallery`) VALUES
(1, '1764822513_fd4118cbd26d0595396c.jpg', 'Nail art elegan dengan warna natural.'),
(2, '1764822539_6858a60aba20dfd3574a.jpg', 'Desain kuku modern warna maroon gelap.'),
(3, '1764822566_327c161adb969a5f35c6.jpg', 'Kuku motif marmer tampak elegan.'),
(4, '1764822640_63555e1f2e7033ba0356.jpg', 'Nail art glossy dengan nuansa biru.'),
(5, '1764822679_4483f60a1feb1ca04fef.jpg', 'Desain kuku marmer kombinasi cantik.'),
(6, '1764822719_fb3847110b9ad10c3859.jpg', 'Nail art silver glitter dengan motif bunga & pita.'),
(7, '1764822766_eb21bd9e7770a3ded32e.jpg', 'Nail art abstrak biru lembut.'),
(8, '1764822804_dd1c22b27d7abf4c0761.jpg', 'Kuku gel merah elegan mengkilap seperti mawar.'),
(9, '1765243825_88c402f521745c67e0e4.jpg', 'Nail art nude dengan detail minimalis.'),
(10, '1765243848_d53a2600c62a4ea811bd.jpg', 'Kuku warna hijau gel tampak mewah.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah_keranjang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `jumlah_keranjang`) VALUES
(13, 1, 2, 2),
(14, 1, 3, 1),
(15, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `models`
--

CREATE TABLE `models` (
  `id_models` int NOT NULL,
  `kategori_models` enum('Easy','Medium','Hard') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Easy',
  `gambar_models` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `durasi` decimal(5,2) NOT NULL,
  `harga_models` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `models`
--

INSERT INTO `models` (`id_models`, `kategori_models`, `gambar_models`, `durasi`, `harga_models`) VALUES
(1, 'Easy', '1764823138_4f25f0544678f9d9a978.jpg', 1.00, 70000.00),
(2, 'Easy', '1764823206_6f2b31b07bba478cfa77.png', 1.00, 65000.00),
(3, 'Easy', '1764823237_1097003e1fc2dacbb083.png', 1.00, 65000.00),
(4, 'Easy', '1764823250_1a37724d10b0cea265a3.png', 1.00, 65000.00),
(5, 'Easy', '1764823274_a052645bea77313a2f19.png', 1.00, 65000.00),
(6, 'Easy', '1764823292_03ef848178db54955e59.png', 1.00, 65000.00),
(7, 'Easy', '1764823319_b802d4f3ca2a50eeaa75.png', 1.00, 65000.00),
(8, 'Easy', '1764823419_99eac23317ff3ae885dd.png', 1.00, 70000.00),
(9, 'Medium', '1764823501_28b3d523a6ab05ea084f.jpg', 1.50, 120000.00),
(10, 'Medium', '1764823556_224713a7706a27a2f89e.png', 1.50, 90000.00),
(11, 'Medium', '1764823648_a0215d903df063969c20.png', 1.50, 90000.00),
(12, 'Medium', '1764823692_8c3f46e7bdad5ddd2e6d.png', 1.50, 120000.00),
(13, 'Medium', '1764823739_58b694ee3276a774e60b.png', 1.50, 120000.00),
(14, 'Medium', '1764823789_95e5065ccc4a8f6754cb.png', 1.50, 100000.00),
(15, 'Medium', '1764823844_ce27d5a8df6d7f1f86c3.png', 1.50, 90000.00),
(16, 'Medium', '1764823876_67049f996ff714b2d1c4.png', 1.50, 100000.00),
(17, 'Hard', '1764823974_181e76ed914016fa0e73.png', 2.30, 160000.00),
(18, 'Hard', '1764824014_1ff444861667b8780430.png', 2.30, 160000.00),
(19, 'Hard', '1764824038_49c533d3bf4043fd791f.png', 2.30, 160000.00),
(20, 'Hard', '1764824065_f2d3a67bc28849a2a6af.png', 2.30, 160000.00),
(21, 'Hard', '1764824081_6360f1c45078088d2ab9.png', 2.30, 160000.00),
(22, 'Hard', '1764824137_14c7708d0210fb57944f.png', 5.00, 250000.00),
(23, 'Hard', '1764824192_0a275e157c1a47330972.png', 2.00, 150000.00),
(24, 'Hard', '1764824249_17b6318266bdaa9e7354.png', 3.00, 180000.00),
(25, 'Easy', '1765243945_4116ec9642e971d89028.png', 1.00, 65000.00),
(26, 'Easy', '1765243973_88a9585470440b7ea72a.png', 1.00, 65000.00),
(27, 'Medium', '1765244044_8fb21dd9881247f083e2.png', 1.50, 100000.00),
(28, 'Medium', '1765244076_65b7ae4cd7d65a13bc30.png', 1.50, 100000.00),
(29, 'Hard', '1765244129_87e06245a4270de8bdf8.png', 2.30, 160000.00),
(30, 'Hard', '1765244167_083a6e1176fa1670a293.png', 2.30, 170000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `id_checkout` int NOT NULL,
  `keterangan_pembayaran` enum('Belum Bayar','Menunggu Verifikasi','Lunas','Gagal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_pesanan` enum('Menunggu Pembayaran','Diproses','Dikemas','Dikirim','Selesai','Dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_checkout`, `keterangan_pembayaran`, `status_pesanan`) VALUES
(3, 23, 'Belum Bayar', 'Menunggu Pembayaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `gambar_user` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_depan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_belakang` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_telp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `gambar_user`, `username`, `nama_depan`, `nama_belakang`, `email`, `tanggal_lahir`, `no_telp`, `alamat`, `password`, `role`) VALUES
(1, NULL, 'admin', 'admin', 'admin', 'admin@gmail.com', NULL, NULL, NULL, 'admin123', 'admin'),
(2, '1764833702_3af8837b793706c99b0b.jpg', 'reza', 'Ahmad Reza', 'Aulia Siregar', 'ahmadrezaauliasiregar@gmail.com', '2005-02-18', '85179918132', 'Jalan Denai Gang Aneka', 'reza1234', 'user');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_checkout`
--
ALTER TABLE `detail_checkout`
  ADD PRIMARY KEY (`id_detailco`),
  ADD KEY `id_checkout` (`id_checkout`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id_models`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_checkout` (`id_checkout`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `detail_checkout`
--
ALTER TABLE `detail_checkout`
  MODIFY `id_detailco` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `models`
--
ALTER TABLE `models`
  MODIFY `id_models` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `detail_checkout`
--
ALTER TABLE `detail_checkout`
  ADD CONSTRAINT `detail_checkout_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `checkout` (`id_checkout`),
  ADD CONSTRAINT `detail_checkout_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `accessories` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `accessories` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `checkout` (`id_checkout`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
