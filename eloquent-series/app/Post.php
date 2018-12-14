<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RecordActivity;
class Post extends Model
{
    use RecordActivity;
    protected $fillable=['body','user_id','title'];
    public function comments() {

        return $this->morphMany(Comment::class, 'comment');

    }
}
