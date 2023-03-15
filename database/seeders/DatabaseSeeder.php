<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \Schema::disableForeignKeyConstraints();
        Product::truncate();
        User::truncate();

        User::factory(5)->create();
        Product::factory(10000)->create();

        \Schema::enableForeignKeyConstraints();
    }
}