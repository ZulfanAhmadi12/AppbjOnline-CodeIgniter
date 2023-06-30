<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laporan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pengadaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenispengadaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ppk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'penyedia' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nokontrak' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tglkontrak' => [
                'type' => 'DATE',
            ],
            'akhirkontrak' => [
                'type' => 'DATE',
            ],
            'pagu' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'nilaikontrak' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'sisapagu' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'uangmuka' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'tahap1' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'tahap2' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'pelunasan' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'sisaanggaran' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'jumin' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'jusik' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'tkdn' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'ket' => [
                'type' => 'VARCHAR',
                'constraint' => '1000',
            ],
            'satker' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('laporan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan');
    }
}
