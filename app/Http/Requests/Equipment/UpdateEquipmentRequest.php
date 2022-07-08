<?php

namespace App\Http\Requests\Equipment;

use App\Http\Controllers\Api\Equipment_type_Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $equipment_types = \App\Models\Equipment_type::all();

        foreach ($equipment_types as $equipment_type){
            /*echo 'Equipment: '.$equipment_type['type_name'].'<br>';*/
            $ser = str_split($equipment_type['serial_mask']);
            $i=0;
            foreach ($ser as $sumb) {
                if ($sumb == 'N'){
                    $reg_sumb = '[A-Z0-9]';
                }
                elseif ($sumb == 'A'){
                    $reg_sumb = '[A-Z]';
                }
                elseif ($sumb == 'a'){
                    $reg_sumb = '[a-z]';
                }
                elseif ($sumb == 'X'){
                    $reg_sumb = '[A-Z0-9]';
                }
                elseif ($sumb == 'Z'){
                    $reg_sumb = '[-_@]';
                }
                $arr_reg[$i]=$reg_sumb;
                $i++;
            }
            $arrs[]=$arr_reg;

        }

        foreach ($arrs as $arr_w) {

            $arrs_reg[] = implode($arr_w);

        }

        return [
            'id_equipment_type' =>  'required',/*'unique:App\Models\Equipment,id_equipment_type',*/
              'serial_number' => 'required|unique:App\Models\Equipment|regex:/^([A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1}[A-Z]{2})$/',
            /*'serial_number' => 'required|unique:App\Models\Equipment|regex:/^('.Rule::in($arrs_reg).')$/',*/
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
