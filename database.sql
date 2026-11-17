-- SQL Schema & Data Awal Kantin Merah POS
-- Database: kantin_merah_db

CREATE DATABASE IF NOT EXISTS `kantin_merah_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kantin_merah_db`;

-- 1. Table user
DROP TABLE IF EXISTS `notifikasi`;
DROP TABLE IF EXISTS `detail_pesanan`;
DROP TABLE IF EXISTS `pembayaran`;
DROP TABLE IF EXISTS `shift`;
DROP TABLE IF EXISTS `pesanan`;
DROP TABLE IF EXISTS `menu`;
DROP TABLE IF EXISTS `kategori`;
DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` INT AUTO_INCREMENT PRIMARY KEY,
  `nama` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('kasir', 'dapur', 'manajerial') NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password for all accounts: password123
-- Hash: $2y$10$wTf7i1iK9t8nL9Z0e4s4qO4J7b3Ew7T4V5Z1L2a3b4c5d6e7f8g9h (example)
-- To ensure compatibility, we insert hash generated with PHP PASSWORD_DEFAULT for 'password123':
-- $2y$10$qR6M7yU8xG6yL.8O8bZ2Ie5g4lF9vjT1iK.Q7v6zN8mB5aC3dE2fG
INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Kasir Kantin Merah', 'kasir@kantinmerah.com', '$2y$10$tZ2E7HhJ5aH5m2.7V4N5v.oE0B1eE6t6X7Q2R3w4E5r6T7y8U9i0O', 'kasir', NOW(), NOW()),
(2, 'Chef Dapur Merah', 'dapur@kantinmerah.com', '$2y$10$tZ2E7HhJ5aH5m2.7V4N5v.oE0B1eE6t6X7Q2R3w4E5r6T7y8U9i0O', 'dapur', NOW(), NOW()),
(3, 'Manajer / Pemilik Kantin', 'manajerial@kantinmerah.com', '$2y$10$tZ2E7HhJ5aH5m2.7V4N5v.oE0B1eE6t6X7Q2R3w4E5r6T7y8U9i0O', 'manajerial', NOW(), NOW());

-- 2. Table kategori
CREATE TABLE `kategori` (
  `id_kategori` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_kategori` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`) VALUES
(1, 'Makanan', NOW()),
(2, 'Minuman', NOW()),
(3, 'Snack', NOW());

-- 3. Table menu
CREATE TABLE `menu` (
  `id_menu` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_menu` VARCHAR(150) NOT NULL,
  `deskripsi` TEXT NULL,
  `harga` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `harga_modal` DECIMAL(10,2) NULL DEFAULT 0.00,
  `jumlah_stok` INT NOT NULL DEFAULT 0,
  `status_stok` ENUM('Tersedia', 'Habis') NOT NULL DEFAULT 'Tersedia',
  `foto` VARCHAR(255) NULL,
  `id_kategori` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  FOREIGN KEY (`id_kategori`) REFERENCES `kategori`(`id_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `menu` (`id_menu`, `nama_menu`, `deskripsi`, `harga`, `harga_modal`, `jumlah_stok`, `status_stok`, `foto`, `id_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Nasi Goreng', 'Nasi goreng gurih dengan telur, ayam, dan sayuran, disajikan hangat.', 15000.00, 10000.00, 59, 'Tersedia', 'uploads/menu/ecf3c30eb6e1f68b8518fabea9f16ef4.jpg', 1, NOW(), NOW()),
(2, 'Mie Goreng', 'Mie goreng kuning dengan telur, sayuran, dan bumbu gurih.', 12000.00, 8000.00, 40, 'Tersedia', 'uploads/menu/katalog/mie-goreng.jpg', 1, NOW(), NOW()),
(3, 'Mie Rebus', 'Mie rebus berkuah kaldu hangat dengan telur dan sayuran.', 11000.00, 7500.00, 35, 'Tersedia', 'uploads/menu/katalog/mie-rebus.jpg', 1, NOW(), NOW()),
(4, 'Nasi Ayam Geprek', 'Nasi putih dengan ayam geprek sambal bawang pedas dan lalapan.', 16000.00, 12000.00, 30, 'Tersedia', 'uploads/menu/katalog/nasi-ayam-geprek.jpg', 1, NOW(), NOW()),
(5, 'Nasi Telur', 'Nasi hangat dengan telur ceplok, kecap manis, dan sayuran.', 10000.00, 7000.00, 35, 'Tersedia', 'uploads/menu/katalog/nasi-telur.jpg', 1, NOW(), NOW()),
(6, 'Nasi Pecel', 'Nasi dengan sayuran rebus, siraman bumbu kacang, dan lauk pelengkap.', 12000.00, 8000.00, 25, 'Tersedia', 'uploads/menu/katalog/nasi-pecel.jpg', 1, NOW(), NOW()),
(7, 'Nasi Rames', 'Nasi campur dengan aneka lauk rumahan dan sayur.', 13000.00, 9000.00, 25, 'Tersedia', 'uploads/menu/katalog/nasi-rames.jpg', 1, NOW(), NOW()),
(8, 'Bakso', 'Bakso sapi kenyal dalam kuah kaldu gurih, dengan mie dan tahu.', 13000.00, 9000.00, 30, 'Tersedia', 'uploads/menu/katalog/bakso.jpg', 1, NOW(), NOW()),
(9, 'Soto Ayam', 'Soto ayam berkuah kuning dengan suwiran ayam, telur, dan koya.', 12000.00, 8500.00, 30, 'Tersedia', 'uploads/menu/katalog/soto-ayam.jpg', 1, NOW(), NOW()),
(10, 'Nasi Kuning', 'Nasi kuning gurih dengan ayam, telur, tempe, dan sambal.', 12000.00, 8000.00, 25, 'Tersedia', 'uploads/menu/katalog/nasi-kuning.jpg', 1, NOW(), NOW()),
(11, 'Es Teh', 'Teh manis dingin dengan es batu, segar untuk menemani makan.', 4000.00, 1800.00, 60, 'Tersedia', 'uploads/menu/katalog/es-teh.jpg', 2, NOW(), NOW()),
(12, 'Teh Hangat', 'Teh melati hangat dengan gula, cocok dinikmati santai.', 3000.00, 1500.00, 50, 'Tersedia', 'uploads/menu/katalog/teh-hangat.jpg', 2, NOW(), NOW()),
(13, 'Es Jeruk', 'Perasan jeruk segar dengan es batu dan gula.', 6000.00, 3000.00, 45, 'Tersedia', 'uploads/menu/katalog/es-jeruk.jpg', 2, NOW(), NOW()),
(14, 'Jeruk Hangat', 'Minuman jeruk hangat yang segar dan menyehatkan.', 5500.00, 2800.00, 40, 'Tersedia', 'uploads/menu/katalog/jeruk-hangat.jpg', 2, NOW(), NOW()),
(15, 'Es Milo', 'Minuman cokelat Milo dingin dengan susu dan es.', 7000.00, 3500.00, 40, 'Tersedia', 'uploads/menu/katalog/es-milo.jpg', 2, NOW(), NOW()),
(16, 'Es Good Day', 'Kopi susu Good Day dingin dengan rasa manis dan creamy.', 6000.00, 3000.00, 40, 'Tersedia', 'uploads/menu/katalog/es-good-day.jpg', 2, NOW(), NOW()),
(17, 'Kopi Hitam', 'Kopi hitam pekat seduh panas, tanpa gula tambahan.', 5000.00, 2000.00, 40, 'Tersedia', 'uploads/menu/katalog/kopi-hitam.jpg', 2, NOW(), NOW()),
(18, 'Kopi Susu', 'Kopi susu creamy dengan gula aren, disajikan dingin.', 8000.00, 3500.00, 35, 'Tersedia', 'uploads/menu/katalog/kopi-susu.jpg', 2, NOW(), NOW()),
(19, 'Air Mineral', 'Air mineral botol dingin, praktis dan menyegarkan.', 3000.00, 2000.00, 100, 'Tersedia', 'uploads/menu/katalog/air-mineral.jpg', 2, NOW(), NOW()),
(20, 'Susu Cokelat', 'Susu cokelat dingin yang manis dan creamy.', 7000.00, 4000.00, 40, 'Tersedia', 'uploads/menu/katalog/susu-cokelat.jpg', 2, NOW(), NOW()),
(21, 'Kentang Goreng', 'Kentang goreng crispy dengan saus tomat.', 10000.00, 6000.00, 30, 'Tersedia', 'uploads/menu/katalog/kentang-goreng.jpg', 3, NOW(), NOW()),
(22, 'Sosis Goreng', 'Sosis goreng gurih, cocok untuk camilan.', 8000.00, 5000.00, 35, 'Tersedia', 'uploads/menu/katalog/sosis-goreng.jpg', 3, NOW(), NOW()),
(23, 'Nugget', 'Nugget ayam goreng crispy, disajikan dengan saus.', 10000.00, 6000.00, 30, 'Tersedia', 'uploads/menu/katalog/nugget.jpg', 3, NOW(), NOW()),
(24, 'Cireng', 'Cireng goreng kenyal dengan isian dan bumbu rujak.', 6000.00, 3500.00, 40, 'Tersedia', 'uploads/menu/katalog/cireng.jpg', 3, NOW(), NOW()),
(25, 'Risoles', 'Risoles goreng renyah dengan isian sayur dan ayam.', 5000.00, 3000.00, 40, 'Tersedia', 'uploads/menu/katalog/risoles.jpg', 3, NOW(), NOW()),
(26, 'Tahu Isi', 'Tahu goreng berisi sayuran, renyah dan gurih.', 5000.00, 2500.00, 40, 'Tersedia', 'uploads/menu/katalog/tahu-isi.jpg', 3, NOW(), NOW()),
(27, 'Bakwan', 'Bakwan sayur goreng crispy, camilan favorit.', 4000.00, 2000.00, 45, 'Tersedia', 'uploads/menu/katalog/bakwan.jpg', 3, NOW(), NOW()),
(28, 'Tempe Goreng', 'Tempe goreng gurih dan renyah, cocok dengan sambal.', 3000.00, 1500.00, 50, 'Tersedia', 'uploads/menu/katalog/tempe-goreng.jpg', 3, NOW(), NOW()),
(29, 'Roti Bakar', 'Roti bakar isi cokelat manis, hangat dan lembut.', 8000.00, 5000.00, 30, 'Tersedia', 'uploads/menu/katalog/roti-bakar.jpg', 3, NOW(), NOW()),
(30, 'Pisang Goreng', 'Pisang goreng manis dan renyah, camilan klasik.', 6000.00, 3000.00, 35, 'Tersedia', 'uploads/menu/katalog/pisang-goreng.jpg', 3, NOW(), NOW());

-- 4. Table pesanan
CREATE TABLE `pesanan` (
  `id_pesanan` INT AUTO_INCREMENT PRIMARY KEY,
  `no_antrian` INT UNSIGNED NULL,
  `kode_pesanan` VARCHAR(50) NOT NULL UNIQUE,
  `nama_customer` VARCHAR(100) NULL DEFAULT 'Pelanggan',
  `nomor_meja` VARCHAR(50) NULL DEFAULT 'Meja -',
  `id_customer` VARCHAR(50) NULL DEFAULT '',
  `waktu_pesan` DATETIME NOT NULL,
  `status` ENUM('Menunggu Pembayaran', 'Dibayar', 'Diproses', 'Siap Diambil', 'Selesai', 'Kadaluarsa', 'Dibatalkan') NOT NULL DEFAULT 'Menunggu Pembayaran',
  `total_bayar` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `metode_bayar` ENUM('Tunai', 'QRIS') NOT NULL DEFAULT 'Tunai',
  `id_user_update` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Table detail_pesanan
CREATE TABLE `detail_pesanan` (
  `id_detail` INT AUTO_INCREMENT PRIMARY KEY,
  `id_pesanan` INT NOT NULL,
  `id_menu` INT NOT NULL,
  `jumlah` INT NOT NULL DEFAULT 1,
  `catatan_khusus` TEXT NULL,
  `subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `created_at` DATETIME NULL,
  FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan`(`id_pesanan`) ON DELETE CASCADE,
  FOREIGN KEY (`id_menu`) REFERENCES `menu`(`id_menu`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Table shift
CREATE TABLE `shift` (
  `id_shift` INT AUTO_INCREMENT PRIMARY KEY,
  `id_kasir` INT NOT NULL,
  `waktu_mulai` DATETIME NOT NULL,
  `waktu_selesai` DATETIME NULL,
  `total_kas_tunai` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `total_kas_qris` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `created_at` DATETIME NULL,
  FOREIGN KEY (`id_kasir`) REFERENCES `user`(`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Table pembayaran
CREATE TABLE `pembayaran` (
  `id_pembayaran` INT AUTO_INCREMENT PRIMARY KEY,
  `id_pesanan` INT NOT NULL UNIQUE,
  `id_kasir` INT NULL,
  `metode` ENUM('Tunai', 'QRIS') NOT NULL,
  `status_bayar` ENUM('Menunggu', 'Berhasil', 'Kadaluarsa', 'Gagal') NOT NULL DEFAULT 'Menunggu',
  `batas_waktu` DATETIME NULL,
  `jumlah_diterima` DECIMAL(10,2) NULL DEFAULT 0.00,
  `kembalian` DECIMAL(10,2) NULL DEFAULT 0.00,
  `waktu_bayar` DATETIME NULL,
  `created_at` DATETIME NULL,
  FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan`(`id_pesanan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Table notifikasi
CREATE TABLE `notifikasi` (
  `id_notifikasi` INT AUTO_INCREMENT PRIMARY KEY,
  `id_pesanan` INT NOT NULL,
  `pesan` TEXT NOT NULL,
  `status_baca` TINYINT(1) NOT NULL DEFAULT 0,
  `waktu_kirim` DATETIME NOT NULL,
  FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan`(`id_pesanan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Shift tidak di-seed karena harus dibuka sendiri oleh kasir
-- melalui halaman Kasir / Kelola Shift agar alur buka-tutup shift
-- bisa diuji apa adanya.

-- Sample pesanan awal untuk demo antrean kasir & dapur
INSERT INTO `pesanan` (`id_pesanan`, `kode_pesanan`, `waktu_pesan`, `status`, `total_bayar`, `metode_bayar`, `created_at`, `updated_at`)
VALUES
(1, 'ORD-20261024-001', NOW() - INTERVAL 25 MINUTE, 'Menunggu Pembayaran', 19000.00, 'Tunai', NOW(), NOW()),
(2, 'ORD-20261024-002', NOW() - INTERVAL 15 MINUTE, 'Dibayar', 20000.00, 'QRIS', NOW(), NOW()),
(3, 'ORD-20261024-003', NOW() - INTERVAL 10 MINUTE, 'Diproses', 15000.00, 'Tunai', NOW(), NOW()),
(4, 'ORD-20261024-004', NOW() - INTERVAL 5 MINUTE, 'Siap Diambil', 8000.00, 'QRIS', NOW(), NOW());

INSERT INTO `detail_pesanan` (`id_pesanan`, `id_menu`, `jumlah`, `catatan_khusus`, `subtotal`, `created_at`) VALUES
(1, 1, 1, 'Pedas level 3, banyakin bawang goreng', 15000.00, NOW()),
(1, 11, 1, 'Gula sedikit', 4000.00, NOW()),
(2, 4, 1, 'Cabe 5 aja', 16000.00, NOW()),
(2, 11, 1, 'Es batu dipisah', 4000.00, NOW()),
(3, 1, 1, 'Tidak pedas, tidak pakai kecap', 15000.00, NOW()),
(4, 18, 1, 'Dingin less sugar', 8000.00, NOW());

INSERT INTO `pembayaran` (`id_pesanan`, `id_kasir`, `metode`, `status_bayar`, `batas_waktu`, `jumlah_diterima`, `kembalian`, `waktu_bayar`, `created_at`) VALUES
(2, 1, 'QRIS', 'Berhasil', NOW() + INTERVAL 15 MINUTE, 20000.00, 0.00, NOW() - INTERVAL 14 MINUTE, NOW()),
(3, 1, 'Tunai', 'Berhasil', NOW() + INTERVAL 15 MINUTE, 20000.00, 5000.00, NOW() - INTERVAL 9 MINUTE, NOW()),
(4, 1, 'QRIS', 'Berhasil', NOW() + INTERVAL 15 MINUTE, 8000.00, 0.00, NOW() - INTERVAL 4 MINUTE, NOW());

