<?php

namespace App\Providers;

use App\Listeners\LogWalletCredit;
use App\Listeners\CreateUserWallet;
use App\Events\NewUserVerifiesEmail;
use App\Events\UserTransferSucessFul;
use App\Events\WalletCreditValidated;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\LogFailedTransaction;
use App\Mail\DebitTransactionEmailAlert;
use App\Listeners\WelcomeNewUserListener;
use App\Listeners\LogSucessfulTransaction;
use App\Listeners\WalletTransactionUpdate;
use App\Events\WalletCreditFailedValidation;
use App\Listeners\SendEmailTransactionAlerts;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewUserVerifiesEmail::class => [
            CreateUserWallet::class,
            WelcomeNewUserListener::class,
        ],
        WalletCreditValidated::class => [
            WalletTransactionUpdate::class,
            LogWalletCredit::class,
        ],
        WalletCreditFailedValidation::class => [
            LogFailedTransaction::class,
        ],
        UserTransferSucessFul::class => [
            SendEmailTransactionAlerts::class,
            LogSucessfulTransaction::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}