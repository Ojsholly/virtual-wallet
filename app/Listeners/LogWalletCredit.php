<?php

namespace App\Listeners;

use App\Transaction;
use Illuminate\Support\Facades\Auth;

class LogWalletCredit
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
            'uuid' => $event->transaction->data->id,
            'txn_ref' => $event->transaction->data->tx_ref,
            'user_id' => Auth::user()->uuid,
            'amount'  => $event->transaction->data->amount,
            'type'   => 'Credit',
            'narration' => 'Wallet Credit',
            'status' => 1
        ]);
    }
}