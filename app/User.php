<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /*Inverse One-to-many relationship with Role model(i.e One role can have multiple users)*/
    public function role(){
        return $this->belongsTo('App\Role');
    }
    /*Inverse One-to-many relationship with Photo model(i.e One Photo can be used by multiple users)*/
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
    /*This function will return the role of the user*/
    public function checkRole(){
        $roleName = $this->role->name;
        return $roleName;
    }
}
