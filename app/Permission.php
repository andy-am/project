<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name','codename',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
