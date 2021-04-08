<?php

use App\Modules\Wordclouds\Models\Wordcloud;
use App\Modules\Wordclouds\Models\WordcloudEntry;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(Wordcloud::class, static function (Faker $faker) {
    return [
        'position' => 1,
        'question' => $faker->sentence,
        'action' => $faker->words(),
        'active' => 0,
        'character_limit' => 20
    ];
});

$factory->define(WordcloudEntry::class, static function (Faker $faker) {
    return [
//        'wordcloud_id' => factory(Wordcloud::class)->create(),
        'wordcloud_id' => 1,
        'word' => $faker->word,
        'count' => 1,
        'status' => 'accepted',
    ];
});
