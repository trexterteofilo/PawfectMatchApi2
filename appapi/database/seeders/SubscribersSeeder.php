<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class SubscribersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 20) as $i) {
            DB::table('subscribers')->insert(
                [
                    'user_id' => ($faker->numberBetween(3, 42)),
                    'subs_id' => ($faker->numberBetween(1, 7)),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]
            );
        }
    }
}
