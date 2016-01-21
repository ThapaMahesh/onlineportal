<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecretKey extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'secret-keys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'status', 'type'
    ];

}
