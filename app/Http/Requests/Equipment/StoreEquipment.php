<?php

namespace App\Http\Requests\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*return false;*/
        return true;
        /*return Auth::check();*/
        /*return auth()->check();*/
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'id_equipment_type' =>  'required',/*'unique:App\Models\Equipment,id_equipment_type',*/
            'serial_number' => 'required', /*|unique:App\Models\Equipment,serial_number',*/
            /*  'regex:/^([A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1})$/',

              'regex:/^([A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1}[A-Z]{2})$/'],*/

            'note' => 'required'
        ];

    }

    public function messages()
    {
        return [
            'serial_number.required' => 'Hey! You have to fill in the :attribute field.'
        ];
    }

}
