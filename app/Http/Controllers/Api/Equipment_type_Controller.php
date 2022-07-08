<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\StoreEquipmentRequest;
use App\Http\Requests\Equipment\UpdateEquipmentRequest;
use App\Http\Resources\Equipment_type_Resource;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Models\Equipment_type as Equipment_type;
use Illuminate\Http\Request;

class Equipment_type_Controller extends Controller
{
    public $id;
    public $type_name;
    public $serial_mask;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //view('index');
        return Equipment_type_Resource::collection(Equipment_type::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public static function store(StoreEquipmentRequest $request)
    {
        $equipment_t = Equipment_type::create($request->validated());
        $equipment_t = new Equipment_type_Resource($equipment_t);
        $equipment_t = Equipment_type_Resource::collection(Equipment_type::all());

        return response()->view('welcome', [
            /*            'equipment_s' => new EquipmentResource($equipment),*/
            'equipment_s' => $equipment_t
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Equipment_type_Resource
     */
    public function show($id)
    {
        return new Equipment_type_Resource(Equipment_type::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEquipmentRequest $request
     * @param Equipment_type $equipment
     * @return Equipment_type
     */
    /* public static function update(UpdateEquipment $request, Equipment $equipment)
     {

         $equipment->update($request->validated());

         return $equipment;
     }*/

    public static function update(UpdateEquipmentRequest $request, Equipment_type $equipment)
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
    public static function destroy(Equipment_type $equipment_t)
    {
        $equipment_t->delete();
        $equipment_s = Equipment_type_Resource::collection(Equipment_type::all());

        /* return response(null);*/

        return response()->view('welcome', [
            'equipment_t' => $equipment_t,
        ]);

    }

    public static function search_t(Request $request)
    {
        $s = $request->s;

        $equipment_t = Equipment_type::where('id', 'LIKE', '%' . $s . '%')
            ->OrWhere('type_name', 'LIKE', '%' . $s . '%')
            ->OrWhere('serial_mask', 'LIKE', '%' . $s . '%')
            ->get();

        /*return view ('welcome', [
            'equipment_s' => $equipment_s,
        ]);*/

        return response()->json([
            'equipment_t' => $equipment_t
        ], 200);

    }


}
