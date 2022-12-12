<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin  extends Authenticatable implements JWTSubject
{
    protected $table = 'admins';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    use HasFactory;


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
