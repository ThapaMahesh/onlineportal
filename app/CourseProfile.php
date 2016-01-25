<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CourseProfile extends Model
{
    // use SoftDeletes;

    /**
     * The database softdelete field activate.
     *
     * @var string
     *
     *  protected $dates = ['deleted_at'];
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course-profiles';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'profile_id'
    ];


    public function course(){
    	return $this->belongsTo('App\Course');
    }

    public function profile(){
    	return $this->belongsTo('App\Profile');
    }
}
