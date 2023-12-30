<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class PetShooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $faker = Faker::create();
        // foreach (range(1, 12) as $i) {
        //     DB::table('petshooters')->insert([
        //         'petshooter_id' => ($faker->numberBetween(1, 12)),
        //         'contact_number' => $faker->phoneNumber,
        //         'category' => $faker->randomElement(['Cats', 'Dogs', 'Birds', 'Hamsters', 'Rabbits']),
        //         'experience' => $faker->paragraph,

        //     ]);
        // }
        $faker = Faker::create();
        DB::table('petshooters')->insert(
            [
                [
                    'petshooter_id' => 11,
                    'contact_number' => $faker->phoneNumber,
                    'category' => $faker->randomElement(['Cats', 'Dogs', 'Birds', 'Hamsters', 'Rabbits']),
                    'experience' => $faker->paragraph,

                ],
                [
                    'petshooter_id' => 15,
                    'contact_number' => $faker->phoneNumber,
                    'category' => $faker->randomElement(['Cats', 'Dogs', 'Birds', 'Hamsters', 'Rabbits']),
                    'experience' => $faker->paragraph,
                ]
            ],
        );

    }
}
