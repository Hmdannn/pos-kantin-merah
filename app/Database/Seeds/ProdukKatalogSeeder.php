<?php

namespace App\Database\Seeds;

use App\Models\KategoriModel;
use App\Models\MenuModel;
use CodeIgniter\Database\Seeder;

/**
 * Mengisi katalog produk Kantin Merah.
 *
 * Seeder ini aman dijalankan berulang kali:
 * - kategori dicocokkan berdasarkan nama (tidak membuat duplikat),
 * - produk dicocokkan berdasarkan nama menu,
 * - produk yang sudah ada tidak ditimpa harga/stoknya; hanya
 *   deskripsi, harga modal, dan foto yang masih kosong yang diisi.
 */
class ProdukKatalogSeeder extends Seeder
{
    /**
     * @var array<int, array<string, mixed>>
     */
    private array $kategori = [
        ['nama' => 'Makanan'],
        ['nama' => 'Minuman'],
        ['nama' => 'Snack'],
    ];

    /**
     * @var array<int, array<string, mixed>>
     */
    private array $produk = [
        // ================= MAKANAN =================
        [
            'nama_menu'   => 'Nasi Goreng',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Nasi goreng gurih dengan telur, ayam, dan sayuran, disajikan hangat.',
            'harga_modal' => 10000,
            'harga'       => 15000,
            'jumlah_stok' => 30,
            'foto'        => 'uploads/menu/ecf3c30eb6e1f68b8518fabea9f16ef4.jpg',
        ],
        [
            'nama_menu'   => 'Mie Goreng',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Mie goreng kuning dengan telur, sayuran, dan bumbu gurih.',
            'harga_modal' => 8000,
            'harga'       => 12000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/mie-goreng.jpg',
        ],
        [
            'nama_menu'   => 'Mie Rebus',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Mie rebus berkuah kaldu hangat dengan telur dan sayuran.',
            'harga_modal' => 7500,
            'harga'       => 11000,
            'jumlah_stok' => 35,
            'foto'        => 'uploads/menu/katalog/mie-rebus.jpg',
        ],
        [
            'nama_menu'   => 'Nasi Ayam Geprek',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Nasi putih dengan ayam geprek sambal bawang pedas dan lalapan.',
            'harga_modal' => 12000,
            'harga'       => 16000,
            'jumlah_stok' => 30,
            'foto'        => 'uploads/menu/katalog/nasi-ayam-geprek.jpg',
        ],
        [
            'nama_menu'   => 'Nasi Telur',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Nasi hangat dengan telur ceplok, kecap manis, dan sayuran.',
            'harga_modal' => 7000,
            'harga'       => 10000,
            'jumlah_stok' => 35,
            'foto'        => 'uploads/menu/katalog/nasi-telur.jpg',
        ],
        [
            'nama_menu'   => 'Nasi Pecel',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Nasi dengan sayuran rebus, siraman bumbu kacang, dan lauk pelengkap.',
            'harga_modal' => 8000,
            'harga'       => 12000,
            'jumlah_stok' => 25,
            'foto'        => 'uploads/menu/katalog/nasi-pecel.jpg',
        ],
        [
            'nama_menu'   => 'Nasi Rames',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Nasi campur dengan aneka lauk rumahan dan sayur.',
            'harga_modal' => 9000,
            'harga'       => 13000,
            'jumlah_stok' => 25,
            'foto'        => 'uploads/menu/katalog/nasi-rames.jpg',
        ],
        [
            'nama_menu'   => 'Bakso',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Bakso sapi kenyal dalam kuah kaldu gurih, dengan mie dan tahu.',
            'harga_modal' => 9000,
            'harga'       => 13000,
            'jumlah_stok' => 30,
            'foto'        => 'uploads/menu/katalog/bakso.jpg',
        ],
        [
            'nama_menu'   => 'Soto Ayam',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Soto ayam berkuah kuning dengan suwiran ayam, telur, dan koya.',
            'harga_modal' => 8500,
            'harga'       => 12000,
            'jumlah_stok' => 30,
            'foto'        => 'uploads/menu/katalog/soto-ayam.jpg',
        ],
        [
            'nama_menu'   => 'Nasi Kuning',
            'kategori'    => 'Makanan',
            'deskripsi'   => 'Nasi kuning gurih dengan ayam, telur, tempe, dan sambal.',
            'harga_modal' => 8000,
            'harga'       => 12000,
            'jumlah_stok' => 25,
            'foto'        => 'uploads/menu/katalog/nasi-kuning.jpg',
        ],

        // ================= MINUMAN =================
        [
            'nama_menu'   => 'Es Teh',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Teh manis dingin dengan es batu, segar untuk menemani makan.',
            'harga_modal' => 1800,
            'harga'       => 4000,
            'jumlah_stok' => 60,
            'foto'        => 'uploads/menu/katalog/es-teh.jpg',
        ],
        [
            'nama_menu'   => 'Teh Hangat',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Teh melati hangat dengan gula, cocok dinikmati santai.',
            'harga_modal' => 1500,
            'harga'       => 3000,
            'jumlah_stok' => 50,
            'foto'        => 'uploads/menu/katalog/teh-hangat.jpg',
        ],
        [
            'nama_menu'   => 'Es Jeruk',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Perasan jeruk segar dengan es batu dan gula.',
            'harga_modal' => 3000,
            'harga'       => 6000,
            'jumlah_stok' => 45,
            'foto'        => 'uploads/menu/katalog/es-jeruk.jpg',
        ],
        [
            'nama_menu'   => 'Jeruk Hangat',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Minuman jeruk hangat yang segar dan menyehatkan.',
            'harga_modal' => 2800,
            'harga'       => 5500,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/jeruk-hangat.jpg',
        ],
        [
            'nama_menu'   => 'Es Milo',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Minuman cokelat Milo dingin dengan susu dan es.',
            'harga_modal' => 3500,
            'harga'       => 7000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/es-milo.jpg',
        ],
        [
            'nama_menu'   => 'Es Good Day',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Kopi susu Good Day dingin dengan rasa manis dan creamy.',
            'harga_modal' => 3000,
            'harga'       => 6000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/es-good-day.jpg',
        ],
        [
            'nama_menu'   => 'Kopi Hitam',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Kopi hitam pekat seduh panas, tanpa gula tambahan.',
            'harga_modal' => 2000,
            'harga'       => 5000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/kopi-hitam.jpg',
        ],
        [
            'nama_menu'   => 'Kopi Susu',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Kopi susu creamy dengan gula aren, disajikan dingin.',
            'harga_modal' => 3500,
            'harga'       => 8000,
            'jumlah_stok' => 35,
            'foto'        => 'uploads/menu/katalog/kopi-susu.jpg',
        ],
        [
            'nama_menu'   => 'Air Mineral',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Air mineral botol dingin, praktis dan menyegarkan.',
            'harga_modal' => 2000,
            'harga'       => 3000,
            'jumlah_stok' => 100,
            'foto'        => 'uploads/menu/katalog/air-mineral.jpg',
        ],
        [
            'nama_menu'   => 'Susu Cokelat',
            'kategori'    => 'Minuman',
            'deskripsi'   => 'Susu cokelat dingin yang manis dan creamy.',
            'harga_modal' => 4000,
            'harga'       => 7000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/susu-cokelat.jpg',
        ],

        // ================= SNACK =================
        [
            'nama_menu'   => 'Kentang Goreng',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Kentang goreng crispy dengan saus tomat.',
            'harga_modal' => 6000,
            'harga'       => 10000,
            'jumlah_stok' => 30,
            'foto'        => 'uploads/menu/katalog/kentang-goreng.jpg',
        ],
        [
            'nama_menu'   => 'Sosis Goreng',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Sosis goreng gurih, cocok untuk camilan.',
            'harga_modal' => 5000,
            'harga'       => 8000,
            'jumlah_stok' => 35,
            'foto'        => 'uploads/menu/katalog/sosis-goreng.jpg',
        ],
        [
            'nama_menu'   => 'Nugget',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Nugget ayam goreng crispy, disajikan dengan saus.',
            'harga_modal' => 6000,
            'harga'       => 10000,
            'jumlah_stok' => 30,
            'foto'        => 'uploads/menu/katalog/nugget.jpg',
        ],
        [
            'nama_menu'   => 'Cireng',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Cireng goreng kenyal dengan isian dan bumbu rujak.',
            'harga_modal' => 3500,
            'harga'       => 6000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/cireng.jpg',
        ],
        [
            'nama_menu'   => 'Risoles',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Risoles goreng renyah dengan isian sayur dan ayam.',
            'harga_modal' => 3000,
            'harga'       => 5000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/risoles.jpg',
        ],
        [
            'nama_menu'   => 'Tahu Isi',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Tahu goreng berisi sayuran, renyah dan gurih.',
            'harga_modal' => 2500,
            'harga'       => 5000,
            'jumlah_stok' => 40,
            'foto'        => 'uploads/menu/katalog/tahu-isi.jpg',
        ],
        [
            'nama_menu'   => 'Bakwan',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Bakwan sayur goreng crispy, camilan favorit.',
            'harga_modal' => 2000,
            'harga'       => 4000,
            'jumlah_stok' => 45,
            'foto'        => 'uploads/menu/katalog/bakwan.jpg',
        ],
        [
            'nama_menu'   => 'Tempe Goreng',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Tempe goreng gurih dan renyah, cocok dengan sambal.',
            'harga_modal' => 1500,
            'harga'       => 3000,
            'jumlah_stok' => 50,
            'foto'        => 'uploads/menu/katalog/tempe-goreng.jpg',
        ],
        [
            'nama_menu'   => 'Roti Bakar',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Roti bakar isi cokelat manis, hangat dan lembut.',
            'harga_modal' => 5000,
            'harga'       => 8000,
            'jumlah_stok' => 30,
            'foto'        => 'uploads/menu/katalog/roti-bakar.jpg',
        ],
        [
            'nama_menu'   => 'Pisang Goreng',
            'kategori'    => 'Snack',
            'deskripsi'   => 'Pisang goreng manis dan renyah, camilan klasik.',
            'harga_modal' => 3000,
            'harga'       => 6000,
            'jumlah_stok' => 35,
            'foto'        => 'uploads/menu/katalog/pisang-goreng.jpg',
        ],
    ];

