<?php

namespace App\Http\Requests;

use App\Models\SendFloat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySendFloatRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('send_float_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:send_floats,id',
        ];
    }
}
