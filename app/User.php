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
        'first_name','last_name', 'nickname', 'email', 'password',
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

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }

    public function isEmployee()
    {
        return ($this->roles()->count()) ? true : false ;
    }

    public function hasRole($role)
    {
        return in_array($this->roles->pluck("name"), $role) ;
    }

    public function getPermissionIdInArray($array, $term)
    {
        foreach($array as $key => $value) {
            if($value = $term){
                return $key;
            }
        }
        throw new UnexpectedValueException;
    }

    public function getPermissions($role)
    {
        $assigned_permissions = [];

        $permissions = Peromision::all()->pluck("name","id");

        switch ($role) {
            case 'super_admin':
                $assigned_permissions[] = $this->getPermissionIdInArray($permissions,'create');
                $assigned_permissions[] = $this->getPermissionIdInArray($permissions,'update');
                $assigned_permissions[] = $this->getPermissionIdInArray($permissions,'delete');
            case 'admin':
            case 'operator':
                $assigned_permissions[] = $this->getPermissionIdInArray($permissions,'ban');
            case 'moderator':
                $assigned_permissions[] = $this->getPermissionIdInArray($permissions,'attention');
                break;
            default:
                $assigned_permissions[] = $this->getPermissionIdInArray($permissions,'read');
        }
        $this->permissions()->sync($assigned_permissions);
    }
}
