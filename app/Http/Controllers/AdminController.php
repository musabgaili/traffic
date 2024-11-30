<?php

namespace App\Http\Controllers;

use App\Models\Ras;
use App\Models\RasGroup;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $rasgroups = RasGroup::all();
        $all_rases = Ras::all();
        return view('admin.ras.index', compact('rasgroups', 'all_rases'));
    }

    function details($id)
    {
        $rasgroup = RasGroup::findOrFail($id);
        return view('admin.ras.details', compact('rasgroup'));
    }



    public function updateMessage(Request $request, $id)
    {
        $rasgroup = RasGroup::findOrFail($id);
        $rasgroup->current_message = $request->current_message;
        $rasgroup->save();

        // Update all related rases through many-to-many relationship
        foreach ($rasgroup->rases as $ras) {
            $ras->message = $request->current_message;
            $ras->save();
        }

        return redirect()->back()->with('success', 'Message updated successfully');
    }

    public function assignGroup(Request $request)
    {
        // logger($request);
        if (!$request->has('ras_ids') || !$request->has('group_id')) {
            return redirect()->back()->with('error', 'Please select devices and a group');
        }

        $rasgroup = RasGroup::findOrFail($request->group_id);

        // Get all selected Ras devices
        $rases = Ras::whereIn('id', $request->ras_ids)->get();

        // Attach each Ras to the group using the many-to-many relationship
        foreach ($rases as $ras) {
            $ras->groups()->attach($rasgroup->id);
        }

        return redirect()->back()->with('success', 'Devices assigned to group successfully');
    }


    public function showAll(Request $request)
    {
        $rasgroups = RasGroup::all();
        foreach ($rasgroups as $rasgroup) {
            $rasgroup->current_message = 'main';
            $rasgroup->save();
            // Update all related rases through many-to-many relationship
        }
        $rases = Ras::all();
        foreach ($rases as $ras) {
            $ras->message = 'main';
            $ras->save();
        }
        return redirect()->back()->with('success', 'All groups set to main message');
    }

    public function detachDevice(Request $request)
    {
        // return $request;
        // Validate request
        $request->validate([
            'ras_id' => 'required|exists:ras,id',
            'ras_group_id' => 'required|exists:ras_groups,id'
        ]);

        // Find the RAS device and group
        $ras = Ras::findOrFail($request->ras_id);
        $rasgroup = RasGroup::findOrFail($request->ras_group_id);

        // Detach the device from the group
        $ras->groups()->detach($rasgroup->id);

        return redirect()->back()->with('success', 'Device removed from group successfully');
    }
}
