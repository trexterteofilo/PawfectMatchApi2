<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        DB::table('subscriptions')->insert(
            [
                [
                    'sub_type' => 'Basic',
                    'subs_plan' => 'Free',
                    'subs_user' => 'pet_owner',
                    'subs_price' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'sub_type' => 'Premium',
                    'subs_plan' => 'Monthly',
                    'subs_user' => 'pet_owner',
                    'subs_price' => '150',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'sub_type' => 'Premium',
                    'subs_plan' => 'Annually',
                    'subs_user' => 'pet_owner',
                    'subs_price' => '1500',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'sub_type' => 'Premium',
                    'subs_plan' => 'Monthly',
                    'subs_user' => 'pet_shooter',
                    'subs_price' => '150',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'sub_type' => 'Premium',
                    'subs_plan' => 'Annually',
                    'subs_user' => 'pet_shooter',
                    'subs_price' => '1500',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'sub_type' => 'Premium',
                    'subs_plan' => 'Monthly',
                    'subs_user' => 'dual',
                    'subs_price' => '250',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'sub_type' => 'Premium',
                    'subs_plan' => 'Annually',
                    'subs_user' => 'dual',
                    'subs_price' => '2500',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
            ]
        );
    }
}
