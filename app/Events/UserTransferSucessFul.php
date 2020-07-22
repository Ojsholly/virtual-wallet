<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTransferSucessFul
{

    public $recipient_data;
    public $data;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($recipient_data, $data)
    {
        //

        $this->recipient = $recipient_data;
        $this->data = $data;
    }
}