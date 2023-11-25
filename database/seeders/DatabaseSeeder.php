<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Skpd;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Skpd::create([
            'nama' => 'Badan Perencanaan Pembangunan Daerah, Penelitian dan Pengembangan',
            'status' => 'active'
        ]);
        
        User::create([
            'name' => 'Bappedalitbang',
            'username' => 'admin',
            'role' => 'admin',
            'avatar' => 'ava.png',
            'status' => 'active',
            'email' => 'bappedatanbu.zoom@gmail.com',
            'password' => bcrypt('12345678'),
            'skpd_id' => 1
        ]);

    }
}
