<?php
// not used - used own information
namespace Database\Factories;

use Illuminate\Support\Str;
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
            'uuid' => Str::uuid(),
            'title' => $this->faker->word,
            'category' => $this->faker->text(50),
            'game_image' => "file_name/images/image name",
            'description' => $this->faker->text(200),
            // 'developer' => $this->faker->name,
            
          //  'publisher_id' => $this->faker->name
        ];
    }
}
