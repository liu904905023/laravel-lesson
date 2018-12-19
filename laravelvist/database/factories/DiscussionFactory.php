<?php

use Faker\Generator as Faker;

$factory->define(\App\Discussion::class, function (Faker $faker) {
    $userid = \App\User::all()->pluck('id')->toArray();
    return [
        'title' => $faker->sentence,
        'body' => $faker->sentence,
        'user_id' =>$faker->randomElement($userid),
        'last_user_id' => $faker->randomElement($userid),
    ];
});
