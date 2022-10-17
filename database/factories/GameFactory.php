<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'genre' => $this->faker->text(50),
            // 'game_image' => "file_name/images/image name"
            'description' => $this->faker->text(200),
            'author' => $this->faker->name
        ];
    }
}
