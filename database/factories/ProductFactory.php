<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    

    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'slug' => fake()->unique()->slug(3),
            'excerpt' => fake()->text(45),
            'description' => fake()->text(),
            'image' => $this->getRandomImage()['arr'][$this->getRandomImage()['number']],
            'user_id' => User::factory()
        ];
    }


    public function getRandomImage() 
    {
        $imagePaths = ['/images/beef-mince.jpg', '/images/sprite.jpeg', '/images/t-shirt.jpeg'];
        $number = array_rand($imagePaths, 1);

        return [
            'number' => $number,
            'arr' => $imagePaths
        ];
    }
}
