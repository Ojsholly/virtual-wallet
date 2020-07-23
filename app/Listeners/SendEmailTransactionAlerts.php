<?php

namespace App\Listeners;

use App\User;
use App\Mail\TransactionEmailAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DebitTransactionEmailAlert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailTransactionAlerts
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

        Mail::to($event->recipient->email)->send(new TransactionEmailAlert($event->data));

        Mail::to(Auth::user()->email)->send(new DebitTransactionEmailAlert($event->data));
    }
}