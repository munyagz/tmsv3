<?php

namespace App\Http\Requests;

use App\Models\OtherExpense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOtherExpenseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('other_expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:other_expenses,id',
        ];
    }
}
