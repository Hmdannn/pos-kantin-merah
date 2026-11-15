<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\KategoriModel;
use App\Models\PesananModel;

class CustomerController extends BaseController
{
    protected $menuModel;
    protected $kategoriModel;
    protected $pesananModel;

    public function __construct()
    {
        helper('url');

        $this->menuModel = new MenuModel();
        $this->kategoriModel = new KategoriModel();
        $this->pesananModel = new PesananModel();
    }

    public function index()
    {
        $this->ensureSampleData();

        $menu = $this->menuModel
            ->select('menu.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = menu.id_kategori'
            )
            ->orderBy('menu.nama_menu', 'ASC')
            ->findAll();

        $menu = $this->lengkapiFotoMenu($menu);

        $kategori = $this->kategoriModel
            ->orderBy('nama_kategori', 'ASC')
            ->findAll();

        // Jika request dari JavaScript (AJAX fetch Accept: application/json)
        if ($this->request->isAJAX()
            || $this->request->getGet('format') === 'json'
            || str_contains($this->request->getHeaderLine('Accept'), 'application/json')) {
            return $this->response->setJSON([
                'status' => true,
                'data'   => [
                    'kategori' => $kategori,
                    'menu'     => $menu
                ]
            ]);
        }

        // Tampilan HTML untuk browser
        return view('customer/index', [
            'menu'     => $menu,
            'kategori' => $kategori
        ]);
    }

    public function menuByKategori($idKategori)
    {
        $kategori = $this->kategoriModel->find($idKategori);

        if (!$kategori) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Kategori tidak ditemukan.'
            ]);
        }

        $menu = $this->menuModel
            ->select('menu.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = menu.id_kategori'
            )
            ->where('menu.id_kategori', $idKategori)
            ->orderBy('menu.nama_menu', 'ASC')
            ->findAll();

        $menu = $this->lengkapiFotoMenu($menu);

        return $this->response->setJSON([
            'status' => true,
            'data'   => [
                'kategori' => $kategori,
                'menu'     => $menu
            ]
        ]);
    }

    public function detailMenu($idMenu)
    {
        $menu = $this->menuModel
            ->select('menu.*, kategori.nama_kategori')
            ->join(
                'kategori',
                'kategori.id_kategori = menu.id_kategori'
            )
            ->find($idMenu);

        if (!$menu) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Menu tidak ditemukan.'
            ]);
        }

        $menu['foto'] = $this->fotoMenuUrl($menu['foto'] ?? null);

        return $this->response->setJSON([
            'status' => true,
            'data'   => $menu
        ]);
    }

    /**
     * Mengubah path foto relatif menjadi URL yang bisa dibuka browser.
     */
    private function lengkapiFotoMenu(array $menu): array
    {
        foreach ($menu as &$item) {
            $item['foto'] = $this->fotoMenuUrl($item['foto'] ?? null);
        }

        unset($item);

        return $menu;
    }

    private function fotoMenuUrl(?string $foto): ?string
    {
        if (!$foto) {
            return null;
        }

        if (preg_match('#^https?://#i', $foto)) {
            return $foto;
        }

        return base_url(ltrim(str_replace('\\', '/', $foto), '/'));
    }

    /**
     * Daftar pesanan yang sudah siap diambil.
     *
     * Menampilkan kode pesanan, nomor meja / ID, nama pemesan, total, dan waktu siap.
     */
    public function pesananSiap()
    {
        $pesanan = $this->pesananModel
            ->select('id_pesanan, kode_pesanan, nama_customer, nomor_meja, id_customer, waktu_pesan, total_bayar, metode_bayar, updated_at')
            ->where('status', 'Siap Diambil')
            ->orderBy('waktu_pesan', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $pesanan
        ]);
    }

    /**
     * Memastikan tabel kategori, menu, pesanan siap dan berisi menu awal
     */
    private function ensureSampleData()
    {
        try {
            $db = \Config\Database::connect();

            // 1. Tabel Kategori
            $db->query("CREATE TABLE IF NOT EXISTS `kategori` (
              `id_kategori` INT AUTO_INCREMENT PRIMARY KEY,
              `nama_kategori` VARCHAR(100) NOT NULL,
              `created_at` DATETIME NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

            // 2. Tabel Menu
            $db->query("CREATE TABLE IF NOT EXISTS `menu` (
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
              `updated_at` DATETIME NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

            // Lengkapi kolom baru jika tabel menu sudah ada dari versi lama.
            if (!$db->fieldExists('deskripsi', 'menu')) {
                $db->query("ALTER TABLE `menu` ADD `deskripsi` TEXT NULL AFTER `nama_menu`");
            }

            if (!$db->fieldExists('harga_modal', 'menu')) {
                $db->query("ALTER TABLE `menu` ADD `harga_modal` DECIMAL(10,2) NULL DEFAULT 0.00 AFTER `harga`");
            }

            // 3. Tabel Pesanan & Relasi
            $db->query("CREATE TABLE IF NOT EXISTS `pesanan` (
              `id_pesanan` INT AUTO_INCREMENT PRIMARY KEY,
              `kode_pesanan` VARCHAR(50) NOT NULL UNIQUE,
              `nama_customer` VARCHAR(100) NULL,
              `nomor_meja` VARCHAR(50) NULL,
              `id_customer` VARCHAR(50) NULL,
              `waktu_pesan` DATETIME NOT NULL,
              `status` ENUM('Menunggu Pembayaran', 'Dibayar', 'Diproses', 'Siap Diambil', 'Selesai', 'Kadaluarsa', 'Dibatalkan') NOT NULL DEFAULT 'Menunggu Pembayaran',
              `total_bayar` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
              `metode_bayar` ENUM('Tunai', 'QRIS') NOT NULL DEFAULT 'Tunai',
              `id_user_update` INT NULL,
              `created_at` DATETIME NULL,
              `updated_at` DATETIME NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

            $db->query("CREATE TABLE IF NOT EXISTS `detail_pesanan` (
              `id_detail` INT AUTO_INCREMENT PRIMARY KEY,
              `id_pesanan` INT NOT NULL,
              `id_menu` INT NOT NULL,
              `jumlah` INT NOT NULL DEFAULT 1,
              `catatan_khusus` TEXT NULL,
              `subtotal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
              `created_at` DATETIME NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

            $db->query("CREATE TABLE IF NOT EXISTS `pembayaran` (
              `id_pembayaran` INT AUTO_INCREMENT PRIMARY KEY,
              `id_pesanan` INT NOT NULL,
              `id_kasir` INT NULL,
              `metode` ENUM('Tunai', 'QRIS') NOT NULL,
              `status_bayar` ENUM('Menunggu', 'Berhasil', 'Kadaluarsa', 'Gagal') NOT NULL DEFAULT 'Menunggu',
              `batas_waktu` DATETIME NULL,
              `jumlah_diterima` DECIMAL(10,2) NULL DEFAULT 0.00,
              `kembalian` DECIMAL(10,2) NULL DEFAULT 0.00,
              `waktu_bayar` DATETIME NULL,
              `created_at` DATETIME NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

            // Katalog produk lengkap dipusatkan di ProdukKatalogSeeder agar
            // data yang tampil di halaman customer sama dengan data awal.
            $menuCount = $this->menuModel->countAllResults();
            if ($menuCount === 0) {
                \App\Database\Seeds\ProdukKatalogSeeder::seed();
            }
        } catch (\Throwable $e) {
            // Error ditangani dengan baik
        }
    }
}
