<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;


class Company extends Authenticatable
{
    use Notifiable , SoftDeletes;

    protected $table = 'companies';

    protected $primaryKey = 'id';


    protected $fillable = [
        'name', 'email', 'password', 'address', 'zipcode', 'city', 'house_number', 'phone', 'vat_number', 'logo'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }
}
