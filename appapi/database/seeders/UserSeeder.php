<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        // $products = factory(\App\Product::class, 100)->create();

        // $faker = Faker::create();
        // $imageUrl = $faker->imageUrl(640, 480, null, false);

        // foreach ($products as $product) {

        //     $product->addMediaFromUrl($imageUrl)->toMediaCollection('products');

        // }


        // $faker = Faker::create();
        // $factory->define(App\User::class, function (Faker $faker) {
        //     $firstName = $faker->firstName();
        //     $lastName = $faker->lastName();
        //     return [
        //         'first_name' => $firstName,
        //         'last_name' => $lastName,
        //         'slug' => Str::slug($lastName . ', ' . $firstName)
        //     ];
        // });
        // for ($i = 1; $i <= 10; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $faker->firstName,
        //         'lastname' => $faker->lastName,
        //         'address' => $faker->address,
        //         'bio' => $faker->paragraph(3, true),
        //         'age' => $faker->numberBetween(11, 99),
        //         'email' => $faker->email,
        //         'image' => $faker->imageUrl,
        //         'password' => 123456,
        //         //   $live =$faker->shuffle([1, 2]),
        //         'role' => $faker->shuffle([1, 2]),
        //         'accounttype' => $faker->randomElement(['pet_owner', 'pet_shooter', 'dual', 'admin']),

        //     ]);
    }
}
//     public $faker function role(){
// DB::table('users')->select('role')->get();
//             if ($role != 1) {
//                 DB::table('users')->insert([
//                     'accounttype' => $faker->randomElement(['pet_owner', 'pet_shooter', 'dual']),
//                 ]);
//             } else {
//                 DB::table('users')->insert([
//                     'accounttype' => 'admin',
//                 ]);
//             }
//     }

