<?php

namespace App\Http\Requests;

use App\Models\OtherExpense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOtherExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('other_expense_create');
    }

    public function rules()
    {
        return [
            'expense_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
            ],
            'date_spent' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
