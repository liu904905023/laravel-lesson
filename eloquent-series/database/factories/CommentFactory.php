<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    $lessonid = \App\Lesson::all()->pluck('id')->toArray();
    $postidid = \App\Post::all()->pluck('id')->toArray();
    return [
        'comment_type'=>$faker->randomElement($array = array ('App\Post','App\Lesson')),
        'comment_id' => $faker->randomElement($array = array_merge($lessonid, $postidid)),
        'body' => $faker->title,

    ];
});
