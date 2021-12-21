<?php

namespace App\Observers;

use App\Models\SendFloat;
use App\Models\MoneyReceived;
use App\Models\FloatManagement;

class SendFloatObserver
{
    /**
     * Handle the SendFloat "created" event.
     *
     * @param  \App\Models\SendFloat  $sendFloat
     * @return void
     */
    public function created(SendFloat $sendFloat)
    {
        $user_id = $sendFloat->sent_by_id;
        $amount_paid_out = $sendFloat->amount;
        $running_bal = FloatManagement::where('user_id', $user_id)
                                    ->orderBy('id','desc')
                                    ->pluck('running_balance')
                                    ->first();
        if(!$running_bal){
            $running_bal = 0-$amount_paid_out;
        }
        $running_balance = (float)$running_bal - $amount_paid_out;

        $data = [
            'transaction_type' => 'Debit',
            'transactio_ref' => $sendFloat->transaction_ref,
            'amount' => $amount_paid_out,
            'user_id' => $user_id,
            'running_balance' => $running_balance,
        ];

        FloatManagement::create($data);

        $data2  = [
            'transaction_ref' => $sendFloat->transaction_ref,
            'amount' => $sendFloat->amount,
            'user_id' => $sendFloat->sent_to_id,
            'date_received' => $sendFloat->date_sent,
        ];

        MoneyReceived::create($data2);



    }

    /**
     * Handle the SendFloat "updated" event.
     *
     * @param  \App\Models\SendFloat  $sendFloat
     * @return void
     */
    public function updated(SendFloat $sendFloat)
    {
        //
    }

    /**
     * Handle the SendFloat "deleted" event.
     *
     * @param  \App\Models\SendFloat  $sendFloat
     * @return void
     */
    public function deleted(SendFloat $sendFloat)
    {
        //
    }

    /**
     * Handle the SendFloat "restored" event.
     *
     * @param  \App\Models\SendFloat  $sendFloat
     * @return void
     */
    public function restored(SendFloat $sendFloat)
    {
        //
    }

    /**
     * Handle the SendFloat "force deleted" event.
     *
     * @param  \App\Models\SendFloat  $sendFloat
     * @return void
     */
    public function forceDeleted(SendFloat $sendFloat)
    {
        //
    }
}
