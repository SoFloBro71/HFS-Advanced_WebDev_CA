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
        // not needed as PublisherSeeder has seeds the games table
        // $this->call(GameSeeder::class);
        
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PublisherSeeder::class);
    }
}
