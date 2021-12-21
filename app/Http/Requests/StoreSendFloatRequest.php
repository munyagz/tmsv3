<?php

namespace App\Http\Requests;

use App\Models\SendFloat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSendFloatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('send_float_create');
    }

    public function rules()
    {
        return [
            'date_sent' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'amount' => [
                'required',
            ],
            'transaction_ref' => [
                'string',
                'required',
                'unique:send_floats',
            ],
            'sent_to_id' => [
                'required',
                'integer',
            ],
            'sent_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
