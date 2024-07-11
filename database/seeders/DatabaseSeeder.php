<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sampah;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
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
            // 'username' => 'AdminBankSampah',
            // 'password' => bcrypt('admin123'),
            'rt_rw' => '001/001',
            'telephone' => '1234567890',
            'saldo' => 0,
            'total_income' => 0,
            'total_outcome' => 0,
            'is_admin' => '1',
            'garbage_sold' => 0
        ]);

        User::create([
            'name' => 'Jason',
            'rt_rw' => '001/001',
            'telephone' => '1234567890',
            'saldo' => 0,
            'total_income' => 0,
            'total_outcome' => 0,
            'is_admin' => '0'
        ]);

        // 1
        Category::create([
            'category_name' => 'Plastik 1'
        ]);

        // 2
        Category::create([
            'category_name' => 'Plastik 2 & 4'
        ]);

        // 3
        Category::create([
            'category_name' => 'Plastik 3'
        ]);

        // 4
        Category::create([
            'category_name' => 'Plastik 5'
        ]);

        // 5
        Category::create([
            'category_name' => 'Plastik 6'
        ]);

        // 6
        Category::create([
            'category_name' => 'Plastik 7'
        ]);

        // 7
        Category::create([
            'category_name' => 'Plastik Campur'
        ]);

        // 8
        Category::create([
            'category_name' => 'Plastik Lembar'
        ]);

        // 9
        Category::create([
            'category_name' => 'Karung'
        ]);

        // 10
        Category::create([
            'category_name' => 'Besi'
        ]);

        // 11
        Category::create([
            'category_name' => 'Logam'
        ]);

        // 12
        Category::create([
            'category_name' => 'Kaca'
        ]);

        // 13
        Category::create([
            'category_name' => 'Kertas'
        ]);

        // 14
        Category::create([
            'category_name' => 'Lainnya'
        ]);

        Sampah::create([
            'garbage_type' => 'PET Bening Bersih',
            'category_id' => 1,
            'price' => 3330
        ]);

        Sampah::create([
            'garbage_type' => 'PET Biru Muda Bersih',
            'category_id' => 1,
            'price' => 2430
        ]);

        Sampah::create([
            'garbage_type' => 'PET Warna Bersih',
            'category_id' => 1,
            'price' => 1530
        ]);

        Sampah::create([
            'garbage_type' => 'PET Kotor',
            'category_id' => 1,
            'price' => 900
        ]);

        Sampah::create([
            'garbage_type' => 'PET Jelek/Minyak',
            'category_id' => 1,
            'price' => 150
        ]);

        Sampah::create([
            'garbage_type' => 'PET Galon Le Minerale',
            'category_id' => 1,
            'price' => 1350
        ]);

        Sampah::create([
            'garbage_type' => 'Tutup Botol AMDK',
            'category_id' => 2,
            'price' => 2250
        ]);

        Sampah::create([
            'garbage_type' => 'Tutup Galon Campur',
            'category_id' => 2,
            'price' => 3150
        ]);

        Sampah::create([
            'garbage_type' => 'Tutup Campur',
            'category_id' => 2,
            'price' => 1350
        ]);

        Sampah::create([
            'garbage_type' => 'PVC/Paralon/Talang',
            'category_id' => 3,
            'price' => 450
        ]);

        Sampah::create([
            'garbage_type' => 'Selang',
            'category_id' => 3,
            'price' => 450
        ]);

        Sampah::create([
            'garbage_type' => 'Gelas Bening Bersih',
            'category_id' => 4,
            'price' => 3600
        ]);

        Sampah::create([
            'garbage_type' => 'Gelas Bening Kotor',
            'category_id' => 4,
            'price' => 1800
        ]);

        Sampah::create([
            'garbage_type' => 'Gelas Sablon/Sedotan',
            'category_id' => 4,
            'price' => 1620
        ]);

        Sampah::create([
            'garbage_type' => 'PS Kaca/Yakult/Akrilik',
            'category_id' => 5,
            'price' => 1350
        ]);

        Sampah::create([
            'garbage_type' => 'Keping CD',
            'category_id' => 6,
            'price' => 3600
        ]);

        Sampah::create([
            'garbage_type' => 'Galon Utuh (Aqua/Club)',
            'category_id' => 6,
            'price' => 3150
        ]);

        Sampah::create([
            'garbage_type' => 'Bak hitam',
            'category_id' => 7,
            'price' => 900
        ]);

        Sampah::create([
            'garbage_type' => 'Bak Campur (Tanpa Keras)',
            'category_id' => 7,
            'price' => 1800
        ]);

        Sampah::create([
            'garbage_type' => 'Plastik Keras',
            'category_id' => 7,
            'price' => 270
        ]);

        Sampah::create([
            'garbage_type' => 'Plastik Bening',
            'category_id' => 8,
            'price' => 900
        ]);

        Sampah::create([
            'garbage_type' => 'Kresek/Bubble Wrap',
            'category_id' => 8,
            'price' => 360
        ]);

        Sampah::create([
            'garbage_type' => 'Sablon Tipis',
            'category_id' => 8,
            'price' => 360
        ]);

        Sampah::create([
            'garbage_type' => 'Sablon Tebal',
            'category_id' => 8,
            'price' => 270
        ]);

        Sampah::create([
            'garbage_type' => 'Karung Kecil/Rusak',
            'category_id' => 8,
            'price' => 450
        ]);

        Sampah::create([
            'garbage_type' => 'Sachet Metalize',
            'category_id' => 8,
            'price' => 100
        ]);

        Sampah::create([
            'garbage_type' => 'Lembaran Campur',
            'category_id' => 8,
            'price' => 100
        ]);

        Sampah::create([
            'garbage_type' => 'Karung Uk. 100 Kg',
            'category_id' => 9,
            'price' => 1350
        ]);

        Sampah::create([
            'garbage_type' => 'Karung Uk. 200 Kg',
            'category_id' => 9,
            'price' => 1800
        ]);

        Sampah::create([
            'garbage_type' => 'Besi Tebal',
            'category_id' => 10,
            'price' => 2700
        ]);

        Sampah::create([
            'garbage_type' => 'Sepeda/Paku',
            'category_id' => 10,
            'price' => 1800
        ]);

        Sampah::create([
            'garbage_type' => 'Besi tipis/Gerabang',
            'category_id' => 10,
            'price' => 900
        ]);

        Sampah::create([
            'garbage_type' => 'Kaleng',
            'category_id' => 10,
            'price' => 1350
        ]);

        Sampah::create([
            'garbage_type' => 'Seng',
            'category_id' => 10,
            'price' => 450
        ]);

        Sampah::create([
            'garbage_type' => 'Tembaga',
            'category_id' => 11,
            'price' => 54000
        ]);

        Sampah::create([
            'garbage_type' => 'Kuningan',
            'category_id' => 11,
            'price' => 27000
        ]);

        Sampah::create([
            'garbage_type' => 'Perunggu',
            'category_id' => 11,
            'price' => 7200
        ]);

        Sampah::create([
            'garbage_type' => 'Alumunium',
            'category_id' => 11,
            'price' => 9000
        ]);

        Sampah::create([
            'garbage_type' => 'Botol Bensin Besar',
            'category_id' => 12,
            'price' => 900
        ]);

        Sampah::create([
            'garbage_type' => 'Botol Bir Bintang Besar',
            'category_id' => 12,
            'price' => 540
        ]);

        Sampah::create([
            'garbage_type' => 'Botol Kecap/Saos Besar',
            'category_id' => 12,
            'price' =>  360
        ]);

        Sampah::create([
            'garbage_type' => 'Botol/Beling Bening',
            'category_id' => 12,
            'price' => 150
        ]);

        Sampah::create([
            'garbage_type' => 'Botol/Beling Bening Warna',
            'category_id' => 12,
            'price' => 100
        ]);

        Sampah::create([
            'garbage_type' => 'Pecahan Kaca',
            'category_id' => 12,
            'price' => 50
        ]);

        Sampah::create([
            'garbage_type' => 'Kardus Bagus',
            'category_id' => 13,
            'price' => 1170
        ]);

        Sampah::create([
            'garbage_type' => 'Kardus Jelek',
            'category_id' => 13,
            'price' => 1080
        ]);

        Sampah::create([
            'garbage_type' => 'Koran',
            'category_id' => 13,
            'price' => 4050
        ]);

        Sampah::create([
            'garbage_type' => 'HVS',
            'category_id' => 13,
            'price' => 1800
        ]);

        Sampah::create([
            'garbage_type' => 'Buram',
            'category_id' => 13,
            'price' => 900
        ]);

        Sampah::create([
            'garbage_type' => 'Majalah',
            'category_id' => 13,
            'price' => 810
        ]);

        Sampah::create([
            'garbage_type' => 'Sak Semen',
            'category_id' => 13,
            'price' => 1350
        ]);

        Sampah::create([
            'garbage_type' => 'Duplek',
            'category_id' => 13,
            'price' => 540
        ]);

        Sampah::create([
            'garbage_type' => 'Karak',
            'category_id' => 14,
            'price' => 1800
        ]);

        Sampah::create([
            'garbage_type' => 'Gembos',
            'category_id' => 14,
            'price' => 360
        ]);

        Sampah::create([
            'garbage_type' => 'Jelantah',
            'category_id' => 14,
            'price' => 6750
        ]);

        Sampah::create([
            'garbage_type' => 'Kabel Listrik (Besar)',
            'category_id' => 14,
            'price' => 3600
        ]);
    }
}
