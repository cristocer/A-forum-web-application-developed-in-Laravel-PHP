<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    global $e;
    $e++;
    $array1 = array ("spare","Amphibians","Birds","Fish","Mammals","Reptiles");
    return [
        "name"=>$array1[$e],
    ];
    
});
