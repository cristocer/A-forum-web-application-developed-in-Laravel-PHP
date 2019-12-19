<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    global $e;
    $e++;
    $array1 = array ("spare","Dairy Foods","Fish and Seafood","Fruits","Grains, Beans and Nuts","Meat and Poultry","Vegetables");
    return [
        "name"=>$array1[$e],
    ];
    
});
