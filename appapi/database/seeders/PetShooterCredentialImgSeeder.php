<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class PetShooterApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 20) as $i) {
            DB::table('petshooter_cred_img')->insert([
                'petshooter_id' => $faker->randomElement([21, 4, 20, 18, 13, 10, 9, 7]),
                'image' => $faker->imageUrl,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
