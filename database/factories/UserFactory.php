<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\product;
use App\category_product;
use App\chapter;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' =>bcrypt('12345'), // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(product::class, function (Faker $faker) {
    $name = $faker->unique()->sentence;
    $isPublished = ['1', '0'];
    return [
        'category_id' => rand(1, 5),
        'name' => $name,
        'slug' => str_slug($name),
        'thumbnail' => $faker->sentence,
        'author'=>$faker->name,
        'details' => $faker->paragraph,
        'especially' => $isPublished[rand(0, 1)],
        'is_published' => $isPublished[rand(0, 1)],
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
$factory->define(category_product::class, function (Faker $faker) {
    return [
        'category_id' => rand(1, 5),
        'product_id' => rand(1, 100),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
$factory->define(chapter::class, function (Faker $faker) {
    $name = $faker->unique()->sentence;
    return [
        'product_id' => rand(1, 100),
        'chapter'=>rand(1, 100),
        'name' => $name,
        'slug' => str_slug($name),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

