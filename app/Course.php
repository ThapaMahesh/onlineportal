<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

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
        'faculty_id', 'name', 'course_code'
    ];


    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }


    public function files(){
        return $this->hasMany('App\File');
    }

    public function courseprofiles(){
        return $this->hasMany('App\CourseProfile');   
    }

}
