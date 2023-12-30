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
        foreach (range(1, 7) as $i) {
            DB::table('petshooter_applications')->insert([
                'petshooter_id' => $faker->randomElement([21, 20, 18, 13, 10, 9, 7]),
                'verification_status' => "Pending",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
