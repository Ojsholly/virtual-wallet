<?php

namespace App\Listeners;

use App\Transaction;
use Illuminate\Support\Facades\Auth;

class LogFailedTransaction
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        new Transaction();

        return Transaction::create([
            'uuid' => $event->response->transaction_id,
            'user_id' => Auth::user()->uuid,
            'amount' => $event->response->amount,
            'type' => 'Credit',
            'status' => 0
        ]);
    }
}