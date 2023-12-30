<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $faker = Faker::create();
        // foreach (range(1, 10) as $i) {
        //     DB::table('bookings')->insert([
        //         'booking_date' => $faker->date,
        //         'booking_time' => $faker->time,
        //         'booking_payment' => ($faker->numberBetween(200, 600)),
        //         'booking_status' => 'Pending',
        //         'requester_id' => ($faker->numberBetween(1, 12)),
        //         'petshooter_id' => ($faker->numberBetween(1, 12)),

        //     ]);
        // }

        DB::table('bookings')->insert(
            [
                [
                    'booking_date' => '10-31-2023',
                    'booking_time' => '11:30AM',
                    'booking_payment' => '400',
                    'booking_status' => 'Pending',
                    'requester_id' => 11,
                    'petshooter_id' => 15,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'booking_date' => '10-31-2023',
                    'booking_time' => '11:30AM',
                    'booking_payment' => '400',
                    'booking_status' => 'Cancelled',
                    'requester_id' => 11,
                    'petshooter_id' => 15,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),

                ],
                [
                    'booking_date' => '10-31-2023',
                    'booking_time' => '11:30AM',
                    'booking_payment' => '350',
                    'booking_status' => 'Pending',
                    'requester_id' => 11,
                    'petshooter_id' => 15,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),

                ]
            ],
        );

        // $faker = Faker::create();
        // $booking = [
        //     [
        //         'booking_date' => '10-31-2023',
        //         'booking_time' => '11:30AM',
        //         'booking_payment' => '400',
        //         'booking_status' => 'Pending',
        //         'requester_id' => 11,
        //         'petshooter_id' => 15,
        //         'created_at' => \Carbon\Carbon::now(),
        //         'updated_at' => \Carbon\Carbon::now(),
        //     ],
        //     [
        //         'booking_date' => '10-31-2023',
        //         'booking_time' => '11:30AM',
        //         'booking_payment' => '400',
        //         'booking_status' => 'Cancelled',
        //         'requester_id' => 11,
        //         'petshooter_id' => 15,
        //         'created_at' => \Carbon\Carbon::now(),
        //         'updated_at' => \Carbon\Carbon::now(),

        //     ],
        //     [
        //         'booking_date' => '10-31-2023',
        //         'booking_time' => '11:30AM',
        //         'booking_payment' => '350',
        //         'booking_status' => 'Pending',
        //         'requester_id' => 11,
        //         'petshooter_id' => 15,
        //         'created_at' => \Carbon\Carbon::now(),
        //         'updated_at' => \Carbon\Carbon::now(),

        //     ]
        // ];

        // // foreach (range(1, 10) as $i) {

        // foreach ($booking as $key => $value) {
        //     Booking::create($booking);
        // }
        // // }



    }
}
