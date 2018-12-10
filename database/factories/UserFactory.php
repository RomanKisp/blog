<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\Category::class, 'categories', function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text($maxNbChars = 150),
    ];
});

$factory->defineAs(App\Post::class, 'posts', function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'content' => $faker->realText($maxNbChars = 1000, $indexSize = 3),
        // 'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});


