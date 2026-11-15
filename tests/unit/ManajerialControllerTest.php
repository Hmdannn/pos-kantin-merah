<?php

use App\Controllers\ManajerialController;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Database;

/**
 * @internal
 */
final class ManajerialControllerTest extends CIUnitTestCase
{
    private $testDb;

    private string $tablePrefix;

    private string $originalTablePrefix;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testDb = Database::connect();
        $this->originalTablePrefix = $this->testDb->getPrefix();
        $this->testDb->setPrefix('');
        $this->tablePrefix = '';

        $this->testDb->query(
            'CREATE TABLE ' . $this->tablePrefix . 'pesanan (
                id_pesanan INTEGER PRIMARY KEY,
                waktu_pesan DATETIME NOT NULL,
                status VARCHAR(30) NOT NULL,
                total_bayar DECIMAL(10, 2) NOT NULL
            )'
        );
        $this->testDb->query(
            'CREATE TABLE ' . $this->tablePrefix . 'pembayaran (
                id_pembayaran INTEGER PRIMARY KEY,
                id_pesanan INTEGER NOT NULL,
                id_kasir INTEGER NULL,
                metode VARCHAR(10) NOT NULL,
                status_bayar VARCHAR(20) NOT NULL,
                jumlah_diterima DECIMAL(10, 2) NULL,
                kembalian DECIMAL(10, 2) NULL,
                waktu_bayar DATETIME NULL
            )'
        );
        $this->testDb->query(
            'CREATE TABLE ' . $this->tablePrefix . 'detail_pesanan (
                id_detail INTEGER PRIMARY KEY,
                id_pesanan INTEGER NOT NULL,
                id_menu INTEGER NOT NULL,
                jumlah INTEGER NOT NULL,
                subtotal DECIMAL(10, 2) NOT NULL
            )'
        );
        $this->testDb->query(
            'CREATE TABLE ' . $this->tablePrefix . 'menu (
                id_menu INTEGER PRIMARY KEY,
                nama_menu VARCHAR(100) NOT NULL
            )'
        );

        $this->testDb->connID->createFunction(
            'HOUR',
            static fn ($value): int => (int) date('G', strtotime((string) $value))
        );
    }

    protected function tearDown(): void
    {
        foreach (['pembayaran', 'detail_pesanan', 'menu', 'pesanan'] as $table) {
            $this->testDb->query('DROP TABLE IF EXISTS ' . $this->tablePrefix . $table);
        }

        $this->testDb->setPrefix($this->originalTablePrefix);
        parent::tearDown();
    }

    public function testLaporanIncludesQrisAndExcludesCashChange(): void
    {
        $waktu = date('Y-m-d H:i:s');

        $this->testDb->table('pesanan')->insertBatch([
            [
                'id_pesanan' => 1,
                'waktu_pesan' => $waktu,
                'status' => 'Selesai',
                'total_bayar' => 5000,
            ],
            [
                'id_pesanan' => 2,
                'waktu_pesan' => $waktu,
                'status' => 'Selesai',
                'total_bayar' => 5000,
            ],
        ]);
        $this->testDb->table('pembayaran')->insertBatch([
            [
                'id_pembayaran' => 1,
                'id_pesanan' => 1,
                'id_kasir' => 7,
                'metode' => 'Tunai',
                'status_bayar' => 'Berhasil',
                'jumlah_diterima' => 6000,
                'kembalian' => 1000,
                'waktu_bayar' => $waktu,
            ],
            [
                'id_pembayaran' => 2,
                'id_pesanan' => 2,
                'id_kasir' => null,
                'metode' => 'QRIS',
                'status_bayar' => 'Berhasil',
                'jumlah_diterima' => 5000,
                'kembalian' => 0,
                'waktu_bayar' => $waktu,
            ],
        ]);
        $this->testDb->table('menu')->insert([
            'id_menu' => 1,
            'nama_menu' => 'Menu Test',
        ]);
        $this->testDb->table('detail_pesanan')->insertBatch([
            [
                'id_detail' => 1,
                'id_pesanan' => 1,
                'id_menu' => 1,
                'jumlah' => 1,
                'subtotal' => 5000,
            ],
            [
                'id_detail' => 2,
                'id_pesanan' => 2,
                'id_menu' => 1,
                'jumlah' => 1,
                'subtotal' => 5000,
            ],
        ]);

        $request = service('request');
        $request->setGlobal('get', ['periode' => 'harian']);

        $controller = new ManajerialController();
        $controller->initController($request, service('response'), service('logger'));
        $response = $controller->laporan();
        $data = json_decode($response->getJSON(), true);

        $this->assertEquals(10000, $data['data']['ringkasan']['total_penjualan']);
        $this->assertSame(2, $data['data']['ringkasan']['jumlah_transaksi']);
        $this->assertEquals(5000, $data['data']['ringkasan']['total_tunai']);
        $this->assertEquals(5000, $data['data']['ringkasan']['total_qris']);
    }
}
