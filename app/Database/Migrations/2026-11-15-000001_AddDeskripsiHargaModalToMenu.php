<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Melengkapi data katalog produk.
 *
 * Tabel menu sebelumnya hanya menyimpan harga jual. Dua kolom baru
 * ditambahkan agar deskripsi singkat dan harga modal bisa disimpan
 * tanpa mengubah kolom maupun relasi yang sudah ada.
 */
class AddDeskripsiHargaModalToMenu extends Migration
{
    public function up()
    {
        if (!$this->db->fieldExists('deskripsi', 'menu')) {
            $this->forge->addColumn('menu', [
                'deskripsi' => [
                    'type' => 'TEXT',
                    'null' => true,
                    'after' => 'nama_menu',
                ],
            ]);
        }

        if (!$this->db->fieldExists('harga_modal', 'menu')) {
            $this->forge->addColumn('menu', [
                'harga_modal' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '10,2',
                    'null'       => true,
                    'default'    => 0.00,
                    'after'      => 'harga',
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('deskripsi', 'menu')) {
            $this->forge->dropColumn('menu', 'deskripsi');
        }

        if ($this->db->fieldExists('harga_modal', 'menu')) {
            $this->forge->dropColumn('menu', 'harga_modal');
        }
    }
}
