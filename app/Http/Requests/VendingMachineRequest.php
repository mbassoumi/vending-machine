<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendingMachineRequest extends FormRequest
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
            'with_card' => 'required',
            'usd_input' => 'required',
            'coins_input' => 'required',
            'code' => 'required',
        ];
    }
}
