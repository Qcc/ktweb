<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    $now = Carbon::now()->toDateTimeString();

    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'phone' => $faker->numberBetween($min = 13, $max = 18).$faker->numberBetween($min = 100000000, $max = 900000000),
        'remember_token' => str_random(10),
        'introduction' => $faker->sentence(),
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
