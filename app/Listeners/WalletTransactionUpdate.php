<?php

namespace App\Listeners;

use App\Wallet;
use Illuminate\Support\Facades\Auth;


class WalletTransactionUpdate
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

        $balance = Auth::user()->wallet->balance;

        $wallet = Wallet::where('user_id', Auth::user()->uuid)->first();
        $wallet->balance = $balance + $event->transaction->data->amount;
        $wallet->save();
    }
}