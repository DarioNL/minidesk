<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Products extends Authenticatable
{
    use Notifiable , SoftDeletes, UsesUuid;

    protected $table = 'products';

    protected $primaryKey = 'id';


    protected $fillable = [
       'description', 'amount', 'estimate_id', 'tax', 'price', 'total', 'invoice'
    ];


    public function Company()
    {
        return $this->hasOne(Company::class ,'id', 'company_id');
    }

    public function Client()
    {
        return $this->hasOne(Client::class ,'id', 'client_id');
    }

    public function estimate()
    {
        return $this->hasOne(Estimate::class ,'id', 'estimate_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class ,'id', 'invoice_id');
    }

}
