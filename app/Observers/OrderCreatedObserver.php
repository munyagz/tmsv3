<?php

namespace App\Observers;

use App\Models\FleetData;
use App\Models\FloatManagement;

class OrderCreatedObserver
{
    /**
     * Handle the FleetData "created" event.
     *
     * @param  \App\Models\FleetData  $fleetData
     * @return void
     */
    public function created(FleetData $fleetData)
    {
        $user_id = $fleetData->user_id;
        $amount_paid_out = $fleetData->amount_paid_out;
        $running_bal = FloatManagement::where('user_id', $user_id)
                                    ->orderBy('id','desc')
                                    ->pluck('running_balance')
                                    ->first();
        $running_balance = (float)$running_bal - $amount_paid_out;

        $data = [
            'transaction_type' => 'Debit',
            'transactio_ref' => $fleetData->order_number,
            'amount' => $amount_paid_out,
            'user_id' => $user_id,
            'running_balance' => $running_balance,
        ];

        $floatManagement = FloatManagement::create($data);
    }

    /**
     * Handle the FleetData "updated" event.
     *
     * @param  \App\Models\FleetData  $fleetData
     * @return void
     */
    public function updated(FleetData $fleetData)
    {
        //
    }

    /**
     * Handle the FleetData "deleted" event.
     *
     * @param  \App\Models\FleetData  $fleetData
     * @return void
     */
    public function deleted(FleetData $fleetData)
    {
        //
    }

    /**
     * Handle the FleetData "restored" event.
     *
     * @param  \App\Models\FleetData  $fleetData
     * @return void
     */
    public function restored(FleetData $fleetData)
    {
        //
    }

    /**
     * Handle the FleetData "force deleted" event.
     *
     * @param  \App\Models\FleetData  $fleetData
     * @return void
     */
    public function forceDeleted(FleetData $fleetData)
    {
        //
    }
}
