<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    $a=$faker->numberBetween($min = 1, $max =  DB::table('users')->count());
    $c=$faker->numberBetween($min = 1, $max = DB::table('categories')->count());
    return [
        "title"=>$faker->text($maxNbChars = 30),
        "body"=>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        "user_id"=>$a,
        "category_id"=>$c,
    ];
});
