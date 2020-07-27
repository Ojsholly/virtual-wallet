<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public $guarded = [];

    //
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'uuid');
    }

    public function existing_transaction($txn_id, $txn_ref)
    {
        return $this->where('uuid', $txn_id)->where('txn_ref', $txn_ref)->exists();
    }
}