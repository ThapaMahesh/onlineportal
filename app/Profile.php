<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    /**
     * The database softdelete field activate.
     *
     * @var string
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'email', 'phone', 'dob', 'semester', 'image', 'faculty_id', 'user_id', 'gender', 'year_joined'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }

    public function courseprofiles(){
        return $this->hasMany('App\CourseProfile');   
    }

    public function imgloc($id){
        $profile = Profile::find($id);
        if($profile->image == ""){
            if($profile->gender == 'Female'){
                $path = url('/').'/asset/img/female.png';
            }else{
                $path = url('/').'/asset/img/male.png';
            }
        }else{
            $path = url('/').'/asset/userimage/'.$profile->image;
        }
        return $path;
    }

}
