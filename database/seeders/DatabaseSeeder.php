<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            'firstName' => 'Dobriyan',
            'lastName' => 'Petkov',
            'username' => 'asdbsd',
            'email' => 'dobriyanp@yahoo.com'
        ]);

        $user2 = User::factory()->create([
            'firstName' => 'John',
            'lastName' => 'Stones',
            'username' => 'JohnS',
            'email' => 'john@gmail.com'
        ]);

        $user3 = User::factory()->create([
            'firstName' => 'Gregs',
            'lastName' => 'Charls',
            'username' => 'gregCharls',
            'email' => 'greg@hotmail.com'
        ]);

        Product::factory(5)->create([
            'user_id' => $user2->id,
        ]);

        Product::factory(2)->create([
            'user_id' => $user1->id,
        ]);

        Product::factory(7)->create([
            'user_id' => $user3->id
        ]);



    }
}
