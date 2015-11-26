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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Items::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'title' => $faker->word,
        'description' => $faker->sentence,
        'keywords' => implode(' ',$faker->words(3)),
        'short_text' => $faker->sentence,
        'text' => $faker->text,
        'obj' => str_random(20),
    ];
});

$factory->define(App\Content::class, function (Faker\Generator $faker) {
    return [
        'parent_id' => $faker->numberBetween(1,20),
        'type' => $faker->word,
        'menu' => $faker->word,
        'name' => $faker->word,
        'order' => $faker->numberBetween(1,100),
        'pseudo_url' => $faker->word,
        'title' => $faker->word,
        'description' => $faker->sentence,
        'keywords' => implode(' ',$faker->words(3)),
        'short_text' => $faker->sentence,
        'text' => $faker->text,
    ];
});