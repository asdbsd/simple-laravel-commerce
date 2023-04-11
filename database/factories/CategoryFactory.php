<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = [
            'name' => fake()->unique()->firstName()
        ];
        $data['slug'] = $this->setSlugFromProductName($data['name']);

        return $data;
    }

    protected function setSlugFromProductName(String $productName)
    {
        return implode('-', explode(' ', strtolower($productName)));
    }
}
