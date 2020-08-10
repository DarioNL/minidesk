<?php

namespace App\Models;

use App\Mail\LoginInfo;
use App\Models\Concerns\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;


class Client extends Authenticatable
{
    use Notifiable , SoftDeletes, UsesUuid;

    protected $table = 'clients';

    protected $primaryKey = 'id';


    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'zipcode', 'city', 'house_number', 'house_number_suffix' , 'phone', 'vat_number', 'logo', 'company_id'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function sendLoginInfo($email, $password)
    {
        Mail::to($email)->send(new LoginInfo($email, $password));
    }


    public function Company()
    {
        return $this->hasOne(Company::class ,'id', 'company_id');
    }

    public function Estimates()
    {
        return $this->hasMany(Estimate::class , 'client_id', 'id');
    }

    public function Invoices()
    {
        return $this->hasMany(Estimate::class , 'client_id', 'id');
    }


}
