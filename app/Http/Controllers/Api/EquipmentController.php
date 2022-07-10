<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\StoreEquipmentRequest;
use App\Http\Requests\Equipment\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class EquipmentController extends Controller
{
    public $id_equipment_type;
    public $serial_number;
    public $note;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //view('index');
        return EquipmentResource::collection(Equipment::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEquipmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function store(StoreEquipmentRequest $request)
    {

        $equipment = Equipment::create($request->validated());
        $equipment = new EquipmentResource($equipment);
        /*  $equipment_s = EquipmentResource::collection(Equipment::all());

          return response()->view ('welcome', [
                        // 'equipment_s' => new EquipmentResource($equipment),
              'equipment_s' => $equipment_s
          ]);*/                                         // для отображения во view

        return response()->json([
            'equipment' => $equipment
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return EquipmentResource
     */
    public function show($id)
    {
        //
        return new EquipmentResource(Equipment::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEquipmentRequest $request
     * @param Equipment $equipment
     * @return Equipment
     */

    public static function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {

        $equipment->update($request->validated());

        return $equipment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Equipment $equipment
     * @return \Illuminate\Http\JsonResponse
     */
    public static function destroy(Equipment $equipment)
    {

        $equipment->delete();
        $equipment_s = EquipmentResource::collection(Equipment::all());

        /*return response(null);

        return response()->view ('welcome', [
            'equipment_s' => $equipment_s,
        ]);*/      // для отображения во view

        return response()->json([
            'equipment_s' => $equipment_s
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $s = $request->s;

        $equipment_s = Equipment::where('id_equipment_type', 'LIKE', '%' . $s . '%')
            ->OrWhere('serial_number', 'LIKE', '%' . $s . '%')
            ->OrWhere('note', 'LIKE', '%' . $s . '%')
            ->get();

        return response()->json([
            'equipment_s' => $equipment_s
        ], 200);

    }

}
