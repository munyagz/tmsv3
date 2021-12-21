<?php

namespace App\Http\Requests;

use App\Models\MoneyReceived;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMoneyReceivedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('money_received_create');
    }

    public function rules()
    {
        return [
            'date_received' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'amount' => [
                'required',
            ],
            'transaction_ref' => [
                'string',
                'nullable',
            ],
        ];
    }
}
