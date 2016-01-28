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

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [

    	'title' => $faker->company,
    	'description' => $faker->paragraphs(3,true),
    	'lat' => $faker->latitude,
    	'lng' => $faker->longitude,
    	'image' => $faker->imageUrl($width = 640, $height = 480),
    	'day_id' => $faker->numberBetween($min = 1, $max = 7),
    	'category_id' => $faker->numberBetween($min = 1, $max = 3),
    	'city_id' => $faker->numberBetween($min = 1, $max = 8)

    ];
});

