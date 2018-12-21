<?php

namespace App;

use App\Events\UserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirm_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function register(array $array) {

        $user = static::create($array);
//        event(new UserRegistered($user)); 打开发送邮件
        return $user;

    }
    public function discussions() {
        return $this->hasMany(Discussion::class);
        
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }
}
