<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrgyOfficialPosition;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $brgy_positions = BrgyOfficialPosition::latest()->get();
        return view('admin.settings.brgy_position.position', compact('brgy_positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
        ]);

        $result = BrgyOfficialPosition::create([
            'position' => $request->position,
        ]);

        if ($result) {
            return redirect()
                ->back()
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Position created successfully.'
                ]);
        }

        return redirect()
            ->back()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to create position. Please try again.'
            ]);
    }

    public function update(Request $request, BrgyOfficialPosition $position)
    {
        $request->validate([
            'position' => 'required|string|max:255',
        ]);

        $res = $position->update([
            'position' => $request->position,
        ]);

        if ($res) {
            return redirect()
                ->back()
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Position updated successfully.'
                ]);
        }

        return redirect()
            ->back()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to update position. Please try again.'
            ]);
    }


    public function destroy(BrgyOfficialPosition $position)
    {
        if ($position->delete()) {
            return redirect()
                ->back()
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Position deleted successfully.'
                ]);
        }

        return redirect()
            ->back()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to delete position. Please try again.'
            ]);
    }
}