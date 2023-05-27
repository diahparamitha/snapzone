<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create('id_ID');

        User::create([
            'name' => 'Diah Paramitha',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'phone' => '089767453678',
            'address' => 'Jln. Baru',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Diah ',
            'email' => 'staff@gmail.com',
            'role' => 'staff',
            'phone' => '089767453673',
            'address' => 'Jln. Baru Nampak',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Mitha',
            'email' => 'pengguna@gmail.com',
            'role' => 'pengguna',
            'phone' => '089767453670',
            'address' => 'Jln. Baru Tahu',
            'password' => bcrypt('password123'),
        ]);

        User::factory(7)->create();

         Category::create([
            'user_id' => 1,
            'name' => 'Nature',
            'slug' => 'nature',
            'description' => $faker->paragraph(5),
        ]);

        Category::create([
            'user_id' => 2,
            'name' => 'Architecture',
            'slug' => 'architecture',
            'description' => $faker->paragraph(5),
        ]);


        Category::create([
            'user_id' => 3,
            'name' => 'Travel',
            'slug' => 'travel',
            'description' => $faker->paragraph(5),
        ]);


        Category::create([
            'user_id' => 4,
            'name' => 'Animal',
            'slug' => 'animal',
            'description' => $faker->paragraph(5),
        ]);


        Category::create([
            'user_id' => 5,
            'name' => 'Street',
            'slug' => 'street',
            'description' => $faker->paragraph(5),
        ]);

        Product::factory(10)->create();
    }
}
