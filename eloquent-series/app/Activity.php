<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable=['user_id','conversation_type','conversation_id'];
    public function conversation() {

        return $this->morphTo();

    }

    public function user() {

        return $this->belongsTo(User::class);

    }
}
