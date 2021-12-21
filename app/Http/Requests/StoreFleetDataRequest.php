<?php

namespace App\Http\Requests;

use App\Models\FleetData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFleetDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fleet_data_create');
    }

    public function rules()
    {
        return [
            'order_number' => [
                'string',
                'required',
                'unique:fleet_datas',
            ],
            'journey_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'vehicle_reg_no' => [
                'string',
                'required',
            ],
            'destination' => [
                'string',
                'required',
            ],
            'customer_name' => [
                'string',
                'required',
            ],
            'invoice_number' => [
                'string',
                'required',
                'unique:fleet_datas',
            ],
            'amount_paid_out' => [
                'required',
            ],
            'quantity' => [
                'string',
                'required',
            ],
        ];
    }
}
