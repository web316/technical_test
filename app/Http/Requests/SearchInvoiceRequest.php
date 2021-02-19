<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchInvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_from' => 'date|nullable',
            'date_to'   => 'date|nullable',
            'status'    => 'max:64|nullable',
            'location'  => 'integer|nullable',
        ];
    }
}
