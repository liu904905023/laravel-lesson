<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    $userid = \App\User::all()->pluck('id')->toArray();
    $discussionid = \App\Discussion::all()->pluck('id')->toArray();
    return [
        'body' => $faker->sentence,
        'user_id' =>$faker->randomElement($userid),
        'discussion_id' => 1,
    ];
});
