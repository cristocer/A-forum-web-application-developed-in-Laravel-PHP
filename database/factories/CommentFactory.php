<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $a=$faker->numberBetween($min = 1, $max = DB::table('users')->count());
    return [
        "content"=>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        "user_id"=>$a,
    ];
});

$factory->state(Comment::class, 'post', function (Faker $faker) {
    $c=$faker->numberBetween($min = 1, $max = DB::table('posts')->count());
    return [
        "post_id"=>$c,
    ];
});
$factory->state(Comment::class, 'thread', function (Faker $faker) {
    $b=$faker->numberBetween($min = 1, $max = DB::table('threads')->count());
    return [
        "thread_id"=>$b,
    ];
});