<?php

namespace App\Http\Requests;

class TariffComparisonRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'consumption' => 'required|integer|min:1'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'consumption' => 'Annual electricity consumption in kWh'
        ];
    }
}
