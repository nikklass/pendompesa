<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->randomElement($array = array ('m','f')),
        'email' => $faker->unique()->safeEmail,
        'phone_number' => "2547" . $faker->numberBetween(11,99) . $faker->numberBetween(100000,999999),
        'company_id' => $faker->numberBetween(2,21),
        'password' => $password ?: $password = bcrypt('123'),
        'remember_token' => str_random(10),
        'sms_user_name' => '',
        'account_number' => $faker->numberBetween(1000,99999),
        'api_token' => str_random(60),
        'created_by' => 5,
        'updated_by' => 5,
    ];
});

$factory->define(App\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->paragraph,
        'physical_address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'company_id' => $faker->numberBetween(1,50),
        'box' => $faker->numberBetween(250, 5000),
        'phone_number' => $faker->numberBetween(1000,99999),
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180) 
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->paragraph,
        'physical_address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'box' => $faker->numberBetween(250, 5000),
        'phone_number' => $faker->numberBetween(1000,99999),
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'created_by' => '1', 
        'updated_by' => '1'
    ];
});

