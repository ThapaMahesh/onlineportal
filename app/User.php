<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
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
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'active', 'clz_key', 'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'clz_key'
    ];


    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function files(){
        return $this->hasMany('App\File');
    }

    public function forums(){
        return $this->hasMany('App\Forum');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    // public function permission(){
    //     $user = $this->find(Auth::user()->id);
    //     $role = Role::find($user->role_id);
    //     return $role->permission;
    // }
}
