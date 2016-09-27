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

    public function isEmployee()
    {
        return ($this->roles()->count()) ? true : false ;
    }

    public function hasRole($role)
    {
        return in_array($this->roles->pluck("name"), $role) ;
    }

    public function getRoleIdInArray($array, $term)
    {
        foreach($array as $key => $value) {
            if($value = $term){
                return $key;
            }
        }
        throw new UnexpectedValueException;
    }

    public function makeEmployee($title)
    {
        $assigned_roles = [];
        $roles = Role::all()->pluck("name","id");

        switch ($title) {
            case 'super_admin':
                $assigned_roles[] = $this->getRoleIdInArray($roles,'create');
                $assigned_roles[] = $this->getRoleIdInArray($roles,'update');
            case 'admin':
                $assigned_roles[] = $this->getRoleIdInArray($roles,'delete');
                $assigned_roles[] = $this->getRoleIdInArray($roles,'ban');
            case 'moderator':
                $assigned_roles[] = $this->getRoleIdInArray($roles,'kickass');
                $assigned_roles[] = $this->getRoleIdInArray($roles,'lemons');
                break;
            default:
                throw new \Exception("The employee status entered does not exist");
        }
        $this->roles()->sync($assigned_roles);
    }
}
