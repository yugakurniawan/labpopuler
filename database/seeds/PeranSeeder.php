<?php

use App\Peran;
use Illuminate\Database\Seeder;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peran::create([
            'nama'  => 'Super Admin'
        ]);

        Peran::create([
            'nama'  => 'Dokter'
        ]);

        Peran::create([
            'nama'  => 'Pengurus Lab'
        ]);

        Peran::create([
            'nama'  => 'Marketing'
        ]);
    }
}
