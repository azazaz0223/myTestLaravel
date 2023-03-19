<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cate;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        \Schema::disableForeignKeyConstraints();
        User::truncate();
        Cate::truncate();
        Product::truncate();

        User::factory(5)->create();
        Cate::factory(100)->create();
        Product::factory(10000)->create();

        \Schema::enableForeignKeyConstraints();
    }
}