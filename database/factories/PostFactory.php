<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $a=$faker->numberBetween($min = 1, $max = DB::table('users')->count());
    $b=$faker->numberBetween($min = 1, $max = DB::table('threads')->count());
    //$c=$faker->numberBetween($min = 1, $max = DB::table('categories')->count());
    return [
        "body"=>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        "user_id"=>$a,
        "thread_id"=>$b,
        //"category_id"=>$c,
        //"thread_id"=>1,
    ];
});
