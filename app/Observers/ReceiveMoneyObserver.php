<?php

namespace App\Observers;

use App\Models\MoneyReceived;
use App\Models\FloatManagement;

class ReceiveMoneyObserver
{
    /**
     * Handle the MoneyReceived "created" event.
     *
     * @param  \App\Models\MoneyReceived  $moneyReceived
     * @return void
     */
    public function created(MoneyReceived $moneyReceived)
    {
        $user_id = $moneyReceived->user_id;
        $amount = $moneyReceived->amount;
        $running_bal = FloatManagement::where('user_id', $user_id)
                                    ->orderBy('id','desc')
                                    ->pluck('running_balance')
                                    ->first();
        if ($running_bal) { 
        $running_balance = (float)$running_bal + $amount;
        }
        else{
            $running_balance = $amount;
        }
        $data = [
            'transaction_type' => 'Credit',
            'transactio_ref' => $moneyReceived->transaction_ref,
            'amount' => $amount,
            'user_id' => $user_id,
            'running_balance' => $running_balance,
        ];

        $floatManagement = FloatManagement::create($data);
    }

    /**
     * Handle the MoneyReceived "updated" event.
     *
     * @param  \App\Models\MoneyReceived  $moneyReceived
     * @return void
     */
    public function updated(MoneyReceived $moneyReceived)
    {
        //
    }

    /**
     * Handle the MoneyReceived "deleted" event.
     *
     * @param  \App\Models\MoneyReceived  $moneyReceived
     * @return void
     */
    public function deleted(MoneyReceived $moneyReceived)
    {
        //
    }

    /**
     * Handle the MoneyReceived "restored" event.
     *
     * @param  \App\Models\MoneyReceived  $moneyReceived
     * @return void
     */
    public function restored(MoneyReceived $moneyReceived)
    {
        //
    }

    /**
     * Handle the MoneyReceived "force deleted" event.
     *
     * @param  \App\Models\MoneyReceived  $moneyReceived
     * @return void
     */
    public function forceDeleted(MoneyReceived $moneyReceived)
    {
        //
    }
}
