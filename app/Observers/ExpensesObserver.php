<?php

namespace App\Observers;

use App\Models\OtherExpense;
use App\Models\FloatManagement;
use Illuminate\Support\Str;


class ExpensesObserver
{
    /**
     * Handle the OtherExpense "created" event.
     *
     * @param  \App\Models\OtherExpense  $otherExpense
     * @return void
     */
    public function created(OtherExpense $otherExpense)
    {
        $user_id = $otherExpense->user_id;
        $amount = $otherExpense->amount;
        $running_bal = FloatManagement::where('user_id', $user_id)
                                    ->orderBy('id','desc')
                                    ->pluck('running_balance')
                                    ->first();
        if(!$running_bal){
            $running_balance = 0 - $amount;
        }                                    
        $running_balance = (float)$running_bal - $amount;

        $data = [
            'transaction_type' => 'Debit',
            'transactio_ref' => $random = Str::random(40),
            'amount' => $amount,
            'user_id' => $user_id,
            'running_balance' => $running_balance,
        ];

       FloatManagement::create($data);
    }

    /**
     * Handle the OtherExpense "updated" event.
     *
     * @param  \App\Models\OtherExpense  $otherExpense
     * @return void
     */
    public function updated(OtherExpense $otherExpense)
    {
        //
    }

    /**
     * Handle the OtherExpense "deleted" event.
     *
     * @param  \App\Models\OtherExpense  $otherExpense
     * @return void
     */
    public function deleted(OtherExpense $otherExpense)
    {
        //
    }

    /**
     * Handle the OtherExpense "restored" event.
     *
     * @param  \App\Models\OtherExpense  $otherExpense
     * @return void
     */
    public function restored(OtherExpense $otherExpense)
    {
        //
    }

    /**
     * Handle the OtherExpense "force deleted" event.
     *
     * @param  \App\Models\OtherExpense  $otherExpense
     * @return void
     */
    public function forceDeleted(OtherExpense $otherExpense)
    {
        //
    }
}
