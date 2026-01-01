<?php

namespace App\Services;

use App\Models\Resident;
use App\Models\Purok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class ResidentService
{
    public function indexRequest(Request $request)
    {
        $residents = Resident::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // keep search during pagination

        $puroks = Purok::all();

        return view('admin.residents.index', compact('residents', 'puroks'));
    }


    public function storeRequest(Request $request)
    {
        DB::beginTransaction();

    try {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|in:jr,sr,ii,iii,iv,v',
            'email' => 'nullable|email|unique:residents,email',
            'phone_number' => 'nullable|string|max:20',
            'age' => 'nullable|integer|min:0|max:150',
            'birthdate' => 'nullable|date',
            'birthplace' => 'nullable|string|max:255',
            // 'street' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'civil_status' => 'nullable|in:single,married,widowed,separated',
            'voter_status' => 'nullable|in:registered_voter,non_voter',
            'description' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'purok_id'   => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('residents', 'public');
        }

        Resident::create($validated);

        DB::commit();
        return true;

        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function showRequest(Resident $resident)
    {
        return view('admin.residents.show', compact('resident'));
    }

    // public function editRequest(Resident $resident)
    // {
    //     return view('admin.residents.edit', compact('resident'));
    // }

    public function updateRequest(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|in:jr,sr,ii,iii,iv,v',

            'email' => 'nullable|email|unique:residents,email,' . $resident->id,
            'phone_number' => 'nullable|string|max:20',

            'age' => 'nullable|integer|min:0|max:150',
            'birthdate' => 'nullable|date',
            'birthplace' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',

            'gender' => 'nullable|in:male,female',
            'civil_status' => 'nullable|in:single,married,widowed,separated',
            'voter_status' => 'nullable|in:registered_voter,non_voter',

            'description' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // UPDATE PHOTO USING STORAGE
        if ($request->hasFile('photo')) {
            if ($resident->photo && Storage::disk('public')->exists($resident->photo)) {
                Storage::disk('public')->delete($resident->photo);
            }
            $validated['photo'] = $request->file('photo')
                ->store('residents', 'public');
        }

        $resident->update($validated);
    }

    public function deleteRequest(Resident $resident)
    {
        $resident->delete();
    }
}