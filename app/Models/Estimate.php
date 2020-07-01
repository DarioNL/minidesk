<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Estimate extends Authenticatable
{
    use Notifiable , SoftDeletes, UsesUuid;

    protected $table = 'estimates';

    protected $primaryKey = 'id';


    protected $fillable = [
       'total', 'discount', 'sign_id', 'company_id', 'client_id', 'amount', 'send_date', 'due_date',
    ];


    public function Company()
    {
        return $this->hasOne(Company::class ,'id', 'company_id');
    }

    public function Client()
    {
        return $this->hasOne(Client::class ,'id', 'client_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class ,'estimate_id', 'id');
    }

}
