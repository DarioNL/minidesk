<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;


class Estimate extends Authenticatable
{
    use Notifiable , SoftDeletes, UsesUuid, Searchable;

    protected $table = 'estimates';

    protected $primaryKey = 'id';


    protected $fillable = [
       'total', 'discount', 'sign_id', 'company_id', 'client_id', 'amount', 'send_date', 'due_date', 'title', 'color',
    ];

    public function Company()
    {
        return $this->hasOne(Company::class ,'id', 'company_id');
    }

    public function Client()
    {
        return $this->hasOne(Client::class ,'id', 'client_id');
    }

    public function Invoice()
    {
        return $this->hasOne(Invoice::class ,'estimate_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Products::class ,'estimate_id', 'id');
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Add an extra attribute:
        if ($this->Client){
            $array['first_name'] = $this->Client->first_name;
            $array['last_name'] = $this->Client->last_name;
        }else{
            $array['first_name'] = null;
            $array['last_name'] = null;
        }

        return $array;
    }

    public function searchableAs()
    {
        return '_estimates_';
    }
}
