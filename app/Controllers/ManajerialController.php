<?php

namespace App\Controllers;

class ManajerialController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('manajerial/index');
    }

    public function laporan()
    {
        $wantsJson = $this->request->isAJAX()
            || $this->request->getGet('format') === 'json'
            || str_contains($this->request->getHeaderLine('Accept'), 'application/json');

        if (!$wantsJson) {
            return view('manajerial/laporan');
        }

        $periode = $this->request->getGet('periode') ?? 'harian';

        $tanggalMulai = null;
        $tanggalSelesai = null;

        switch ($periode) {
            case 'harian':
                $tanggalMulai = date('Y-m-d');
                $tanggalSelesai = date('Y-m-d');
                break;

            case 'mingguan':
                $tanggalMulai = date('Y-m-d', strtotime('-6 days'));
                $tanggalSelesai = date('Y-m-d');
                break;

            case 'bulanan':
                $tanggalMulai = date('Y-m-01');
                $tanggalSelesai = date('Y-m-t');
                break;

            default:
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => false,
                    'message' => 'Periode harus harian, mingguan, atau bulanan.'
                ]);
        }

        /*
         * 1. Ringkasan penjualan
         */
        $penjualan = $this->db
            ->table('pesanan')
            ->where('DATE(waktu_pesan) >=', $tanggalMulai)
            ->where('DATE(waktu_pesan) <=', $tanggalSelesai)
            ->whereIn('status', [
                'Dibayar',
                'Diproses',
                'Siap Diambil',
                'Selesai'
            ])
            ->selectSum('total_bayar')
            ->get()
            ->getRow();

        $jumlahTransaksi = $this->db
            ->table('pesanan')
            ->where('DATE(waktu_pesan) >=', $tanggalMulai)
            ->where('DATE(waktu_pesan) <=', $tanggalSelesai)
            ->whereIn('status', [
                'Dibayar',
                'Diproses',
                'Siap Diambil',
                'Selesai'
            ])
            ->countAllResults();

        /*
         * 2. Penjualan berdasarkan metode pembayaran
         */
        $pembayaran = $this->db
            ->table('pembayaran')
            ->select(
                'metode,
                 SUM(
                    CASE
                        WHEN metode = \'Tunai\'
                            THEN COALESCE(jumlah_diterima, 0) - COALESCE(kembalian, 0)
                        ELSE COALESCE(jumlah_diterima, 0)
                    END
                 ) AS total'
            )
            ->where('DATE(waktu_bayar) >=', $tanggalMulai)
            ->where('DATE(waktu_bayar) <=', $tanggalSelesai)
            ->where('status_bayar', 'Berhasil')
            ->groupBy('metode')
            ->get()
            ->getResultArray();

        $totalTunai = 0;
        $totalQris = 0;

        foreach ($pembayaran as $item) {
            if ($item['metode'] === 'Tunai') {
                $totalTunai = (float) $item['total'];
            }

            if ($item['metode'] === 'QRIS') {
                $totalQris = (float) $item['total'];
            }
        }

        /*
         * 3. Menu terlaris
         */
        $menuTerlaris = $this->db
            ->table('detail_pesanan')
            ->select(
                'menu.id_menu,
                 menu.nama_menu,
                 SUM(detail_pesanan.jumlah) AS jumlah_terjual,
                 SUM(detail_pesanan.subtotal) AS total_penjualan'
            )
            ->join(
                'menu',
                'menu.id_menu = detail_pesanan.id_menu'
            )
            ->join(
                'pesanan',
                'pesanan.id_pesanan = detail_pesanan.id_pesanan'
            )
            ->where('DATE(pesanan.waktu_pesan) >=', $tanggalMulai)
            ->where('DATE(pesanan.waktu_pesan) <=', $tanggalSelesai)
            ->whereIn('pesanan.status', [
                'Dibayar',
                'Diproses',
                'Siap Diambil',
                'Selesai'
            ])
            ->groupBy('menu.id_menu')
            ->orderBy('jumlah_terjual', 'DESC')
            ->get()
            ->getResultArray();

        /*
         * 4. Tren omzet pada periode terpilih dibanding periode sebelumnya.
         */
        $jumlahHari = (int) ((strtotime($tanggalSelesai) - strtotime($tanggalMulai)) / 86400) + 1;
        $tanggalSebelumnyaSelesai = date('Y-m-d', strtotime($tanggalMulai . ' -1 day'));
        $tanggalSebelumnyaMulai = date('Y-m-d', strtotime($tanggalSebelumnyaSelesai . ' -' . ($jumlahHari - 1) . ' days'));
        $granularitasTren = $periode === 'harian' ? 'jam' : 'hari';
        $bucketTren = $periode === 'harian'
            ? 'FLOOR(HOUR(waktu_pesan) / 4)'
            : 'DATE(waktu_pesan)';

        $ambilTren = function (string $mulai, string $selesai) use ($bucketTren): array {
            $rows = $this->db
                ->table('pesanan')
                ->select($bucketTren . ' AS bucket, SUM(total_bayar) AS total_penjualan', false)
                ->where('DATE(waktu_pesan) >=', $mulai)
                ->where('DATE(waktu_pesan) <=', $selesai)
                ->whereIn('status', ['Dibayar', 'Diproses', 'Siap Diambil', 'Selesai'])
                ->groupBy('bucket')
                ->get()
                ->getResultArray();

            $hasil = [];
            foreach ($rows as $row) {
                $hasil[(string) $row['bucket']] = (float) $row['total_penjualan'];
            }
            return $hasil;
        };

        $trenSekarang = $ambilTren($tanggalMulai, $tanggalSelesai);
        $trenSebelumnya = $ambilTren($tanggalSebelumnyaMulai, $tanggalSebelumnyaSelesai);
        $titikTren = [];

        if ($granularitasTren === 'jam') {
            for ($slot = 0; $slot < 6; $slot++) {
                $titikTren[] = [
                    'label' => str_pad((string) ($slot * 4), 2, '0', STR_PAD_LEFT) . ':00',
                    'current' => $trenSekarang[(string) $slot] ?? 0,
                    'previous' => $trenSebelumnya[(string) $slot] ?? 0,
                ];
            }
        } else {
            $namaHari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            for ($offset = 0; $offset < $jumlahHari; $offset++) {
                $tanggal = date('Y-m-d', strtotime($tanggalMulai . ' +' . $offset . ' days'));
                $tanggalLalu = date('Y-m-d', strtotime($tanggalSebelumnyaMulai . ' +' . $offset . ' days'));
                $titikTren[] = [
                    'label' => $periode === 'mingguan'
                        ? $namaHari[(int) date('w', strtotime($tanggal))]
                        : date('d', strtotime($tanggal)),
                    'date' => $tanggal,
                    'current' => $trenSekarang[$tanggal] ?? 0,
                    'previous' => $trenSebelumnya[$tanggalLalu] ?? 0,
                ];
            }
        }

        /*
         * 5. Omzet per kategori dari item pesanan pada periode terpilih.
         */
        $performaKategori = $this->db
            ->table('detail_pesanan')
            ->select('kategori.id_kategori, kategori.nama_kategori, SUM(detail_pesanan.subtotal) AS total_penjualan, SUM(detail_pesanan.jumlah) AS jumlah_terjual')
            ->join('menu', 'menu.id_menu = detail_pesanan.id_menu')
            ->join('kategori', 'kategori.id_kategori = menu.id_kategori')
            ->join('pesanan', 'pesanan.id_pesanan = detail_pesanan.id_pesanan')
            ->where('DATE(pesanan.waktu_pesan) >=', $tanggalMulai)
            ->where('DATE(pesanan.waktu_pesan) <=', $tanggalSelesai)
            ->whereIn('pesanan.status', ['Dibayar', 'Diproses', 'Siap Diambil', 'Selesai'])
            ->groupBy('kategori.id_kategori')
            ->orderBy('total_penjualan', 'DESC')
            ->get()
            ->getResultArray();

        /*
         * 6. Jam paling ramai
         */
        $jamRamai = $this->db
            ->table('pesanan')
            ->select(
                'HOUR(waktu_pesan) AS jam,
                 COUNT(*) AS jumlah_transaksi,
                 SUM(total_bayar) AS total_penjualan'
            )
            ->where('DATE(waktu_pesan) >=', $tanggalMulai)
            ->where('DATE(waktu_pesan) <=', $tanggalSelesai)
            ->whereIn('status', [
                'Dibayar',
                'Diproses',
                'Siap Diambil',
                'Selesai'
            ])
            ->groupBy('HOUR(waktu_pesan)')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'periode' => $periode,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai,

                'ringkasan' => [
                    'total_penjualan' =>
                        (float) ($penjualan->total_bayar ?? 0),

                    'jumlah_transaksi' =>
                        $jumlahTransaksi,

                    'total_tunai' =>
                        $totalTunai,

                    'total_qris' =>
                        $totalQris,
                ],

                'menu_terlaris' => $menuTerlaris,

                'tren_penjualan' => [
                    'granularitas' => $granularitasTren,
                    'tanggal_sebelumnya_mulai' => $tanggalSebelumnyaMulai,
                    'tanggal_sebelumnya_selesai' => $tanggalSebelumnyaSelesai,
                    'titik' => $titikTren,
                ],

                'performa_kategori' => $performaKategori,

                'jam_ramai' => $jamRamai
            ]
        ]);
    }
}
