<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    protected $guarded = [];
    //
    use SoftDeletes, HasUUID;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'uuid');
    }
}