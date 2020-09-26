<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'title' => $faker->streetName,
        'year_of_publication' => $faker->year,
        'place_of_publication' => $faker->city,
        'price' => $faker->randomFloat(2, 100, 500)
    ];
});
