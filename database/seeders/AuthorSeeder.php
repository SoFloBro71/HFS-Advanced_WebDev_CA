<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developer::factory()
        ->times(4)
        ->create();

        foreach(Game::all() as $game)
        {
            $developers = Developer::inRandomOrder()->take(rand(1,3))->pluck('id');
            $game->developer()->attach($developers);
        }
    }
}
