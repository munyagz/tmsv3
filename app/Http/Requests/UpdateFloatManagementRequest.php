<?php

namespace App\Http\Requests;

use App\Models\FloatManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFloatManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('float_management_edit');
    }

    public function rules()
    {
        return [
            'transaction_type' => [
                'string',
                'required',
            ],
            'transactio_ref' => [
                'string',
                'nullable',
            ],
            'amount' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
