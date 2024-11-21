<?php

namespace App\Services;

use App\Models\TrafficLight;
use Illuminate\Http\Request;

class SystemColorService
{
    // set system color after traffic light color change
    public function setSystemColorAfterTrafficLightColorChange(Request $request, TrafficLight $trafficLight)
    {
        // get previous color
        $previousColor = $trafficLight->systemColors()->latest()->first();

        // if previous color is red and current color is same, update time limit only

        // if ai is not working, or the request time limit is not set, light color will be changed after 1 minutes
        if (!$request->time_limit) {
            $light_color_time_limit = now()->addMinutes(1);
        } else {
            $light_color_time_limit = $request->time_limit;
        }

        if ($previousColor->color == $trafficLight->color) {
            $trafficLight->systemColors()->create([
                'time_limit' => $light_color_time_limit,
            ]);
        }
    }

    /*
     * Color Change Logic:
     *
     * When traffic light color changes:
     * 1. Gets the most recent color record for the traffic light
     *
     * 2. Time limit handling:
     *    - If no time_limit provided in request (AI not working):
     *      Sets default 1 minute time limit
     *    - If time_limit exists in request:
     *      Uses the requested time limit
     *
     * 3. Color comparison:
     *    - If new color matches previous color:
     *      Creates new color record with updated time limit
     *      This allows tracking sequential periods of same color
     *    - If color is different:
     *      No new record created (handled elsewhere)
     *
     * This enables monitoring how long each color phase lasts
     * and maintains history of color changes with their durations
     */

}
