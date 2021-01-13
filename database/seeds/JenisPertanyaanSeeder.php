<?php

use App\JenisPertanyaan;
use Illuminate\Database\Seeder;

class JenisPertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPertanyaan::create(['jenis' => 'Jawaban Singkat']);
        JenisPertanyaan::create(['jenis' => 'Paragraf']);
        JenisPertanyaan::create(['jenis' => 'Pilihan Ganda']);
        JenisPertanyaan::create(['jenis' => 'Kotak Centang']);
        JenisPertanyaan::create(['jenis' => 'Dropdown']);
        JenisPertanyaan::create(['jenis' => 'Skala Linier']);
        JenisPertanyaan::create(['jenis' => 'Tanggal']);
        JenisPertanyaan::create(['jenis' => 'Waktu']);
    }
}
