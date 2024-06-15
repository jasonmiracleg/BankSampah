<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'username' => 'AdminBankSampah',
            'password' => bcrypt('admin123'),
            'saldo' => 0,
            'total_income' => 0,
            'total_outcome' => 0,
            'is_admin' => '1'
        ]);

        User::create([
            'name' => 'Jason',
            'username' => 'jasonmiracle_',
            'password' => bcrypt('jason123'),
            'saldo' => 0,
            'total_income' => 0,
            'total_outcome' => 0,
            'is_admin' => '0'
        ]);
    }
}
