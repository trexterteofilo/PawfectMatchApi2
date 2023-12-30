<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;


class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $i) {
            DB::table('pets')->insert([
                'petimage' => $faker->imageUrl,
                'petname' => $faker->firstname,
                'pettype' => 'Cat',
                'petbreed' => $faker->randomElement(['Ragdoll', 'British Shorthair', 'Tabby', 'Siamese']),
                'petbirthdate' => $faker->date,
                'petgender' => $faker->randomElement(['Female', 'Male']),
                'petsize' => $faker->randomElement(['Small', 'Medium', 'Large']),
                'petsterilized' => 'Sterilized',
                'petvaccinated' => 'Vaccinated',
                'petdewormed' => 'Dewormed',
                'pet_eye_color' => $faker->colorName,
                'pet_color' => $faker->colorName,
                'petage' => ($faker->numberBetween(1, 6)),
                'petstatus' => 'Active',
                'owner_id' => ($faker->numberBetween(2, 3)),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