    /**
     * Memudahkan pemanggilan dari controller saat database masih kosong.
     */
    public static function seed(): void
    {
        $seeder = new self(config('Database'));
        $seeder->run();
    }

    public function run()
    {
        $kategoriModel = new KategoriModel();
        $menuModel     = new MenuModel();

        $kategoriTersedia = $kategoriModel->findAll();
        $kategoriMap      = [];

        foreach ($this->kategori as $kategori) {
            $namaKategori = $kategori['nama'];
            $ditemukan    = null;

            foreach ($kategoriTersedia as $row) {
                if (mb_strtolower(trim((string) $row['nama_kategori'])) === mb_strtolower($namaKategori)) {
                    $ditemukan = $row;
                    break;
                }
            }

            if ($ditemukan === null) {
                $idKategori = $kategoriModel->insert(['nama_kategori' => $namaKategori]);
                $ditemukan  = $kategoriModel->find($idKategori);
                $kategoriTersedia[] = $ditemukan;
            }

            $kategoriMap[$namaKategori] = (int) $ditemukan['id_kategori'];
        }

        $menuTersedia = $menuModel->findAll();
        $menuMap      = [];

        foreach ($menuTersedia as $menu) {
            $menuMap[mb_strtolower(trim((string) $menu['nama_menu']))] = $menu;
        }

        foreach ($this->produk as $produk) {
            $kunci = mb_strtolower(trim($produk['nama_menu']));

            if (isset($menuMap[$kunci])) {
                $menuLama = $menuMap[$kunci];
                $perubahan = [];

                if (empty($menuLama['deskripsi'])) {
                    $perubahan['deskripsi'] = $produk['deskripsi'];
                }

                if (empty($menuLama['harga_modal']) || (float) $menuLama['harga_modal'] <= 0) {
                    $perubahan['harga_modal'] = $produk['harga_modal'];
                }

                if (empty($menuLama['foto'])) {
                    $perubahan['foto'] = $produk['foto'];
                }

                if ($perubahan !== []) {
                    $menuModel->update($menuLama['id_menu'], $perubahan);
                }

                continue;
            }

            $menuModel->insert([
                'nama_menu'   => $produk['nama_menu'],
                'id_kategori' => $kategoriMap[$produk['kategori']],
                'deskripsi'   => $produk['deskripsi'],
                'harga_modal' => $produk['harga_modal'],
                'harga'       => $produk['harga'],
                'jumlah_stok' => $produk['jumlah_stok'],
                'status_stok' => 'Tersedia',
                'foto'        => $produk['foto'],
            ]);
        }
    }
}
