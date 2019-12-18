<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vote;
use Faker\Generator as Faker;

$factory->define(Vote::class, function (Faker $faker) {
    return [
        "up_count"=>$faker->numberBetween($min = 1, $max = 300),
        "down_count"=>$faker->numberBetween($min = 1, $max = 300),
    ];
});
$factory->state(Vote::class, 'thread', function (Faker $faker) {
    $b=$faker->numberBetween($min = 1, $max = DB::table('threads')->count());
    return [
        "thread_id"=>$b,
    ];
});
$factory->state(Vote::class, 'post', function (Faker $faker) {
    $c=$faker->numberBetween($min = 1, $max = DB::table('posts')->count());
    return [
        "post_id"=>$c,
    ];
});
$factory->state(Vote::class, 'comment', function (Faker $faker) {
    $b=$faker->numberBetween($min = 1, $max = DB::table('comments')->count());
    return [
        "comment_id"=>$b,
    ];
});
