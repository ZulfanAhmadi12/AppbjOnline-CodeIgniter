<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;


class LaporanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'pengadaan' => 'PENGADAAN MAKAN PIKET BID TIK POLDA KALBAR  TAHUN ANGGARAN 2022',
            'ppk'    => 'IRWAN PRIBADI, S.T.',
            'penyedia'    => 'RUMAH MAKAN FAZA',
            'nokontrak'    => 'SPK/1/XII/2021/BID TIK',
            'tglkontrak'    => '2021/12/27',
            'akhirkontrak'    => '2022/12/31',
            'pagu'    => '102200000',
            'nilaikontrak'    => '102200000',
            'sisapagu'    => '102200000',
            'uangmuka'    => '102200000',
            'tahap1'    => '59360000',
            'tahap2'    => '59360000',
            'pelunasan'    => '42840000',
            'sisaanggaran'    => '42840000',
            'jumin'    => '42',
            'jusik'    => '42',
            'tkdn'    => '100',
            'ket'    => 'TANPA KETERANGAN',
            'created_at' => Time::now(),
            'updated_at' => Time::now()
            
        ];

        // $faker = \Faker\Factory::create('id_ID');
        // for($i = 0; $i < 100; $i++){
        //     $data = [
        //         'nama' => $faker->name,
        //         'alamat' => $faker->address,
        //         'created_at' => Time::createFromTimestamp($faker->unixTime()),
        //         'updated_at' => Time::now()
        //     ];
        //     $this->db->table('orang')->insert($data);
        // }


        // Simple Queries
        // $this->db->query('INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        $this->db->table('laporan')->insert($data);
        // $this->db->table('orang')->insertBatch($data);
    }
}