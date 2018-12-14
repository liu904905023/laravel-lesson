<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RecordActivity;
class Comment extends Model
{
    /* function comment
     * 此处对应 2018_12_14_031155_create_comments_table.php中
     * comment_type与comment_id
     * */
    use RecordActivity;

    protected $fillable = ['body'];
    public function comment() {


        return $this->morphTo();
        
    }
}
