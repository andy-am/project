<?php

namespace App;

use Doctrine\Instantiator\Exception\UnexpectedValueException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'nickname', 'role_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Project');
        //return $this->belongsToMany('App\Project','project_user','user_id');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function isAdmin(){

        if ($this->role->name == 'admin') {
            return true;
        }

        return false;
    }

    public function isSuperAdmin(){

        if ($this->role->name == 'super_admin') {
            return true;
        }
        return false;
    }

    public function hasRole($roleName)
    {
        if ($this->role->name == $roleName) {
            return true;
        }
        return false;
    }

    public function options(){
        return $this->hasOne('App\Option');
    }
}
