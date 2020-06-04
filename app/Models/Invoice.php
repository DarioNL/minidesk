<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Invoice extends Authenticatable
{
    use Notifiable , SoftDeletes, UsesUuid;

    protected $table = 'invoices';

    protected $primaryKey = 'id';


    protected $fillable = [
        'company_id', 'client_id', 'amount', 'sent_date', 'due_date', 'sign_date'
    ];


    public function Company()
    {
        return $this->hasOne(Company::class ,'id', 'company_id');
    }

    public function Client()
    {
        return $this->hasOne(Client::class ,'id', 'client_id');
    }


}
