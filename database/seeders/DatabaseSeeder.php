<?php

namespace Database\Seeders;

use App\Models\Skim;
use App\Models\User;
use App\Models\Bidang;
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
        User::create([
            'email' => 'spadmin@example.com',
            'name' => 'SP-Admin',
            'username' => 'sp-admin',
            'password' => bcrypt('rahasia'),
            'level' => 'sp-admin'
        ]);

        Bidang::create([
            'nm_bidang' => 'dummy_bidang_1',
            'slug' => 'dummy-bidang-1'
        ]);

        Bidang::create([
            'nm_bidang' => 'dummy_bidang_2',
            'slug' => 'dummy-bidang-2'
        ]);

        Bidang::create([
            'nm_bidang' => 'dummy_bidang_3',
            'slug' => 'dummy-bidang-3'
        ]);

        Skim::create([
            'nm_skim' => 'dummy_skim1',
            'slug' => 'dummy-skim-1'
        ]);
        Skim::create([
            'nm_skim' => 'dummy_skim2',
            'slug' => 'dummy-skim-2'
        ]);
        Skim::create([
            'nm_skim' => 'dummy_skim3',
            'slug' => 'dummy-skim-3'
        ]);

    }
}
