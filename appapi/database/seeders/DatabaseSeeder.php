<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
                // \App\Models\User::factory(10 )->create();

                // \App\Models\User::factory()->create([
                //     'name' => 'Test User',
                //     'email' => 'test@example.com',
                // ]);

                $this->call(UserSeeder::class);
                $this->call(PetSeeder::class);
                $this->call(AdoptionSeeder::class);
                $this->call(AgreementSeeder::class);
                $this->call(BookingSeeder::class);
                $this->call(PetShooterSeeder::class);
                $this->call(AdoptionSeeder::class);
                $this->call(AgreementSeeder::class);
                $this->call(BookingSeeder::class);
        }
}
