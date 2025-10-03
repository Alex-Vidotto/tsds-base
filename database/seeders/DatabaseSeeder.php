<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(RoleSeeder::class);        
        $this->call(UserSeeder::class);
        
        $this->call(CarBrandSeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(CarServiceSeeder::class);
        $this->call(CarServiceDateSeeder::class);
        $this->call(TareaSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
