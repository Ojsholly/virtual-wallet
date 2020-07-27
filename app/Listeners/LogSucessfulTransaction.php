<?php

namespace App\Listeners;

use App\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LogSucessfulTransaction
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

        $txn_ref = 'VW-' . mt_rand();
        $txn_id = Str::random(16);

        Transaction::create([
            'uuid' => $txn_id,
            'txn_ref' => $txn_ref,
            'user_id' => Auth::user()->uuid,
            'amount' => $event->data->amount,
            'type' => 'Debit',
            'title' => 'Transfer to ' . $event->data->recipient,
            'narration' => $event->data->narration,
            'status' => 1
        ]);


        Transaction::create([
            'uuid' => $txn_id,
            'txn_ref' => $txn_ref,
            'user_id' => $event->data->recipient_uuid,
            'amount'  => $event->data->amount,
            'title' => 'Transfer from ' . $event->data->sender,
            'type'    => 'Credit',
            'narration' => $event->data->narration,
            'status' => 1
        ]);
    }
}