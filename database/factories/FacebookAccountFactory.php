<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FacebookAccount;
use Faker\Generator as Faker;

$factory->define(FacebookAccount::class, function (Faker $faker) {   
    global $a;
    $a++;
    return [
        'username' => $faker->name,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'facebook_token' => $faker->password,//It will generate as a random token string.
        "user_id"=>$a,//Each Facebook Account will have a unique id
    ];

});
