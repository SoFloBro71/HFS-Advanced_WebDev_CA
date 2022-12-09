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
        
        // $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        // PublisherSeeder calls hasGames() and creates the games table with 10 games for each publisher
        // $this->call(PublisherSeeder::class);
        // DeveloperSeeder creates developers with games from DB and randomly assigns Devs to many games
        $this->call(DeveloperSeeder::class);
    }
}
