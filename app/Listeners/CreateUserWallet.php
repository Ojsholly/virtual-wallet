<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Wallet;

class CreateUserWallet
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
        $wallet = new Wallet();
        $wallet->user_id = $event->user->uuid;
        $wallet->balance = '0.00';
        $wallet->save();
    }
}