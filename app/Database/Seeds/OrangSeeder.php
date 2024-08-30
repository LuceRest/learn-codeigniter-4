<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

// Mengisi tabel secara otomatis
class OrangSeeder extends Seeder
{
    public function run()
    {

        $data = [
            [
                'nama'          => 'Luce Restu',
                'alamat'        => 'Jl. ABC No. 123',
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta'),
            ],
            [
                'nama'          => 'Ombra Restu',
                'alamat'        => 'Jl. DEF No. 234',
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta'),
            ],
            [
                'nama'          => 'Evory Restu',
                'alamat'        => 'Jl. GHJ No. 23',
                'created_at'    => Time::now('Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta'),
            ]
        ];
        
        // Simple Queries
        // $this->db->query('INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('orang')->insert($data);       # insert() -> hanya bisa insert 1 data
        // $this->db->table('orang')->insertBatch($data);       # insertBatch() -> bisa insert banyak data
        
        
        // Mengisi data dengan data faker menggunakan query builder
        $faker = \Faker\Factory::create('id_ID');
        for ( $i = 0; $i < 100; $i++ ) {
            $dataFaker = [
                'nama'          => $faker->name,
                'alamat'        => $faker->address,
                'created_at'    => Time::createFromTimestamp($faker->unixTime(), 'Asia/Jakarta'),
                'updated_at'    => Time::now('Asia/Jakarta'),
            ];
            $this->db->table('orang')->insert($dataFaker);       # insert() -> hanya bisa insert 1 data
        }

    }
}
