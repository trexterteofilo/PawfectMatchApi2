<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use App\Models\Adoption;

class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  
        $faker = Faker::create();
        foreach (range(1, 10) as $i) {
            DB::table('adoptions')->insert([
                'adopt_desc' => $faker->paragraph,
                'adopt_date' => $faker->date,
                'adopt_payment' => ($faker->numberBetween(200, 600)),
                'adopt_status' => 'Pending',
                'owner_id' => ($faker->numberBetween(2, 16)),
                'pet_id' => ($faker->numberBetween(22, 31)),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        // $adopt = [
        //     [
        //         'adopt_desc' => $faker->paragraph,
        //         'adopt_date' => $faker->date,
        //         'adopt_payment' => ($faker->numberBetween(200, 600)),
        //         'adopt_status' => 'Pending',
        //         'adopter' => null,
        //         'owner_id' => ($faker->numberBetween(2, 16)),
        //         'old_owner_id' => null, 
        //'pet_id' => ($faker->numberBetween(22, 31)),
        //         'created_at' => \Carbon\Carbon::now(),
        //        
        //         'updated_at' => \Carbon\Carbon::now(),
        //     ]
        // ];
        // foreach (range(1, 20) as $i) {

        //     foreach ($adopt as $key => $value) {
        //         Adoption::create($adopt);
        //     }
        // }

    }
}
