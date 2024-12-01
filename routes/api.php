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

Route::post('/get-image', function (Request $request) {
    // get image of the rasppery group
    try {
        $ras = Ras::where('id', $request->id)
            ->orWhere('unique_id', $request->unique_id)->first();

        if (!$ras->message) {
            return response()->json(['image' => 'main'], 200);
        }

        return response()->json(['image' => $ras->message], 200);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json(['message' => 'Error Happened'], 400,);
    }
});


Route::post('/set-image', function (Request $request) {
    // logger($request);
    $request->validate(['message'=> 'required']);
    $rasgroups = RasGroup::all();
    foreach ($rasgroups as $rasgroup) {
        $rasgroup->current_message = $request->message;
        $rasgroup->save();
        // Update all related rases through many-to-many relationship
    }
    $rases = Ras::all();
    foreach ($rases as $ras) {
        $ras->message = $request->message;
        $ras->save();
    }
});
