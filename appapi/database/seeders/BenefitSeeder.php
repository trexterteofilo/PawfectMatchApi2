<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('benefits')->insert(
            [
                //✓ Message Pet Owners    
                // ✓ Find pet partner
                // ✓ 1 pet profile
                // 𐤕  Adoption
                // 𐤕  Add more pets
                // 𐤕  Book Shooter
                // 𐤕 View Reports
                // 𐤕  Filters
                ///////////// 1 Pet owner basic
                [
                    'subs_benefit' => 'Message Pet Owners',
                    'subs_id' => '1',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Find pet partner',
                    'subs_id' => '1',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => '1 pet profile',
                    'subs_id' => '1',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Adoption',
                    'subs_id' => '1',
                    'subs_cons' => '1',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Add more pets',
                    'subs_id' => '1',
                    'subs_cons' => '1',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Book Shooter',
                    'subs_id' => '1',
                    'subs_cons' => '1',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'View Reports',
                    'subs_id' => '1',
                    'subs_cons' => '1',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Filters',
                    'subs_id' => '1',
                    'subs_cons' => '1',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],

                // ✓ Message Pet Owners    
                // ✓ Find pet partner
                // ✓ 1 pet profile
                // ✓  Adoption
                // ✓  Add more pets
                // ✓  Book Shooter
                // ✓ View Reports
                // ✓  Filters

                //////////// 2 Pet Owner monthly 
                [
                    'subs_benefit' => 'Message Pet Owners',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Find pet partner',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => '1 pet profile',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Adoption',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Add more pets',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Book Shooter',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'View Reports',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Filters',
                    'subs_id' => '2',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],


                ///////// 3 Pet owner annually

                [
                    'subs_benefit' => 'Message Pet Owners',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Find pet partner',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => '1 pet profile',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Adoption',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Add more pets',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Book Shooter',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'View Reports',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Filters',
                    'subs_id' => '3',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],

                //✓ Accept Bookings
                // ✓ View Reports
                // ✓ Messaging
                ////// 4 Pet shooter monthly

                [
                    'subs_benefit' => 'Accept Bookings',
                    'subs_id' => '4',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'View Reports',
                    'subs_id' => '4',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Messaging',
                    'subs_id' => '4',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                ////// 5 Pet shooter annually

                [
                    'subs_benefit' => 'Accept Bookings',
                    'subs_id' => '5',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'View Reports',
                    'subs_id' => '5',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Messaging',
                    'subs_id' => '5',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],

                // ✓ Messaging    
                // ✓ Find pet partner
                // ✓ 1 pet profile
                // ✓ View Reports
                // ✓ Accept Bookings 
                // ✓ Adoption
                // ✓ Add more pets
                // ✓ Book Shooter
                // ✓ View Reports
                // ✓ Filters

                //////////// 6 dual monthly 
                [
                    'subs_benefit' => 'Messaging',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Find pet partner',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => '1 pet profile',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'View Reports',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Accept Bookings ',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Adoption',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Add more pets',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Book Shooter',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Filters',
                    'subs_id' => '6',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],


                ///////// 7 dual annually

                [
                    'subs_benefit' => 'Messaging',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Find pet partner',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => '1 pet profile',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'View Reports',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Accept Bookings ',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Adoption',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Add more pets',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Book Shooter',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'subs_benefit' => 'Filters',
                    'subs_id' => '7',
                    'subs_cons' => '0',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],

            ]
        );
    }
}
