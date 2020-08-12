<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Company extends Authenticatable
{

    use Notifiable , SoftDeletes, UsesUuid;

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

    public function Clients()
    {
       return $this->hasMany(Client::class , 'company_id', 'id');
    }

    public function Estimates()
    {
       return $this->hasMany(Estimate::class , 'company_id', 'id');
    }

    public function Invoices()
    {
      return  $this->hasMany(Invoice::class , 'company_id', 'id');
    }
}
