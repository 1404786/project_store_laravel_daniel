<?php

namespace App\Models;

use App\Models\Balance;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Historic;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function balance () {
        return $this->hasOne(Balance::class);
        //Faz relacionamento de 1 pra 1
    }

    //relacinamento um pra muitos, ou seja um usuário muitos históricos
    public function historics () {
        return $this->hasMany(Historic::class);
    }

    public function getSender ($sender)
    {
        return $this->where('name', 'LIKE', "%$sender%")
            ->orWhere('email', $sender)
//            ->toSql(); //Muito usado para debugar as queries
            ->get()
            ->first();
    }
    
} 
