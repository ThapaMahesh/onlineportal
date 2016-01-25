<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'replies';

    /**
     * The database softdelete field activate.
     *
     * @var string
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forum_id', 'reply', 'user_id', 'solution'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function forum(){
        return $this->belongsTo('App\Forum');
    }

}
