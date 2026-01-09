<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrgyCommitteePosition;
use Illuminate\Http\Request;

class CommitteePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brgy_committee = BrgyCommitteePosition::all()
        ->sortBy('committee_name');
        return view('admin.settings.brgy_position.committee', compact('brgy_committee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'committee_name' => 'required|string|max:255',
        ]);

        $result = BrgyCommitteePosition::create([
            'committee_name' => $request->committee_name,
        ]);

        if ($result) {
            return redirect()
                ->back()
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Committee Position created successfully.'
                ]);
        }

        return redirect()
            ->back()
            ->with('alert', [
                'type' => 'danger',
                'message' => 'Failed to create Committee Position. Please try again.'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BrgyCommitteePosition $committee_position)
    {
        $result = $committee_position;
        $committee_position->delete();

        if ($result) {
            return redirect()
                ->back()
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Committee Position deleted successfully.'
                ]);

            return redirect()
                ->back()
                ->with('alert', [
                    'type' => 'danger',
                    'message' => 'Failed to delete Committee Position. Please try again.'
                ]);
        }
    }
}