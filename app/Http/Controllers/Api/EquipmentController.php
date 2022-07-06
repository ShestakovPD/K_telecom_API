<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\StoreEquipment;
use App\Http\Requests\Equipment\UpdateEquipment;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use http\Env\Response;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use mysql_xdevapi\Table;

class EquipmentController extends Controller
{
    public $id_equipment_type;
    public $serial_number;
    public $note;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //view('index');
        return EquipmentResource::collection(Equipment::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public static function store(StoreEquipment $request)
    {
        /*$ch = curl_init();

        $token = '2|tpoMNXkyaL08VSQ1wzvIJpUACOvJZMIoN92p2V1v';

        $arFields = [
            $request
        ];
        $jFields = json_encode($arFields, JSON_UNESCAPED_UNICODE);

        $arOptions = [
            CURLOPT_SSL_VERIFYPEER => false, //Проверка SSL сертификата
            CURLOPT_SSL_VERIFYHOST => false, //Проверка хоста на соответствие с SSL
            CURLOPT_HEADER => true, //Включаем передачу заголовка
            CURLOPT_RETURNTRANSFER => true, //Возврат результата
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . base64_encode($token),
                'Accept: application/json',
                'Content-Type: application/json'
            ], //Массив заголовков
            //CURLOPT_URL => $this->url . '/client/' . $id, //Загружаемый URL, куда посылаем
            CURLOPT_URL => 'http://ktel/api/equipment',
            CURLOPT_POST => true, //Передаем данные POST
            CURLOPT_POSTFIELDS => $jFields, //POST - запрос
        ];
        curl_setopt_array($ch, $arOptions);*/

        $equipment = Equipment::create($request->validated());
        $equipment = new EquipmentResource($equipment);
        $equipment_s = EquipmentResource::collection(Equipment::all());

        return response()->view ('welcome', [
            /*            'equipment_s' => new EquipmentResource($equipment),*/
            'equipment_s' => $equipment_s
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return new EquipmentResource(Equipment::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEquipment $request
     * @param Equipment $equipment
     * @return Equipment
     */
    public static function update(UpdateEquipment $request, Equipment $equipment)
    {

        $equipment->update($request->validated());

        return $equipment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy(Equipment $equipment)
    {
        /*$id=$equipment['id'];
        $ch = curl_init();

        $token = '2|tpoMNXkyaL08VSQ1wzvIJpUACOvJZMIoN92p2V1v';

        $arFields = [
            $equipment
        ];
        $jFields = json_encode($arFields, JSON_UNESCAPED_UNICODE);

        $arOptions = [
            CURLOPT_SSL_VERIFYPEER => false, //Проверка SSL сертификата
            CURLOPT_SSL_VERIFYHOST => false, //Проверка хоста на соответствие с SSL
            CURLOPT_HEADER => true, //Включаем передачу заголовка
            CURLOPT_RETURNTRANSFER => true, //Возврат результата
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . base64_encode($token),
                'Accept: application/json',
                'Content-Type: application/json'
            ], //Массив заголовков
            //CURLOPT_URL => $this->url . '/client/' . $id, //Загружаемый URL, куда посылаем
            CURLOPT_URL => 'http://ktel/api/equipment/`$id`',
            CURLOPT_POST => true, //Передаем данные POST
            CURLOPT_POSTFIELDS => $jFields, //POST - запрос
        ];
        curl_setopt_array($ch, $arOptions);*/

        $equipment->delete();
        $equipment_s = EquipmentResource::collection(Equipment::all());

        /* return response(null);*/

        return response()->view ('welcome', [
            'equipment_s' => $equipment_s,
        ]);

    }

    public static function search(Request $request)
    {
        $s = $request->s;

        $equipment_s = Equipment::where('id_equipment_type', 'LIKE', '%' . $s . '%')
            ->OrWhere('serial_number','LIKE', '%' . $s . '%')
            ->OrWhere('note','LIKE', '%' . $s . '%')
            ->get();

        /*return view ('welcome', [
            'equipment_s' => $equipment_s,
        ]);*/

        /*return EquipmentResource::collection(Equipment::all($equipment_s));*/

        return response()->json([
            'equipment_s' => $equipment_s
        ], 200);

    }

}
