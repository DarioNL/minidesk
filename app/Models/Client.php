<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Client extends Authenticatable
{
    use Notifiable , SoftDeletes, UsesUuid;

    protected $table = 'clients';

    protected $primaryKey = 'id';


    protected $fillable = [
        'name', 'email', 'password', 'address', 'zipcode', 'city', 'house_number', 'phone', 'vat_number', 'logo', 'company_id'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Company()
    {
        return $this->hasOne(Company::class ,'id', 'company_id');
    }

    public function Estimates()
    {
        $this->hasMany(Estimate::class , 'client_id', 'id');
    }

    public function Invoices()
    {
        $this->hasMany(Estimate::class , 'client_id', 'id');
    }


}
