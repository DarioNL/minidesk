<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

trait UsesUuid
{
    public static function boot()
    {
        parent::boot();


        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Uuid::generate(4);
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
