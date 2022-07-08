<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
/*    $equipment_types = \App\Models\Equipment_type::all();

    foreach ($equipment_types as $equipment_type){
        echo 'Equipment: '.$equipment_type['type_name'].'<br>';
        $ser = str_split($equipment_type['serial_mask']);'<br>';
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
    '<pre>'.var_dump($arrs).'</pre>';
    $q=0;
    foreach ($arrs as $arr_w) {

        $arrs_reg = implode($arr_w);
        '<pre>'.var_dump($arrs_reg).'</pre>';
    }*/

/*N = [A-Z0-9]{1}
A = [A-Z]{1}
a = [a-z]{1}
X = [A-Z0-9]{1}
Z =  [-_@]

regex:/^([A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1}[A-Z]{2})$/*/

    return view('welcome');
});
