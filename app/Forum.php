<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forums';

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
        'question', 'user_id', 'solved', 'tags', 'description'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function tags(){
        $forums = Forum::get();
        $tags = $forums->lists('tags')->toArray();
        $alltags = [];
        foreach ($tags as $eachtag) {
            if($eachtag != ""){
                $tagArray = explode(', ', $eachtag);
            }
            $alltags = array_merge($alltags, $tagArray);
        }
        return array_unique($alltags);
    }

}
