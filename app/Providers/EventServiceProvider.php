<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\FleetData;
use App\Models\MoneyReceived;
use App\Models\SendFloat;
use App\Observers\OrderCreatedObserver;
use App\Observers\ReceiveMoneyObserver;
use App\Observers\SendFloatObserver;
use App\Models\OtherExpense;
use App\Observers\ExpensesObserver;


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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        MoneyReceived::observe(ReceiveMoneyObserver::class);
        FleetData::observe(OrderCreatedObserver::class);
        SendFloat::observe(SendFloatObserver::class);
        OtherExpense::observe(ExpensesObserver::class);
    }
}
