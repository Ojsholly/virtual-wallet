<?php

namespace App\Listeners;


use App\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogWalletWithdrawal
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
            'uuid' => $event->response->data->id,
            'txn_ref' => $event->response->data->reference,
            'user_id' => Auth::user()->uuid,
            'amount' => $event->response->data->amount,
            'type' => 'Debit',
            'title' => 'Withdrawal to Bank Account',
            'narration' => 'WIthdrawal to bank account ' . $event->response->data->bank_name . " " . $event->response->data->account_number,
            'status' => 1
        ]);
    }
}