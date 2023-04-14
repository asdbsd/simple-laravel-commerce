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
        $data = [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0.50, 999999.99),
            'image' => $this->getRandomImage()['arr'][$this->getRandomImage()['number']],
            'user_id' => User::factory()
        ];

        $data['slug'] = $this->setSlugFromProductName($data['name']);
        $data['excerpt'] = $this->setExcerptFromDescription($data['description']);

        return $data;
    }

    public function getRandomImage() 
    {
        $imagePaths = ['images/beef-mince.jpg', 'images/sprite.jpeg', 'images/t-shirt.jpeg', 'images/7SWrAi9GAW3LkXBcuhZt17EgcGBAouoXiork71vi.jpg', 'images/jq644jNlpAJ21CaW0Ujq9GBUgd5m74VbyWWVewNL.webp'];
        $number = array_rand($imagePaths, 1);

        return [
            'number' => $number,
            'arr' => $imagePaths
        ];
    }

    protected function setExcerptFromDescription(String $productDescription)
    {
        return substr($productDescription, 0, 95) . '...';
    }

    protected function setSlugFromProductName(String $productName) {
        return implode('-', explode(' ', strtolower($productName)));
    }
}
