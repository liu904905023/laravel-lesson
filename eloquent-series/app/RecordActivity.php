<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/14
 * Time: 14:28
 */

namespace App;


use Illuminate\Support\Facades\Auth;

trait RecordActivity {
    public static function bootRecordActivity() {
        foreach (static::getModelEvents() as $Event) {
            static::$Event(function ($model) {
                $model->recordActivity();
            });
         }
    }

    public function recordActivity() {
        Activity::create([
            'user_id' => Auth::id(),
            'conversation_id'=>$this->id,
            'conversation_type'=>get_class($this)

        ]);

    }

    protected static function getModelEvents() {

        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }
        return ['created'];
    }
}