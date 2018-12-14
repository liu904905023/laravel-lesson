<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RecordActivity;
class Lesson extends Model
{
    use RecordActivity;

    public function comments() {

        return $this->morphMany(Comment::class, 'comment');

    }
}
