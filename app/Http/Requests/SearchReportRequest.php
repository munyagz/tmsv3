<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_from' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'date_to' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ]
         
        ];
    }
}
