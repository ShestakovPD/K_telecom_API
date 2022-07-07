<?php

namespace App\Http\Requests\Equipment;

use App\Http\Controllers\Api\Equipment_type_Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateEquipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
       // return true;
        return Auth::check();
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
            'serial_number' => 'required|unique:App\Models\Equipment|regex:/^([A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1}[A-Z]{2})$/',
            'note' => 'required'
        ];

    }

    public function messages(): array
    {
        return [
            'id_equipment_type.required' => 'Вы не ввели данные в поле :attribute.',
            'serial_number.required' => 'Вы не ввели данные в поле :attribute.',
            'serial_number.unique' => 'Вы ввели данные, которые уже есть в базе в поле :attribute, и точно с ними совпадают.',
            'serial_number.regex' => 'Вы ввели данные в поле :attribute, которые не соответствуют заданной маске',
            'note.required' => 'Вы не ввели данные в поле :attribute.',
        ];
    }

}
