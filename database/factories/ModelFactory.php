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
$factory->define(Inayat\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Inayat\Account::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'amount' => $faker->randomNumber(4),
        'reference' => $faker->word,
        'transaction' => 'savings',
        'status' => 'active',
        'type' => 'credit',
        'approver' => 'Mogaji Aremu'
    ];
});
