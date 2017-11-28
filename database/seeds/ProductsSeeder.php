<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 15) as $index) {
          DB::table('products')->insert([
              'category_id' => $index % 3,
              'name' => $faker->catchPhrase,
              'description' => $faker->paragraph,
              'price' => $faker->randomNumber(3),
          ]);
        }
    }
}
