<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
        'name', 'email', 'phone', 'avatar', 'password','confirmation_token','api_token','verify_code','settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $casts = [
        'settings' => array()
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tips()
    {
        return $this->hasMany(Tip::class);
    }


    public function owns(Model $model)
    {
         return $this->id === $model->user_id;
    }

}
