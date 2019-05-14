<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        'role_id' => $faker->numberBetween($min = 1,$max = 3),
        'is_active' => $faker->numberBetween($min = 0,$max = 1),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('work1234'),   //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,2),
        'photo_id' => 1,
        'title' => $faker->sentence(10,15),
        'body' => $faker->paragraph(rand(100,200),true),
    ];
});
