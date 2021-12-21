<?php

namespace App\Http\Requests;

use App\Models\FleetData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFleetDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fleet_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fleet_datas,id',
        ];
    }
}
