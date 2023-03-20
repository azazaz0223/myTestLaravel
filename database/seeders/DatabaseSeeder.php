<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cate;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        User::truncate();
        Cate::truncate();
        Product::truncate();

        // 建立最高權限管理員
        User::create([
            'name' => 'Admin',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('1111'),
            'remember_token' => Str::random(10),
        ]);
        User::factory(4)->create();
        Cate::factory(100)->create();
        Product::factory(10000)->create();
    }
}