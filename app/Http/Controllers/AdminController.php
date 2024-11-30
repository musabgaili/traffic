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

        return redirect()->back()->with('success', 'Message updated successfully');
    }

    public function assignGroup(Request $request)
    {
        // logger($request);
        if (!$request->has('ras_ids') || !$request->has('group_id')) {
            return redirect()->back()->with('error', 'Please select devices and a group');
        }

        $rasgroup = RasGroup::findOrFail($request->group_id);

        Ras::whereIn('id', $request->ras_ids)->update(['group_id' => $request->group_id]);

        return redirect()->back()->with('success', 'Devices assigned to group successfully');
    }
}
