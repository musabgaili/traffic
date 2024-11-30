<?php

use App\Http\Controllers\TrafficLightController;
use App\Http\Middleware\ApiTokenValidate;
use App\Models\Ras;
use App\Models\RasGroup;
use App\Models\TrafficLight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// register rasperry pi-->

// Route::get('/register', function (Request $request) {
//     try {
//         $ras =     Ras::create([
//             'unique_id' => $request->uniqe_id,
//         ]);
//         return response()->json(['message' => 'Registered Successfully'], 201,);
//     } catch (Exception $e) {
//         // error handling
//         return response()->json(['message' => 'Error Happened'], 400,);
//     }
// });

Route::get('/get-image', function (Request $request) {
    // get image of the rasppery group
    try {
        $ras = Ras::where('id', $request->id)
            ->orWhere('unique_id', $request->unique_id)->first();

        if (!$ras->group_id) {
            return response()->json(['image' => 'main'], 200);
        }

        $ras_group = RasGroup::where('id', $ras->group_id)->first();
        return response()->json(['image' => $ras_group->current_message], 200);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(['message' => 'Error Happened'], 400,);
    }
});
