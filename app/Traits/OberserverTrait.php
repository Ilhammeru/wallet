<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait OberserverTrait {
    public static function bootOberserverTrait()
    {
        static::retrieved(function (Model $model) {
            $encode = encodeID($model->id);

            $model->uid = $encode;
        });
    }
}
