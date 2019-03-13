<?php

use Illuminate\Database\Seeder;
use App\restaurant;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Let's truncate our existing records to start from scratch.
        restaurant::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            restaurant::create([
                'name' => $faker->company,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
