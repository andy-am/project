<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name','codename',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function hasPermission($permName)
    {
        dd($this->permissions);
        foreach ($this->permissions as $perm) {
            if ($perm->name == $permName) {
                return true;
            }
        }
        return false;
    }
}
