<?php

namespace Database\Seeders;

use App\Models\PegawaiModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PegawaiModel::query()->create([
            'nip' => '12210675',
            'nama_lengkap' => 'Muhammad Nur',
            'jabatan' => 'CYNICAL POET',
            'password' => Hash::make('nur'),
            'email' => 'm-nur@gmail.com'
        ]);
    }
}
