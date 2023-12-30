<?php

namespace Database\Seeders;

use App\Models\Agreement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;


class AgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        foreach (range(1, 10) as $i) {
            DB::table('agreements')->insert([
                'recipient_id' => ($faker->numberBetween(2, 16)),
                'requester_id' => ($faker->numberBetween(2, 16)),
                'requester_pet_id' => ($faker->numberBetween(22, 31)),
                'recipient_pet_id' => ($faker->numberBetween(22, 31)),
                'agreement_date' => $faker->date,
                'agreement_info' => $faker->paragraph,
                'agreement_location' => $faker->address,
                'agreement_payperson' => $faker->name,
                'first_session' => $faker->date,
                'second_session' => $faker->date,
                'third_session' => $faker->date,
                'agreement_shooter' => ($faker->numberBetween(2, 16)),
                'agreement_payment' => ($faker->numberBetween(200, 600)),
                'agreement_paymode' => $faker->randomElement(['cash', 'share']),
                'agreement_status' => 'Pending',
                // 'breeding_date' => $faker->date,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
        // $agreement = [
        //     [
        //         'recipient_id' => ($faker->numberBetween(1, 12)),
        //         'requester_id' => ($faker->numberBetween(1, 12)),
        //         'requester_pet_id' => ($faker->numberBetween(1, 12)),
        //         'recipient_pet_id' => ($faker->numberBetween(1, 12)),
        //         'agreement_date' => $faker->date,
        //         'agreement_info' => $faker->paragraph,
        //         'agreement_location' => $faker->address,
        //         'agreement_payperson' => $faker->name,
        //         'agreement_shooter' => ($faker->numberBetween(1, 12)),
        //         'agreement_payment' => ($faker->numberBetween(200, 600)),
        //         'agreement_paymode' => $faker->randomElement(['cash', 'share']),
        //         'agreement_status' => 'Pending',
        //         'breeding_date' => $faker->date,
        //         'created_at' => \Carbon\Carbon::now(),
        //         'updated_at' => \Carbon\Carbon::now(),
        //     ]
        // ];
        // foreach (range(1, 10) as $i) {

        //     foreach ($agreement as $key => $value) {
        //         Agreement::create($agreement);
        //     }
        // }


    }
}
