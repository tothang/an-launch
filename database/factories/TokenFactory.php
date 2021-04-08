<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(App\Token::class, static function (Faker $faker) {
    return [
        'token' => Str::random(\App\Token::$length),
        'type' => \App\Token::TYPE_AUTH,
        'expires_at' => \App\Token::expiryFor(\App\Token::TYPE_AUTH),
        'tokenable_type' => App\User::class,
        'tokenable_id' => factory(\App\User::class)->create()->id,
    ];
});

$factory->state(\App\Token::class, 'expired', static function () {
    return [
        'expires_at' => now()->subDay(),
    ];
});

$factory->state(\App\Token::class, 'permanent', static function () {
    return [
        'expires_at' => null,
    ];
});
