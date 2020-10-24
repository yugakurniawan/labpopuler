<?php

use App\Dokter;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'peran_id'          => 1,
            'nama'              => 'Admin Pengelola Web',
            'username'          => 'superadmin',
            'email'             => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        User::create([
            'peran_id'          => 3,
            'nama'              => 'Admin Laboratorium',
            'username'          => 'adminlab',
            'email'             => 'adminlab@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        User::create([
            'peran_id'          => 4,
            'nama'              => 'Admin Marketing',
            'username'          => 'adminmarketing',
            'email'             => 'adminmarketing@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        User::create([
            'peran_id'          => 5,
            'nama'              => 'Manager Marketing',
            'username'          => 'managermarketing',
            'email'             => 'managermarketing@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        foreach (Dokter::all() as $dokter) {
            $user = User::where('email',str_replace(' ','',$dokter->nama) . '@gmail.com')->first();
            if ($user == null) {
                $pengguna = User::create([
                    'peran_id'          => 2,
                    'nama'              => $dokter->nama,
                    'username'          => str_replace(' ','',$dokter->nama),
                    'email'             => str_replace(' ','',$dokter->nama) . '@gmail.com',
                    'email_verified_at' => now(),
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token'    => Str::random(10),
                ]);

                $dokter->user_id = $pengguna->id;
                $dokter->save();
            }
        }
    }
}
